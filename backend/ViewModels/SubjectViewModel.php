<?php 
require_once __DIR__ . '/../Models/SubjectModel.php';

class SubjectViewModel{
    protected $model;

    public function __construct(){
        $this->model = new SubjectModel();
    }

    public function getsubjectPaginated($page = 1, $limit = 4) {
        $offset = ($page - 1) * $limit;
        return $this->model->getsubjectPaginated($offset, $limit);
    }

    public function getTotalPages($limit = 4) {
        $totalRecords = $this->model->countAllSubjects();
        return ceil($totalRecords / $limit);
    }

    public function setNewSubject($sCode, $sDes, $Department, $Course, $yearlvl){
        return $this->model->createNewSubject($sCode, $sDes, $Department, $Course, $yearlvl);
    }

    public function getYearLevel(){
        return $this->model->getYearLevel();
    }
    
    public function getDeleteSubject($id){
        return $this->model->deleteSubject($id);
    }

    public function getUpdateStatus($id, $status){
        return $this->model->updateSubject($id, $status);
    }
}

?>