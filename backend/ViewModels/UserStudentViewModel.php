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
}