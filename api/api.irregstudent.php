<?php
require_once '../backend/ViewModels/IrregularStudentViewModel.php';
header('Content-Type: application/json');

$vm = new IrregularStudentViewModel();

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnSaveIrreg'])){
    $studentID = filter_input(INPUT_POST, 'studentID' , FILTER_SANITIZE_SPECIAL_CHARS);
    $subjectCode = filter_input(INPUT_POST, 'subjectCode' , FILTER_SANITIZE_SPECIAL_CHARS);
    $faculty = filter_input(INPUT_POST, 'faculty' , FILTER_SANITIZE_SPECIAL_CHARS);
    $semester = filter_input(INPUT_POST, 'semester' , FILTER_SANITIZE_SPECIAL_CHARS);
    $sy = filter_input(INPUT_POST, 'sy' , FILTER_SANITIZE_SPECIAL_CHARS);
    try{
        $result = $vm->CreateNewIrreg($studentID, $subjectCode, $faculty, $semester, $sy);
        if($result){
            echo json_encode("added");
        }else{
            echo json_encode("error");
        }
    }catch(Exception $e){
        echo json_encode("error" . $e->getMessage());
    }
    exit;
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteIrreg'])){
    $id = filter_input(INPUT_POST, 'deleteIrreg', FILTER_SANITIZE_SPECIAL_CHARS);

    try{
        $result = $vm->getDeleteIrreg($id);
        if($result){
            echo json_encode("success");
        }else{
            echo json_encode("error");
        }
    }catch(Exception $e){
        echo json_encode("error". $e->getMessage());
    }
    exit;
}

?>