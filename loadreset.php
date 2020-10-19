<?php
  require_once 'init.php';
  require_once 'functions.php';
 include 'header.php'; 
 $email =$_GET['email'];
 $user = findUserByEmail($email);

 if($user)
 {
    $secret = createResetPassword($user['id'],$user['fullname']);
    sendEmail($user['email'],$user['fullname'],'Yeu cau doi mat khau','Click <a href="http://localhost:81/dack/resetpassword.php?secret='.$secret.'">vao day de khoi phuc tai khoan</a>');
    echo '<div class="alert alert-success" role="alert">
    Vui lòng kiểm tra email để khôi phục tài khoản.
    </div>';
 }
 else{
    echo '<div class="alert alert-success" role="alert">
    Vui lòng kiểm tra email
    </div>';
 }