<?php
require_once __DIR__ . '/../Models/DepartmentModel.php';

class DepartmentViewModel{

    private $model;

    public function __construct(){
        $this->model = new DepartmentModel();
    }
    public function getDepartmentPaginated($page = 1, $limit = 4) {
        $offset = ($page - 1) * $limit;
        return $this->model->getDepartmentPaginated($offset, $limit);
    }

    public function getTotalPages($limit = 4) {
        $totalRecords = $this->model->countAllDepartments();
        return ceil($totalRecords / $limit);
    }

    public function insertDepartment($code, $description){
        return $this->model->createNewDepartment($code, $description);
    }

    public function getupdateDepartment($code, $status, $description){
        return $this->model->updateDepartment($code, $status, $description);
    }

    public function getDeleteDepartment($id){
        return $this->model->deleteDepartment($id);
    }
}