<?php
require_once __DIR__ . '/../Models/LoadingModel.php';

class LoadingViewModel{

    protected $model;
    
    public function __construct(){
        $this->model = new LoadingModel();
    }

    public function getCoursePaginated($page = 1, $limit = 4) {
        $offset = ($page - 1) * $limit;
        return $this->model->getLoadPaginated($offset, $limit);
    }

    public function getTotalPages($limit = 4) {
        $totalRecords = $this->model->countAllLoad();
        return ceil($totalRecords / $limit);
    }
}

?>