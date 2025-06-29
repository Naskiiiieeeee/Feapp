<?php
require_once __DIR__ . '/../Core/BaseModel.php';

class StudentModel extends BaseModel{
    
    public function getAllstudents(){
        $stmt = $this->db->query("SELECT * FROM `student_info`");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getStudent($studentID){
        $stmt = $this->db->prepare("SELECT * FROM `student_info` WHERE `student_id` = ? ");
        $stmt->execute([$studentID]);
        return $stmt->fetch();
    }

    public function setcreateNewStudent($studentID, $studentName, $section, $year){
        $stmt = $this->db->prepare("INSERT INTO `student_info` (`student_no`, `student_name`, `student_section`, `student_year`) VALUES (?, ?, ?, ? )");
        return $stmt->execute([$studentID, $studentName, $section, $year]);
    }

    public function getUpdateStudent($studentID, $studentName, $section){
        $stmt = $this->db->prepare("UPDATE `student_info` SET `student_name` = ? , `student_section` = ?  WHERE `si_id` = ? ");
        return $stmt->execute([$studentName,$section,$studentID]);
    }

    public function getDeleteStudent($studentID){
        $stmt = $this->db->prepare("DELETE FROM `student_info` WHERE `si_id` = ? ");
        return $stmt->execute([$studentID]);
    }
    public function getByUserNO($studentID){
        $stmt = $this->db->prepare("SELECT * FROM `student_info` WHERE `student_no` = ? ");
        return $stmt->execute([$studentID]);
    }
}

?>