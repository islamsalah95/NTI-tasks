<?php 
namespace app\models;
use app\database\connection;
use app\database\contracts\crud;
class User extends connection implements crud {
    private $id,$first_name,$last_name,$email,$password,$phone,$gender,$image,$status,$remember_token,
    $email_verified_at,$verification_code,$forget_code,$code_expired_at,$created_at,$updated_at;

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of first_name
     */ 
    public function getFirst_name()
    {
        return $this->first_name;
    }

    /**
     * Set the value of first_name
     *
     * @return  self
     */ 
    public function setFirst_name($first_name)
    {
        $this->first_name = $first_name;

        return $this;
    }

    /**
     * Get the value of last_name
     */ 
    public function getLast_name()
    {
        return $this->last_name;
    }

    /**
     * Set the value of last_name
     *
     * @return  self
     */ 
    public function setLast_name($last_name)
    {
        $this->last_name = $last_name;

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

    /**
     * Get the value of gender
     */ 
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set the value of gender
     *
     * @return  self
     */ 
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get the value of image
     */ 
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */ 
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of remember_token
     */ 
    public function getRemember_token()
    {
        return $this->remember_token;
    }

    /**
     * Set the value of remember_token
     *
     * @return  self
     */ 
    public function setRemember_token($remember_token)
    {
        $this->remember_token = $remember_token;

        return $this;
    }

    /**
     * Get the value of email_verified_at
     */ 
    public function getEmail_verified_at()
    {
        return $this->email_verified_at;
    }

    /**
     * Set the value of email_verified_at
     *
     * @return  self
     */ 
    public function setEmail_verified_at($email_verified_at)
    {
        $this->email_verified_at = $email_verified_at;

        return $this;
    }

    /**
     * Get the value of activation_code
     */ 
    public function getVerification_code()
    {
        return $this->verification_code;
    }

    /**
     * Set the value of activation_code
     *
     * @return  self
     */ 
    public function setVerification_code($verification_code)
    {
        $this->verification_code = $verification_code;

        return $this;
    }

    /**
     * Get the value of code_expired_at
     */ 
    public function getCode_expired_at()
    {
        return $this->code_expired_at;
    }

    /**
     * Set the value of code_expired_at
     *
     * @return  self
     */ 
    public function setCode_expired_at($code_expired_at)
    {
        $this->code_expired_at = $code_expired_at;

        return $this;
    }

    
    /**
     * Get the value of forget_code
     */ 
    public function getForget_code()
    {
        return $this->forget_code;
    }

    /**
     * Set the value of forget_code
     *
     * @return  self
     */ 
    public function setForget_code($forget_code)
    {
        $this->forget_code = $forget_code;

        return $this;
    }

    /**
     * Get the value of created_at
     */ 
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */ 
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of updated_at
     */ 
    public function getUpdated_at()
    {
        return $this->updated_at;
    }

    /**
     * Set the value of updated_at
     *
     * @return  self
     */ 
    public function setUpdated_at($updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function create(){
        $query = "INSERT INTO `users` (`first_name`,`last_name`,`email`,`phone`,`password`,`verification_code`) 
        VALUES ('{$this->first_name}','{$this->last_name}','{$this->email}','{$this->phone}','{$this->password}',{$this->verification_code}) ";
        return $this->runDML($query);
    }
    public function read(){

    }
    public function update(){
        $image = '';
        if($this->image){
            $image = ",`image`='{$this->image}'";
        }
        $query = "UPDATE `users` SET `first_name` = '{$this->first_name}' , 
        `last_name` = '$this->last_name' , `phone` = '{$this->phone}' , 
        `gender` = '{$this->gender}' $image  WHERE `email` = '{$this->email}' ";
        return $this->runDML($query);
    }
    public function delete(){

    }

    public function getUserByEmail()
    {
        $query = "SELECT * FROM `users` WHERE `email` = '{$this->email}'";
        return $this->runDQL($query);
    }
    public function getUserByPhone()
    {
        $query = "SELECT * FROM `users` WHERE `phone` = '{$this->phone}'";
        return $this->runDQL($query);
    }

    public function checkCode()
    {
        $query = "SELECT * FROM `users` WHERE `verification_code`= {$this->verification_code} AND `email` = '{$this->email}'";
        return $this->runDQL($query);
    }

    public function checkForgetCode()
    {
        $query = "SELECT * FROM `users` WHERE `forget_code`= {$this->forget_code} AND `email` = '{$this->email}'";
        return $this->runDQL($query);
    }
    

    public function verifyUser()
    {
        $query = "UPDATE `users` SET `email_verified_at` = '" . date('Y-m-d H:i:s') . "' WHERE `email` = '{$this->email}' ";
        return $this->runDML($query);
    }
    
    public function updateForgetCode()
    {
        $query = "UPDATE `users` SET `forget_code` = '{$this->forget_code}',
        `code_expired_at` = '{$this->code_expired_at}' WHERE `email` = '{$this->email}' ";
        return $this->runDML($query);
    }

    public function updatePassword()
    {
        $query = "UPDATE `users` SET `password` = '{$this->password}'
        WHERE `email` = '{$this->email}' ";
        return $this->runDML($query);
    }

    public function updateEmailById()
    {
        $query = "UPDATE `users` SET `email` = '{$this->email}' , `verification_code` = {$this->verification_code} ,
        `email_verified_at` = {$this->email_verified_at} WHERE `id` = {$this->id}";
        return $this->runDML($query);
    }
}