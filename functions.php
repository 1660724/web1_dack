<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require 'vendor/autoload.php';
    
    function RandomString()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < 10; $i++) {
            $randstring .= $characters[rand(0, strlen($characters))];
        }
        return $randstring;
    }
    function createResetPassword ($userid)
    {
        global $db;
        $secret=RandomString();
        $query = $db->prepare("INSERT INTO reset_passwords(userid,secret,used) VALUES(?,?,0)");
        $query->execute([$userid,$secret]);
        return $secret;
    }
    function sendEmail ($email,$receiver,$subject, $content)
    {
        $mail = new PHPMailer(true); 
        try {
            //Server settings
            //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'vinhhuynhdota2@gmail.com';                 // SMTP username
            $mail->Password = 'manller123';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to
        
            //Recipients
            $mail->setFrom('vinhhuynhdota2@gmail.com', 'LTWeb1');
            $mail->addAddress($email, $receiver);     // Add a recipient
        
        
        
            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $content;
        
            $mail->send();
           return true;
            } 
            catch (Exception $e) {return false;}   
    }

function findUserByID($id) 
{
    global $db;
    $stmt=$db->prepare("SELECT * FROM users WHERE id=? ");
    $stmt->execute([$id]);
    $user=$stmt->fetch(PDO::FETCH_ASSOC);
    return $user;
}
function findUserByEmail($email) {
    global $db;
    $stmt=$db->prepare("SELECT * FROM users WHERE email=?");
    $stmt->execute(array($email));
    $user=$stmt->fetch(PDO::FETCH_ASSOC);
    return $user;
}
function findAllPostsPublic() {
    global $db;
    $stmt=$db->prepare("SELECT p.*,u.fullname FROM posts AS p LEFT JOIN users AS u ON u.id=p.userId where type=0 or type=2 or type =1 ORDER BY createdAt DESC");
    $stmt->execute();
    $posts=$stmt->fetchAll(PDO::FETCH_ASSOC);
    return $posts;
}

function createUser($email,$fullName,$passwordHash){
    $img="default.image.jpg";
    global $db;
    $stmt=$db->prepare("INSERT INTO users(email,fullName, password) VALUES(?, ?, ?)");
    $stmt->execute(array($email,$fullName,$passwordHash));
    $posts=$stmt->fetchAll(PDO::FETCH_ASSOC);
    return $db->lastInsertId(); 
}
function changePass($email,$passwordHash)
{
    global $db;
    $stmt=$db -> prepare("UPDATE users set password = ? WHERE email =?");
    $stmt->execute(array($passwordHash,$_SESSION['email']));
}
function addReaction($postid,$reaction,$comment)
{
    $curUser = getCurrentUser();
    global $db;
    $stmt= $db->prepare("insert into reactions(postid,reactorid,reaction,comment) VALUES(?,?,?,?)");
    $stmt->execute([$postid,$curUser['id'],$reaction,$comment]);
}
function getCurrentUser()
{
    global $db;
    $stmt=$db->prepare("SELECT* FROM users where email=?");
    $stmt->execute([$_SESSION['email']]);
    $user=$stmt->fetch(PDO::FETCH_ASSOC);
    return $user;

}
function countLikes($postid)
{
    global $db;
    $stmt=$db->prepare("SELECT * FROM reactions WHERE postid=? AND reaction=?");
    $stmt->execute([$postid,'liked']);
    $likes = 0;
    while($row = $stmt->fetch(PDO::FETCH_ASSOC))
        $likes++;
    return $likes;
}
function isLiked($postid)
{
    $curUser = getCurrentUser();
    global $db;
    $stmt=$db->prepare("SELECT * FROM reactions WHERE postid=? AND reaction=? AND reactorid=?");
    $stmt->execute([$postid,'liked',$curUser['id']]);
    $check = $stmt->fetch(PDO::FETCH_ASSOC);
    if($check)
        return 1;
    return 0;
}
function removeReaction($postid,$reaction)
{
    $curUser = getCurrentUser();
    global $db;
    $stmt= $db->prepare("DELETE FROM reactions WHERE postid=? AND reactorid=? AND reaction=?");
    $stmt->execute([$postid,$curUser['id'],$reaction]);
}
function resizeImage($file, $w, $h, $crop=FALSE,$output) 
{
    list($width, $height) = getimagesize($file);
    $r = $width / $height;
    if ($crop) {
        if ($width > $height) {
            $width = ceil($width-($width*abs($r-$w/$h)));
        } else {
            $height = ceil($height-($height*abs($r-$w/$h)));
        }
        $newwidth = $w;
        $newheight = $h;
    } else {
        if ($w/$h > $r) {
            $newwidth = $h*$r;
            $newheight = $h;
        } else {
            $newheight = $w/$r;
            $newwidth = $w;
        }
    }
    $src = imagecreatefromjpeg($file);
    $dst = imagecreatetruecolor($newwidth, $newheight);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    imagejpeg($dst, $output);
}
function checkPic($postid)
{
    global $db;
    $stmt=$db->prepare("SELECT * FROM posts WHERE id=?");
    $stmt->execute([$postid]);
    $num=$stmt->fetch(PDO::FETCH_ASSOC);
    return $num;
}
function findRelationship($user1id,$user2id){
    global $db;
    $stmt=$db->prepare("SELECT * from friends WHERE user1id=? and user2id=? or user1id=? and user2id=?");
    $stmt->execute(array($user1id,$user2id,$user2id,$user1id));
    $posts=$stmt->fetchAll(PDO::FETCH_ASSOC);
    return $posts;
}

