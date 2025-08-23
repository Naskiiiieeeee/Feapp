<?php
require_once "../backend/ViewModels/LoadingViewModel.php";
header('Content-Type: application/json');
$vm = new LoadingViewModel();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['departmentCode'])) {
    $departmentCode = $_POST['departmentCode'];

    $courses = $vm->getCoursesByDepartment($departmentCode);
    $yearLvls = $vm->getYearLevelsByDepartment($departmentCode);
    $subjects = $vm->getSubjectsByDepartment($departmentCode);

    echo json_encode([
        'courses' => $courses,
        'yearLvls' => $yearLvls,
        'subjects' => $subjects
    ]);
    exit;
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnSaveLoad'])){
    $department = filter_input(INPUT_POST, 'department', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $course = filter_input(INPUT_POST, 'course', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $yearLvl = filter_input(INPUT_POST, 'yearLvl', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $subjects = filter_input(INPUT_POST, 'subjects', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $section = filter_input(INPUT_POST, 'section', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $faculty = filter_input(INPUT_POST, 'faculty', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $semester = filter_input(INPUT_POST, 'semester', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $sy = filter_input(INPUT_POST, 'sy', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    try{
        $result = $vm->setNewLoad($department,$course,$yearLvl,$subjects,$section,$faculty, $semester ,$sy);

        if($result){
            echo json_encode("added");
        }else{
            echo json_encode("error");
        }
    }catch(Exception $ex){
        echo json_encode("error". $ex->getMessage());
    }   
    exit;
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteload'])){
    $id = filter_input(INPUT_POST , 'deleteload' , FILTER_SANITIZE_SPECIAL_CHARS);
    try{
        $result = $vm->getDeleteLoad($id);
        if($result){
            echo json_encode("success");
        }else{
            echo json_encode("error");
        }
    }catch(Exception $d){
        echo json_encode("error" . $d->getMessage());
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['loadingCSV'])) {
    $response = $vm->uploadCSV($_FILES['loadingCSV']);
    echo json_encode($response['status'] === 'added' ? 'added' : $response);
    exit;
}
?>