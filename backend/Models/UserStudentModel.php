<?php
require_once __DIR__ . '/../Core/BaseModel.php';

class UserStudentModel extends BaseModel{
        public function countAllStudent() {
        $query = "SELECT COUNT(*) as total_records FROM `student_info` WHERE `role` = 'Student'";
        $stmt = $this->db->query($query);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_records'] ?? 0;
    }

    public function getStudentPaginated($offset, $limit) {
        $query = "SELECT * FROM `student_info` WHERE `role` = 'Student' ORDER BY `si_id` DESC LIMIT :offset, :limit";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteStudent($id) {
        $stmt = $this->db->prepare("DELETE FROM `student_info` WHERE `si_id` = ?");
        return $stmt->execute([$id]);
    }

    public function updateStatus($id, $status) {
        $stmt = $this->db->prepare("UPDATE `student_info` SET `status` = ? WHERE `student_no` = ?");
        return $stmt->execute([$status, $id]);
    }

    public function createNewStudent($email, $studentNo, $fullname, $section, $yearLvl, $role , $course, $dep){
        $query = "INSERT INTO `student_info`(`student_email`, `student_no`, `student_name`, `student_section`, `student_year`, `student_course`, `student_dep`, `role`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$email, $studentNo, $fullname, $section, $yearLvl , $course, $dep, $role]);
    }
    public function getByEmail($email){
        $stmt = $this->db->prepare("SELECT * FROM `student_info` WHERE `student_email` = ? AND `status` = 1 ");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function getUserByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM `student_info` WHERE `student_email` = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insertStudent($email, $no, $name, $section, $year) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM `student_info` WHERE `student_email` = ?");
        $stmt->execute([$email]);
        if ($stmt->fetchColumn() > 0) {
            return false; // Duplicate
        }
        $role = "Student";
        $stmt = $this->db->prepare("INSERT INTO `student_info` (`student_email`, `student_no`, `student_name`, `student_section`, `student_year`, `role`) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$email, $no, $name, $section, $year, $role]);
    }

}