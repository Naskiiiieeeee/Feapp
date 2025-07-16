<?php
require_once __DIR__ . '/../Models/UserPasswordModel.php';

class UserPasswordViewModel {
    private $model;

    public function __construct(){
        $this->model = new UserPasswordModel();
    }

    public function getUserCredentials($code){
        return $this->model->getRequestCredentials($code);
    }

    public function getUsersFullDetails($email){
        return $this->model->getUserCredentials($email);
    }

    public function setnewpassword($email, $pass){
        return $this->model->setNewUserpassword($email,$pass);
    }
}
