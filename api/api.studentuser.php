<?php

require_once '../backend/ViewModels/UserStudentViewModel.php';
$vm = new UserStudentViewModel();

header("Content-Type : application/json");

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteUser'])){
    $userId = filter_input(INPUT_POST, 'deleteUser' , FILTER_SANITIZE_SPECIAL_CHARS);
    $result = $vm->deleteStudent($userId);

    if($result){
        echo json_encode("success");
    }else{
        echo json_encode("error");
    }
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnUpdateAccess'])){
    $id = filter_input(INPUT_POST , 'id' , FILTER_SANITIZE_SPECIAL_CHARS);
    $status = filter_input(INPUT_POST , 'status' , FILTER_SANITIZE_SPECIAL_CHARS);
    
    $result = $vm->updateStudent($id, $status);
    if($result){
        echo json_encode("success");
    }else{
        echo json_encode("error");
    }
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnSaveStudent'])){
    
}