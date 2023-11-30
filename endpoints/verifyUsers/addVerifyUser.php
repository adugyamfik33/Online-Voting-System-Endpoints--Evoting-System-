<?php
include $_SERVER['DOCUMENT_ROOT'].'/votingSystem/config/conn.php';

$verifyUser = new VerifyUsers();

$verifyUser->username = $_POST['username'];
$verifyUser->password = $_POST['password'];

if($verifyUser->save()){
    $result['code'] = 200;
    $result['message'] = 'Successful';
    $result['data'] = $verifyUser->to_array();
}
else{
    $result['code'] = 400;
    $result['message'] = 'Failed';
    $result['data'] = array();
}

header('Content-Type: application/json; charset = utf-8');
echo json_encode($result);