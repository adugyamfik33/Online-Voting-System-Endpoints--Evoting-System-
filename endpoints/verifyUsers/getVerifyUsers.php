<?php
include $_SERVER['DOCUMENT_ROOT'].'/votingSystem/config/conn.php';

$verifyUser = VerifyUsers::find('all');
$verifyUser = array_map(function($res){
    return $res->to_array();
},$verifyUser);

if(!empty($verifyUser)){
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