<?php
  require_once 'init.php';
  require_once 'functions.php';
  include 'header.php';
  $email= $_GET['email'];
  verifyAccount($email);
  ?>
  <a href="index.php"><button type="button" class="btn btn-success">Kích hoạt thành công. Về trang chủ</button></a>
