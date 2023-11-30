<?php
include $_SERVER['DOCUMENT_ROOT'].'/votingSystem/config/conn.php';

$position = Positions::find('all');
$position = array_map(function($res){
    return $res->to_array(array('include' => array('candidates','votes')));
},$position);

if(!empty($position)){
    $result['code'] = 200;
    $result['message'] = 'Positions Found';
    $result['data'] = $position;
}
else{
    $result['code'] = 200;
    $result['message'] = 'Positions not Found';
    $result['data'] = array();
}

header('Content-Type: application/json; charset = utf-8');
echo json_encode($result);