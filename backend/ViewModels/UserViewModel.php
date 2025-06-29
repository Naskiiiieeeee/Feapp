<?php 
require_once __DIR__ . '/../Models/UserModel.php';
class UserViewModel {
    private $model;
    public function __construct() {
        $this->model = new UserModel();
    }

    public function all() {
        return $this->model->getAllUsers();
    }

    public function create($name, $email) {
        return $this->model->createUser($name, $email);
    }

    public function edit($id) {
        return $this->model->getUser($id);
    }

    public function update($id, $name, $email) {
        return $this->model->updateUser($id, $name, $email);
    }

    public function delete($id) {
        return $this->model->deleteUser($id);
    }
}

?>