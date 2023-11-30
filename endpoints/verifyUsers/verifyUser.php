<?php
include $_SERVER['DOCUMENT_ROOT'].'/votingSystem/config/conn.php';

$username = $_POST['username'];
$password = $_POST['password'];

$verifyuser = VerifyUser::find_by_username_and_password($username,$password);

if(!empty($verifyuser)){
    $result['code'] = 200;
    $result['message'] = 'Found Successfully';
}
else{
    $result['code'] = 400;
    $result['message'] = 'Not Found';
}

header('Content-Type: application/json; charset = utf-8');
echo json_encode($result);