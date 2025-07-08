<?php
require_once __DIR__ . '/../Models/DashboardModel.php';

class DashboardViewModel{

    private $model;

    public function __construct(){
        $this->model = new DashboardModel();
    }

    public function getTotalStudent(){
        return $this->model->countStudent();
    }

    public function getTotalFaculty(){
        return $this->model->countFaculty();
    }

    public function getTotalAdmins(){
        return $this->model->countAdmin();
    }

    public function getForEachStudentResponse(){
        return $this->model->getStudentResponseData();
    }
    
    public function getFacultyRankedScores() {
        return $this->model->getFacultyRanking();
    }
    public function historyRatings($faculty_email){
        return $this->model->getFacultyHistoricalRatings($faculty_email);
    }
}