<?php
// required headers
include_once '../config/headers.php';
  
// get database connection
include_once '../config/database.php';
  
// instantiate accounts object
include_once '../objects/account.php';


$database = new Database();
$db = $database->getConnection();
  
$account = new Account($db);

if (isset($_GET['username']) === false || isset($_GET['password']) === false) {
     // set response code - 400 bad request
     http_response_code(400);
  
     // tell the user
     echo json_encode(array('message' => 'Unable to fetch account. Params is incomplete.'));
     die();
}

$account->username = $_GET['username'];
$account->password = $_GET['password'];
$account->readOne();
  
if($account->account_id !== null) {
    // create array
    $account_arr = array(
        'account_id' =>  $account->account_id,
        'username' => $account->username,
        'email' => $account->email,
        'created' => $account->created
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($account_arr);
}
else {
    // set response code - 404 Not found
    http_response_code(404);
    
  
    // tell the user product does not exist
    echo json_encode(array('message' => 'Account does not exist.'));
}