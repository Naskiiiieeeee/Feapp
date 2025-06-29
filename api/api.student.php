<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Content-Type: application/json");

require_once __DIR__ . '/../app/ViewModels/StudentViewModel.php';

$vm = new StudentViewModel();

if($_SERVER['REQUEST_METHOD'] === 'GET'){
    if(isset($_GET['delete'])){
        $vm->deleteStudent($_GET['delete']);
        echo json_encode(['status' => 'success']);
    }else{
        echo json_encode($vm->allStudent());
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $studentID = filter_input(INPUT_POST, 'student_no', FILTER_SANITIZE_SPECIAL_CHARS);
    $studentName = filter_input(INPUT_POST, 'student_name', FILTER_SANITIZE_SPECIAL_CHARS);
    $section = filter_input(INPUT_POST, 'student_section', FILTER_SANITIZE_SPECIAL_CHARS);

    error_log("Saving student: $studentID, $studentName, $section");

    if (isset($_GET['create'])) {
        $vm->createNewstudent($studentID, $studentName, $section, $year);
        echo json_encode(['status' => 'created']);
    } elseif (isset($_GET['update']) && isset($_POST['si_id'])) {
        $vm->updateStudent($_POST['si_id'], $studentName, $section);
        echo json_encode(['status' => 'updated']);
    }

    exit;
}
