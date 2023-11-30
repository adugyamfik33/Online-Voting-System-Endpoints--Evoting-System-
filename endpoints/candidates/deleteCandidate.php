<?php
include $_SERVER['DOCUMENT_ROOT'].'/votingSystem/config/conn.php';
$id = $_GET['id'];
$candidate =Candidates::find_by_id($id);

if(!empty($candidate)){
    $img = $candidate->photo;
    if($candidate->delete()){
        if(file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$img)){
            unlink($_SERVER['DOCUMENT_ROOT'].'/'.$img);
        }
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
    $result['message'] = 'Candidate not Found';
}

header('Content-Type: application/json; charset = utf-8');
echo json_encode($result);