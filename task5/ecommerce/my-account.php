<?php

use app\models\User;
use app\helpers\Hash;
use app\services\media;
use app\mails\VerificationMail;
use app\requests\RegisterRequest;

$title = "My Account";
include_once "layouts/header.php";
include_once "app/middlewares/auth.php";

$errors = [];
$success = [];
$userData = new User;
$changePasswordRequest = new RegisterRequest;
$changeEmailRequest = new RegisterRequest;
// dump($_REQUEST);
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (isset($_POST['update-profile'])) {
        // validation 
        if (!empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['phone']) && !empty($_POST['gender'])) {
            # upload image if exists
            if ($_FILES['image']['error'] == 0) {
                $media = new media($_FILES['image']);
                if (empty($media->validateOnSize()->validateOnExtension()->errors())) {
                    $photoName = $media->upload('users');
                    if ($photoName) {
                        $userData->setImage($photoName);
                    }
                }
            }
            # update if no validation errors in image
            if (empty($media->errors())) {
                $result = $userData->setFirst_name($_POST['first_name'])
                    ->setLast_name($_POST['last_name'])
                    ->setPhone($_POST['phone'])
                    ->setGender($_POST['gender'])
                    ->setEmail($_SESSION['user']->email)
                    ->update();
                if ($result) {
                    $_SESSION['user']->first_name = $_POST['first_name'];
                    $_SESSION['user']->phone = $_POST['phone'];
                    $_SESSION['user']->gender = $_POST['gender'];
                    $_SESSION['user']->last_name = $_POST['last_name'];
                    $success['update-profile']['success'] = "Profile Updated Successfully";
                } else {
                    $errors['update-profile']['wrong']['something'] = "Something Went Wrong";
                }
            }
        } else {
            $errors['update-profile']['wrong']['all-data'] = "All Inputs Are Required";
        }
    } elseif (isset($_POST['update-password'])) {
        #validation
        # required , regex , correct password
        $changePasswordRequest->setPassword($_POST['old-password'])
            ->passwordValidation("Enter Valid Password", 'old-password')
            ->CorrectPassword($_POST['old-password'], $_SESSION['user']->password);

        # required , regex , new
        $changePasswordRequest
            ->setPassword($_POST['new-password'])
            ->passwordValidation(key: 'new-password')
            ->newPassword($_POST['new-password'], $_SESSION['user']->password);


        # required , confirmed
        $changePasswordRequest->setPassword_confirmation($_POST['password_confirmation'])
            ->passwordConfirmationValidation();
        if (empty($changePasswordRequest->errors())) {
            // update 
            $result = $userData->setPassword(Hash::make($_POST['new-password']))
                ->setEmail($_SESSION['user']->email)
                ->updatePassword();
            if ($result) {
                $success['update-password']['success'] = "Password Updated Successfully";
            } else {
                $errors['update-password']['wrong']['something'] = "Something Went Wrong";
            }
        }
    } elseif (isset($_POST['update-email'])) {
        // alert modal(bootstrap)
        // validate [required,regex,new,unique]
        $changeEmailRequest->setEmail($_POST['email'])
            ->emailValidation()
            ->newEmail($_SESSION['user']->email, $_POST['email']);
        if (empty($changeEmailRequest->errors())) {
            // generate code
            $verificationCode = rand(10000, 99999);
            // update email test@gmail.com=>test@test.com,email_verified_at = NULL,code=12345
            $result = $userData->setId($_SESSION['user']->id)
                ->setEmail($_POST['email'])
                ->setVerification_code($verificationCode)
                ->setEmail_verified_at('NULL')
                ->updateEmailById();

            if ($result) {
                // send mail
                $subject = 'Verification Code';
                $body = "<div>
                        <p> Hello {$_POST['email']} </p>
                        <p> Your Verification Code:<strong>{$verificationCode}</strong></p>
                        <p> Please Verify Your Email Address Before Code Expiration</p>
                        <p> Thank you.</p>
                    </div>";
                $verificationMail = new VerificationMail($_POST['email'], $subject, $body);
                $verificationMailResult = $verificationMail->send();
                if ($verificationMailResult) {
                    $_SESSION['email'] = $_POST['email'];
                    header('location:logout.php?page=check-code.php?page=my-account');
                    die;
                } else {
                    $errors['update-email']['email']['failed'] = 'Try Again Later';
                }
            } else {
                $errors['update-email']['email']['wrong'] = 'Something Went Wrong';
            }
        }
    }
}


