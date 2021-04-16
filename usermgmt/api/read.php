<?php

//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// initializing API

include_once('../core/initialize.php');


$user = new User($db);

$result = $user->read();

$num = $result->rowCount();

if($num > 0) {
    $user_arr = array();
    $user_arr['users'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) 
    {
        extract($row);
        $user_item = array(
            'id'  => $id,
            'first_name' => $first_name,
            'last_name'  => $last_name,
            'username' => $username,
            'mode' => $darkmode
        );
        array_push($user_arr['users'], $user_item);
    }
    echo json_encode($user_arr);
}
else{
    echo json_encode(array('message' => 'No users found'));
}