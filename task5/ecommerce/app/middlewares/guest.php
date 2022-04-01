<?php 
if(!empty($_SESSION['user'])){
    // authenticated
    header('location:index.php');die;
}