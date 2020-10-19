<?php
  require_once 'init.php';
  require_once 'functions.php';
  if(!isset($_SESSION['email']))
  {
    header('Location: login.php');
  }
  $hello=findUserByEmail($_SESSION['email']);

  ?>
  <?php include 'header.php'; ?>
  <form action="loadinfo.php" method="POST" enctype="multipart/form-data">
  <h3>Thông tin cá nhân</h3>
  <h5>Họ tên</h5>
  <div class="form-group">
    <input type="text" name="fullname" class="form-control" value="<?php echo $hello['fullname'];?>">
  </div>
  <div class="form-group">
    <label for="profilePicture">Ảnh đại diện</label>
    <input type="file" class="form-control-file" id="profilePicture" name="profilePicture">
  </div>
  
  <button type="submit" class="btn btn-primary">Cập nhật</button>
</form>
<?php include 'footer.php'; ?>