<?php
require_once '../backend/ViewModels/EvaluationViewModel.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vm = new EvaluationViewModel();

    if (isset($_POST['btnSaveEvaluations'])) {
        $requiredFields = [
            'FacultyID', 'FacultyName', 'FacultyEmail', 'FacultyDep',
            'AcadsRating', 'CoreValuesRating', 'OverallEvaluation', 'OverallRatings',
            'AiRecommendations', 'FeedbacksStrengths', 'FeedbackImprovements', 'FeedbackComments'
        ];

        $missing = array_filter($requiredFields, function($field){
            return !isset($_POST[$field]);
        });

        if (count($missing) > 0) {
            echo json_encode(["error" => "Missing fields: " . implode(", ", $missing)]);
            exit;
        }

        $facultyEmail = $_POST['FacultyEmail'];

        if (!$vm->checkIfCanSubmit($facultyEmail)) {
            echo json_encode("recent_exists");
            exit;
        }

        $isSaved = $vm->saveEvaluationSummary($_POST);

        if ($isSaved) {
            echo json_encode("added");
        } else {
            echo json_encode("error");
        }
        exit;
    }
}

// DELETE EVALUATION HISTORY
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteUser'])) {
    $userId = $_POST['deleteUser'];
    $result = $vm->deleteEvalHistory($userId);

    if ($result) {
        echo json_encode("success");
    } else {
        echo json_encode("error");
    }
    exit;
}
