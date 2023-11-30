<?php
include $_SERVER['DOCUMENT_ROOT'].'/votingSystem/config/conn.php';
$id = $_GET['id'];

$candidate = Candidates::find_by_id($id);

if(!empty($candidate)){
    $candidate = $candidate->to_array(array('include' => array('positions','votes')));
    $result['code'] = 200;
    $result['message'] = 'Candidate Found';
    $result['data'] = $candidate;
}
else{
    $result['code'] = 400;
    $result['message'] = 'Candidate not Found';
    $result['data'] = array();
}

header('Content-Type: application/json; charset = utf-8');
echo json_encode($result);
