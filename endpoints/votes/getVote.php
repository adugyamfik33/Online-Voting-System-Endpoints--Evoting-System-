<?php
include $_SERVER['DOCUMENT_ROOT'].'/votingSystem/config/conn.php';
$id = $_GET['id'];

$vote = Votes::find_by_id($id);

if(!empty($vote)){
    $vote = $vote->to_array(array('include' => array('candidates','positions','voters')));
    $result['code'] = 200;
    $result['message'] = 'Found Successfully';
    $result['data'] = $vote;
}
else{
    $result['code'] = 400;
    $result['message'] = 'Not Found';
    $result['data'] = array();
}

header('Content-Type: application/json; charset = utf-8');
echo json_encode($result);