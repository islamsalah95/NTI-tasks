<?php

use app\helpers\Hash;
use app\models\User;
use app\requests\RegisterRequest;

$title = 'Sign in';
include_once 'layouts/header.php';
include_once "app/middlewares/guest.php";
include_once 'layouts/navbar.php';
include_once 'layouts/breadcrumb.php';

$loginRequest = new RegisterRequest;

if($_SERVER['REQUEST_METHOD']==='POST'){
    // dd($_REQUEST);
    // validation
    // [
    //     'email'=>['required','email','exists:users,email'],
    //     'password'=>['required','regex']
    // ];
    $errors = [];
    $loginRequest->setEmail($_POST['email'])->emailValidation(false);
    $loginRequest->setPassword($_POST['password'])->passwordValidation("The Provided Credentials Are Incorrect");
    if(empty($loginRequest->errors())){
        $userObject = new User;
        $userObject->setEmail($_POST['email']);
        $result = $userObject->getUserByEmail();
        if($result->num_rows == 1){
            $user = $result->fetch_object();
            if(Hash::check($_POST['password'],$user->password)){
                if($user->email_verified_at){
                    if(isset($_POST['remember_me'])){
                        setcookie('remember_me',$_POST['email'],time() + (365*86400),'/');
                    }
                    $_SESSION['user'] = $user;
                    header('location:index.php');die;
                }else{
                    $_SESSION['email'] = $_POST['email'];
                    header('location:check-code.php');die;
                }
            }else{
                $errors['wrong-email'] = 'The Provided Credentials Are Incorrect'; 
            }
        }else{
            $errors['wrong-email'] = 'The Provided Credentials Are Incorrect'; 
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
                                    <form action="" method="post">
                                        <input type="email" name="email" placeholder="Email Address" value="<?= old('email') ?>">
                                        <?= $loginRequest->getErrorMessage('email') ?>
                                        <input type="password" name="password" placeholder="Password">
                                        <?= $loginRequest->getErrorMessage('password') ?>
                                        <?php 
                                            if(!empty($errors)){
                                                foreach ($errors as $error) {
                                                    echo "<p class='text-danger font-weight-bold'>* {$error} </p>";
                                                }
                                            }
                                        ?>
                                        <div class="button-box">
                                            <div class="login-toggle-btn">
                                                <input type="checkbox" name="remember_me" value="true">
                                                <label>Remember me</label>
                                                <a href="check-email.php">Forgot Password?</a>
                                            </div>
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
include_once 'layouts/footer.php';
include_once 'layouts/footer-scripts.php';
?>