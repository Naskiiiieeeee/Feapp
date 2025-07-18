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
        $query = "SELECT * FROM `department` ORDER BY `id` DESC LIMIT :offset, :limits";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->bindValue(':limits', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function createNewDepartment($code , $description){
        $ifExist = $this->db->prepare("SELECT * FROM `department` WHERE `code` = ?");
        $ifExist->execute([$code]);
        if($ifExist->rowCount() > 0){
            return false;
        }else{
            $stmt =  $this->db->prepare("INSERT INTO `department`(`code`, `description`) VALUES (?, ?)");
            return $stmt->execute([$code, $description]);
        }
    }

    public function updateDepartment($code, $status, $description){
        $stmt = $this->db->prepare("UPDATE `department` SET `status` = ? , `description` = ? WHERE `code` = ? ");
        return $stmt->execute([$status, $description, $code]);
    }
}