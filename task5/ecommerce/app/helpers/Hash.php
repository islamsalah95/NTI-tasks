<?php 
namespace app\helpers;
class Hash {
    public static function make(string $password) :string
    {
        return password_hash($password,PASSWORD_BCRYPT);
    }

    public static function check(string $password,string $hashedPassword) :bool
    {
        return password_verify($password,$hashedPassword);
    }
}