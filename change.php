<?php 
  require_once 'init.php';
  require_once 'functions.php';
  $page = 'login';
  $success= false;
  $error = 0;
  if(isset($_POST['password'])&& isset ($_POST['confirm'])&& isset ($_POST['oldpassword']))
  {
    $oldpassword = $_POST['oldpassword'];
    $password=$_POST['password'];
    $confirm=$_POST['confirm']; 
    if($password!=""&&$confirm!=""&&$oldpassword!="")
    {
    $user=findUserByEmail($_SESSION['email']); 
    if($user) 
    {
        $check = password_verify($oldpassword,$user['password']);
        if($check&&$password==$confirm) 
        {
            $passwordHash=password_hash($password, PASSWORD_DEFAULT);
            $query=$db->prepare("UPDATE USERS SET PASSWORD=? WHERE EMAIL=?");
            $query->execute(array($passwordHash,$_SESSION['email']));
            $change =1 ;
            $success = true;
        }
        else
        {
          $error = 1;
        }
    }
    else
        {
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
<h1>Đổi mật khẩu</h1>
<?php if(!$success) : ?>
<form action="change.php" method ="post" >
<div class="form-group">
    <input type="password" class="form-control" id="email" name="oldpassword" placeholder="Enter old password">
  </div>
  <div class="form-group">
    <input type="password" class="form-control" id="email" name="password" placeholder="Enter new password">
  </div>
  <div class="form-group">
    <input type="password" class="form-control" id="password" name="confirm"  placeholder="Confirm new password">
  </div>
  <div><button type="submit" class="btn btn-primary">Đổi mật khẩu</button></div>
  </form>
 <?php if($error == 1)
 {
   echo '<div class="alert alert-danger" style="margin: 10px;">
   <strong>Vui lòng !</strong> Sai mật khẩu cũ hoặc xác nhận mật khẩu mới không trùng khớp.
 </div>';
 }
 if($error == 0)
 {
   echo '<div class="alert alert-primary" style="margin: 10px;">
   <strong>Vui lòng !</strong> Vui lòng điền đầy đủ mật khẩu cũ, mật khẩu mới và xác nhận mật khẩu mới.
 </div>';
  $error = 0;
 } ?>
 <?php else :?>
 <div class="alert alert-success" role="alert">
  Đổi mật khẩu thành công.
</div>
<a href="index.php" style="text-decoration:none;"><button class="btn btn-lg btn-primary btn-block" type="button" style="width: 20%">Về trang chủ</button></a>

<?php endif; ?>
<?php include 'footer.php'; ?>