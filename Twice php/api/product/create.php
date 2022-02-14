<?php
include_once '../config/headers.php';
  
// get database connection
include_once '../config/database.php';
  
// instantiate product object
include_once '../objects/product.php';

$database = new Database();
$db = $database->getConnection();
  
$product = new Product($db);
// get posted data
$data = json_decode(file_get_contents('php://input'));

if(isDataEmpty($data) === false) {
    $product->product_name = $data->product_name;
    $product->product_img_1 = $data->product_img_1;
    $product->product_img_2 = $data->product_img_2;
    $product->product_img_3 = $data->product_img_3;
    $product->prize = $data->prize;
    $product->rating = $data->rating;
    $product->is_latest = $data->is_latest;
    $product->is_feature = $data->is_feature;
    $product->created = date('Y-m-d H:i:s');

    if($product->create() === true){
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array('message' => 'Product was created.'));
    } else {
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array('message' => 'Unable to create product.'));
    }
} else {
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array('message' => 'Unable to create product. Data is incomplete.'));
}


//Check if data is complete for creating product
function isDataEmpty($data){
    if (empty($data->product_name) === true) {
        return true;
    }
    if (empty($data->product_img_1) === true) {
        return true;
    }
    if (empty($data->prize) === true) {
        return true;
    }
    if (empty($data->rating) === true) {
        return true;
    }
    return false;
}