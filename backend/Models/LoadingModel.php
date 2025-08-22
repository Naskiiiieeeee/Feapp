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
        $query = "SELECT fl.* , eu.fullname 
        FROM `faculty_load` AS fl
        INNER JOIN `endusers` AS eu ON fl.faculty_email = eu.email
        ORDER BY `id`
        DESC LIMIT :offset, :limit";
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

    public function getActivatedFaculty(){
        $status = 1;
        $role = 'Faculty';
        $stmt = $this->db->prepare("SELECT * FROM `endusers` WHERE `status` = ? AND `role` = ? ");
        $stmt->execute([$status, $role]);
        
        $faculties = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $faculties[] = $row;
        }
        return $faculties;
    }

    
    public function getActivatedSection(){
        $status = 1;
        $stmt = $this->db->prepare("SELECT * FROM `section` WHERE `status` = ? ");
        $stmt->execute([$status]);
        
        $sections = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $sections[] = $row;
        }
        return $sections;
    }

    public function getSchoolYear(){
        $stmt = $this->db->prepare("SELECT * FROM `school_year` ");
        $stmt->execute();
        
        $syYear = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $syYear[] = $row;
        }
        return $syYear;
    }

    public function getCoursesByDepartment($departmentCode) {
        $stmt = $this->db->prepare("SELECT DISTINCT `subj_course` FROM `subjects` WHERE `subj_dep` = ?");
        $stmt->execute([$departmentCode]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getSubjectsByDepartment($departmentCode) {
        $stmt = $this->db->prepare(" SELECT DISTINCT `subj_code`, `subj_des` FROM `subjects` WHERE `subj_dep` = ? ");
        $stmt->execute([$departmentCode]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getYearLevelsByDepartment($departmentCode) {
        $stmt = $this->db->prepare(" SELECT DISTINCT `subj_yearLvl` FROM `subjects` WHERE `subj_dep` = ? ");
        $stmt->execute([$departmentCode]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertNewFacultyLoad($code, $dep, $course, $yearLvl, $subject, $section, $fac_email, $sem, $sy){
        $stmt = $this->db->prepare("SELECT * FROM `faculty_load` WHERE `department` = ? AND `course` = ? AND  `subjects` = ? AND `section` = ?  AND `faculty_email` = ?");
        $stmt->execute([$dep, $course, $subject, $section, $fac_email]);
        if($stmt->rowCount() > 0){
            return false;
        }else{
            $stmt = $this->db->prepare("SELECT * FROM `faculty_load` WHERE `department` = ? AND `course` = ? AND  `subjects` = ? AND `section` = ? ");
            $stmt->execute([$dep, $course, $subject, $section]);
            if($stmt->rowCount() > 0){
                return false;
            }else{
                $stmt = $this->db->prepare("INSERT INTO `faculty_load`(`fl_code`, `department`, `course`, `year_lvl`, `subjects`, `section`, `faculty_email`, `semester`, `sy`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                return $stmt->execute([$code, $dep, $course, $yearLvl, $subject, $section, $fac_email, $sem, $sy]);
            }
        }
    }

    public function deleteLoad($id){
        $stmt = $this->db->prepare("DELETE FROM `faculty_load` WHERE `id` = ?");
        return $stmt->execute([$id]);
    }

    
    public function searchLoad($keyword) {
        $keyword = "%$keyword%";
        $query = "SELECT fl.* , eu.fullname 
                FROM `faculty_load` AS fl
                INNER JOIN `endusers` AS eu ON fl.faculty_email = eu.email
                WHERE (
                    fl.fl_code LIKE :keyword OR
                    fl.department LIKE :keyword OR
                    fl.course LIKE :keyword OR
                    fl.year_lvl LIKE :keyword OR
                    fl.subjects LIKE :keyword OR
                    fl.section LIKE :keyword OR
                    eu.fullname LIKE :keyword
                )
                ORDER BY `id` DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':keyword', $keyword, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>