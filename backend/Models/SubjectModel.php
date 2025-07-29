<?php
require_once __DIR__ . '/../Helpers/helpers.php';

class SubjectModel extends Helpers{

    public function countAllSubjects() {
        $query = "SELECT COUNT(*) as total_records FROM `subjects` ";
        $stmt = $this->db->query($query);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_records'] ?? 0;
    }

    public function getsubjectPaginated($offset, $limit) {
        $query = "SELECT * FROM `subjects` ORDER BY `id` DESC LIMIT :offset, :limit";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createNewSubject($sCode, $sDes, $Department, $Course, $yearlvl){
        $stmt = $this->db->prepare("SELECT * FROM `subjects` WHERE `subj_code` = ? AND `subj_dep` = ? ");
        $stmt->execute([$sCode, $Department]);
        if($stmt->rowCount() > 0 ){
            return false;
        }else{
            $stmt = $this->db->prepare("INSERT INTO `subjects`(`subj_code`, `subj_des`, `subj_dep`, `subj_course`, `subj_yearLvl`) VALUES (?,?,?,?,?)");
            return $stmt->execute([$sCode, $sDes, $Department, $Course, $yearlvl]);
        }
    }

    public function getYearLevel(){
        $stmt = $this->db->prepare("SELECT * FROM `year_lvl`");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);   
    }

    public function deleteSubject($id){
        $stmt = $this->db->prepare("DELETE FROM `subjects` WHERE `id` = ? ");
        return $stmt->execute([$id]);
    }

    public function updateSubject($id, $status){
        $stmt = $this->db->prepare("UPDATE `subjects` SET `status` = ? WHERE `subj_code` = ?");
        return $stmt->execute([$status, $id]);
    }
}
?>