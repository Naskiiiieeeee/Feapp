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
}