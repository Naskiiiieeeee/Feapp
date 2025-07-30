<?php
require_once '../backend/ViewModels/CourseViewModel.php';
header('Content-Type: application/json');
$vm = new CourseViewModel();

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnSaveCourse'])){
    $courseCode = filter_input(INPUT_POST, 'courseCode', FILTER_SANITIZE_SPECIAL_CHARS);
    $Description = filter_input(INPUT_POST, 'Description', FILTER_SANITIZE_SPECIAL_CHARS);
    $department = filter_input(INPUT_POST, 'department', FILTER_SANITIZE_SPECIAL_CHARS);

    try{
        $result = $vm->createNewCourse($courseCode,$Description,$department);
        if($result){
            echo json_encode(['status' => 'added']);
        }else{
            echo json_encode(['status' => 'isDuplicate']);
        }
        exit;
    }catch(Exception $e){
        echo json_encode(['status' => 'error' .$e->getMessage()]);
    }
    exit;
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnUpdateAccess'])){
    $code = filter_input(INPUT_POST , 'id', FILTER_SANITIZE_SPECIAL_CHARS);
    $status = filter_input(INPUT_POST , 'status', FILTER_SANITIZE_SPECIAL_CHARS);

    try{
        $result = $vm->getUpdateCourseStatus($code, $status);

        if($result){
            echo json_encode(["status" => "updated"]);
        }else{
            echo json_encode(["status" => "error"]);
        }
        exit;
    }catch(Exception $exception){
        echo json_encode(["status" => "error". $exception->getMessage()]);
    }
    exit;
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteCourse'])){
    $id = filter_input(INPUT_POST, 'deleteCourse', FILTER_SANITIZE_SPECIAL_CHARS);

    try{
        $result = $vm->getDeleteCourse($id);
        if($result){
            echo json_encode("success");
        }else{
            echo json_encode("error");
        }
        exit;
    }catch(Exception $exception){
        echo json_encode("error".$exception->getMessage());
    }
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['departmentCode'])) {
    $departmentCode = $_POST['departmentCode'];
    $courses = $vm->getCoursesByDepartment($departmentCode);
    echo json_encode($courses);
} else {
    echo json_encode([]);
}

?>