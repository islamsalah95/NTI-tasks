<?php 
namespace app\requests;

use app\helpers\Hash;
use app\models\User;

class RegisterRequest {
    private $password,$password_confirmation,$email,$phone,$errors = [];

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of password_confirmation
     */ 
    public function getPassword_confirmation()
    {
        return $this->password_confirmation;
    }

    /**
     * Set the value of password_confirmation
     *
     * @return  self
     */ 
    public function setPassword_confirmation($password_confirmation)
    {
        $this->password_confirmation = $password_confirmation;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of phone
     */ 
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set the value of phone
     *
     * @return  self
     */ 
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    public function passwordValidation($regularExpressionMessage="Minimum 8 and maximum 32 characters, at least one uppercase letter, one lowercase letter, one number and one special characte",string $key = 'password') 
    {
        if(empty($this->password)){
            $this->errors[$key]['required'] = 'Password Is Required';
        }else{
            if(!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,32}$/',$this->password)){
                $this->errors[$key]['regex'] = $regularExpressionMessage;
            }
        }
        return $this;

    }

    public function passwordConfirmationValidation() 
    {
        if(empty($this->password_confirmation)){
            $this->errors['password_confirmation']['required'] = 'Password Confirmation Is Required';
        }
        else{
            if($this->password !== $this->password_confirmation){
                $this->errors['password_confirmation']['confirmed'] = 'Password Not Confirmed';
            }
        }
        return $this;

    }

    public function emailValidation($uniqueRule=true) 
    {
        if(empty($this->email)){
            $this->errors['email']['required'] = 'Email Is Required';
        }
        else{
            if(!preg_match('/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/',$this->email)){
                $this->errors['email']['regex'] = 'Email Is Invalid';
            }else{
                if($uniqueRule){
                    $user = new User;
                    $user->setEmail($this->email);
                    $result = $user->getUserByEmail();
                    if($result->num_rows >= 1){
                        $this->errors['email']['unique'] = 'Email Already Exists';
                    }
                }
            }
        }
        return $this;

    }

    public function phoneValidation($uniqueRule=true) 
    {
        if(empty($this->phone)){
            $this->errors['phone']['required'] = 'Phone Is Required';
        }
        else{
            if(!preg_match('//',$this->phone)){
                $this->errors['phone']['regex'] = 'Phone Is Invalid';
            }else{
                if($uniqueRule){
                    $user = new User;
                    $user->setPhone($this->phone);
                    $result = $user->getUserByPhone();
                    if($result->num_rows >= 1){
                        $this->errors['phone']['unique'] = 'Phone Already Exists';
                    }
                }
            }
        }
        return $this;

    }


    public function correctPassword(string $oldPassword,string $currentHashedPassword)
    {
        if(!Hash::check($oldPassword,$currentHashedPassword)){
            $this->errors['old-password']['correct'] = "Wrong Password";
        }
        return $this;
    }

    public function newPassword(string $oldPassword,string $currentHashedPassword)
    {
        if(Hash::check($oldPassword,$currentHashedPassword)){
            $this->errors['new-password']['new'] = "Please Enter New Password";
        }
        return $this;
    }
    public function newEmail(string $oldEmail,string $currentEmail)
    {
        if($oldEmail == $currentEmail){
            $this->errors['email']['new'] = "Please Enter New Email";
        }
        return $this;
    }

    public function errors()
    {
        return  $this->errors;
    }

    public function getError($key='')
    {
        return $this->errors[$key] ?? [];
    }

    public function getErrorMessage($key='')
    {
        if(!empty($this->getError($key))){
            foreach($this->getError($key) AS $error){
                return "<p class='text-danger font-weight-bold'>*{$error}</p>";
            }
        }
    }

}