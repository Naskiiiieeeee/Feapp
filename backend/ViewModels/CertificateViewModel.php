<?php 
require_once __DIR__ .'/../Models/CertificateModel.php';

class CertificateViewModel{
    private $model;
    public function __construct(){
        $this->model = new CertificateModel();
    }
    public function getPaginatedCertificates($page = 1, $limit = 4){
        $offset = ($page - 1) * $limit;
        return $this->model->getCertificates($offset, $limit);
    }

    public function getTotalPages($limit = 4){
        $totalRecords = $this->model->countAllcertificate();
        return ceil($totalRecords / $limit);
    }

    public function getcertificateByID($id){
        return $this->model->getcertificateByID($id);
    }
}

?>