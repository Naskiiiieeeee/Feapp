<?php
require_once '../backend/ViewModels/SectionViewModel.php';
header("Content-Type: application/json");

$vm = new SectionViewModel();

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnSaveSection'])){
    $sectionName = filter_input(INPUT_POST , 'sectionName' , FILTER_SANITIZE_SPECIAL_CHARS);
    $dateCreated = filter_input(INPUT_POST , 'dateCreated' , FILTER_SANITIZE_SPECIAL_CHARS);

    try{
        $result = $vm->setCreateNewSection($sectionName,$dateCreated);

        if($result){
            echo json_encode("added");
        }else{
            echo json_encode("error");
        }
    }catch(Exception $ex){
        echo json_encode("error" . $ex->getMessage());
    }
    exit;
}



if($_SERVER['REQUEST_METHOD']   === 'POST' && isset($_POST['deleteSection'])){
    $id = filter_input(INPUT_POST, 'deleteSection' , FILTER_SANITIZE_SPECIAL_CHARS);
    try{
        $result = $vm->getDeleteSection($id);

        if($result){
            echo json_encode("success");
        }else{
            echo json_encode("error");
        }
    }catch(Exception $e){
        echo json_encode("error" . $e->getMessage());
    }
    exit;
}


?>