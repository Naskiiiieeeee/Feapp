<?php 
  // session_start();
  // if (!isset($_SESSION['email']) || !isset($_SESSION['fullname']) || !isset($_SESSION['role'])) {
  //     '<script>alert("Unauthorized access!"); window.location = "index.php";</script>';
  //     exit;
  // }
  // $username = $_SESSION['email'];
  // $fullname = $_SESSION['fullname'];
  // $role = $_SESSION['role'];
?>

<?php
  $basePath = '/feapp/frontend/';
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>FE-APP</title>
  <link rel="icon" href="<?= $basePath ?>/src/img/logo.png" type="image/icon type">
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="<?= $basePath ?>/src/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= $basePath ?>/src/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= $basePath ?>/src/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?= $basePath ?>/src/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="<?= $basePath ?>/src/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="<?= $basePath ?>/src/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?= $basePath ?>/src/assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
  <link href="<?= $basePath ?>/src/assets/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= $basePath ?>/src/assets/css/notification.css">
  <link rel="stylesheet" href="<?= $basePath ?>/src/assets/css/pendingRequest.css">
  <link rel="stylesheet" href="<?= $basePath ?>/src/font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.32/sweetalert2.min.css" crossorigin="anonymous">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
  <script src="https://www.gstatic.com/charts/loader.js"></script>
  <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
  <script type="text/javascript">
    window.history.forward();
  </script>
</head>