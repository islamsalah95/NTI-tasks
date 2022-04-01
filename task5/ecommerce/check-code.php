<?php

use app\models\User;
use app\mails\VerificationMail;

$title = 'Check Code';
include_once 'layouts/header.php';
include_once "app/middlewares/guest.php";

define('ALLOWED_PAGES', ['signup', 'check-email','my-account']);
define('CODE_EXPIRATION_PERIOD_IN_MINUTES', 1);
// validation on allowed pages
if (!empty($_GET)) {
    if (isset($_GET['page'])) {
        if (!in_array($_GET['page'], ALLOWED_PAGES)) {
            header('location:layouts/errors/404.php');
            die;
        }
    } else {
        header('location:layouts/errors/404.php');
        die;
    }
} else {
    header('location:layouts/errors/404.php');
    die;
}
// session should have email key
if (empty($_SESSION['email'])) {
    header('location:signin.php');
    die;
}
$userObject = new User;
$user = $userObject->setEmail($_SESSION['email'])->getUserByEmail()->fetch_object();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];
    # check code
    if (!empty($_POST['submit']) && $_POST['submit'] == 'check-code') {
        // validation on code
        if (!empty($_POST['code'])) {
            $userObject->setEmail($_SESSION['email']);
            if ($_GET['page'] == 'signup' || $_GET['page'] == 'my-account') {
                $userObject->setVerification_code($_POST['code']);
                $result = $userObject->checkCode();
                if ($result->num_rows == 1) {
                    $verificationResult = $userObject->verifyUser();
                    if ($verificationResult) {
                        unset($_SESSION['email']);
                        $success = "<p class='text-success text-center'> <strong> Correct Code </strong> </p>";
                        header("Refresh:3; url=signin.php");
                    } else {
                        $errors['tryAgain'] = 'Please Try Again Later';
                    }
                } else {
                    $errors['wrong'] = 'Code Is Wrong';
                }
            } else {
                // check-email
                $userObject->setForget_code($_POST['code']);
                $result = $userObject->checkForgetCode();
                if ($result->num_rows == 1) {
                    $user = $result->fetch_object();
                    if (date('Y-m-d H:i:s') <= $user->code_expired_at) {
                        header('location:set-new-password.php');
                        die;
                    } else {
                        $errors['code'] = 'Code Is Expired';
                    }
                } else {
                    $errors['code'] = 'Code Is Wrong';
                }
            }
        } else {
            $errors['code'] = 'Code Is Required';
        }
    }
    # resend code
    elseif (!empty($_POST['submit']) && $_POST['submit'] == 'resend-code') {
        # check if code expired to resend a new one
        if (date('Y-m-d H:i:s') > $user->code_expired_at) {
            $forgetCode = rand(10000, 99999);
            $forgetCodeExpiration = date('Y-m-d H:i:s', strtotime('+' . CODE_EXPIRATION_PERIOD_IN_MINUTES . ' minutes'));
            $updateCodeResult = $userObject->setForget_code($forgetCode)
                ->setCode_expired_at($forgetCodeExpiration)
                ->updateForgetCode();
            if ($updateCodeResult) {
                // send mail
                $subject = 'Forget Password Code';
                $body = "<div>
                            <p> Hello {$user->first_name} {$user->last_name} </p>
                            <p> Your Forget Password Code:<strong>{$forgetCode}</strong></p>
                            <p> Please Verify Your Email Address Before Code Expiration at <strong>{$forgetCodeExpiration}</strong></p>
                            <p> Thank you.</p>
                        </div>";
                $verificationMail = new VerificationMail($_SESSION['email'], $subject, $body);
                $verificationMailResult = $verificationMail->send();
                if (!$verificationMailResult) {
                    $errors['mail'] = 'Try Again Later';
                } else {
                    $success = "<p class='text-success text-center'> <strong> A fresh mail has been sent , please check your mailbox </strong> </p>";
                }
            } else {
                $errors['wrong'] = "Something Went Wrong";
            }
        }
    }
    # case no submit , valid data
    else {
        $errors['wrong'] = 'Something Went Wrong';
    }
}
if ($_GET['page'] == 'check-email') {
    $user = $userObject->setEmail($_SESSION['email'])->getUserByEmail()->fetch_object();
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
                                    <form method="post">
                                        <input type="number" name="code" placeholder="Verification Code">
                                        <?php
                                        if (!empty($errors)) {
                                            foreach ($errors as $error) {
                                                echo "<p class='text-danger font-weight-bold'>* {$error}</p>";
                                            }
                                        }
                                        echo $success ?? null;
                                        ?>
                                        <div class="button-box">

                                            <button type="submit" name="submit" value="check-code"><span><?= $title ?></span></button>
                                            <?php if ($_GET['page'] == 'check-email') { ?>
                                                <button type="submit" name="submit" value="resend-code" id='demo' class="btn btn-outline-success" disabled> Resend Code </button>
                                            <?php }  ?>
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
# AJAX
# DOM
# Jquery
if ($_GET['page'] == 'check-email') {
    $scripts = "<script src='assets/js/count-down-timer.js' expirationTime='$user->code_expired_at'></script>";
}
include_once 'layouts/footer-scripts.php';
?>