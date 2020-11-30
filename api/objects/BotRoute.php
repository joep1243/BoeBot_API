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

    function getarrays(){
        // select all query
        $query = "SELECT blockade FROM " . $this->table_name . " WHERE username = '".$this->BOT_ID."'";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();

        return $stmt;
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


    // get route by bot id
    function setblockade(){

        $getarray = $this->getarrays();
        
        while ($row = $getarray->fetch(PDO::FETCH_ASSOC)){
            $blocade = $row['log'];
        }
    
        $blocade = array_push($blocade, $this->blockade);

        // select all query
        $query = "UPDATE " . $this->table_name . " SET blockade=:blockade  WHERE BOT_ID=:BOT_ID";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $blocade=htmlspecialchars(strip_tags($blocade));
        $this->BOT_ID=htmlspecialchars(strip_tags($this->BOT_ID));

        // bind values
        $stmt->bindParam(":blockade", $blocade);
        $stmt->bindParam(":BOT_ID", $this->BOT_ID);

        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }
}
?>