$userData->setEmail($_SESSION['user']->email);
$user = $userData->getUserByEmail()->fetch_object();
include_once "layouts/navbar.php";
include_once "layouts/breadcrumb.php";
?>
<!-- my account start -->
<div class="checkout-area pb-80 pt-100">
    <div class="container">
        <div class="row">
            <div class="ml-auto mr-auto col-lg-9">
                <div class="checkout-wrapper">
                    <div id="faq" class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title"><span>1</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-1">Edit your account information </a></h5>
                            </div>
                            <div id="my-account-1" class="panel-collapse collapse <?= isset($_POST['update-profile']) ? 'show' : '' ?>">
                                <div class="panel-body">
                                    <div class="billing-information-wrapper">
                                        <div class="account-info-wrapper">
                                            <h4>My Account Information</h4>
                                            <h5>Your Personal Details</h5>
                                        </div>
                                        <form method="post" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-12">
                                                    <?php
                                                    if (!empty($errors['update-profile']['wrong'])) {
                                                        foreach ($errors['update-profile']['wrong'] as $error) {
                                                            echo "<p class='alert alert-danger text-center'> {$error} </p>";
                                                        }
                                                    }

                                                    if (!empty($success['update-profile'])) {
                                                        foreach ($success['update-profile'] as $succ) {
                                                            echo "<p class='alert alert-success text-center'> {$succ} </p>";
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-4 offset-4 my-5">
                                                    <label for="image"><img src="assets/img/users/<?= $user->image ?>" alt="<?= $user->first_name ?>" class="w-100 rounded-circle" style="cursor: pointer;"></label>
                                                    <input type="file" name="image" id="image" class="d-none">
                                                    <?= isset($media) ? $media->getErrorMessage('size') : '' ?>
                                                    <?= isset($media) ? $media->getErrorMessage('extension') : '' ?>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="billing-info">
                                                        <label>First Name</label>
                                                        <input type="text" name="first_name" value="<?= $user->first_name ?>">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="billing-info">
                                                        <label>Last Name</label>
                                                        <input type="text" name="last_name" value="<?= $user->last_name ?>">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-6">
                                                    <div class="billing-info">
                                                        <label>Phone</label>
                                                        <input type="text" name="phone" value="<?= $user->phone ?>">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="billing-info">
                                                        <label>Gender</label>
                                                        <select name="gender" class="form-control" id="">
                                                            <option <?= $user->gender == 'm' ? 'selecte' : '' ?> value="m">Male</option>
                                                            <option <?= $user->gender == 'f' ? 'selecte' : '' ?> value="f">Female</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="billing-back-btn">

                                                <div class="billing-btn">
                                                    <button type="submit" name="update-profile">Update Profile</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title"><span>2</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-2">Change your password </a></h5>
                            </div>
                            <div id="my-account-2" class="panel-collapse collapse <?= isset($_POST['update-password']) ? 'show' : '' ?>">
                                <div class="panel-body">
                                    <div class="billing-information-wrapper">
                                        <div class="account-info-wrapper">
                                            <h4>Change Password</h4>
                                            <h5>Your Password</h5>
                                        </div>
                                        <form action="" method="post">
                                            <div class="row">
                                                <div class="col-12">
                                                    <?php
                                                    if (!empty($errors['update-password']['wrong'])) {
                                                        foreach ($errors['update-password']['wrong'] as $error) {
                                                            echo "<p class='alert alert-danger text-center'> {$error} </p>";
                                                        }
                                                    }

                                                    if (!empty($success['update-password'])) {
                                                        foreach ($success['update-password'] as $succ) {
                                                            echo "<p class='alert alert-success text-center'> {$succ} </p>";
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Old Password</label>
                                                        <input type="password" name="old-password">
                                                        <?= $changePasswordRequest->getErrorMessage('old-password') ?>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>New Password</label>
                                                        <input type="password" name="new-password">
                                                        <?= $changePasswordRequest->getErrorMessage('new-password') ?>

                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Password Confirmation</label>
                                                        <input type="password" name="password_confirmation">
                                                        <?= $changePasswordRequest->getErrorMessage('password_confirmation') ?>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="billing-back-btn">

                                                <div class="billing-btn">
                                                    <button type="submit" name="update-password">Update Password</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title"><span>3</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-3">Modify your Email address </a></h5>
                            </div>
                            <div id="my-account-3" class="panel-collapse collapse <?= isset($_POST['update-email']) ? 'show' : '' ?>">
                                <div class="panel-body">
                                    <div class="billing-information-wrapper">
                                        <div class="account-info-wrapper">
                                            <h4>Change Email Address</h4>
                                        </div>
                                        <form action="" method="post" id="email-form">

                                            <div class="row">
                                                <div class="col-12">
                                                    <?php
                                                    if (!empty($errors['update-email']['email'])) {
                                                        foreach ($errors['update-email']['email'] as $error) {
                                                            echo "<p class='alert alert-danger text-center'> {$error} </p>";
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Email</label>
                                                        <input type="email" name="email" value="<?= $user->email ?>">
                                                        <?= $changeEmailRequest->getErrorMessage('email') ?>
                                                        <input type="hidden" name="update-email">
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="billing-back-btn">

                                                <div class="billing-btn">
                                                    <button id="update-email" type="submit" name="update-email" data-toggle="modal" data-target="#exampleModal" >Update Email Address</button>
                                                </div>
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
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog w-50" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Email</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are You Sure ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary rounded" style="cursor: pointer;" data-dismiss="modal">Dismiss</button>
                <button type="button" class="btn btn-outline-warning rounded" id="save-cahnges" style="cursor: pointer;">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- my account end -->
<?php
$scripts = "<script src='assets/js/email-modal.js'></script>";
include_once "layouts/footer.php";
include_once "layouts/footer-scripts.php";
?>