
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Mạng xã hội</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <style>body {

background-color: #B6D7DA;
}</style>
</head>
<body>
<div class="container">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php"><img style ="width:34px;height:34px;" src="ava/face.jpg"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item <?php echo $page == 'index' ? 'active' :''?>">
        <a class="nav-link" href="index.php">Trang Chủ</a>
      </li>
      
      <?php if(!isset($_SESSION['email'])):?>
      <li class="nav-item <?php echo $page == 'register' ? 'active' :''?>">
        <a class="nav-link" href="register.php">Đăng Ký</a>
      </li>
      <li class="nav-item <?php echo $page == 'login' ? 'active' :''?>">
        <a class="nav-link" href="login.php">Đăng Nhập</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="forgot.php">Quên Mật Khẩu</a>
      </li>
      <?php else: ?>
      <li class="nav-item">
    
        <a class="nav-link" href="change.php">Đổi Mật Khẩu</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="status.php">Đăng Trạng Thái</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="info.php">Thông tin cá nhân</a>
      </li>
      <li class="nav-item">
    
        <a class="nav-link" href="list.php">Danh sách bạn bè </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="personal.php">Trang cá nhân</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="search.php">Tìm kiếm</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Đăng Xuất</a>
      </li>
      <?php endif; ?>


  </div>
</nav>
    
