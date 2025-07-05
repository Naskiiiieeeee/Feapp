<?php
require_once '../backend/ViewModels/UserAdminViewModel.php';

header("Content-Type: application/json");

$vm = new UserAdminViewModel();

// DELETE ADMIN USER
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteUser'])) {
    $userId = $_POST['deleteUser'];
    $result = $vm->deleteAdminUser($userId);

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

// ADD NEW ADMIN
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnSaveAdminProfile'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = "Admin";
    $code = uniqid();

    $photo = $_FILES['photo'];
    $uploadDir = __DIR__ . '/../uploads/admin/'; 
    $fileName = uniqid() . '_' . basename($photo['name']);
    $targetFile = $uploadDir . $fileName;
    $relativePath = 'uploads/admin/' . $fileName; 

    $isDuplicate = $vm->getUserEmail($email);
    if(!$isDuplicate){

        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        if (move_uploaded_file($photo['tmp_name'], $targetFile)) {
            $result = $vm->addNewAdmin($relativePath, $fullname, $email, $password, $department, $role, $code);
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
