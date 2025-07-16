<?php
require_once __DIR__ . '/../Models/UserPasswordModel.php';

class UserPasswordViewModel {
    private $model;

    public function __construct(){
        $this->model = new UserPasswordModel();
    }

    public function getUserEmail($code){
        return $this->model->getRequestCredentials($code);
    }

    public function getUsersFullDetails($email){
        return $this->model->getUserCredentials($email);
    }

    public function setnewpassword($email, $pass){
        return $this->model->setNewUserpassword($email,$pass);
    }

    public function deleteDatainresetDB($code){
        return $this->model->deleteSaveDataOnResetDB($code);
    }
}
