<?php
session_start();
require_once 'functions.php';

$db= new PDO('mysql:host=localhost;dbname=dack;charset=utf8','root','');

$currentUser=null;

if(isset($_SESSION['email'])){
    $user=findUserByEmail($_SESSION['email']);
    if($user){
        $currentUser=$user;
    }
}
?>