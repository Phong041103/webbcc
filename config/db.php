<?php
class db{
    
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $dbname = "treedb";
    public $conn;
    public function connect(){
        $this->conn=null;
        try{
            $this->conn= new PDO("mysql:host=".$this->host.";dbname=".$this->dbname,$this->user,$this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            // echo "Connected to database successfully<br>";
        }catch(PDOException $e){
            echo "Connection failed: ".$e->getMessage()."<br>";
        }
        return $this->conn;
    }
}
?>

