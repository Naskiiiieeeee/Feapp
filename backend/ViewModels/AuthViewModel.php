<?php
require_once __DIR__ . '/../Models/UserModel.php';

class AuthViewModel {
    private $model;

    public function __construct() {
        $this->model = new UserModel();
    }

    public function login($email, $password) {
        $user = $this->model->getByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
}
