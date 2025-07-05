<?php
require_once '../backend/ViewModels/UserStudentViewModel.php';
header("Content-Type: application/json");
$vm = new UserStudentViewModel();

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteUser'])){
    $userId = filter_input(INPUT_POST, 'deleteUser' , FILTER_SANITIZE_SPECIAL_CHARS);
    $result = $vm->deleteStudent($userId);

    if($result){
        echo json_encode("success");
    }else{
        echo json_encode("error");
    }
    exit;
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnUpdateAccess'])){
    $id = filter_input(INPUT_POST , 'id' , FILTER_SANITIZE_SPECIAL_CHARS);
    $status = filter_input(INPUT_POST , 'status' , FILTER_SANITIZE_SPECIAL_CHARS);
    
    $result = $vm->updateStudent($id, $status);
    if($result){
        echo json_encode("updated");
    }else{
        echo json_encode("error");
    }
    exit;
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnSaveStudentProfile'])){
    $fullname = filter_input(INPUT_POST, 'fullname', FILTER_SANITIZE_SPECIAL_CHARS);
    $section = filter_input(INPUT_POST, 'section', FILTER_SANITIZE_SPECIAL_CHARS); 
    $yearLvl = filter_input(INPUT_POST, 'yearLvl', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $studentNo = filter_input(INPUT_POST, 'studentNo', FILTER_SANITIZE_SPECIAL_CHARS);
    $role = "Student";

    $existEmail = $vm->getUserEmail($email);
    if(!$existEmail){
        $result = $vm->addStudent($email,$studentNo, $fullname, $section, $yearLvl, $role);
        if($result){
            echo json_encode("added");
        }else{
            echo json_encode("error");
        }
        exit;
    }else{
        echo json_encode("error");
    }
    exit;
}