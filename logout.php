<?php
require_once 'init.php';
require_once 'functions.php';
unset($_SESSION['email']);
header('Location: index.php');
?>