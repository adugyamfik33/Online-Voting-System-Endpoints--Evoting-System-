<?php
header('Access-Control-Allow-Origin:*');
include $_SERVER['DOCUMENT_ROOT'].'/votingSystem/config/conn.php';

$votes_cast = json_decode($_POST['votes_cast']);
$voters_id = $_POST['voters_id'];
$errors = [];

foreach ($votes_cast as $vote_cast){
    $vote = new Votes();
    $vote->voters_id = $voters_id;
    $vote->candidate_id = $vote_cast->candidate_id;
    $candidate = Candidates::find_by_id($vote_cast->candidate_id);
    $vote->position_id = $candidate->position_id;
    if($vote->save()){
        $errors = [];   
    }
    else{
        $errors[] = 'Failed to save Vote';
    }
}

if(empty($errors)){
    $result['code'] = 200;
    $result['message'] = 'Vote Casted Successfully';
}
else{
    $result['code'] = 400;
    $result['message'] = 'Failed to Cast Vote';
}

header('Content-Type: application/json; charset = utf-8');
echo json_encode($result);