<?php
include $_SERVER['DOCUMENT_ROOT'].'/votingSystem/config/conn.php';
$id = $_GET['id'];

$vote = Votes::find_by_id($id);

if(!empty($vote)){
    if($_POST['voters_id'] != ''){
        $vote->voters_id = $_POST['voters_id'];
    }
    if($_POST['candidate_id'] != ''){
        $vote->candidate_id = $_POST['candidate_id'];
        $candidate = Candidates::find_by_is($_POST['candidate_id']);
        $vote->position_id = $candidate->position_id;
    }

    if($voter->save()){
        $result['code'] = 200;
        $result['message'] = 'Updated Successfully';
        $result['data'] = $vote->to_array();
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