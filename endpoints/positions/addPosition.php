<?php
include $_SERVER['DOCUMENT_ROOT'].'/votingSystem/config/conn.php';

$position = new Positions();

$position->description = $_POST['description'];
$position->max_vote = $_POST['max_vote'];
$position->priority =$_POST['priority'];
$position->platform = $_POST['platform'];

if($position->save()){
    $result['code'] = 200;
    $result['message'] = 'Added Successfully';
    $result['data'] = $position->to_array();
}
else{
    $result['code'] = 400;
    $result['message'] = 'Failed to Add';
    $result['data'] = array();
}

header('Content-Type: application/json; charset = utf-8');
echo json_encode($result);