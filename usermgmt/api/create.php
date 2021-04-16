<?php

//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

// initializing API

include_once('../core/initialize.php');


$user = new User($db);


$data = json_decode(file_get_contents("php://input"));

$user->first_name = $data->first_name;
$user->last_name = $data->last_name;
$user->username = $data->username;
$user->darkmode = $data->darkmode;

if($user->create())
{
    echo json_encode(
        array('message' => 'New user created')
    );
}
else{
    echo json_encode(
        array('message' => 'New user created failed')
    );
}