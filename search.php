<?php
  require_once 'init.php';
  require_once 'functions.php';
  if(!isset($_SESSION['email']))
  {
    header('Location: login.php');
  }
  include 'header.php';
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
  <form id="myform" action="search.php" method ="post">
   <label for="comment">Tìm kiếm:</label> 
  <select class="form-group" name="type">
    <option value="0" >Mọi người </option>
    <option value="1"selected="selected" >Bài viết</option>  
</select>
    <input type="text" style ="width:60%;height:35px;" id="field" name="searchContent"/>
    <button type="submit" name="submit" class="btn btn-primary">Tìm</button>
</form>
<?php if(isset($_POST['submit'])):?>
  <?php
      $searchContent = $_POST['searchContent'];
      $type=$_POST['type'];?>   
     <?php if($searchContent!="") : ?>
        <?php if($type==0): //1?>
        <?php $name = '%'.$_POST['searchContent'].'%';
       findPeoples($name);
        ?>
        <?php endif; //1?>

        <?php if($type==1): //2?>
        <?php
          $contentz = '%'.$_POST['searchContent'].'%';
          $posts = findAllPostsPublicContent($contentz);
          //var_dump ($posts);
          foreach($posts as $post)
              {
                if(isset($_POST['likedv']) && $_POST['likedv']==$post['id'].'like')
                {
                  addReaction($post['id'],'liked','');
                }
                if(isset($_POST['likedv']) && $_POST['likedv']==$post['id'].'unlike')
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
     
    <?php else: ?>
     
    <?php endif; ?> 
    <a href="comment.php?id=<?php echo $post['id'];?>" target="_self"><input type="button" value="Bình luận" class="btn btn-success"></a>
  <?php if($post['userid']===$currentUser['id']):?>
 
  
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
     
    <?php else: ?>

    <?php endif; ?> 
    <a href="comment.php?id=<?php echo $post['id'];?>" target="_self"><input type="button" value="Bình luận" class="btn btn-success"></a>
  <?php if($post['userid']===$currentUser['id']):?>
  
  
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
    
    <?php else: ?>
     
    <?php endif; ?> 
    <a href="comment.php?id=<?php echo $post['id'];?>" target="_self"><input type="button" value="Bình luận" class="btn btn-success"></a>
  <?php if($post['userid']===$currentUser['id']):?>

  
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

    <?php else: ?>

    <?php endif; ?> 
    <a href="comment.php?id=<?php echo $post['id'];?>" target="_self"><input type="button" value="Bình luận" class="btn btn-success"></a>
  <?php if($post['userid']===$currentUser['id']):?>

  
<?php endif;?>
    </form>
  </div>
</div>
<?php endif;?>
<?php endif;?> <?php ///////?>


<?php endforeach; ?>
        <?php endif; //2?>
     <?php endif; ?> 
<?php endif; ?>