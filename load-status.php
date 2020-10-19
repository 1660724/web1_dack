<?php
     require_once 'init.php';
     if( !isset($_POST['post'])  &&!isset($_FILES['statusPicture']['name'] )){
        header('Location: index.php');
    }
    $content =$_POST['post'];
    $img_name = $_FILES['statusPicture']['name'];       
    $type = $_POST['type'];
    $user =   findUserByEmail($_SESSION['email']);

   
    

    //$content = htmlentities($content);

    $fileName = $_FILES['statusPicture']['name'];

    if(!empty($fileName))
    {
        $fileName = time().$fileName;

    $fileTemp = $_FILES['statusPicture']['tmp_name'];
    $newPath = 'status_picture/'.$fileName;

   move_uploaded_file($fileTemp, $newPath);
   resizeImage($newPath,400,400,false,$newPath);
    }

    $stmt = $db->prepare("INSERT INTO posts(content,userid,createdAt,type,pic,image) VALUES(?,?,now(),?,?,?)");
    $stmt->execute([$content,$user['id'],$type,1,$fileName]);
   
    header('Location: index.php');
?>