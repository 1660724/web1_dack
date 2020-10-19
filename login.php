<?php 
  require_once 'init.php';
  require_once 'functions.php';
  $page = 'login';
  $success= false;
  if(isset($_SESSION['email'])) {header('Location: index.php');}
  $error = 0;
  if(isset($_POST['email'])&& isset ($_POST['password']))
  {
    $password=$_POST['password'];
    $email=$_POST['email']; 
    if($password!=""&&$email!="")
    {
    $user=findUserByEmail($email); 
    if($user) {
        $check = password_verify($password,$user['password']);
        if($check) {
          if($user['active']==1){
            $_SESSION['email']=$email;
            header('Location: index.php');
            $success = true;}
            if($user['active']==0)
            {
              $error=5;
            }
        }
        else
        {
          $error = 1;
        }
    }
    else{
      $error =1;
    }
  } 
  }
  else
  {
    $error = 0;
  }

 
?>
<?php include 'header.php'; ?>
<h1>Đăng Nhập</h1>
<?php if(!$success) : ?>
<form action="login.php" method ="post" >
  <div class="form-group">
    <label for="email">Địa chỉ email</label>
    <input type="email" class="form-control" id="email" name="email">
  </div>
  <div class="form-group">
    <label for="password">Mật Khẩu</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
  <div><button type="submit" class="btn btn-primary">Đăng Nhập</button></div>
  </form>
 <?php if($error == 1)
 {
   echo '<div class="alert alert-danger" style="margin: 10px;">
   <strong>Vui lòng !</strong> Sai tài khoản hoặc mật khẩu.
 </div>';
 }
if($error==0)
 {
   echo '<div class="alert alert-primary" style="margin: 10px;">
   <strong>Vui lòng !</strong> Điền đầy đủ tài khoản và mật khẩu.
 </div>';
 
  $error = 0;
 }
 if($error==5)
 {
   echo '<div class="alert alert-primary" style="margin: 10px;">
   <strong>Vui lòng !</strong> Kích hoạt tài  khoản qua mail để sử dụng.
 </div>'; }?>
<?php endif; ?>
<?php include 'footer.php'; ?>