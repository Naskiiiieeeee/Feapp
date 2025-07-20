<?php 

require __DIR__ . '/../Core/BaseModel.php';

class EvalationSummaryModel extends BaseModel{
    public function getEvaluationSummaryByDateRange($from, $to) {
        $query = "SELECT * FROM `faculty_evaluation_summary` 
                  WHERE DATE(created_at) BETWEEN :from AND :to 
                  ORDER BY `created_at` DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':from', $from);
        $stmt->bindValue(':to', $to);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getIndividualInsertion($from, $to , $email){
        $query = "SELECT
        fe.*, eu.fullname AS faculty_name , eu.department AS faculty_dep
        FROM faculty_evaluations fe
        JOIN endusers eu ON fe.faculty_token = eu.code
        WHERE DATE(submitted_at) BETWEEN :from AND :to AND `student_email` = :email
        ORDER BY submitted_at DESC;
        ";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(":from", $from);
        $stmt->bindValue(":to", $to);
        $stmt->bindValue(":email", $email);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>