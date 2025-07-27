<?php
require_once __DIR__ . '/../Models/YearLevelModel.php';

class YearLevelViewModel {
    protected $model;

    public function __construct(){
        $this->model = new YearLevelModel();
    }

    public function setYearLevel($yearLvl, $dateCreated){
        $code = $this->model->randomStringGenerator(12);
        return $this->model->createNewYearLvl($code , $yearLvl, $dateCreated);
    }
}
?>