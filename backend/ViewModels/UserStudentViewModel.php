<?php
require_once __DIR__ . '/../Models/UserStudentModel.php';

class UserStudentViewModel {
    private $model;

    public function __construct() {
        $this->model = new UserStudentModel();
    }
    public function getUserEmail($email){
        return $this->model->getUserByEmail($email);
    }
}