<?php 
namespace app\services;
class media {
    private array $image = [];
    private array $errors = [];
    private const MAX_UPLOAD_SIZE = 10**6;
    private const ALLOWED_EXTENSIONS = ['png','jpg','jpeg'];
    private string $ext;
    public function __construct(array $image) {
        $this->image = $image;
    }

    public function validateOnSize(int $size = null)
    {
        $size = $size ?? self::MAX_UPLOAD_SIZE;
        if($this->image['size'] >  $size){
            $this->errors['size'] = "Maximum Upload Size " . ($size/10**6) . " Megabytes";
        }
        return $this;
    }

    public function validateOnExtension(?array $allowedExtensions = null)
    {
        $allowedExtensions = $allowedExtensions ?? self::ALLOWED_EXTENSIONS;
        $this->ext = pathinfo($this->image['name'],PATHINFO_EXTENSION);
        if(!in_array($this->ext , $allowedExtensions)){
            $this->errors['extension'] = "Allowed Extensions Are ". implode(',',$allowedExtensions);
        }
        return $this;
    }

    public function upload(string $directory)
    {
        $photoName = uniqid() . '.' . $this->ext; // 2131231a23ds.png
        $photoPath = "assets/img/$directory/";
        $fullPath = $photoPath  . $photoName ;
        if(move_uploaded_file($this->image['tmp_name'],$fullPath)){
            return $photoName;
        }else{
            return false;
        }
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
            return "<p class='text-danger font-weight-bold'>*{$this->getError($key)}</p>";
        }
    }

}