function addRelationship($user1id,$user2id){
    global $db;
    $stmt=$db->prepare("INSERT INTO friends(user1id,user2id) VALUES(?,?)");
    $stmt->execute(array($user1id,$user2id));
}
function removeRelationship($user1id,$user2id)
{
    global $db;
    $stmt=$db->prepare("DELETE from friends where (user1id=? and user2id=?) or (user1id=? and user2id=?)");
    $stmt->execute(array($user1id,$user2id,$user2id,$user1id));
}
function findAllPostsPublicWithId($id) {
    global $db;
    $stmt=$db->prepare("SELECT p.*,users.fullname FROM posts p,users where p.userid=users.id and p.userid=? and type=0  ORDER BY createdAt DESC");
    $stmt->execute([$id]);
    $posts=$stmt->fetchAll(PDO::FETCH_ASSOC);
    return $posts;
}
function findAllPostsPublicWithIdisFriend($id) 
{
    global $db;
    $stmt=$db->prepare("SELECT p.*,users.fullname FROM posts p,users where p.userid=users.id and p.userid=? and (type=0 or type=1)  ORDER BY createdAt DESC");
    $stmt->execute([$id]);
    $posts=$stmt->fetchAll(PDO::FETCH_ASSOC);
    return $posts;
}
function ShowFriends($currentId)
{
    
    global $db;
    $stmt=$db->prepare("SELECT * FROM users where id!=?");
    $stmt->execute([$currentId]);
    while($friends=$stmt->fetch(PDO::FETCH_ASSOC))
    {
        $relationship =findRelationship($currentId , $friends['id']);
        $isFriend=count($relationship)===2;
        if($isFriend==1)
        {
           echo '<div class="card">
           <div class="card-header"><img style ="width:50px;height:50px;" src="./profile_picture/'.$friends['image'].'"><a href="profile.php?id='.$friends['id'].'">
             '. $friends['fullname'].'</a>
           </div>
         </div>';
        } 
}
}
function ShowRequest($currentId)
{
    global $db;
    $stmt=$db->prepare("SELECT * FROM users where id!=? ");
    $stmt->execute([$currentId]);
    
      while($friends=$stmt->fetch(PDO::FETCH_ASSOC))
      {
          $relationship =findRelationship($currentId , $friends['id']);
          if(count($relationship)===1){
            $isRequesting = $relationship[0]['user2id']===$currentId;
            if($isRequesting)
             {  $userpic=findUserByID($friends['id']);
                 echo '<div class="card">
             <div class="card-header"><img style ="width:50px;height:50px;" src="./profile_picture/'.$userpic['image'].'"><a href="profile.php?id='.$friends['id'].'">
               '. $friends['fullname'].'</a>
             </div>
           </div>';
        }
          }
          
          } 
}
function CountRequest($currentId)
{   
    $i = 0;
    global $db;
    $stmt=$db->prepare("SELECT * FROM users where id!=? ");
    $stmt->execute([$currentId]);
    
      while($friends=$stmt->fetch(PDO::FETCH_ASSOC))
      {
          $relationship =findRelationship($currentId , $friends['id']);
          if(count($relationship)===1){
            $isRequesting = $relationship[0]['user2id']===$currentId;
            if($isRequesting)
             {$i++;
        }
          }
          
          } 
          return $i;
}
function findAllMyPosts($id) {
    global $db;
    $stmt=$db->prepare("SELECT p.*,u.fullName FROM posts AS p LEFT JOIN users AS u ON u.id=p.userId where userid=? ORDER BY createdAt DESC");
    $stmt->execute([$id]);
    $posts=$stmt->fetchAll(PDO::FETCH_ASSOC);
    return $posts;
}
function deletePost($postid)
{
    global $db;
    $stmt=$db->prepare("DELETE from posts where id =?");
    $stmt->execute([$postid]);
}
function countPost($id)
{
    global $db;
    $stmt=$db->prepare("SELECT * from posts where userid =?");
    $stmt->execute([$id]);
    $count = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if($count) return 1;
    return 0;
}
function findPost($postid)
{
    global $db;
    $stmt=$db->prepare("SELECT * from posts where id =?");
    $stmt->execute([$postid]);
    $count = $stmt->fetch(PDO::FETCH_ASSOC);
    return $count;
}
function insertComment($postid,$userid,$content)
{
    global $db;
    $stmt= $db->prepare("INSERT into comments(postid,userid,content) values(?,?,?)");
    $stmt->execute([$postid,$userid,$content]);
    $cmt=$stmt->fetchAll(PDO::FETCH_ASSOC);
    return $cmt;
}
function findComment($postid)
{
    global $db;
    $stmt= $db->prepare("SELECT * FROM comments where postid=?");
    $stmt->execute([$postid]);
    $cmt=$stmt->fetchAll(PDO::FETCH_ASSOC);
    return $cmt;
}
function countComment($postid)
{   
    $i=0;
    global $db;
    $stmt= $db->prepare("SELECT * FROM comments where postid=?");
    $stmt->execute([$postid]);
    while($cmt=$stmt->fetch(PDO::FETCH_ASSOC))
    {
        if($cmt)
        $i++;
    }
    return $i;
}
function ShowRequestFriends($currentId)
{
    global $db;
    $stmt=$db->prepare("SELECT * FROM users where id!=?");
    $stmt->execute([$currentId]);
  
    while($friends=$stmt->fetch(PDO::FETCH_ASSOC))
    {    
        
        $relationship =findRelationship($currentId , $friends['id']);
        $noRelationship =count($relationship)===0;
        
        if($noRelationship==1)
        {
           echo '<div class="card">
           <div class="card-header"><img style ="width:50px;height:50px;" src="./profile_picture/'.$friends['image'].'"><a href="profile.php?id='.$friends['id'].'">
             '. $friends['fullname'].'</a>
           </div>
         </div>';
        } 
}
}
function findPeoples($fullname)
{
    global $db;
    $stmt=$db->prepare("SELECT * FROM users WHERE fullname like ? ");
    $stmt->execute([$fullname]);
    while($friends=$stmt->fetch(PDO::FETCH_ASSOC))
    {
        echo '<div class="card">
           <div class="card-header"><img style ="width:50px;height:50px;" src="./profile_picture/'.$friends['image'].'"><a href="profile.php?id='.$friends['id'].'">
             '. $friends['fullname'].'</a>
           </div>
         </div>';
    }
    
}

