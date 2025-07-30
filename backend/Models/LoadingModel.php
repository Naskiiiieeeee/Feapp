<?php
require_once __DIR__ . '/../Helpers/helpers.php';

class LoadingModel extends Helpers{
    public function countAllLoad() {
        $query = "SELECT COUNT(*) as total_records FROM `faculty_load` ";
        $stmt = $this->db->query($query);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_records'] ?? 0;
    }

    public function getLoadPaginated($offset, $limit) {
        $query = "SELECT * FROM `faculty_load` ORDER BY `id` DESC LIMIT :offset, :limit";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getActivatedDepartment(){
        $stmt = $this->db->prepare("SELECT * FROM `department` WHERE `status` = 1");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);   
    }

    public function getCoursesByDepartment($departmentCode) {
        $stmt = $this->db->prepare("SELECT * FROM `subjects` WHERE `subj_dep` = ?");
        $stmt->execute([$departmentCode]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>