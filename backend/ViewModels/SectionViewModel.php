<?php
require_once __DIR__ . '/../Models/SectionModel.php';

class SectionViewModel{
    protected $model;

    public function __construct(){
        $this->model = new SectionModel();
    }

    public function getsectionPaginated($page = 1, $limit = 4) {
        $offset = ($page - 1) * $limit;
        return $this->model->getsectionPaginated($offset, $limit);
    }

    public function getTotalPages($limit = 4) {
        $totalRecords = $this->model->countAllSections();
        return ceil($totalRecords / $limit);
    }

    public function setCreateNewSection($secName, $createdDate){
        $sectionCode = $this->model->randomStringGenerator(12);
        return $this->model->createNewSection($sectionCode, $secName, $createdDate);
    }

    public function getDeleteSection($id){
        return $this->model->deleteSection($id);
    }
}

?>