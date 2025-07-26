<?php 
require_once '../backend/ViewModels/SchedEvalViewModel.php';
header("Content-Type: application/json");

$vm = new SchedEvalViewModel();

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnSaveSched'])){
    $department = filter_input(INPUT_POST , 'department' , FILTER_SANITIZE_SPECIAL_CHARS);
    $startDate = filter_input(INPUT_POST , 'startDate' , FILTER_SANITIZE_SPECIAL_CHARS);
    $endDate = filter_input(INPUT_POST , 'endDate' , FILTER_SANITIZE_SPECIAL_CHARS);
    $adminAccount = filter_input(INPUT_POST , 'adminAccount' , FILTER_SANITIZE_SPECIAL_CHARS);

    try{
        $result = $vm->createNewSchedule($department,$startDate,$endDate,$adminAccount);
        if($result){
            echo json_encode(["status" => "added"]);
        }else{
            echo json_encode(["status" => "error"]);
        }
    }catch(Exception $e){
        echo json_encode(["status" => 'error'. $e->getMessage()]);
    }
    exit;
}

if($_SERVER["REQUEST_METHOD"] === 'POST' && isset($_POST['deleteSched'])){
    $deleteSched = filter_input(INPUT_POST , 'deleteSched' , FILTER_SANITIZE_SPECIAL_CHARS);

    try{
        $result = $vm->getdeleteEval($deleteSched);
        if($result){
            echo json_encode("success");
        }else{
            echo json_encode("error");
        }

    }catch(Exception $e ){
        echo json_encode(["error" . $e->getMessage()]);
    }
    exit;

}
?>