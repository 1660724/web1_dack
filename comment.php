<?php
  require_once 'init.php';
  require_once 'functions.php';
  if(!isset($_SESSION['email']))
  {
    header('Location: login.php');
  }
  include 'header.php';
  $post = findPost($_GET['id']);
  
  $mainuser = findUserByID($post['userid']);
  $currentUser= findUserByEmail($_SESSION['email']);
  if(isset($_POST['likeda']) && $_POST['likeda']==$post['id'].'like')
    {
      addReaction($post['id'],'liked','');
    }
    if(isset($_POST['likeda']) && $_POST['likeda']==$post['id'].'unlike')
    {
      removeReaction($post['id'],'liked');
    }
    if(isset($_POST['deletez']))
    {
        deletePost($_POST['deletez']);
        header('Location: index.php');
    }
    if(isset($_POST['commentContent']))
    {
        if($_POST['commentContent']!="")
        insertComment($_GET['id'],$currentUser['id'],$_POST['commentContent']);
        
    }
    else{ }
    $cmts=findComment($_GET['id']);

?>
<script>
//chan resub
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
   }
   //Keep the scrolling position after reload page
   document.addEventListener('DOMContentLoaded', function() {
  var sep = '\uE000'; // an unusual char: unicode 'Private Use, First'

  window.addEventListener('pagehide', function(e) {
    window.name += sep + window.pageXOffset + sep + window.pageYOffset;
  });

  if(window.name && window.name.indexOf(sep) > -1)
  {
    var parts = window.name.split(sep);
    if(parts.length >= 3)
    {
      window.name = parts[0];
      window.scrollTo(parseFloat(parts[parts.length - 2]), parseFloat(parts[parts.length - 1]));
    }
  }
});
    
</script>
<style>
#field
{
    height:50px;
    width:100%;
    font-size:14pt;
}</style>

<div class="card">
<div class="card-header"style="background-color:#6CC3B6;" > 
<h5><img style ="width:50px;height:50px;" src="./profile_picture/<?php echo $mainuser['image'];?>"> <a href="profile.php?id=<?php echo $post['userid'];?>"><?php echo $mainuser['fullname'];?></a> 
     </h5>
     
    </div>
    <div class="card-body">
    <h6><?php if($post['type']==0) echo "Chế độ Công khai";
          if($post['type']==1) echo "Chế độ Bạn bè"; 
          if($post['type']==2) echo "Chế độ Chỉ mình tôi";    ?></h6>
    <h6 class="card-subtitle mb-2 text-muted"><?php echo $post['createdAt'];?></h6>
    <p class="card-text"><?php echo $post['content'];?></p>
    <?php if($post['image'] != '') : ?>

      <img src="status_picture/<?php echo $post['image']; ?>"/>

<?php endif; ?>
    <p class="card-text"><?php echo countLikes($post['id']);?>  Thích    <?php echo countComment($post['id']) ?> Bình luận</p>
    
    <form id="abc" method="post">
    <?php if(isLiked($post['id']) == 0): ?>
      <button name="likeda" type="submit" class="btn btn-primary"value= "<?php echo $post['id'].'like';?>">Thích</button>
    <?php else: ?>
      <button name="likeda" type="submit" class="btn btn-danger"value= "<?php echo $post['id'].'unlike';?>">Bỏ thích</button>
    <?php endif; ?> 
  <?php if($post['userid']===$currentUser['id']):?>
  <button name="deletez" type="submit" value="<?php echo $post['id'];?>" class="btn btn-secondary">Xóa bài</button>
<?php endif;?>
    </form> 
  </div>
</div>
    <?php foreach($cmts as $cmt): ?>
    <?php $cmtuser=findUserByID($cmt['userid']); ?>
    <div class="card">
  <div class="card-body">
    <h5 class="card-title"><img style ="width:50px;height:50px;" src="./profile_picture/<?php echo $cmtuser['image']?>"><a href="profile.php?id=<?php echo $cmtuser['id'];?>"><?php echo $cmtuser['fullname'] ;  ?></a>   <?php echo $cmt['content']; ?></h5>

  </div>
</div>
    <?php endforeach; ?>
<!--<div class="form-group">
  <label for="comment">Comment:</label>
  <textarea class="form-control" rows="5" id="comment"></textarea>
</div>-->
<label for="comment">Bình luận:</label>
<form id="myform" action="comment.php?id=<?php echo $_GET['id'];?>" method ="post">
    <input type="text" id="field" name="commentContent"/>
</form>
<script>
    $(function () {
        $("#field").keyup(function (event) {
            if (event.which === 13) {
                document.myform.submit();
            }
        }
    });
    
</script>

