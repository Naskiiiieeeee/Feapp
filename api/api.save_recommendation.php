<?php
require_once '../backend/Core/Database.php';
header('Content-Type: application/json');

$db = new Database();
$conn = $db->getConnection();

file_put_contents('debug_recommender.log', json_encode($_POST) . PHP_EOL, FILE_APPEND); // TEMP DEBUG LOG

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['student_email'] ?? '';
    $token = $_POST['faculty_token'] ?? '';
    $recommendation = $_POST['ai_recommendation'] ?? '';
    $decoded = base64_decode($token);
    list($code, $salt) = explode('|', $decoded);
    $token = $code;

    if (!$email || !$token || !$recommendation) {
        echo json_encode(['status' => 'missing_data']);
        exit;
    }

    $checkStmt = $conn->prepare("SELECT id FROM faculty_evaluations WHERE student_email = ? AND faculty_token = ?");
    $checkStmt->execute([$email, $token]);

    if ($checkStmt->rowCount() === 0) {
        echo json_encode(['status' => 'evaluation_not_found']);
        exit;
    }

    $stmt = $conn->prepare("UPDATE faculty_evaluations SET ai_recommendation = ? WHERE student_email = ? AND faculty_token = ?");
    $success = $stmt->execute([$recommendation, $email, $token]);

    echo json_encode([
        'status' => $success ? 'saved' : 'error',
        'query_success' => $success,
        'recommendation' => $recommendation,
        'email' => $email,
        'token' => $token
    ]);
} else {
    echo json_encode(['status' => 'invalid_method']);
}