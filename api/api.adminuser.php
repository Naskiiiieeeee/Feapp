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
