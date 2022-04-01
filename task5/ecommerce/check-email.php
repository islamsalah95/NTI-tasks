<?php
use app\models\User;
use app\mails\VerificationMail;
use app\requests\RegisterRequest;

$title = 'Verify Your Email Address';
include_once 'layouts/header.php';
include_once "app/middlewares/guest.php";
define('CODE_EXPIRATION_PERIOD_IN_MINUTES',5);
$emailVerificationRequest = new RegisterRequest;

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $errors= [];
    $emailVerificationRequest->setEmail($_POST['email'])->emailValidation(false);
    if(empty($emailVerificationRequest->errors())){
        $userObject = New User;
        $result = $userObject->setEmail($_POST['email'])->getUserByEmail();
        if($result->num_rows == 1){
            $user = $result->fetch_object();
            $forgetCode = rand(10000,99999);
            $forgetCodeExpiration = date('Y-m-d H:i:s',strtotime('+'.CODE_EXPIRATION_PERIOD_IN_MINUTES.' minutes'));
            $updateCodeResult = $userObject->setForget_code($forgetCode)->setCode_expired_at($forgetCodeExpiration)->updateForgetCode();
            if($updateCodeResult){
                // send mail
                $subject = 'Forget Password Code';
                $body = "<div>
                            <p> Hello {$user->first_name} {$user->last_name} </p>
                            <p> Your Forget Password Code:<strong>{$forgetCode}</strong></p>
                            <p> Please Verify Your Email Address Before Code Expiration at <strong>{$forgetCodeExpiration}</strong></p>
                            <p> Thank you.</p>
                        </div>";
                $verificationMail = new VerificationMail($_POST['email'],$subject,$body);
                $verificationMailResult = $verificationMail->send();
                if($verificationMailResult){
                    $_SESSION['email'] = $_POST['email'];
                    header('location:check-code.php?page=check-email');die;
                }else{
                    $errors['mail'] = 'Try Again Later';
                }
            }else{
                $errors['wrong']="Something Went Wrong";
            }
        }else{
            $errors['wrong']="Email dosen't match our records";
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
                                        <input type="email" name="email" placeholder="Email Address">
                                        <?= $emailVerificationRequest->getErrorMessage('email') ?>
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