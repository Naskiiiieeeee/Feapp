<?php
require_once __DIR__ . '/../backend/ViewModels/YearLevelViewModel.php';
header('Content-Type: application/json');

$vm = new YearLevelViewModel();

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnSaveYearLevel'])){
    $yearLvl = filter_input(INPUT_POST , 'yearLvl', FILTER_SANITIZE_SPECIAL_CHARS);
    $dateCreated = filter_input(INPUT_POST , 'dateCreated', FILTER_SANITIZE_SPECIAL_CHARS);
    
    try{
        $result = $vm->setYearLevel($yearLvl,$dateCreated);
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

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteYear'])){
    $deleteYear = filter_input(INPUT_POST ,'deleteYear', FILTER_SANITIZE_SPECIAL_CHARS);

    try{
        $result = $vm->deleteYear($deleteYear);

        if($result){
            echo json_encode("success");    
        }else{
            echo json_encode("error");
        }
    }catch(Exception $e){
        echo json_encode("error".$e->getMessage());
    }
    exit;
}
?>