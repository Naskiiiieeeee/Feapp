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
    
    public function getyearPaginated($page = 1, $limit = 10) {
        $offset = ($page - 1) * $limit;
        return $this->model->getyearPaginated($offset, $limit);
    }

    public function getTotalPages($limit = 4) {
        $totalRecords = $this->model->countAllyearLevel();
        return ceil($totalRecords / $limit);
    }

    public function deleteYear($id){
        return $this->model->deleteYear($id);
    }

}
?>