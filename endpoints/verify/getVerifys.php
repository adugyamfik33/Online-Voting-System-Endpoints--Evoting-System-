<?php
include $_SERVER['DOCUMENT_ROOT'].'/votingSystem/config/conn.php';

$verify = Verify::find('all');
$verify = array_map(function($res){
    return $res->to_array(array('include' => array('voters')));
},$verify);

if(!empty($verify)){
    $result['code'] = 200;
    $result['message'] = 'Found';
    $result['data'] = $verify;
}
else{
    $result['code'] = 400;
    $result['message'] = 'Not Found';
    $result['data'] = array();
}

header('Content-Type: application/json; charset = utf-8');
echo json_encode($result);