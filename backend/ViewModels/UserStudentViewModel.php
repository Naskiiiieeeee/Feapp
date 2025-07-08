<?php
require_once __DIR__ . '/../Models/UserStudentModel.php';

class UserStudentViewModel {
    private $model;

    public function __construct() {
        $this->model = new UserStudentModel();
    }
    public function getUserEmail($email){
        return $this->model->getUserByEmail($email);
    }

    public function deleteStudent($id){
        return $this->model->deleteStudent($id);
    }

    public function addStudent($email, $studentNo, $fullname, $section, $yearLvl, $role){
        return $this->model->createNewStudent($email, $studentNo, $fullname, $section, $yearLvl, $role);
    }
    public function updateStudent($id, $status){
        return $this->model->updateStatus($id, $status);
    }

    public function getStudentPaginated($page = 1, $limit = 4) {
        $offset = ($page - 1) * $limit;
        return $this->model->getStudentPaginated($offset, $limit);
    }

    public function getTotalPages($limit = 4) {
        $totalRecords = $this->model->countAllStudent();
        return ceil($totalRecords / $limit);
    }

public function uploadCSV($file) {
        if (($handle = fopen($file['tmp_name'], "r")) !== false) {
            // Read the first row (headers)
            $header = fgetcsv($handle, 1000, ",");

            // Remove BOM from the first header column
            if (isset($header[0])) {
                $header[0] = preg_replace('/^\xEF\xBB\xBF/', '', $header[0]);
            }

            // Normalize: trim, lowercase, remove special chars
            $header = array_map('trim', $header);
            $header = array_map('strtolower', $header);
            $header = array_map(fn($h) => preg_replace('/[^a-z0-9_]/', '', $h), $header);

            // Expected fields
            $required = ['student_email', 'student_no', 'student_name', 'student_section', 'student_year'];

            // Validate header
            if ($header !== $required) {
                return [
                    'status' => 'error',
                    'message' => 'CSV headers must match required fields: ' . implode(', ', $required),
                    'debug_header' => $header
                ];
            }

            $inserted = 0;
            $duplicates = 0;

            // Read each line of CSV
            while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                if (count($data) < 5) continue; // skip incomplete rows

                [$email, $no, $name, $section, $year] = array_map('trim', $data);
                $success = $this->model->insertStudent($email, $no, $name, $section, $year);

                if ($success) {
                    $inserted++;
                } else {
                    $duplicates++;
                }
            }

            fclose($handle);

            return [
                'status' => 'added',
                'inserted' => $inserted,
                'duplicates' => $duplicates
            ];
        }

        return [
            'status' => 'error',
            'message' => 'Unable to read CSV file.'
        ];
    }
}