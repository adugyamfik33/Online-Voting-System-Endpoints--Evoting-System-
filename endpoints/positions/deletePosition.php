<?php
include $_SERVER['DOCUMENT_ROOT'].'/votingSystem/config/conn.php';
$id = $_GET['id'];

$position = Positions::find_by_id($id);

if(!empty($position)){
    $candidates = Candidates::find_all_by_position_id($id);
    $candidates = array_map(function($res){
        return $res->to_array();
    },$candidates);
    if(!empty($candidates)){
        foreach ($candidates as $candidate) {
            $candidate->delete();
        }
    }
    if($position->delete()){
        $result['code'] = 200;
        $result['message'] = 'Deleted Successfully';
    }
    else{
        $result['code'] = 400;
        $result['message'] = 'Failed to delete';
    }
}
else{
    $result['code'] = 400;
    $result['message'] = 'Position not Found';
}

header('Content-Type: application/json; charset: utf-8');
echo json_encode($result);