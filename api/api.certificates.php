<?php
require_once '../backend/ViewModels/EvaluationViewModel.php';
header('Content-Type: application/json');

$response = ['success' => false, 'message' => 'Unknown error occurred.'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vm = new EvaluationViewModel();

    if (!isset($_POST['selected']) || empty($_POST['selected'])) {
        $response['message'] = 'No seminar selected.';
        echo json_encode($response);
        exit;
    }

    $selected       = $_POST['selected'];
    $titles         = $_POST['title'];
    $seminarTexts   = $_POST['seminar_text'];
    $certificates   = $_FILES['certificate'];
    $faculty_email  = $_POST['faculty_email'] ?? '';
    $fullname       = $_POST['fullname'] ?? '';
    $CertificateID  = $_POST['CertificateID'] ?? '';

    $uploadDir = __DIR__ . '/../uploads/certificates/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    if ($vm->isExistCertificate($CertificateID)) {
        $response['success'] = false;
        $response['message'] = 'This certificate has already been submitted.';
        echo json_encode($response);
        exit;
    }

    $successCount = 0;

    foreach ($selected as $index => $on) {
        if (
            isset($certificates['name'][$index]) &&
            isset($titles[$index]) &&
            isset($seminarTexts[$index]) &&
            !empty($titles[$index]) &&
            !empty($certificates['tmp_name'][$index])
        ) {
            $timestamp = time();
            $fileName = basename($certificates['name'][$index]);
            $safeFileName = preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $fileName); // optional sanitization
            $targetPath = $uploadDir . $timestamp . '_' . $safeFileName;
            $dbFilePath = 'uploads/certificates/' . $timestamp . '_' . $safeFileName;

            if (move_uploaded_file($certificates['tmp_name'][$index], $targetPath)) {
                $data = [
                    'seminar_title'     => $titles[$index],
                    'seminar_name'      => $seminarTexts[$index],
                    'certificate_path'  => $dbFilePath,
                    'faculty_email'     => $faculty_email,
                    'faculty_name'      => $fullname,
                    'certificate_id'    => $CertificateID
                ];

                $inserted = $vm->saveUploadedCertificate($data);

                if ($inserted) {
                    $successCount++;
                }
            }
        }
    }

    if ($successCount > 0) {
        $vm->getUpdateSummary($CertificateID);
        $response['success'] = true;
        $response['message'] = "$successCount certificate(s) successfully uploaded.";
    } else {
        $response['success'] = false;
        $response['message'] = "Upload failed. No certificate saved.";
    }

    echo json_encode($response);
    exit;
}
