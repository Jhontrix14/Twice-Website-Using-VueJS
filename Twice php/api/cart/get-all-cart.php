<?php
include_once '../config/headers.php';
  
// get database connection
include_once '../config/database.php';
  
// instantiate product object
include_once '../objects/cart.php';

$database = new Database();
$db = $database->getConnection();
  
$cart = new Cart($db);

if (isset($_GET['account_id']) === false) {
     // set response code - 400 bad request
     http_response_code(400);
  
     // tell the user
     echo json_encode(array('message' => 'Unable to fetch cart. Params is incomplete.'));
     die();
}

$cart->account_id = $_GET['account_id'];

$cart_arr = $cart->getAllCart();

if(empty($cart_arr) === false) {
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($cart_arr);
}
else {
    // set response code - 404 Not found
    http_response_code(404);
    
  
    // tell the user product does not exist
    echo json_encode(array('message' => 'No carts data.'));
}