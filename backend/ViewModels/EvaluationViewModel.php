<?php
require_once __DIR__ . '/../Models/EvaluationModel.php';

class EvaluationViewModel {
    private $model;

    public function __construct(){
        $this->model = new EvaluationModel();
    }
    public function getByStudentTofacultyEvaluation($email){
        return $this->model->countAllEvaluationsFromUsersInput($email);
    }

    public function getPaginatedEvaluatedFaculty($page = 1, $limit = 4, $email) {
        $offset = ($page - 1) * $limit;
        return $this->model->getPaginatedEvaluatedFaculty($offset, $limit, $email);
    }
    
    public function getTotalPages($limit = 4, $email) {
        $totalRecords = $this->model->countAllEvaluationsFromUsersInput($email);
        return ceil($totalRecords / $limit);
    }

    public function getPaginatedOverallFaculty($page = 1, $limit = 4){
        $offset = ($page - 1) * $limit;
        return $this->model->getPagitanedOverallEvaluatedFaculty($offset,$limit );
    }

    public function getPaginatedGroupBy($page = 1, $limit = 4){
        $offset = ($page - 1) * $limit;
        return $this->model->getPaginatedGroupByResult($offset,$limit);
    }
    
}