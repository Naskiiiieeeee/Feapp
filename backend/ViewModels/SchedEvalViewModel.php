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
}

?>