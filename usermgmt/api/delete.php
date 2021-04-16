<?php

//headers

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

// initializing API

include_once('../core/initialize.php');


$user = new User($db);

$user->id = isset($_GET['id']) ? $_GET['id'] : die();

if($user->delete())
{
    echo json_encode(
        array('message' => 'User entry deleted')
    );
}
else{
    echo json_encode(
        array('message' => 'User entry deletion failed')
    );
}


