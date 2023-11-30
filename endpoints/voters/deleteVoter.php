<?php
include $_SERVER['DOCUMENT_ROOT'].'/votingSystem/config/conn.php';
$id = $_GET['id'];

$voter = Voters::find_by_id($id);

if(!empty($voter)){
    $img = $voter->photo;
    if($voter->delete()){
        if(file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$img)){
            unlink($_SERVER['DOCUMENT_ROOT'].'/'.$img);
        }
        $result['code'] = 200;
        $result['message'] = 'Deleted Successfully';
    }
    else{
        $result['code'] = 400;
        $result['message'] = 'Failed to Delete ';
    }

}
else{
    $result['code'] = 400;
    $result['message'] = 'Not Found';
    $result['data'] = array();
}

header('Content-Type: application/json; charset = utf-8');
echo json_encode($result);