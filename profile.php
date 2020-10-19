<?php 
  require_once 'init.php';
  require_once 'functions.php';
  $page = 'profile';
  $user = findUserByID($_GET['id']);
  if(!$currentUser)
  {
    header('location:index.php');
    exit(0);

  }
  if($_GET['id']==$currentUser['id'])
  {
    header('location:personal.php');
  }
  $relationship =findRelationship($currentUser['id'] , $user['id']);
  $isFriend=count($relationship)===2;
  $noRelationship=count($relationship)===0;
  if(count($relationship)===1){
    $isRequesting = $relationship[0]['user1id']===$currentUser['id'];
  }
?>

<?php include 'header.php';

       if($isFriend)
      {
        $posts = findAllPostsPublicWithIdisFriend($_GET['id']);
      } 
       else{
         $posts=findAllPostsPublicWithId($_GET['id']);
       }
      //$posts = findAllPostsPublic();
      foreach($posts as $post)
  {
    if(isset($_POST['likeds']) && $_POST['likeds']==$post['id'].'like')
    {
      addReaction($post['id'],'liked','');
    }
    if(isset($_POST['likeds']) && $_POST['likeds']==$post['id'].'unlike')
    {
      removeReaction($post['id'],'liked');
    }
  }
      ?>





<style>
/***
User Profile Sidebar by @keenthemes
A component of Metronic Theme - #1 Selling Bootstrap 3 Admin Theme in Themeforest: http://j.mp/metronictheme
Licensed under MIT
***/

body {
    background: #F1F3FA;
    background-color: #B6D7DA;
  }
  
  /* Profile container */
  .profile {
    margin: 20px 0;
  }
  
  /* Profile sidebar */
  .profile-sidebar {
    padding: 20px 0 10px 0;
    background: #fff;
  }
  
  .profile-userpic img {
    float: none;
    margin: 0 auto;
    width: 50%;
    height: 50%;
    -webkit-border-radius: 50% !important;
    -moz-border-radius: 50% !important;
    border-radius: 50% !important;
  }
  
  .profile-usertitle {
    text-align: center;
    margin-top: 20px;
  }
  
  .profile-usertitle-name {
    color: #5a7391;
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 7px;
  }
  
  .profile-usertitle-job {
    text-transform: uppercase;
    color: #5b9bd1;
    font-size: 12px;
    font-weight: 600;
    margin-bottom: 15px;
  }
  
  .profile-userbuttons {
    text-align: center;
    margin-top: 10px;
  }
  
  .profile-userbuttons .btn {
    text-transform: uppercase;
    font-size: 11px;
    font-weight: 600;
    padding: 6px 15px;
    margin-right: 5px;
  }
  
  .profile-userbuttons .btn:last-child {
    margin-right: 0px;
  }
      
  .profile-usermenu {
    margin-top: 30px;
  }
  
  .profile-usermenu ul li {
    border-bottom: 1px solid #f0f4f7;
  }
  
  .profile-usermenu ul li:last-child {
    border-bottom: none;
  }
  
  .profile-usermenu ul li a {
    color: #93a3b5;
    font-size: 14px;
    font-weight: 400;
  }
  
  .profile-usermenu ul li a i {
    margin-right: 8px;
    font-size: 14px;
  }
  
  .profile-usermenu ul li a:hover {
    background-color: #fafcfd;
    color: #5b9bd1;
  }
  
  .profile-usermenu ul li.active {
    border-bottom: none;
  }
  
  .profile-usermenu ul li.active a {
    color: #5b9bd1;
    background-color: #f6f9fb;
    border-left: 2px solid #5b9bd1;
    margin-left: -2px;
  }
  
  /* Profile Content */
  .profile-content {
    padding: 20px;
    background: #fff;
    min-height: 460px;
  }</style>

  <div class="container">
    <div class="row profile">
		<div class="col-md-3">
			<div class="profile-sidebar">
				<!-- SIDEBAR USERPIC -->
				<div class="profile-userpic">
					<img src="http://keenthemes.com/preview/metronic/theme/assets/admin/pages/media/profile/profile_user.jpg" class="img-responsive" alt="">
				</div>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
        <?php $userpic1=findUserByID($_GET['id']);?>
        <p><img style ="width:200px;height:200px;"  src="./profile_picture/<?php echo $userpic1['image']?>"></p>
					<div class="profile-usertitle-name">
						<?php  echo $user['fullname'];?>
					</div>					
				</div>
				<!-- END SIDEBAR USER TITLE -->
				<!-- SIDEBAR BUTTONS -->
				<div class="profile-userbuttons">
        <?php if ($user ['id'] !== $currentUser['id']): ?>
        <form action="friend.php" method="post">
  <input type ="hidden" name="id" value ="<?php echo $user['id'];?>">
  <?php if($isFriend):?>
  <input type="submit" name="action" class="btn btn-danger" value="Xóa bạn bè" >
  <?php elseif($noRelationship):?>
  <input type="submit" name="action" class="btn btn-primary" value="Gửi yêu cầu kết bạn">
  <?php else: ?>
  <?php if(!$isRequesting): ?>
  <input type="submit" name="action" class="btn btn-success" value="Đồng ý yêu cầu kết bạn" >
<?php endif;?>
  <input type="submit" name="action" class="btn btn-warning" value="Hủy yêu cầu kết bạn" >
  <?php endif;?>
</form>
				</div>
				<!-- END SIDEBAR BUTTONS -->
				<!-- SIDEBAR MENU -->
				<div class="profile-usermenu">
					<ul class="nav"> 
					</ul>
				</div>
				<!-- END MENU -->
			</div>
		</div>
		<div class="col-md-9">
            <div class="profile-content">
<?php foreach($posts as $post) : ?>
<?php $userpic=findUserByID($post['userid']);?>
<div class="card">
<div class="card-header" style="background-color:#6CC3B6;">
<h5><img style ="width:50px;height:50px;" src="./profile_picture/<?php echo $userpic['image']?>"> <a href="profile.php?id=<?php echo $post['userid'];?>"><?php echo $post['fullname'];?></a> 
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
      <button name="likeds" type="submit" class="btn btn-primary"value= "<?php echo $post['id'].'like';?>">Thích</button>
    <?php else: ?>
      <button name="likeds" type="submit" class="btn btn-danger"value= "<?php echo $post['id'].'unlike';?>">Bỏ thích</button>
    <?php endif; ?> 
    <a href="comment.php?id=<?php echo $post['id'];?>" target="_self"><input type="button" value="Bình luận" class="btn btn-success"></a>
    </form>
  </div>
</div>
<?php endforeach; ?>

            </div>
		</div>
	</div>
</div>
<center>
<strong>Powered by <a href="profile.php?id=1">1660724</a></strong>
</center>
<br>
<br>







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



<!--https://bootsnipp.com/snippets/featured/user-profile-sidebar-->
<?php endif;?>
<?php include 'footer.php'; ?>