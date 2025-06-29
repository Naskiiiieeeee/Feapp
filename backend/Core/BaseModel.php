<?php 
require_once 'Database.php';
class BaseModel {
    protected $db;
    public function __construct() {
        $this->db = (new Database())->getConnection();
    }
}
?>