<?php
require_once __DIR__ . '/../Core/BaseModel.php';

class UserModel extends BaseModel {
    public function getUserByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM `endusers` WHERE `email` = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}