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
    public function getStudentResponseData() {
        $query = "SELECT student_email, COUNT(*) as total FROM faculty_evaluations GROUP BY student_email";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFacultyRanking() {
        $query = "
            SELECT 
                eu.fullname, 
                ROUND(AVG((fe.academic_avg + fe.core_values_avg + fe.overall_score) / 3), 2) AS average_score
            FROM faculty_evaluations fe
            JOIN endusers eu ON fe.faculty_token = eu.code
            GROUP BY fe.faculty_token
            ORDER BY average_score DESC
        ";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}