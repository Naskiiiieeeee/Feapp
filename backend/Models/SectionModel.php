<?php

require_once __DIR__ . '/../Helpers/helpers.php';

class SectionModel extends Helpers{
    public function countAllSections() {
        $query = "SELECT COUNT(*) as total_records FROM `section` ";
        $stmt = $this->db->query($query);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_records'] ?? 0;
    }

    public function getsectionPaginated($offset, $limit) {
        $query = "SELECT * FROM `section` ORDER BY `id` DESC LIMIT :offset, :limit";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createNewSection($sectionCode, $secName, $createdDate){
        $stmt = $this->db->prepare("SELECT * FROM `section` WHERE `section_name` = ?");
        $stmt->execute([$secName]);
        if($stmt->rowCount() > 0 ){
            return false;
        }else{
            $stmt = $this->db->prepare("INSERT INTO `section`(`sec_code`, `section_name`, `created_date`) VALUES (?, ?, ?) ");
            return $stmt->execute([$sectionCode, $secName, $createdDate]);
        }
    }
}

?>