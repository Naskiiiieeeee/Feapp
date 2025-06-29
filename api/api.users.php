<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Content-Type: application/json");

require_once __DIR__ . '/../app/ViewModels/UserViewModel.php';

$vm = new UserViewModel();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['delete'])) {
        $vm->delete($_GET['delete']);
        echo json_encode(['status' => 'deleted']);
    } else {
        echo json_encode($vm->all());
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';

    if (isset($_GET['create'])) {
        $vm->create($name, $email);
        echo json_encode(['status' => 'created']);
    } elseif (isset($_GET['update']) && isset($_POST['id'])) {
        $vm->update($_POST['id'], $name, $email);
        echo json_encode(['status' => 'updated']);
    }

    exit;
}
