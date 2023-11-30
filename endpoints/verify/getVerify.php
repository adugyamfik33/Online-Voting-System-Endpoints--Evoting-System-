<?php
include $_SERVER['DOCUMENT_ROOT'].'/votingSystem/config/conn.php';
$id = $_GET['id'];

$verify = Verify::find_by_id($id);

if(!empty($verify)){
    $verify = $verify->to_array(array('include' => array('voters')));
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