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
                $fetchEmail = $row['userEmail'];
            }
            $setpassword = $userDatas->setnewpassword($email,$password);
            if($setpassword){
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
}
