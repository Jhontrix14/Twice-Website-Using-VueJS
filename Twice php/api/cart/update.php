<?php
include_once '../config/headers.php';
  
// get database connection
include_once '../config/database.php';
  
// instantiate accounts object
include_once '../objects/cart.php';


$database = new Database();
$db = $database->getConnection();
  
$cart = new Cart($db);
// get posted data
$data = json_decode(file_get_contents('php://input'));

if(isDataEmpty($data) === false) {
    $cart->account_id = $data->account_id;
    $cart->product_id = $data->product_id;
    $cart->quantity = $data->quantity;

    if($cart->getOne() === null){
        // set response code - 400 created
        http_response_code(400);
  
        // tell the user
        echo json_encode(array('message' => 'Product does not exist, add first to cart'));
        die();
    }

    if($cart->update() === true){
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array('message' => 'Product quantity updated.'));
    } else {
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array('message' => 'Unable to update cart.'));
    }
}
  
// tell the user data is incomplete
else{
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array('message' => 'Unable to update cart. Data is incomplete.'));
}

//Check if data is complete for adding to cart
function isDataEmpty($data){
    if (empty($data->account_id) === true) {
        return true;
    }
    if (empty($data->product_id) === true) {
        return true;
    }
    if (empty($data->quantity) === true) {
        return true;
    }
    return false;
}