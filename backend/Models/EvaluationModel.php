<?php

require_once __DIR__ . '/../Core/BaseModel.php';

class EvaluationModel extends BaseModel{

    public function countAllEvaluationsFromUsersInput($email){ // instead of method overloading I just set null for email if no values needed inside arguments
        $query = "SELECT COUNT(*) as total_records FROM `faculty_evaluations` WHERE `student_email` = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_records'];
    }

    public function countAllevaluationsFromStudent(){
        $query = "SELECT COUNT(*) as total_records FROM `faculty_evaluations`";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
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

    public function getPagitanedOverallEvaluatedFaculty($offset, $limit){
        $query = "
            SELECT fe.*, eu.fullname AS faculty_name 
            FROM faculty_evaluations fe
            JOIN endusers eu ON fe.faculty_token = eu.code
            ORDER BY fe.id DESC
            LIMIT :offset, :limit
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPaginatedGroupByResult($offset, $limit){
        $query = "
            SELECT fe.*, eu.fullname AS faculty_name , eu.department AS faculty_dep
            FROM faculty_evaluations fe
            JOIN (
                SELECT MAX(id) AS latest_id
                FROM faculty_evaluations
                GROUP BY faculty_token
            ) grouped_fe ON fe.id = grouped_fe.latest_id
            JOIN endusers eu ON fe.faculty_token = eu.code
            ORDER BY fe.id DESC
            LIMIT :offset, :limit
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEvaluationResult($token){
        $query = "
            SELECT fe.*, eu.fullname AS faculty_name , eu.department AS faculty_dep, eu.photo AS faculty_img, eu.email AS faculty_email
            FROM faculty_evaluations fe
            JOIN endusers eu ON fe.faculty_token = eu.code
            WHERE fe.faculty_token = ?
            ORDER BY fe.id DESC
        ";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$token]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    public function saveEvaluationSummary($data) {
        $query = "
            INSERT INTO faculty_evaluation_summary (
                faculty_id, faculty_name, faculty_email, faculty_department,
                academic_rating, core_values_rating, overall_evaluation, overall_rating,
                ai_recommendations, feedback_strengths, feedback_improvements, feedback_comments
            ) VALUES (
                :faculty_id, :faculty_name, :faculty_email, :faculty_department,
                :academic_rating, :core_values_rating, :overall_evaluation, :overall_rating,
                :ai_recommendations, :feedback_strengths, :feedback_improvements, :feedback_comments
            )
        ";

        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            ':faculty_id' => $data['FacultyID'],
            ':faculty_name' => $data['FacultyName'],
            ':faculty_email' => $data['FacultyEmail'],
            ':faculty_department' => $data['FacultyDep'],

            ':academic_rating' => $data['AcadsRating'],
            ':core_values_rating' => $data['CoreValuesRating'],
            ':overall_evaluation' => $data['OverallEvaluation'],
            ':overall_rating' => $data['OverallRatings'],

            ':ai_recommendations' => json_encode($data['AiRecommendations']),
            ':feedback_strengths' => json_encode($data['FeedbacksStrengths']),
            ':feedback_improvements' => json_encode($data['FeedbackImprovements']),
            ':feedback_comments' => json_encode($data['FeedbackComments']),
        ]);
    }

}