<?php
include_once '../config/headers.php';
  
// get database connection
include_once '../config/database.php';
  
// instantiate accounts object
include_once '../objects/account.php';


$database = new Database();
$db = $database->getConnection();
  
$account = new Account($db);
// get posted data
$data = json_decode(file_get_contents('php://input'));

if(isDataEmpty($data) === false) {
    $account->username = $data->username;
    $account->email = $data->email;
    $account->password = $data->password;
    $account->created = date('Y-m-d H:i:s');
    if($account->checkUsernameExist() === true){
        // set response code - 400 created
        http_response_code(400);
  
        // tell the user
        echo json_encode(array('message' => 'Username already exist.'));
        die();
    }

    if($account->checkEmailExist() === true){
        // set response code - 400 created
        http_response_code(400);
  
        // tell the user
        echo json_encode(array('message' => 'Email already exist.'));
        die();
    }

    if($account->create() === true){
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array('message' => 'Account was created.'));
    } else {
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array('message' => 'Unable to create account.'));
    }
}
  
// tell the user data is incomplete
else{
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array('message' => 'Unable to create account. Data is incomplete.'));
}

//Check if data is complete for creating account
function isDataEmpty($data){
    if (empty($data->username) === true) {
        return true;
    }
    if (empty($data->email) === true) {
        return true;
    }
    if (empty($data->password) === true) {
        return true;
    }
    return false;
}