<?php
session_start();
require_once '../backend/ViewModels/AuthViewModel.php';
header("Content-Type: application/json");

$authVM = new AuthViewModel();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnLogin'])) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

    $result = $authVM->login($email, $password);

    if ($result) {
        $_SESSION['email'] = $result['user']['email'];
        $_SESSION['fullname'] = $result['user']['fullname'];
        $_SESSION['role'] = $result['role'];
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error"]);
    }
    exit;
}
