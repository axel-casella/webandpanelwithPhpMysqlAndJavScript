<?php

require_once '../autoload.php';
header("Content-Type: application/json");

$inputData = file_get_contents('php://input');
$postData = json_decode($inputData,true);

$email = $postData['email'];
$password = $postData['password'];

$auth = new Auth();

if($auth->login($email, $password)){
    echo json_encode([
        'usuario' => $auth->getUser()->getEmail(),
        'exito' => true,
    ]);
}else{
    echo json_encode([
        'exito' => false,
    ]);
}