<?php
 // Allow from any origin
 if (isset($_SERVER['HTTP_ORIGIN'])) {
    // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
    // you want to allow, and if so:
    header('Access-Control-Allow-Origin: '. $_SERVER['HTTP_ORIGIN']);
    header('Access-Control-Max-Age: 3600');
    header('Access-Control-Allow-Credentials: true');
    header('Content-Type: application/json');
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header('Access-Control-Allow-Methods: '.$_SERVER['REQUEST_METHOD']);         
    
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header('Access-Control-Allow-Headers: '.$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']);

    exit(0);
}