<?php

class Conexao {
    private $host;
    private $user;
    private $password;
    private $database;
    private $conn;

    public $total = 0;

    public function __construct()
    {
        $this->host = 'localhost';
        $this->database = "GTMIL";
        $this->user = 'root';
        $this->password = '12345';
        $this->connect();
    }

    public function connect()
    {
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->database}", $this->user, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            trigger_error("Connection failed: " . $e->getMessage(), E_USER_ERROR);
        }
    }

     public function Consultar($sql){
            try {
                if ($result = $this->conn->query($sql)){
                    $this->total = $result->rowCount();
                    return $result;
                }
                $this->total = 0;
                return null;
            } catch (Exception) {
                $this->close();
            }
        }


         public function close()
    {
        $this->conn = null;
    }



    public function getConnection()
    {
        return $this->conn;
    }



}

?>