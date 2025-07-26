<?php
require_once __DIR__ . "/../Helpers/helpers.php";

class SchedEvalModel extends Helpers{

    public function createNewSched($code, $depName, $startDate, $endDate, $uploader){
        $stmt = $this->db->prepare("SELECT * FROM evaluationsched WHERE department = ? AND (startDate <= ? AND endDate >= ?)");
        $stmt->execute([$depName, $endDate, $startDate]);
            if($stmt->rowCount() > 0 ){
                return false;
            }else{
                $stmt = $this->db->prepare("INSERT INTO `evaluationsched`(`ev_code`, `department`, `startDate`, `endDate`, `uploadBy`) VALUES (?, ?, ?, ?, ?)");
                return $stmt->execute([$code, $depName, $startDate, $endDate, $uploader]);
            }
    }

    public function countAllSched() {
        $query = "SELECT COUNT(*) as total_records FROM `evaluationsched` ";
        $stmt = $this->db->query($query);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_records'] ?? 0;
    }

    public function getSchedPaginated($offset, $limit) {
        $query = "SELECT * FROM `evaluationsched` ORDER BY `ev_id` DESC LIMIT :offset, :limit";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteSched($id){
        $stmt = $this->db->prepare("DELETE FROM `evaluationsched` WHERE `ev_id` = ? ");
        return $stmt->execute([$id]);
    }
}
?>