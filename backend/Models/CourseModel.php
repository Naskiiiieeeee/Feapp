<?php 
require_once __DIR__ .'/../Core/BaseModel.php';

class CourseModel extends BaseModel{
    
    public function countAllCourse() {
        $query = "SELECT COUNT(*) as total_records FROM `courses` ";
        $stmt = $this->db->query($query);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_records'] ?? 0;
    }
    public function getCoursePaginated($offset, $limit) {
        $query = "SELECT * FROM `courses` ORDER BY `id` DESC LIMIT :offset, :limits";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->bindValue(':limits', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
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
    public function getActivatedDepartment(){
        $stmt = $this->db->prepare("SELECT * FROM `department` WHERE `status` = 1");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);   
    }
}
?>