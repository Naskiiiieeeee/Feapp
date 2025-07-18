<?php
require_once '../backend/ViewModels/DepartmentViewModel.php';
header('Content-Type: application/json');
$vm = new DepartmentViewModel();

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnSaveDepartment'])){
    $depCode = filter_input(INPUT_POST, 'depCode', FILTER_SANITIZE_SPECIAL_CHARS);
    $Description = filter_input(INPUT_POST, 'Description', FILTER_SANITIZE_SPECIAL_CHARS);

    try{
        $result = $vm->insertDepartment($depCode,$Description);
        if($result){
            echo json_encode(['status' => 'added']);
        }else{
            echo json_encode(['status' => 'isDuplicate']);
        }
        exit;
    }catch(Exception $e){
        echo json_encode(['status' => 'error' .$e->getMessage()]);
    }
    exit;
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnUpdateAccess'])){
    $depCode = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
    $status = $_POST['status'];
    
    try{
        $result = $vm->getupdateDepartment($depCode,$status,$description);
        if($result){
            echo json_encode(['status' => 'updated']);
        }else{
            echo json_encode(['status' => 'error']);
        }
    }catch(Exception $e){
        echo json_encode(['status' => 'error'. $e->getMessage()]);
    }
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteDep'])){
    $deleteDep = filter_input(INPUT_POST, 'deleteDep' , FILTER_SANITIZE_SPECIAL_CHARS);
    $result = $vm->getDeleteDepartment($deleteDep);

    if($result){
        echo json_encode("success");
    }else{
        echo json_encode("error");
    }
    exit;
}
?>