<?php 
require_once __DIR__ . '/../Models/SchedEvalModel.php';

class SchedEvalViewModel {
    protected $model;
    public function __construct(){
        $this->model = new SchedEvalModel();
    }
    public function createNewSchedule($depName, $startDate, $endDate, $uploader){
        $code = $this->model->randomStringGenerator(12);
        return $this->model->createNewSched($code, $depName, $startDate, $endDate, $uploader);
    }
    
    public function getSchedPaginated($page = 1, $limit = 4) {
        $offset = ($page - 1) * $limit;
        return $this->model->getSchedPaginated($offset, $limit);
    }

    public function getTotalPages($limit = 4) {
        $totalRecords = $this->model->countAllSched();
        return ceil($totalRecords / $limit);
    }

    public function getdeleteEval($id){
        return $this->model->deleteSched($id);
    }
}

?>