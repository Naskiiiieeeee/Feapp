<?php 
require_once __DIR__ . '/../Helpers/helpers.php';

class IrregularStudentModel extends Helpers{
    public function countAllIrreg() {
        $query = "SELECT COUNT(*) as total_records FROM `evaluation_load` ";
        $stmt = $this->db->query($query);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_records'] ?? 0;
    }

    public function getirregPaginated($offset, $limit) {
        $query = "SELECT * FROM `evaluation_load` ORDER BY `id` DESC LIMIT :offset, :limit";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createNewIrregStudent($studentID, $subjectID, $facultyID, $sem, $sy){
        $stmt = $this->db->prepare("SELECT * FROM `evaluation_load` WHERE `student_id` = ? AND `subject_id` = ? AND `faculty_id` = ? AND `semester` = ? AND `sy` = ? ");
        $stmt->execute([$studentID, $subjectID, $facultyID, $sem, $sy]);
        if($stmt->rowCount() > 0){
            return false;
        }else{
            $stmt = $this->db->prepare("INSERT INTO `evaluation_load`(`student_id`, `subject_id`, `faculty_id`, `semester`, `sy`) VALUES (?, ?, ?, ?, ?)");
            return $stmt->execute([$studentID, $subjectID, $facultyID, $sem, $sy]);
        }
    }

    public function deleteIrregularStudent($id){
        $stmt = $this->db->prepare("DELETE FROM `evaluation_load` WHERE `id` = ? ");
        return $stmt->execute([$id]);
    }
}

?>