<?php
include_once '../config/db.php';
include_once '../objects/BotAccount.php';

function AuthCheck($API_code){

    $database = new Database();
    $db = $database->getConnection();
  
    $BotAccount = new BotAccount($db);

    $pieces = explode("/", $API_code);


    //print_r($pieces);
    //print_r($pieces[1]);
    

    
        // set BotAccount property values
        $BotAccount->username = $pieces[0];
    
        // query products
        $stmt = $BotAccount->getbot();
        $num = $stmt->rowCount();

        // check if more than 0 record found
        if($num>0){
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

                if($API_code == $row['API_code']) {
                    return true;
                }else{

                    return false;

                }
            }   
        }else{
            return false;
    }
}
?>