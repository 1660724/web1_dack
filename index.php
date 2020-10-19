<?php
  require_once 'init.php';
  require_once 'functions.php';
  if(!isset($_SESSION['email']))
  {
    header('Location: login.php');
  }
  $page = 'index';
  $posts = findAllPostsPublic();
  

  foreach($posts as $post)
  {
    if(isset($_POST['liked']) && $_POST['liked']==$post['id'].'like')
    {
      addReaction($post['id'],'liked','');
    }
    if(isset($_POST['liked']) && $_POST['liked']==$post['id'].'unlike')
    {
      removeReaction($post['id'],'liked');
    }
    if(isset($_POST['delete']))
    {
        deletePost($_POST['delete']);
        header('Location: index.php');
    }
    
  }

?>
<?php $count =CountRequest($user['id']); ?>
<?php include 'header.php'; ?>
<h2>Trang Chủ</h2>
<p><?php if($currentUser): ?>
Xin Chào <img style ="width:45px;height:45px;" src="./profile_picture/<?php echo $currentUser['image']?>"> <a href="profile.php?id=<?php echo $currentUser['id'];?>"><?php echo $currentUser['fullname']; ?></a>. Chúc một ngày tốt lành.
<?php if($count>0):?>
<p><a href="list.php">Bạn có <?php echo $count; ?> lời mời kết bạn. </a> </p>
<?php endif;?>
<?php else: ?>
Chào mừng bạn đến với mạng xã hội... 
<?php endif; ?>
</p>

<!--Tham khảo source: https://stackoverflow.com/questions/6320113/how-to-prevent-form-resubmission-when-page-is-refreshed-f5-ctrlr -->
<!--Chức năng: chặn form resubmission -->



<?php foreach($posts as $post) : ?>

<?php if($post['type']==0):   ?>
<?php $userpic=findUserByID($post['userid']);?>
<div class="card">
<div class="card-header" style="background-color:#6CC3B6;"> 
<h5><img style ="width:50px;height:50px;" src="./profile_picture/<?php echo $userpic['image']?>"> <a href="profile.php?id=<?php echo $post['userid'];?>" ><?php echo $post['fullname'];?></a> 
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
    <p class="card-text"><?php echo countLikes($post['id']);?> Thích    <?php echo countComment($post['id']) ?> Bình luận</p>
    
    <form id="abc" method="post">
    <?php if(isLiked($post['id']) == 0): ?>
      <button name="liked" type="submit" class="btn btn-primary"value= "<?php echo $post['id'].'like';?>">Thích</button>
    <?php else: ?>
      <button name="liked" type="submit" class="btn btn-danger"value= "<?php echo $post['id'].'unlike';?>">Bỏ thích</button>
    <?php endif; ?> 
    <a href="comment.php?id=<?php echo $post['id'];?>" target="_self"><input type="button" value="Bình luận" class="btn btn-success"></a>
  <?php if($post['userid']===$currentUser['id']):?>
  <button name="delete" type="submit" value="<?php echo $post['id'];?>" class="btn btn-secondary">Xóa bài</button>
  
<?php endif;?>
    </form>
  </div>
</div>
<?php endif;?>  <?php ///////?> <?php //ko loi ?>
<?php if($post['type']==1): ?>
<?php if(checkFriend($currentUser['id'],$post['userid'])):?>
<?php $userpic=findUserByID($post['userid']);?>
<div class="card">
<div class="card-header" style="background-color:#6CC3B6;"> 
<h5><img style ="width:50px;height:50px;" src="./profile_picture/<?php echo $userpic['image']?>"> <a href="profile.php?id=<?php echo $post['userid'];?>" ><?php echo $post['fullname'];?></a> 
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
    <p class="card-text"><?php echo countLikes($post['id']);?> Thích    <?php echo countComment($post['id']) ?> Bình luận</p>
    
    <form id="abc" method="post">
    <?php if(isLiked($post['id']) == 0): ?>
      <button name="liked" type="submit" class="btn btn-primary"value= "<?php echo $post['id'].'like';?>">Thích</button>
    <?php else: ?>
      <button name="liked" type="submit" class="btn btn-danger"value= "<?php echo $post['id'].'unlike';?>">Bỏ thích</button>
    <?php endif; ?> 
    <a href="comment.php?id=<?php echo $post['id'];?>" target="_self"><input type="button" value="Bình luận" class="btn btn-success"></a>
  <?php if($post['userid']===$currentUser['id']):?>
  <button name="delete" type="submit" value="<?php echo $post['id'];?>" class="btn btn-secondary">Xóa bài</button>
  
<?php endif;?>
    </form>
  </div>
</div>
<?php endif;?>  <?php //chot?>
<?php if($currentUser['id']==$post['userid']) :?>
<?php $userpic=findUserByID($post['userid']);?>
<div class="card">
<div class="card-header" style="background-color:#6CC3B6;"> 
<h5><img style ="width:50px;height:50px;" src="./profile_picture/<?php echo $userpic['image']?>"> <a href="profile.php?id=<?php echo $post['userid'];?>" ><?php echo $post['fullname'];?></a> 
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
    <p class="card-text"><?php echo countLikes($post['id']);?> Thích    <?php echo countComment($post['id']) ?> Bình luận</p>
    
    <form id="abc" method="post">
    <?php if(isLiked($post['id']) == 0): ?>
      <button name="liked" type="submit" class="btn btn-primary"value= "<?php echo $post['id'].'like';?>">Thích</button>
    <?php else: ?>
      <button name="liked" type="submit" class="btn btn-danger"value= "<?php echo $post['id'].'unlike';?>">Bỏ thích</button>
    <?php endif; ?> 
    <a href="comment.php?id=<?php echo $post['id'];?>" target="_self"><input type="button" value="Bình luận" class="btn btn-success"></a>
  <?php if($post['userid']===$currentUser['id']):?>
  <button name="delete" type="submit" value="<?php echo $post['id'];?>" class="btn btn-secondary">Xóa bài</button>
  
<?php endif;?>
    </form>
  </div>
</div>
<?php endif;?>
<?php endif;?> <?php ///////?>
<?php if($post['type']==2): ?>
<?php if($currentUser['id']==$post['userid']):?>
<?php $userpic=findUserByID($post['userid']);?>
<div class="card">
<div class="card-header" style="background-color:#6CC3B6;"> 
<h5><img style ="width:50px;height:50px;" src="./profile_picture/<?php echo $userpic['image']?>"> <a href="profile.php?id=<?php echo $post['userid'];?>" ><?php echo $post['fullname'];?></a> 
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
    <p class="card-text"><?php echo countLikes($post['id']);?> Thích    <?php echo countComment($post['id']) ?> Bình luận</p>
    
    <form id="abc" method="post">
    <?php if(isLiked($post['id']) == 0): ?>
      <button name="liked" type="submit" class="btn btn-primary"value= "<?php echo $post['id'].'like';?>">Thích</button>
    <?php else: ?>
      <button name="liked" type="submit" class="btn btn-danger"value= "<?php echo $post['id'].'unlike';?>">Bỏ thích</button>
    <?php endif; ?> 
    <a href="comment.php?id=<?php echo $post['id'];?>" target="_self"><input type="button" value="Bình luận" class="btn btn-success"></a>
  <?php if($post['userid']===$currentUser['id']):?>
  <button name="delete" type="submit" value="<?php echo $post['id'];?>" class="btn btn-secondary">Xóa bài</button>
  
<?php endif;?>
    </form>
  </div>
</div>
<?php endif;?>
<?php endif;?> <?php ///////?>


<?php endforeach; ?>

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
<?php include 'footer.php'; ?>
