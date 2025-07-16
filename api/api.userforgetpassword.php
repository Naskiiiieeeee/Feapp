<?php
require_once '../backend/Helpers/helpers.php';
require_once '../backend/ViewModels/UserPasswordViewModel.php';
header("Content-Type: application/json");
$vm = new Helpers();
$userDatas = new UserPasswordViewModel();

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnForgetPassword'])){
    $email = filter_input(INPUT_POST , 'email' , FILTER_SANITIZE_EMAIL);
    try{    
        $result = $vm->ForgetPassword($email);
        if($result){
            echo json_encode(["status" => "success"]);
        }else{
            echo json_encode(["status" => "error"]);
        }
        exit;
    }catch(Exception $e){
        echo json_encode(["status" => "error"]);
    }
    exit;
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnUpdatePassword'])){
    $code = filter_input(INPUT_POST, 'code' , FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    try{
        $saveDatas = $userDatas->getUsersFullDetails($email);
        if($saveDatas){
            foreach($saveDatas as $row){
                $fetchEmail = $row['email'];
            }
            $setpassword = $userDatas->setnewpassword($fetchEmail,$password);
            if($setpassword){
                $userDatas->deleteDatainresetDB($code);
                echo json_encode(["status" => "success"]);
            }else{
                echo json_encode(["status" => "passwordNotSave"]);
            }
        }else{
            echo json_encode(["status" => "notExist"]);
        }
    }catch(Exception $e){
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
    }
    exit;
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnRecoverAccount'])){
    $studentEmail = filter_input(INPUT_POST , 'studentID', FILTER_SANITIZE_SPECIAL_CHARS);
    try{
        $result = $vm->RecoveryAccount($studentEmail); 
        if($result){
            echo json_encode(["status" => "success"]);
        }else{
            echo json_encode(["status" => "accountNotFound"]);
        }
        exit;
    }catch(Exception $e){
        echo json_encode(["status" => "error", "message"=> $e->getMessage()]);
    }
    exit;
}
