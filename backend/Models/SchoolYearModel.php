<?php  

require_once __DIR__ . '/../Helpers/helpers.php';


class SchoolYearModel extends Helpers{

    public function countAllSchoolYear() {
        $query = "SELECT COUNT(*) as total_records FROM `school_year` ";
        $stmt = $this->db->query($query);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_records'] ?? 0;
    }

    public function getschoolYearPaginated($offset, $limit) {
        $query = "SELECT * FROM `school_year` ORDER BY `sy_id` DESC LIMIT :offset, :limit";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}


?>