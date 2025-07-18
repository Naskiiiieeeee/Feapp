<?php 
require_once __DIR__ .'/../Core/BaseModel.php';

class CourseModel extends BaseModel{
    
    public function addNewCourse($code, $description, $department){
        $selectQuery = $this->db->prepare("SELECT * FROM `courses` WHERE `course` = ?");
        $selectQuery->execute([$code]);
        if($selectQuery->rowCount() > 0){
            return false;
        }else{
            $stmt = $this->db->prepare("INSERT INTO `courses`(`code`, `description`, `department`) VALUES (?, ? ,?)");
            return $stmt->execute([$code, $description, $department]);
        }
    }
}
?>