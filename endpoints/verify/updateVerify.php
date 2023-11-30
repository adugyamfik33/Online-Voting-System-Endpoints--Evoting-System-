<?php
include $_SERVER['DOCUMENT_ROOT'].'/votingSystem/config/conn.php';
$id = $_GET['id'];

$uploadDirectory = 'votingSystem/uploads/verify/';
$date = gmdate('d-m-y');
$time = time();
$fileName = '';
$FileextensionsAllowed = ['jpeg','jpg','png','webp'];
$errors = [];

if(!empty($_FILES['photo']) && $_FILES['photo'] > 0){
    $fileName = $_FILES['photo']['name'];
    $fileSize = $_FILES['photo']['size'];
    $fileTmpName = $_FILES['photo']['tmp_name'];
    $fileType = $_FILES['photo']['type'];

    $photo_components = explode('.',$fileName);
    $fileExtension = strtolower(array_pop($photo_components));
    $uploadPath = $_SERVER['DOCUMENT_ROOT'].'/'.$uploadDirectory.$time.basename($fileName);

    if(!in_array($fileExtension,$FileextensionsAllowed)){
        $errors[] = 'File extension not allowed. Upload JPEG or PNG image';
    }
    if($fileSize > 4000000){
        $errors[] = 'File exceeds maximum size (4MB)';
    }
    if(empty($errors)){
        $uploadedFile = move_uploaded_file($fileTmpName,$uploadPath);
        if($uploadedFile){
            $fileName = $uploadDirectory.$time.basename($fileName);
        }
        else{
            $result['code'] = 400;
            $result['message'] = 'Unable to upload Image';
            $result['data'] = array();
        }
    }
    else{
        $result['code'] = 400;
        $result['message'] = implode('\n',$errors);
        $result['data'] = array();
    }
}

if(empty($errors)){
    $verify =  Verify::find_by_id($id);
    if($_POST['voters_id'] != ''){
        $verify->voters_id = $_POST['voters_id'];
    }
    if($_POST['password'] != ''){
        $verify->password = $_POST['password'];
    }
    if($_POST['firstname'] != ''){
        $verify->firstname = $_POST['firstname'];
    }
    if($_POST['lastname'] != ''){
        $verify->lastname = $_POST['lastname'];
    }
    if($_POST['platform'] != ''){
        $verify->platform = $_POST['platform'];
    }
    if($_POST['status'] != ''){
        $verify->status = $_POST['status'];
    }

    if(!empty($_FILES['photo'])){
        if(file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$verify->photo)){
            unlink($_SERVER['DOCUMENT_ROOT'].'/'.$verify->photo);
        }
    }
    
    $verify->photo = $fileName;

    if($verify->save()){
        $result['code'] = 200;
        $result['message'] = 'Successful';
        $result['data'] = $verify->to_array();
    }
    else {
        $result['code'] = 400;
        $result['message'] = 'Failed';
        $result['data'] = array();
    }
}


header('Content-Type: application/json; charset = utf-8');
echo json_encode($result);