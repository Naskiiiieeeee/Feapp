<?php

require_once __DIR__ . '/../Models/EvalationSummaryModel.php';

class EvaluationSummaryViewModel{
    private $model;

    public function __construct(){
        $this->model = new EvalationSummaryModel();
    }
    public function getEvaluationSummary($from, $to){
        return $this->model->getEvaluationSummaryByDateRange($from, $to);
    }
}

?>