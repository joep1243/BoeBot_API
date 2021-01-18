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
include_once '../objects/BotRoute.php';
include_once '../auth/AuthCheck.php';
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$BotRoute = new BotRoute($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));
  
// make sure data is not empty
if(
    !empty($data->ID) &&
    !empty($data->API_code) 
){
    if(true == AuthCheck($data->API_code)){

  
        // set BotAccount property values   
        $BotRoute->BOT_ID = $data->ID;
    
        // read products will be here
        // query products
        $stmt = $BotRoute->getroute();
        $num = $stmt->rowCount();

        // check if more than 0 record found
        if($num>0){
        
            // products array
            $routearrary=array();
            $routearrary["route"]=array();
        
            // retrieve our table contents
            // fetch() is faster than fetchAll()
            // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                // extract row
                // this will make $row['name'] to
                // just $name only
                extract($row);
        
                $routeitem=array(
                    "ID" => $ID,
                    "BOT_ID" => $BOT_ID,
                    "MAX_X" => $MAX_X,
                    "MAX_Y" => $MAX_Y,
                    "start" => $start,
                    "end" => $end,
                    "blockade" => $blockade
                );
        
                array_push($routearrary["route"], $routeitem);
            }
        
            // set response code - 200 OK
            http_response_code(200);
        
            // show products data in json format
            echo json_encode($routearrary);

        }else{
        
            // set response code - 404 Not found
            http_response_code(404);
        
            // tell the user no products found
            echo json_encode(
                array("message" => "No route found.")
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