<?php 
if(empty($_SESSION['user'])){
    // guest
    header('location:signin.php');die;
}