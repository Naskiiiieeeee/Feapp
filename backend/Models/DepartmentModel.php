<?php
require_once __DIR__ . '/../Core/BaseModel.php';

class DepartmentModel extends BaseModel{

    
    public function countAllDepartments() {
        $query = "SELECT COUNT(*) as total_records FROM `department` ";
        $stmt = $this->db->query($query);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_records'] ?? 0;
    }

    public function getDepartmentPaginated($offset, $limit) {
        $query = "SELECT * FROM `department`ORDER BY `id` DESC LIMIT :offset, :limit";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function createNewDepartment($code , $description){
        $stmt =  $this->db->prepare("INSERT INTO `department`(`code`, `description`) VALUES (?, ?)");
        return $stmt->execute([$code, $description]);
    }
}