<?php
class BotAccount{
  
    // database connection and table name
    private $conn;
    private $table_name = "temp_command";
  
    // object properties
    public $ID;
    public $BOT_ID;
    public $API_code;
    public $username;

  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    
    // get command by bot id
    function getcommand(){
    
        // select all query
        $query = "SELECT command, FROM " . $this->table_name . "WHERE BOT_ID = '".$this->username."'";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }
}
?>