<?php
namespace App\Modules;

class Conn 
{
    private $conn;
    
    public static function getConn () 
    {
        $this->conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        $this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // always disable emulated prepared statement when using the MySQL driver
        $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        return $this->conn;
    }
}