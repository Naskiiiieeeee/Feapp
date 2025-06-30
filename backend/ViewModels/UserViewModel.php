<?php
require_once __DIR__ . '/../Models/UserModel.php';

class UserViewModel {
    private $model;

    public function __construct() {
        $this->model = new UserModel();
    }
    public function getUserEmail($email){
        return $this->model->getUserByEmail($email);
    }

}
