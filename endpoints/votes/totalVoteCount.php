<?php
include $_SERVER['DOCUMENT_ROOT'].'/votingSystem/config/conn.php';

$votes = Votes::find('all');
$votes = array_map(function($res){
    return $res->to_array();
},$votes);
$count = 0;

if(!empty($votes)){
    foreach ($votes as $vote) {
        $count++;
    }
    $result['code'] = 200;
    $result['message'] = 'Votes Counted Successfully';
    $result['data'] = $count->to_array();
}
else{
    $result['code'] = 400;
    $result['message'] = 'No votes Cast';
    $result['data'] = array();
}

header('Content-Type: application/json; charset = utf-8');
echo json_encode($result);