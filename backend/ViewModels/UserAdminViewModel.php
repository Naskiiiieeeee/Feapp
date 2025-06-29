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
}
