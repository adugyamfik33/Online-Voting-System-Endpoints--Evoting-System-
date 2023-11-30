<?php
include $_SERVER['DOCUMENT_ROOT'].'/votingSystem/config/conn.php';
$id = $_GET['id'];

$sendsms = Sendsms::find_by_id($id);

if(!empty($sendsms)){
    if($sendsms->delete()){
        $result['code'] = 200;
        $result['message'] = 'Deleted Successfully';
    }
    else{
        $result['code'] = 400;
        $result['message'] = 'Unable to delete';
    }
}
else{
    $result['code'] = 400;
    $result['message'] = 'Not found';
}

header('Content-Type: application/json; charset = utf-8');
echo json_encode($result);