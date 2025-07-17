<?php
require_once __DIR__ . '/../Core/BaseModel.php';

class CertificateModel extends BaseModel{
    
    public function countAllcertificate(){
        $stmt = $this->db->prepare("SELECT COUNT(*) AS total_records FROM `certificates`");
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row['total_records'] ?? 0;
    }

    public function getCertificates($offset, $limit) {
        $query = "SELECT * FROM `certificates` ORDER BY `id` DESC LIMIT :offset, :limit";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getcertificateByID($id){
        $stmt = $this->db->prepare("SELECT * FROM `certificates` WHERE `id` = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}