<?php 
require_once __DIR__ . '/../Helpers/helpers.php';

class UserPasswordModel extends Helpers{

    public function getRequestCredentials($code){
        $stmt = $this->db->prepare("SELECT * FROM `resetpassword` WHERE `code` = ? ");
        $stmt->execute([$code]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserCredentials($email){
        $stmt = $this->db->prepare("SELECT `email` AS userEmail FROM `endusers` WHERE `email` = ? ");
        $stmt->execute([$email]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function setNewUserpassword($fetchEmail, $password){
        $stmt = $this->db->prepare("SELECT * FROM `endusers` WHERE `email` = ? ");
        $stmt->execute([$fetchEmail]);
        if($stmt->rowCount() > 0){
            $stmtfaculty = $this->db->prepare("UPDATE `endusers` SET `password` = ? WHERE `email` = ? ");
            return $stmtfaculty->execute([$password,$fetchEmail]);
        }else{
            return false;
        }
    }
}

?>