<?php
class BotAccount{
  
    // database connection and table name
    private $conn;
    private $table_name = "bot_account";
  
    // object properties
    public $ID;
    public $username;
    public $password;
    public $API_code;
    
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    
    // read all bots
    function read(){
    
        // select all query
        $query = "SELECT ID, username, password, API_code FROM " . $this->table_name . "";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // get bot by username
    function getbot(){
    
        // select all query
        $query = "SELECT ID, username, password, API_code FROM " . $this->table_name . " WHERE username = '".$this->username."'";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // set API_code for bot
    function setAPIcode(){
    
        // select all query
        $query = "UPDATE " . $this->table_name . " SET API_code=:API_code  WHERE username=:username";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->API_code=htmlspecialchars(strip_tags($this->API_code));
        $this->username=htmlspecialchars(strip_tags($this->username));
    
        // bind values
        $stmt->bindParam(":API_code", $this->API_code);
        $stmt->bindParam(":username", $this->username);

        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }
}
?>