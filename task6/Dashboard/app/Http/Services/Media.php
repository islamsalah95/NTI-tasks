<?php
namespace App\Http\Services;
class Media {
    public static function upload($image,$dir)
    {
        $photoName = uniqid() . '.' . $image->extension();
        $image->move(public_path("assets\images\\{$dir}",$photoName));
        return $photoName;
    }

    public static function delete($dir){
        if(file_exists($dir)){
            unlink($dir);
            return true;
        }else{
            return false;
        }
    }
}