function test($content)
{
    echo $content;
}
function findResetPassword($string)
{
    global $db;
    $stmt=$db->prepare("SELECT * FROM reset_passwords WHERE secret =? ");
    $stmt->execute([$string]);
    $reset=$stmt->fetch(PDO::FETCH_ASSOC);
    return $reset;
}
function verifyAccount($email)
{
    global $db;
    $stmt=$db->prepare("UPDATE users set active =1 where email=? ");
    $stmt->execute([$email]);
}
function findPostContentNoFriend($email,$content)
{
    global $db;
    $stmt=$db->prepare("SELECT * from posts where content  =? and type =0");
    $stmt->execute([$content]);
    $find = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $find;
}
function findPostContentFriend($email,$content)
{
    global $db;
    $stmt=$db->prepare("SELECT * from posts where content  =? and (type =0 or type=1)");
    $stmt->execute([$content]);
    $find = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $find;
}
function checkFriend($currentuserid,$id)
{
    $relationship =findRelationship($currentuserid , $id);
  $isFriend=count($relationship);
  
  if($isFriend==2) return true;
  else return false ;
}
function findAllPostsPublicContent($content1)
{
    global $db;
    $stmt=$db->prepare("SELECT p.*,u.fullname FROM posts AS p LEFT JOIN users AS u ON u.id=p.userId where  content like ? ORDER BY createdAt DESC");
    $stmt->execute([$content1]);
    $posts=$stmt->fetchAll(PDO::FETCH_ASSOC);
    return $posts;
}