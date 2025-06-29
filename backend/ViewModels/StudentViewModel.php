<?php 
require_once __DIR__ .  '/../Models/StudentModel.php';

class StudentViewModel{
    private $model ; 

    public function __construct(){
        $this->model = new StudentModel();
    }

    public function allStudent(){
        return $this->model->getAllstudents();
    }

    public function createNewstudent($studentID, $studentName, $section, $year){
        return $this->model->setcreateNewStudent($studentID, $studentName, $section, $year);
    }

    public function updateStudent($studentID, $studentName, $section){
        return $this->model->getUpdateStudent($studentID, $studentName, $section);
    }

    public function deleteStudent($studentID){
        return $this->model->getDeleteStudent($studentID);
    }
}
?>