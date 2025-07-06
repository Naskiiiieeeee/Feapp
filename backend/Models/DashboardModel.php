<?php

require_once __DIR__ . '/../Core/BaseModel.php';

class DashboardModel extends BaseModel{

    public function countStudent(){
        $query = "SELECT COUNT(*) as total_records FROM `student_info` ";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_records'];
    }

    public function countFaculty(){
        $query = "SELECT COUNT(*) as total_records FROM `endusers` WHERE `role` = 'Faculty' ";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_records'];       
    }
    
    public function countAdmin(){
        $query = "SELECT COUNT(*) as total_records FROM `endusers` WHERE `role` = 'Admin' AND `status` = 1 ";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_records'];
    }

}