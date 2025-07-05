<?php

require_once __DIR__ . '/../Core/BaseModel.php';

class EvaluationModel extends BaseModel{

    public function countAllEvaluationsFromUsersInput($email){
        $query = "SELECT COUNT(*) as total_records FROM `faculty_evaluations` WHERE `student_email` = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_records'];
    }
    public function getPaginatedEvaluatedFaculty($offset, $limit, $email) {
        $query = "
            SELECT fe.*, eu.fullname AS faculty_name 
            FROM faculty_evaluations fe
            JOIN endusers eu ON fe.faculty_token = eu.code
            WHERE fe.student_email = :email
            ORDER BY fe.id DESC
            LIMIT :offset, :limit
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}