<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// database connection will be here
// include database and object files
include_once '../config/db.php';
include_once '../objects/BotCommand.php';
include_once '../auth/AuthCheck.php';
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$BotCommand = new BotCommand($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));
  
// make sure data is not empty
if(
    !empty($data->ID) &&
    !empty($data->API_code)
){
    if(true == AuthCheck($data->API_code)){

  
        // set BotAccount property values   
        $BotCommand->BOT_ID = $data->ID;
        $BotCommand->command = 0;
    
        if(true == $BotCommand->UpdateCommand()){
        
             // set response code - 200 OK
            http_response_code(200);
        
            // tell the user no products found
            echo json_encode(
                array("message" => "true.")
            );

        }else{
        
            // set response code - 404 Not found
            http_response_code(404);
        
            // tell the user no products found
            echo json_encode(
                array("message" => "false.")
            );
        }
    }else{

        // set response code - 404 Not found
        http_response_code(404);
        
        // tell the user no products found
        echo json_encode(
            array("message" => "Bad API code.")
        );

    }
}else{

    // set response code - 404 Not found
    http_response_code(404);
    
    // tell the user no products found
    echo json_encode(
        array("message" => "no data.")
    );

}

// no products found will be here