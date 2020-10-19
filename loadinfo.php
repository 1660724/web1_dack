<?php
session_start();
include 'connect.php';
include 'functions.php';
if (!isset($_SESSION['email'])) {
	 header('Location: login.php');
}
?>
<?php
                $fullname = $_POST['fullname']; 

                error_reporting(E_ALL);
                ini_set('display_errors', 1);
                $query = $db->prepare("UPDATE users SET fullname=? WHERE email=?");
                $query->execute([$fullname, $_SESSION['email']]);
                $user=findUserByEmail($_SESSION['email']);
                if(isset($_FILES['profilePicture']))
                {
                    $fileName = $_FILES['profilePicture']['name'];

                    if(!empty($fileName))
                    {
                        $fileName = time().$fileName;

                    $fileTemp = $_FILES['profilePicture']['tmp_name'];
                    $newPath = 'profile_picture/'.$fileName;

                    move_uploaded_file($fileTemp, $newPath);
                    resizeImage($newPath,256,256,false,$newPath);
                    }

                    $stmt = $db->prepare("UPDATE users set image=? where email=?");
                    $stmt->execute([$fileName,$_SESSION['email']]);
                
                    header('Location: index.php');

                }
                header('Location: index.php');
                
                
?>