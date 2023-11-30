<?php
include $_SERVER['DOCUMENT_ROOT'].'/votingSystem/config/conn.php';
$id = $_GET['id'];

$position = Positions::find_by_id($id);

if(!empty($position)){
    if($_POST['description'] != ''){
        $position->description = $_POST['description'];
    }
    if($_POST['max_vote'] != ''){
        $position->max_vote = $_POST['max_vote'];
    }
    if($_POST['priority'] != ''){
        $position->priority = $_POST['priority'];
    }
    if($_POST['platform'] != ''){
        $position->platform = $_POST['platform'];
    }

    if($position->save()){
        $result['code'] = 200;
        $result['message'] = 'Updated Successfully';
        $result['data'] = $position->to_array();
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