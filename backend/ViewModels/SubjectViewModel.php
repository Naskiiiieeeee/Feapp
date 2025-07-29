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
}

?>