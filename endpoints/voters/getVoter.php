<?php
include $_SERVER['DOCUMENT_ROOT'].'/votingSystem/config/conn.php';
$id = $_GET['id'];

$voter = Voters::find_by_id($id);

if(!empty($voter)){
    $voter = $voter->to_array(array('include' => array('verify','votes')));
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