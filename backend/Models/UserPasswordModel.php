<?php 
require_once __DIR__ . '/../Helpers/helpers.php';

class UserPasswordModel extends Helpers{

    public function getRequestCredentials($code){
        $stmt = $this->db->prepare("SELECT * FROM `resetpassword` WHERE `code` = ? ");
        $stmt->execute([$code]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserCredentials($email){
        $stmt = $this->db->prepare("SELECT * FROM `endusers` WHERE `email` = ? ");
        $stmt->execute([$email]);
        if($stmt->rowCount() > 0){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $stmt1 = $this->db->prepare("SELECT * FROM `student_info` WHERE `student_email` = ?");
            $stmt1->execute([$email]);
            return $stmt1->fetchAll(PDO::FETCH_ASSOC);
        }
    }
}

?>