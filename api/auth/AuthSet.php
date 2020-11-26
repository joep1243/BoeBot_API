<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once '../config/db.php';
  
// instantiate BotAccount object
include_once '../objects/BotAccount.php';
  
$database = new Database();
$db = $database->getConnection();
  
$BotAccount = new BotAccount($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
  
// make sure data is not empty
if(
    !empty($data->username) &&
    !empty($data->password) 
){
  
    // set BotAccount property values
    $BotAccount->username = $data->username;
    $BotAccount->password = $data->password;
  
    // query products
    $stmt = $BotAccount->getbot();
    $num = $stmt->rowCount();

    // check if more than 0 record found
    if($num>0){
    
        // products array
        //$products_arr=array();
        //$products_arr["records"]=array();
    
        // retrieve our table contents
        // fetch() is faster than fetchAll()
        // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            // extract row
            // this will make $row['name'] to
            // just $name only
   
            if($data->password == $row['password']) {

               //generate API_code
               $API_code = $row['username'].'/'.hash('md5', $row['ID'].$row['username'].rand(5, 15));

               //set values in bot object
               $BotAccount->ID = $row['ID'];
               $BotAccount->API_code = $API_code;

               if(true == $BotAccount->setAPIcode()){

                    // set response code - 200 OK
                    http_response_code(200);
                        
                    // show products data in json format
                    echo json_encode(
                        array("API_code" => $API_code)
                    );

               }else{
                    // set response code - 404 Not found
                    http_response_code(404);
                
                    // tell the user no products found
                    echo json_encode(
                        array("message" => "No account found1.")
                    );
                }
            }else{
                // set response code - 404 Not found
                http_response_code(404);
            
                // tell the user no products found
                echo json_encode(
                    array("message" => "No account found2.")
                );
            }
        }
    }else{
        // set response code - 404 Not found
        http_response_code(404);
      
        // tell the user no products found
        echo json_encode(
            array("message" => "No account found3.")
        );
    }
}else{
    // tell the user data is incomplete
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create code. Data is incomplete."));
}
?>