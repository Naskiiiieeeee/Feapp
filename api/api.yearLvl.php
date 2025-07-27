<?php
require_once __DIR__ . '/../backend/ViewModels/YearLevelViewModel.php';
header('Content-Type: application/json');

$vm = new YearLevelViewModel();

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btns'])){
    $yearLvl = filter_input(INPUT_POST , 'yearlvl', FILTER_SANITIZE_SPECIAL_CHARS);
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

?>