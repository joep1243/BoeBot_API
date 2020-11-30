<?php
class BotLog{
  
    // database connection and table name
    private $conn;
    private $table_name = "temp_log";
  
    // object properties
    public $ID;
    public $BOT_ID;
    public $log;
    public $diagnostics;
    public $diagnosticsname;
    public $location;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function getarrays(){
        // select all query
        $query = "SELECT log, diagnostics, location FROM " . $this->table_name . " WHERE username = '".$this->BOT_ID."'";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();

        return $stmt;
    }


    // update location for bot
    function UpdateLog(){

        $getarray = $this->getarrays();

        while ($row = $getarray->fetch(PDO::FETCH_ASSOC)){
            $log = $row['log'];
        }

        $arr = json_decode($log, TRUE);
        $newnum = count($arr) + 1;
        $arr[] = ['log'.$newnum.'' => $this->log];
        $json = json_encode($arr);

        // select all query
        $query = "UPDATE " . $this->table_name . " SET log=:log  WHERE BOT_ID=:BOT_ID";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $json=htmlspecialchars(strip_tags($json));
        $this->BOT_ID=htmlspecialchars(strip_tags($this->BOT_ID));

        // bind values
        $stmt->bindParam(":log", $json);
        $stmt->bindParam(":BOT_ID", $this->BOT_ID);

        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }


    // update location for bot
    function Updatediagnostics(){

        $getarray = $this->getarrays();

        while ($row = $getarray->fetch(PDO::FETCH_ASSOC)){
            $diagnostics = $row['diagnostics'];
        }

        $arr = json_decode($diagnostics, TRUE);  
        $arr[][$this->diagnosticsname]=$this->diagnostics;   
        $json = json_encode($arr);
        
        // select all query
        $query = "UPDATE " . $this->table_name . " SET diagnostics=:diagnostics  WHERE BOT_ID=:BOT_ID";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $json=htmlspecialchars(strip_tags($json));
        $this->BOT_ID=htmlspecialchars(strip_tags($this->BOT_ID));

        // bind values
        $stmt->bindParam(":diagnostics", $json);
        $stmt->bindParam(":BOT_ID", $this->BOT_ID);

        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    
     // update location for bot
     function UpdateLocation(){
    
        // select all query
        $query = "UPDATE " . $this->table_name . " SET location=:location  WHERE BOT_ID=:BOT_ID";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->location=htmlspecialchars(strip_tags($this->location));
        $this->BOT_ID=htmlspecialchars(strip_tags($this->BOT_ID));
    
        // bind values
        $stmt->bindParam(":location", $this->location);
        $stmt->bindParam(":BOT_ID", $this->BOT_ID);

        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }
}
?>