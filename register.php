<?php 
  require_once 'init.php';
  require_once 'functions.php';
  $page = 'register';
  $success= false;
  // if(isset($_POST['fullName']) && isset($_POST['email'])&&isset ($_POST['password'])){
  //   $password=$_POST['password'];
  //   $fullName=$_POST['fullName'];
  //   $email=$_POST['email'];  
  //   $passwordHash=password_hash($password, PASSWORD_DEFAULT);
  //   $userId=createUser($email,$fullName,$passwordHash);
  //   $_SESSION['userId']=$userId;
  //   header('location: index.php');
  //   $success = true;
  // }
  if(isset($_POST['submit']))
{
                $fullname = $_POST['fullname'];
                $password = $_POST['password']; 
                $confirm = $_POST['confirm'];
                $email = $_POST['email'];
                error_reporting(E_ALL);
                ini_set('display_errors', 1);
                include 'connect.php';
                $stmt = $db->prepare("SELECT * FROM users WHERE email=?");
                $stmt->execute(array($email));
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                if($fullname == null || $password == null || $confirm == null||$email==null)
                {
                    header('location:register.php?message=<div class="alert alert-danger">Vui lòng nhập đầy đủ !</div>');
                    exit;
                }
                if($user)
                {
                    header('location:register.php?message=<div class="alert alert-danger">Tài khoản đã tồn tại !</div>');
                    exit;
                }
                if($password != $confirm)
                {
                    header('location:register.php?message=<div class="alert alert-danger">Xác nhận mật khẩu chưa đúng !</div>');
                    exit;
                }
                $img="default_image.jpg";
                $passwordHash = password_hash($password,PASSWORD_DEFAULT);
                $query = $db->prepare("INSERT INTO users(email,fullname,password,active,image) VALUES(?,?,?,?,?)");
                $query->execute([$email,$fullname,$passwordHash,0,$img]);
                sendEmail($email,$fullname,'Yeu cau kich hoat tai khoan.','Click <a href="http://localhost:81/dack/verify.php?email='.$email.'">vao day de kich hoat tai khoan.</a>');
                header('location: register.php?message=<div class="alert alert-success">Đăng kí thằng công! Vui lòng kích hoạt tài khoản bằng mail đã đăng kí.</div>');
              } 
  
 
?>
<?php include 'header.php'; ?>
<h1>Đăng Ký</h1>
<?php if(!$success) : ?>
<form action="register.php" method ="post" >
  <div class="form-group">
    <label for="fullName">Tên Hiển Thị:</label>
    <input type="text" class="form-control" id="fullName" name="fullname">
  </div>
  <div class="form-group">
    <label for="email">Địa chỉ email:</label>
    <input type="email" class="form-control" id="email" name="email">
  </div>
  <div class="form-group">
    <label for="password">Mật Khẩu:</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
  <div class="form-group">
    <label for="password">Xác nhận mật Khẩu:</label>
    <input type="password" class="form-control" id="password" name="confirm">
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Đăng Ký</button>
</form>
<?php
	if(isset($_GET['message']))
	{
		$message = $_GET['message'];
		unset($_GET['message']);
		echo $message;
	}
?>
<?php endif;
 ?>

<?php include 'footer.php'; ?>