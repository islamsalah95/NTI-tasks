<?php
session_start();
unset($_SESSION['user']);
setcookie('remember_me','',time()-1,'/');
$page = $_GET['page'] ?? 'signin.php';
header("location:$page");