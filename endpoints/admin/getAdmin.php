<?php
include $_SERVER['DOCUMENT_ROOT'].'/votingSystem/config/conn.php';
$id = $_GET['id'];

$admin = Admin::find_by_id($id);

if(!empty($admin)){
    $admin = $admin->to_array();
    $result['code'] = 200;
    $result['message'] = 'Admin Found';
    $result['data'] = $admin;
}
else{
    $result['code'] = 400;
    $result['message'] = 'Admin not Found';
    $result['data'] = array();
}

header('Content-Type: application/json; charset = utf-8');
echo json_encode($result);
