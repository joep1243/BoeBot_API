<?php
class BotCommand{
  
    // database connection and table name
    private $conn;
    private $table_name = "temp_command";
  
    // object properties
    public $ID;
    public $BOT_ID;
    public $command;

  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    
    // get command by bot id
    function getcommand(){
    
        // select all query
        $query = "SELECT command FROM " . $this->table_name . "WHERE BOT_ID = '".$this->BOT_ID."'";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }
 
    // update location for bot
    function UpdateCommand(){
    
        // select all query
        $query = "UPDATE " . $this->table_name . " SET command=:command  WHERE BOT_ID=:BOT_ID";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->command=htmlspecialchars(strip_tags($this->command));
        $this->botid=htmlspecialchars(strip_tags($this->botid));
    
        // bind values
        $stmt->bindParam(":command", $this->command);
        $stmt->bindParam(":BOT_ID", $this->botid);

        $stmt->execute();
    }
}
?>