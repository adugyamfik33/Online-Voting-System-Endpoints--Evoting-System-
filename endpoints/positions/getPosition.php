<?php
include $_SERVER['DOCUMENT_ROOT'].'/votingSystem/config/conn.php';
$id = $_GET['id'];

$position = Positions::find_by_id($id);

if(!empty($position)){
    $position = $position->to_array(array('include' => array('candidates','votes')));
    $result['code'] = 200;
    $result['message'] = 'Position Found';
    $result['data'] = $position;
}
else{
    $result['code'] = 400;
    $result['message'] = 'Position not Found';
    $result['data'] = array();
}

header('Content-Type: application/json; charset = utf-8');
echo json_encode($result);
