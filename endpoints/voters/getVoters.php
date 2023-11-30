<?php
include $_SERVER['DOCUMENT_ROOT'].'/votingSystem/config/conn.php';

$voter = Voters::find('all');
$voter = array_map(function($res){
    return $res->to_array(array('include' => array('verify','votes')));
},$voter);

if(!empty($voter)){
    $result['code'] = 200;
    $result['message'] = 'Found';
    $result['data'] = $voter;
}
else{
    $result['code'] = 400;
    $result['message'] = 'Not Found';
    $result['data'] = array();
}

header('Content-Type: application/json; charset = utf-8');
echo json_encode($result);