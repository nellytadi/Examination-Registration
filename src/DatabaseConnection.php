<?php

class DatabaseConnection{
    
    public $servername = "localhost";
    public $username = "root";
    public  $password = "";
    public $dbname = "vogue";

    public function connect()
    {   
        
        $sql = "mysql:host=$this->servername;dbname=$this->dbname;";
        $dsn_Options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

        try {
            $conn = new PDO($sql, $this->username, $this->password, $dsn_Options);
        } catch (PDOException $error) {
            http_response_code(404);
            die(json_encode(array('message' => "Error connecting to database {$error->getMessage()}")));
        }        
       
        return $conn;
    }
}
