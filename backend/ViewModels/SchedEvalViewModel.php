<?php 

require_once __DIR__ . '/../Models/SchedEvalModel.php';

class SchedEvalViewModel {
    protected $model;

    public function __construct(){
        $this->model = new SchedEvalModel();
    }

    public function createNewSched($code, $depName, $startDate, $endDate, $uploader){
        return $this->model->createNewSched($code, $depName, $startDate, $endDate, $uploader);
    }
}

?>