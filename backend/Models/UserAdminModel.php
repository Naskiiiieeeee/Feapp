<?php
require_once __DIR__ . '/../Core/BaseModel.php';

class UserAdminModel extends BaseModel {

    public function countAllAdmins() {
        $query = "SELECT COUNT(*) as total_records FROM `endusers` WHERE role = 'Admin'";
        $stmt = $this->db->query($query);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_records'] ?? 0;
    }

    public function getAdminsPaginated($offset, $limit) {
        $query = "SELECT * FROM `endusers` WHERE role = 'Admin' ORDER BY `eu_id` DESC LIMIT :offset, :limit";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
