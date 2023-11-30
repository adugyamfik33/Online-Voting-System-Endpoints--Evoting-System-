<?php
include $_SERVER['DOCUMENT_ROOT'].'/votingSystem/config/conn.php';
$id = $_GET['id'];

$uploadDirectory = 'votingSystem/uploads/admins/';
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
    $admin = Admin::find_by_id($id);
    if(!empty($admin)){
        if($_POST['username'] != ''){
            $admin->username = $_POST['username'];
        }
        if($_POST['password'] != ''){
            $admin->password = $_POST['password'];
        }
        if($_POST['firstname'] != ''){
            $admin->firstname = $_POST['firstname'];
        }
        if($_POST['lastname'] != ''){
            $admin->lastname = $_POST['lastname'];
        }
        if(!empty($_FILES['photo'])){
            if(file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$admin->photo)){
                unlink($_SERVER['DOCUMENT_ROOT'].'/'.$admin->photo);
            }
        }
        $admin->photo = $fileName;
        if($admin->save()){
            $result['code'] = 200;
            $result['message'] = 'Admin Updated Successfully';
            $result['data'] = $admin->to_array();
        }
        else{
            $result['code'] = 400;
            $result['message'] = 'Failed to Update Admin';
            $result['data'] = array();
        }
    }

}

header('Content-Type: application/json; charset = utf-8');
echo json_encode($result);