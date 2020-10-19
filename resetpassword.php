<?php 
     
     require_once 'init.php';
     require_once 'functions.php';
     include 'header.php';
     global $db;
     $i=3;
     $temp =0;
    $secret= $_GET['secret'];
    $id=findResetPassword($secret);
        if(isset($_POST['submit']))
        {
            $password=$_POST['password'];
            $confirm=$_POST['confirm'];
            if($password==null||$confirm==null)
            {
                $i=0;
            }
            else if($password!=$confirm)
            {
                $i=1;
            }
            else if($password==$confirm)
            {

                
                $passwordHash=password_hash($password,PASSWORD_DEFAULT);
                $query=$db->prepare("UPDATE USERS SET PASSWORD=? WHERE id=?");
                $query->execute(array($passwordHash,$id['userid']));
                $temp=1;
                echo '<a href="index.php" style="text-decoration:none;"><button type="button" class="btn btn-success">Khôi phục thành công. Về trang chủ</button></a>';
            }
        }
        if($temp==0){
        echo '<form action="resetpassword.php?secret='.$secret.'" method="POST">
        <h3>Change Password</h3>
        <div class="form-group">
        <?php $te = 5; ?>
          <input type="password" name="password" class="form-control" placeholder="Enter new password">
        </div>
        <div class="form-group">
          <input type="password" name="confirm" class="form-control" placeholder="Confirm new password">
        </div>
        <div class="form-group">
          <input type="hidden" name="secret" value="'.$secret.'" >
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Khôi phục</button>
      </form>';
            if($i==0)
            {
                echo '<div class="alert alert-danger">Vui lòng nhập đầy đủ !</div>';
            }
            if($i==1)
            {
                echo '<div class="alert alert-danger">Xác nhận mật khẩu chưa đúng !</div>';
            }
        }
    include 'footer.php';
?>