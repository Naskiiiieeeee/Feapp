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

    public function getPages($limit = 4){
        $totalRecords = $this->model->countAllevaluationsFromStudent();
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

    public function getunitEvaluationResult($token){
        return $this->model->getEvaluationResult($token);
    }
    
    public function checkIfCanSubmit($email) {
        return !$this->model->hasRecentEvaluation($email);
    }

    public function saveEvaluationSummary($data) {
        return $this->model->saveEvaluationSummary($data);
    }
    // for faculty view

    public function getPaginatedIndividualResult($page = 1, $limit = 4, $email){
        $offset = ($page -  1 ) * $limit;
        return $this->model->getPaginatedIndividualResult($offset,$limit,$email);
    }

    public function getFacultyEvaluationPages($limit = 4, $email){
        $totalRecords = $this->model->countfacultyEvaluation($email);
        return ceil($totalRecords / $limit);
    }
    public function getIndiEvaluationResult($token, $email){
        return $this->model->getIndividualEvaluationResult($token,$email);
    }

    // for admin view
    public function getPaginatedIndividualResultAdmin($page = 1, $limit = 4){
        $offset = ($page -  1 ) * $limit;
        return $this->model->getPaginatedIndividualResultAdminSide($offset,$limit);
    }

    public function getFacultyEvaluationPagesAdmin($limit = 4){
        $totalRecords = $this->model->countfacultyEvaluationAdminSide();
        return ceil($totalRecords / $limit);
    }

    public function getIndiEvaluationResultAdmin($token){
        return $this->model->getIndividualEvaluationResultAdminSide($token);
    }

    public function deleteEvalHistory($id){
        return $this->model->deleteEvaluationHistory($id);
    }
}