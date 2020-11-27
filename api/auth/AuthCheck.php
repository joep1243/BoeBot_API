<?php

function AuthCheck($API_code){

    $database = new Database();
    $db = $database->getConnection();
  
    $BotAccount = new BotAccount($db);

    $pieces = explode("/", $API_code);
    
        // set BotAccount property values
        $BotAccount->username = $pieces[0];
    
        // query products
        $stmt = $BotAccount->getbot();
        $num = $stmt->rowCount();

        // check if more than 0 record found
        if($num>0){
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                if($API_code == $row['password']) {
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