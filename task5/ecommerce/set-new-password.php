<?php

use app\helpers\Hash;
use app\models\User;
use app\requests\RegisterRequest;

$title = 'Set New Password';
include_once 'layouts/header.php';
include_once "app/middlewares/guest.php";

$setNewPasswordRequest  = new RegisterRequest;

// session should have email key
if(empty($_SESSION['email'])){
    header('location:signin.php');die;
}
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $errors= [];
    // validation
    $setNewPasswordRequest->setPassword($_POST['password'])->passwordValidation();
    $setNewPasswordRequest->setPassword_confirmation($_POST['password_confirmation'])->passwordConfirmationValidation();
    if(empty($setNewPasswordRequest->errors())){
        $userObject = new User;
        $result = $userObject->setEmail($_SESSION['email'])
        ->setPassword(Hash::make($_POST['password']))
        ->updatePassword();
        if($result){
            unset($_SESSION['email']);
            header('location:signin.php');die;
        }else{
            $errors['wrong'] = "Something Went Wrong";
        }
    }
}
?>
<div class="login-register-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-register-tab-list nav">
                        <a class="active" data-toggle="tab" href="#lg1">
                            <h4> <?= $title ?> </h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form  method="post">
                                        <input type="password" name="password" placeholder="Password">
                                        <?= $setNewPasswordRequest->getErrorMessage('password') ?>
                                        <input type="password" name="password_confirmation" placeholder="Password Confirmation">
                                        <?= $setNewPasswordRequest->getErrorMessage('password_confirmation') ?>

                                        <?php 
                                            if(!empty($errors)){
                                                foreach ($errors as $error) {
                                                    echo "<p class='text-danger font-weight-bold'>* {$error}</p>";
                                                }
                                            }
                                        ?>
                                        <div class="button-box">
                                           
                                            <button type="submit"><span><?= $title ?></span></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 

include_once 'layouts/footer-scripts.php';
?>