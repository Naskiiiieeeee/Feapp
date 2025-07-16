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
    $password = filter_input(INPUT_POST, 'password' , FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

    
}
