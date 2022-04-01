<?php

namespace app\database;

use mysqli;

class connection
{
    private $hostName = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'nti';
    protected $con;
    public function __construct()
    {
        $this->con = new mysqli($this->hostName, $this->username, $this->password, $this->database);
        // if($this->con->connect_error){
        //     die('connection faild :'.$this->con->connect_error);
        // }
        // echo "connection successfully";
    }
    // DML (INSERT - UPDATE - DELETE)
    public function runDML($query): bool
    {
        $result = $this->con->query($query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    // DQL (SELECT)
    public function runDQL($query)
    {
        return $this->con->query($query);
    }

    public function __destruct()
    {
        $this->con->close();
    }
}
