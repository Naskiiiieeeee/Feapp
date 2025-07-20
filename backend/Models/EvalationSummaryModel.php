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
}

?>