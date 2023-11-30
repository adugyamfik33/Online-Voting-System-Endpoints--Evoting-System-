<?php
include $_SERVER['DOCUMENT_ROOT'].'/votingSystem/config/conn.php';
$id = $_GET['id'];

$verifyUser = VerifyUsers::find_by_id($id);

if(!empty($verifyUser)){
    if($_POST['username'] != ''){
        $verifyUser->username = $_POST['username'];
    }
    if($_POST['password'] != ''){
        $verifyUser->password = $_POST['password'];
    }

    if($verifyUser->save()){
        $result['code'] = 200;
        $result['message'] = 'Updated Successfully';
        $result['data'] = $verifyUser->to_array();
    }
    else{
        $result['code'] = 400;
        $result['message'] = 'Failed to Update';
        $result['data'] = array();
    }
}
else{
    $result['code'] = 400;
    $result['message'] = 'Not Found';
    $result['data'] = array();
}

header('Content-Type: application/json; charset = utf-8');
echo json_encode($result);