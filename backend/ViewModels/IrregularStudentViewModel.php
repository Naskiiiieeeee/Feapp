<?php
require_once __DIR__ . '/../Models/IrregularStudentModel.php';

class IrregularStudentViewModel {
    protected $model;

    public function __construct(){
        $this->model = new IrregularStudentModel();
    }

    public function getirregPaginated($page = 1, $limit = 4) {
        $offset = ($page - 1) * $limit;
        return $this->model->getirregPaginated($offset, $limit);
    }

    public function getTotalPages($limit = 4) {
        $totalRecords = $this->model->countAllIrreg();
        return ceil($totalRecords / $limit);
    }

    public function CreateNewIrreg($studentID, $subjectID, $facultyID, $sem, $sy){
        return $this->model->createNewIrregStudent($studentID, $subjectID, $facultyID, $sem, $sy);
    }

}

?>