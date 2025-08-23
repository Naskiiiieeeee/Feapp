<?php
require_once __DIR__ . '/../Models/LoadingModel.php';

class LoadingViewModel{

    protected $model;
    
    public function __construct(){
        $this->model = new LoadingModel();
    }

    public function getLoadPaginated($page = 1, $limit = 4) {
        $offset = ($page - 1) * $limit;
        return $this->model->getLoadPaginated($offset, $limit);
    }

    public function getTotalPages($limit = 4) {
        $totalRecords = $this->model->countAllLoad();
        return ceil($totalRecords / $limit);
    }

    public function getAllValidatedDepartment(){
        return $this->model->getActivatedDepartment();
    }

    public function getActivatedFaculty(){
        return $this->model->getActivatedFaculty();
    }

    public function getCoursesByDepartment($departmentCode){
        return $this->model->getCoursesByDepartment($departmentCode);
    }

    public function getSubjectsByDepartment($departmentCode){
        return $this->model->getSubjectsByDepartment($departmentCode);
    }

    public function getYearLevelsByDepartment($departmentCode){
        return $this->model->getYearLevelsByDepartment($departmentCode);
    }
    public function getActivatedSection(){
        return $this->model->getActivatedSection();
    }

    public function getSchoolYear(){
        return $this->model->getSchoolYear();
    }

    public function setNewLoad($dep, $course, $yearLvl, $subject, $section, $fac_email, $sem, $sy){
        $code = $this->model->randomStringGenerator(9);
        return $this->model->insertNewFacultyLoad($code, $dep, $course, $yearLvl, $subject, $section, $fac_email, $sem, $sy);
    }

    public function getDeleteLoad($id){
        return $this->model->deleteLoad($id);
    }

    public function searchLoad($keyword){
        return $this->model->searchLoad($keyword);
    }

    public function uploadCSV($file) {
        $code = $this->model->randomStringGenerator(9);
        if (($handle = fopen($file['tmp_name'], "r")) !== false) {
            $header = fgetcsv($handle, 1000, ",");
            if (isset($header[0])) {
                $header[0] = preg_replace('/^\xEF\xBB\xBF/', '', $header[0]);
            }
            $header = array_map('trim', $header);
            $header = array_map('strtolower', $header);
            $header = array_map(fn($h) => preg_replace('/[^a-z0-9_]/', '', $h), $header);

            $required = [
                'department',
                'course',
                'yearlevel',
                'subjectcode',
                'section',
                'facultyemail',
                'semester',
                'schoolyear'
            ];

            if ($header !== $required) {
                return [
                    'status' => 'error',
                    'message' => 'CSV headers must match required fields: ' . implode(', ', $required),
                    'debug_header' => $header
                ];
            }
            $inserted = 0;
            $duplicates = 0;
            while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                if (count($data) < 5) continue; // skip incomplete rows

                [$department, $course, $year, $subject, $section , $facultyemail, $sem, $sy] = array_map('trim', $data);
                $success = $this->model->insertLoad($code, $department, $course, $year, $subject, $section , $facultyemail, $sem, $sy);

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

?>