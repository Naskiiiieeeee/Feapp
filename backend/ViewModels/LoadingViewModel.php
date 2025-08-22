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
    
}

?>