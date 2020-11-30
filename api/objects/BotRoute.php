<?php
class BotRoute{
  
    // database connection and table name
    private $conn;
    private $table_name = "bot_route";
  
    // object properties
    public $ID;
    public $BOT_ID;
    public $MAX_X;
    public $MAX_Y;
    public $start;
    public $end;
    public $blockade;

  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    
    // get route by bot id
    function getroute(){
    
        // select all query
        $query = "SELECT MAX_X, MAX_Y, start, end, blockade FROM " . $this->table_name . "WHERE BOT_ID = '".$this->BOT_ID."'";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }
}
?>