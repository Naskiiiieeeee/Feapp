<?php
require_once '../backend/ViewModels/UserFacultyViewModel.php';

header("Content-Type: application/json");

$vm = new UserFacultyViewModel();

// DELETE ADMIN USER
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteUser'])) {
    $userId = $_POST['deleteUser'];
    $result = $vm->deleteFacultyUser($userId);

    if ($result) {
        echo json_encode("success");
    } else {
        echo json_encode("error");
    }
    exit;
}

// UPDATE STATUS
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnUpdateAccess'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];
    
    $result = $vm->updateAdminUser($id, $status);
    if ($result) {
        echo json_encode("updated");
    } else {
        echo json_encode("error");
    }
    exit;
}

// ADD NEW Faculty
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnSaveAdminProfile'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = "Faculty";
    $code = uniqid();

    $photo = $_FILES['photo'];
    $uploadDir = __DIR__ . '/../uploads/faculty/'; 
    $fileName = uniqid() . '_' . basename($photo['name']);
    $targetFile = $uploadDir . $fileName;
    $relativePath = 'uploads/faculty/' . $fileName; 

    $isduplicate = $vm->getNewEmail($email);

    if(!$isduplicate){
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        if (move_uploaded_file($photo['tmp_name'], $targetFile)) {
            $result = $vm->addNewFaculty($relativePath, $fullname, $email, $password, $department, $role, $code);
            echo json_encode($result ? "added" : "error");
        } else {
            echo json_encode("error");
        }
        exit;
    }else{
        echo json_encode("error");
    }
    exit;
}
