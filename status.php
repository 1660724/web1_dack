<?php
  require_once 'init.php';
  
  if(!isset($_SESSION['email']))
  {
      header('Location: index.php');
      exit;
  }
  
  $page= 'status';
  include 'header.php'; 
  $user1 = findUserByEmail($_SESSION['email']);
?>
<form action="load-status.php" method="POST" enctype="multipart/form-data">
<h3>Trạng thái mới</h3>
Chế độ đăng: <select class="form-group" name="type">
    <option value="0" selected="selected">Công khai</option>
    <option value="1">Bạn bè</option>
    <option value="2">Chỉ mình tôi</option>
</select>
<div class="form-group">
<textarea name="post" style="width:100%;height:80px" placeholder="Bạn đang nghĩ gì <?php echo $user1['fullname'];?> ?">
</textarea>
<div class="form-group">
    <label for="statusPicture">Ảnh trạng thái</label>
    <input type="file" class="form-control-file" id="statusPicture" name="statusPicture">
  </div>
</div>
<button type="submit" class="btn btn-primary">Đăng</button>
</form >


