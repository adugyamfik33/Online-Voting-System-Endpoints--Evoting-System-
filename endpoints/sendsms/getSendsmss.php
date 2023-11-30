<?php
include $_SERVER['DOCUMENT_ROOT'].'/votingSystem/config/conn.php';

$sendsms = Sendsms::find('all');
$sendsms = array_map(function($res){
    return $res->to_array();
},$sendsms);

if(!empty($sendsms)){
    $result['code'] = 200;
    $result['message'] = 'Found successfully';
    $result['data'] = $sendsms;
}
else {
    $result['code'] = 400;
    $result['message'] = 'Not Found';
    $result['data'] = array();
}

header('Content-Type: application/json; charset = utf-8');
echo json_encode($result);