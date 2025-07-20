<?php
require_once __DIR__ . '/../Core/BaseModel.php';

class UserFaculty extends BaseModel {

    public function countAllFaculty() {
        $query = "SELECT COUNT(*) as total_records FROM `endusers` WHERE `role` = 'Faculty'";
        $stmt = $this->db->query($query);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_records'] ?? 0;
    }

    public function getFacultiesPaginated($offset, $limit) {
        $query = "SELECT * FROM `endusers` WHERE `role` = 'Faculty' ORDER BY `eu_id` DESC LIMIT :offset, :limit";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteFaculty($id) {
        $stmt = $this->db->prepare("SELECT `photo` FROM `endusers` WHERE `eu_id` = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && !empty($user['photo'])) {
            $photoPath = __DIR__ . '/../../' . $user['photo'];
            if (file_exists($photoPath)) {
                unlink($photoPath);
            }
        }
        $stmt = $this->db->prepare("DELETE FROM `endusers` WHERE `eu_id` = ?");
        return $stmt->execute([$id]);
    }

    public function updateStatus($id, $status) {
        $stmt = $this->db->prepare("UPDATE `endusers` SET `status` = ? WHERE `code` = ?");
        return $stmt->execute([$status, $id]);
    }

    public function createNewFaculty($path, $fullname, $email, $password, $dep, $role, $code){
        $query = "INSERT INTO `endusers`(`photo`, `fullname`, `email`, `password`, `department`, `role`, `code`) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$path, $fullname, $email, $password, $dep, $role, $code]);
    }

    public function getFacultyByCode($code) {
        $stmt = $this->db->prepare("SELECT * FROM `endusers` WHERE `code` = ?");
        $stmt->execute([$code]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getByEmail($email){
        $stmt = $this->db->prepare("SELECT * FROM `endusers` WHERE `email` = ? AND `status` = 1 ");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getByRole(){
        $stmt = $this->db->prepare("SELECT * FROM `endusers` WHERE `role` = 'Faculty' AND `status` = 1 ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchFaculty($keyword) {
        $keyword = "%$keyword%";
        $query = "SELECT * FROM `endusers` 
                WHERE `role` = 'Faculty' AND (
                    `code` LIKE :keyword OR
                    `email` LIKE :keyword OR
                    `fullname` LIKE :keyword OR
                    `department` LIKE :keyword
                )
                ORDER BY `eu_id` DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':keyword', $keyword, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
