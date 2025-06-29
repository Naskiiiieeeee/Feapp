<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Content-Type: application/json");


require_once __DIR__ . '/../app/ViewModels/AuthViewModel.php';
$auth = new AuthViewModel();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $user = $auth->login($email, $password);

    if ($user) {
        $_SESSION['user'] = $user;
        echo json_encode(['success' => true, 'user' => $user]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid credentials']);
    }
    exit;
}

if (isset($_GET['logout'])) {
    session_start();
    session_unset();
    session_destroy();
    echo json_encode(['success' => true]);
    exit;
}
