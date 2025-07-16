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
}
