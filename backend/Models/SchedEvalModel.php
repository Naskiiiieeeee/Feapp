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
}
?>