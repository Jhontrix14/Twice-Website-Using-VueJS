<?php
// required headers
include_once '../config/headers.php';
  
// get database connection
include_once '../config/database.php';
  
// instantiate accounts object
include_once '../objects/cart.php';


$database = new Database();
$db = $database->getConnection();
  
$cart = new Cart($db);

if (isset($_GET['account_id']) === false || isset($_GET['product_id']) === false) {
     // set response code - 400 bad request
     http_response_code(400);
  
     // tell the user
     echo json_encode(array('message' => 'Unable to fetch cart. Params is incomplete.'));
     die();
}

$cart->account_id = $_GET['account_id'];
$cart->product_id = $_GET['product_id'];
$cart_arr = $cart->getOne();
  
if($cart_arr !== null) {
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($cart_arr);
}
else {
    // set response code - 404 Not found
    http_response_code(404);
    
  
    // tell the user cart does not exist
    echo json_encode(array('message' => 'Cart is empty'));
}