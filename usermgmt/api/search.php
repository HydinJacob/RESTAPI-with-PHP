<?php

//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// initializing API

include_once('../core/initialize.php');


$user = new User($db);

$data = json_decode(file_get_contents("php://input"));
$user->first_name = $data->first_name;

$user->search();

$user_arr = array(
    'id' => $user->id,
    'first_name' => $user->first_name,
    'last_name' => $user->last_name,
    'username' => $user->username,
    'mode' => $user->darkmode
);
echo json_encode($user_arr);


