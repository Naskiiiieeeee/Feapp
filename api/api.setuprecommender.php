<?php
session_start();
header('Content-Type: application/json');
require_once '../backend/Core/Database.php';

$db = new Database();
$conn = $db->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnSubmitEvaluation'])) {
    $student_email = $_SESSION['email'] ?? '';
    $token = $_POST['faculty_token'] ?? '';
    $decoded = base64_decode($token);
    list($code, $salt) = explode('|', $decoded);

    $academic_avg = $_POST['academic_avg'] ?? 0;
    $core_values_avg = $_POST['core_values_avg'] ?? 0;
    $overall_score = $_POST['overall_score'] ?? 0;

    $strengths = $_POST['strengths'] ?? '';
    $improvements = $_POST['improvements'] ?? '';
    $comments = $_POST['comments'] ?? '';

    if ($code === $salt) {
        $facultyCode = $code;
        $faculty_token = $code; 

        $stmt = $conn->prepare("SELECT id FROM faculty_evaluations WHERE student_email = ? AND faculty_token = ?");
        $stmt->execute([$student_email, $faculty_token]);

        if ($stmt->rowCount() > 0) {
            echo json_encode("already_evaluated");
            exit;
        }
        $insert = $conn->prepare("INSERT INTO faculty_evaluations 
            (student_email, faculty_token, academic_avg, core_values_avg, overall_score, feedback_strengths, feedback_improvements, feedback_comments)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        $success = $insert->execute([
            $student_email,
            $faculty_token,
            $academic_avg,
            $core_values_avg,
            $overall_score,
            $strengths,
            $improvements,
            $comments
        ]);

        if ($success) {
            echo json_encode("added");
        } else {
            echo json_encode("error_saving");
        }
    } else {
        echo json_encode("invalid");
    }
} else {
    echo json_encode("invalid_request");
}
