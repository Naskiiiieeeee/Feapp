<?php
require_once "../backend/ViewModels/LoadingViewModel.php";
header('Content-Type: application/json');
$vm = new LoadingViewModel();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['departmentCode'])) {
    $departmentCode = $_POST['departmentCode'];
    $courses = $vm->getCoursesByDepartment($departmentCode);
    echo json_encode($courses);
} else {
    echo json_encode([]);
}

?>