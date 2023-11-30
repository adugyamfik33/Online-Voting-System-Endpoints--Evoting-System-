<?php
include $_SERVER['DOCUMENT_ROOT'].'/votingSystem/config/conn.php';

$admin = Admin::find('all');
$admin = array_map(function($res){
    return $res->to_array();
},$admin);

if(!empty($admin)){
    $result['code'] = 200;
    $result['message'] = 'Admins Found';
    $result['data'] = $admin;
}
else{
    $result['code'] = 200;
    $result['message'] = 'Admins not Found';
    $result['data'] = array();
}

header('Content-Type: application/json; charset = utf-8');
echo json_encode($result);