<?php
require_once '../backend/ViewModels/SubjectViewModel.php';
header("Content-Type: application/json");

$vm = new SubjectViewModel();

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnSaveSubject'])){
    $sCode = filter_input(INPUT_POST, 'sCode', FILTER_SANITIZE_SPECIAL_CHARS);
    $sDes = filter_input(INPUT_POST, 'sDes', FILTER_SANITIZE_SPECIAL_CHARS);
    $sdepartment = filter_input(INPUT_POST, 'department', FILTER_SANITIZE_SPECIAL_CHARS);
    $scourse = filter_input(INPUT_POST, 'course', FILTER_SANITIZE_SPECIAL_CHARS);
    $syear = filter_input(INPUT_POST, 'syear', FILTER_SANITIZE_SPECIAL_CHARS);

    try{
        $result = $vm->setNewSubject($sCode,$sDes,$sdepartment,$scourse,$syear);
        if($result){
            echo json_encode("added");
        }else{
            echo json_encode("error");
        }
    }catch(Exception $e){
        echo json_encode("error" .$e->getMessage());
    }
    exit;
}
?>