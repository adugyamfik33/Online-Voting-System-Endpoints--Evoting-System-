<?php
include $_SERVER['DOCUMENT_ROOT'].'/votingSystem/config/conn.php';
$id = $_GET['id'];

$sendsms = Sendsms::find_by_id($id);

if(!empty($sendsms)){
    if($_POST['voters_id'] != '')
    {
        $sendsms->voters_id = $_POST['voters_id'];
    }
    if($_POST["password"] != '')
    {
        $sendsms->password = $_POST["password"];
    }
    if($_POST['contact'] != '')
    {
        $sendsms->contact = $_POST['contact'];
    }
    if($_POST['firstname'] != '')
    {
        $sendsms->firstname = $_POST['firstname'];
    }
    if($_POST['lastname'] != '')
    {
        $sendsms->lastname = $_POST['lastname'];
    }
    if($_POST['platform'] != '')
    {
        $sendsms->platform = $_POST['platform'];
    }
    if($sendsms->save()){
        $result['code'] = 200;
        $result['message'] = 'Updated Successfully';
        $result['data'] = $sendsms->to_array();
    }
    else{
        $result['code'] = 400;
        $result['message'] = 'Failed to Update';
        $result['data'] = array();
    }
}
else{
    $result['code'] = 400;
    $result['message'] = 'Not found';
    $result['data'] = array();
}

header('Content-Type: application/json; charset = utf-8');
echo json_encode($result);