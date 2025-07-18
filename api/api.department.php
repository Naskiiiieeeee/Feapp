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
    }catch(Exception $e){
        echo json_encode(['status' => 'error' .$e->getMessage()]);
    }
}

?>