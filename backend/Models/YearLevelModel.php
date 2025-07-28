<?php 
require_once __DIR__ . '/../Helpers/helpers.php';

class YearLevelModel extends Helpers{

    public function createNewYearLvl($code , $yearLvl, $dateCreated){
        $stmt = $this->db->prepare("SELECT * FROM `year_lvl` WHERE `y_name` = ? ");
        $stmt->execute([$yearLvl]);
        if($stmt->rowCount() > 0){
            return false;
        }else{
            $stmt = $this->db->prepare("INSERT INTO `year_lvl`(`y_code`, `y_name`, `created_at`) VALUES (?, ?, ?)");
            return $stmt->execute([$code, $yearLvl, $dateCreated]);
        }
    }

    public function countAllyearLevel() {
        $query = "SELECT COUNT(*) as total_records FROM `year_lvl`";
        $stmt = $this->db->query($query);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_records'] ?? 0;
    }

    public function getyearPaginated($offset, $limit) {
        $query = "SELECT * FROM `year_lvl` ORDER BY `y_id` DESC LIMIT :offset, :limit";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}

?>