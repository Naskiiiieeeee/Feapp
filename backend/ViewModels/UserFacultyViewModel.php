<?php
require_once __DIR__ . '/../Models/UserFacultyModel.php';

class UserFacultyViewModel {
    private $model;

    public function __construct() {
        $this->model = new UserFaculty();
    }

    public function getPaginatedFaculty($page = 1, $limit = 4) {
        $offset = ($page - 1) * $limit;
        return $this->model->getFacultiesPaginated($offset, $limit);
    }

    public function getTotalPages($limit = 4) {
        $totalRecords = $this->model->countAllFaculty();
        return ceil($totalRecords / $limit);
    }

    public function deleteFacultyUser($id){
        return $this->model->deleteFaculty($id);
    }

    public function updateAdminUser($id, $status){
        return $this->model->updateStatus($id, $status);
    }

    public function addNewFaculty($path, $fullname, $email, $password, $dep, $role, $code){
        return $this->model->createNewFaculty($path, $fullname, $email, $password, $dep, $role, $code);
    }

    public function getFacultyByCode($code) {
        return $this->model->getFacultyByCode($code);
    }

    public function getUserEmail($email) {
        return $this->model->getByEmail($email);
    }

    public function getFacultyInfo(){
        return $this->model->getByRole();
    }

    public function searchFaculty($keyword){
        return $this->model->searchFaculty($keyword);
    }

    public function getNewEmail($email){
        return $this->model->getNewEmail($email);
    }
    
    public function getIfStudentisActivated($email){
        return $this->model->checkIfStudentisActivated($email);
    }
}
