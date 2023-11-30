<?php
include $_SERVER['DOCUMENT_ROOT'].'/votingSystem/config/conn.php';

$candidate = Candidates::find('all');
$candidate = array_map(function($res){
    return $res->to_array(array('include' => array('positions','votes')));
},$candidate);

if(!empty($candidate)){
    $result['code'] = 200;
    $result['message'] = 'Candidates Found';
    $result['data'] = $candidate;
}
else{
    $result['code'] = 200;
    $result['message'] = 'Candidates not Found';
    $result['data'] = array();
}

header('Content-Type: application/json; charset = utf-8');
echo json_encode($result);