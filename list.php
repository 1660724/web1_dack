<?php
  require_once 'init.php';
  require_once 'functions.php';
  if(!isset($_SESSION['email']))
  {
    header('Location: login.php');
  }
  $users = findUserByEmail($_SESSION['email']);
?>
<?php include 'header.php'; ?>
<?php $count =CountRequest($users['id']); ?>
<h3>Lời mời kết bạn  <label class="badge-danger" style="font-size:14px;font-style:normal;"><?php if($count>0) echo $count; ?></label></h3>
<?php ShowRequest($users['id']);?>
<h3>Danh sách bạn</h3>
<?php ShowFriends($users['id']);?>
<h3>Gợi ý kết bạn</h3>
<?php ShowRequestFriends($users['id']);?>
