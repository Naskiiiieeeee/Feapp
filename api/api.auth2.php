<?php
session_start();
require_once '../backend/ViewModels/AuthVModel.php';
header("Content-Type: application/json");

$authVM = new AuthViewModel();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnLogin'])) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

    $result = $authVM->login($email, $password);

    if ($result) {
        $_SESSION['email'] = $result['user']['student_email'];
        $_SESSION['fullname'] = $result['user']['student_name'];
        $_SESSION['role'] = $result['role'];
        header("Location: ../frontend/views/student_users/dashboardstudent");
        exit;
    } else {
        echo json_encode("error");
    }
}
