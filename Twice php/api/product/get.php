<?php
// required headers
include_once '../config/headers.php';
  
// get database connection
include_once '../config/database.php';
  
// instantiate accounts object
include_once '../objects/product.php';


$database = new Database();
$db = $database->getConnection();
  
$product = new Product($db);

if (isset($_GET['id']) === false) {
     // set response code - 400 bad request
     http_response_code(400);
  
     // tell the user
     echo json_encode(array('message' => 'Unable to fetch product. Params is incomplete.'));
     die();
}

$product->product_id = $_GET['id'];
$product->getOne();
  
if($product->product_name !== null) {
    // create array
    $product_item = [
        'product_id' => $product->product_id,
        'product_name' => $product->product_name,
        'product_img_1' => $product->product_img_1,
        'product_img_2' =>$product->product_img_2,
        'product_img_3' => $product->product_img_3,
        'prize' => $product->prize,
        'rating' => $product->rating,
        'is_latest' => $product->is_latest,
        'is_feature' => $product->is_feature,
        'created' => $product->created
    ];
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($product_item);
}
else {
    // set response code - 404 Not found
    http_response_code(404);
    
  
    // tell the user product does not exist
    echo json_encode(array('message' => 'Product does not exist.'));
}