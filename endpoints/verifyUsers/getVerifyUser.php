<?php
include $_SERVER['DOCUMENT_ROOT'].'/votingSystem/config/conn.php';
$id = $_GET['id'];

$verifyUser = VerifyUsers::find_by_id($id);

if(!empty($verifyUser)){
    $verifyUser = $verifyUser->to_array();
    $result['code'] = 200;
    $result['message'] = 'Found Successfully';
    $result['data'] = $verifyUser;
}
else {
    $result['code'] = 400;
    $result['message'] = 'Not Found';
    $result['data'] = array();
}

header('Content-Type: application/json; charset = utf-8');
echo json_encode($result);