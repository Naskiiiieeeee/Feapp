<?php 
require_once __DIR__ . '/../Helpers/helpers.php';

class UserPasswordModel extends Helpers{

    public function getRequestCredentials($code){
        $stmt = $this->db->prepare("SELECT * FROM `resetpassword` WHERE `code` = ? ");
        return $stmt->execute([$code]);
    }
}

?>