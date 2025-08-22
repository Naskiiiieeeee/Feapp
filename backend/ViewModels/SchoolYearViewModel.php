<?php
require_once __DIR__ . '/../Models/SchoolYearModel.php';

class SchoolYearViewModel{
    protected $model;

    public function __construct()
    {
        $this->model = new SchoolYearModel();    
    }

    public function getsectionPaginated($page = 1, $limit = 4) {
        $offset = ($page - 1) * $limit;
        return $this->model->getschoolYearPaginated($offset, $limit);
    }

    public function getTotalPages($limit = 4) {
        $totalRecords = $this->model->countAllSchoolYear();
        return ceil($totalRecords / $limit);
    }
    
}