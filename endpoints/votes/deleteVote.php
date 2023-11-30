<?php
include $_SERVER['DOCUMENT_ROOT'].'/votingSystem/config/conn.php';
$id = $_GET['id'];

$vote = Votes::find_by_id($id);

if(!empty($vote)){
    if($voter->delete()){
        $result['code'] = 200;
        $result['message'] = 'Deleted Successfully';
    }
    else{
        $result['code'] = 400;
        $result['message'] = 'Failed to Delete';
    }
}
else{
    $result['code'] = 400;
    $result['message'] = 'Not Found';
}


header('Content-Type: application/json; charset = utf-8');
echo json_encode($result);