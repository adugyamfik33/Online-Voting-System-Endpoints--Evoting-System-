<?php
include $_SERVER['DOCUMENT_ROOT'].'/votingSystem/config/conn.php';

$vote = Votes::find('all');
$vote = array_map(function($res){
    return $res->to_array(array('include' => array('candidates','positions','voters')));
},$vote);
if(!empty($vote)){
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