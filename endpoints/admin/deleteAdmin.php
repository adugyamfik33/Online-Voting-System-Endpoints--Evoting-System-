<?php
include $_SERVER['DOCUMENT_ROOT'].'/votingSystem/config/conn.php';
$id = $_GET['id'];
$admin =Admin::find_by_id($id);

if(!empty($admin)){
    $img = $admin->photo;
    if($admin->delete()){
        if(file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$img)){
            unlink(file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$img));
        }
        $result['code'] = 200;
        $result['message'] = 'Admin deleted Successfully';
    }
    else{
        $result['code'] = 400;
        $result['message'] = 'Unable to delete Admin'; 
    }
}
else{
    $result['code'] = 400;
    $result['message'] = 'Admin not Found';
}

header('Content-Type: application/json; charset = utf-8');
echo json_encode($result);