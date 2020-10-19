<?php
  require_once 'init.php';
  require_once 'functions.php';
 include 'header.php'; 

 if(isset($_POST['submit']))
 {
    $email= $_POST['email'];
    if($email==null)
    {
      header('location:forgot.php?message=<div class="alert alert-danger">Vui lòng nhập vào ô trống !</div>');
      exit;
    }
    else{
      header('location:loadreset.php?email='.$email.'');
      exit;
    }
 }
 
 echo '<h1>Khôi phục mật khẩu</h1>
  <form action="forgot.php" method ="post">
    
    <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" name="email" >
    </div>
 <button type="submit" name="submit" class="btn btn-primary">Khôi phục</button>
</form>';
if(isset($_GET['message']))
{
  $message = $_GET['message'];
  unset($_GET['message']);
  echo $message;
}
    include 'footer.php';
 ?>
 
