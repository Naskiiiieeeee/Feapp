<?php
require_once __DIR__ . '/../Models/UserAdminModel.php';

class UserAdminViewModel {
    private $model;

    public function __construct() {
        $this->model = new UserAdminModel();
    }

    public function getPaginatedAdmins($page = 1, $limit = 4) {
        $offset = ($page - 1) * $limit;
        return $this->model->getAdminsPaginated($offset, $limit);
    }

    public function getTotalPages($limit = 4) {
        $totalRecords = $this->model->countAllAdmins();
        return ceil($totalRecords / $limit);
    }

    public function deleteAdminUser($id){
        return $this->model->deleteAdmin($id);
    }

    public function updateAdminUser($id, $status){
        return $this->model->updateStatus($id, $status);
    }

    public function addNewAdmin($path, $fullname, $email, $password, $dep, $role, $code){
        return $this->model->createNewAdmin($path, $fullname, $email, $password, $dep, $role, $code);
    }

    public function getAdminByCode($code) {
        return $this->model->getAdminByCode($code);
    }

}
