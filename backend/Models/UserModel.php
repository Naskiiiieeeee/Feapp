<?php
require_once __DIR__ . '/../Core/BaseModel.php';

class UserModel extends BaseModel {
    public function getUserByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM `endusers` WHERE `email` = ? AND `status` = 1 ");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}