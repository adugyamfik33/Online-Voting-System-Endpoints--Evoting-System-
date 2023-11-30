<?php
include $_SERVER['DOCUMENT_ROOT'].'/votingSystem/config/conn.php';

$sendsms = new Sendsms();

$sendsms->voters_id = $_POST['voters_id'];
$sendsms->password = $_POST["password"];
$sendsms->firstname = $_POST['firstname'];
$sendsms->lastname = $_POST['lastname'];
$sendsms->platform = $_POST['platform'];
$sendsms->contact = $_POST['contact'];

if($sendsms->save()){
    $result['code'] = 200;
    $result['message'] = ' Added Successfully';
    $result['data'] = $sendsms->to_array();
}
else{
    $result['code'] = 400;
    $result['message'] = 'Failed to add';
    $result['data'] = array();
}

header('Content-Type: application/json; charset = utf-8');
echo json_encode($result);