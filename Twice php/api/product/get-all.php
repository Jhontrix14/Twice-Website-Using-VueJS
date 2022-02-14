<?php
include_once '../config/headers.php';
  
// get database connection
include_once '../config/database.php';
  
// instantiate product object
include_once '../objects/product.php';

$database = new Database();
$db = $database->getConnection();
  
$product = new Product($db);
$product_arr = $product->getAll();

if(empty($product_arr) === false) {
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($product_arr);
}
else {
    // set response code - 404 Not found
    http_response_code(404);
    
  
    // tell the user product does not exist
    echo json_encode(array('message' => 'No Products data.'));
}