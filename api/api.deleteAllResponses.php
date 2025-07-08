<?php
session_start();
require_once '../backend/Core/Database.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents("php://input"), true);
    $inputPassword = $input['password'] ?? '';
    $email = $_SESSION['email'] ?? null;

    if (!$email) {
        echo json_encode(['status' => 'error', 'message' => 'Unauthorized access.']);
        exit;
    }

    try {
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("SELECT `password` FROM `endusers` WHERE `email` = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user || !password_verify($inputPassword, $user['password'])) {
            echo json_encode(['status' => 'error', 'message' => 'Incorrect password.']);
            exit;
        }
        $deleteStmt = $conn->prepare("DELETE FROM `faculty_evaluations`");
        $deleteStmt->execute();

        echo json_encode(['status' => 'success', 'message' => 'All student responses successfully deleted.']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Server error: ' . $e->getMessage()]);
    }
}
