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
}

?>