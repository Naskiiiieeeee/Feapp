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
                ai_recommendations, feedback_strengths, feedback_improvements, feedback_comments,
                created_at
            ) VALUES (
                :faculty_id, :faculty_name, :faculty_email, :faculty_dep,
                :acad, :core, :overall, :rating,
                :recommendations, :strengths, :improvements, :comments,
                NOW()
            )
        ";

        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            ':faculty_id' => $data['FacultyID'],
            ':faculty_name' => $data['FacultyName'],
            ':faculty_email' => $data['FacultyEmail'],
            ':faculty_dep' => $data['FacultyDep'],
            ':acad' => $data['AcadsRating'],
            ':core' => $data['CoreValuesRating'],
            ':overall' => $data['OverallEvaluation'],
            ':rating' => $data['OverallRatings'],
            ':recommendations' => implode(", ", $data['AiRecommendations']),
            ':strengths' => implode(" | ", $data['FeedbacksStrengths']),
            ':improvements' => implode(" | ", $data['FeedbackImprovements']),
            ':comments' => implode(" | ", $data['FeedbackComments']),
        ]);
    }


    public function hasRecentEvaluation($facultyEmail) {
        $query = "
            SELECT COUNT(*) as total 
            FROM faculty_evaluation_summary 
            WHERE faculty_email = ? 
            AND created_at >= DATE_SUB(NOW(), INTERVAL 6 MONTH)
        ";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$facultyEmail]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'] > 0;
    }

    
    public function getPaginatedIndividualResult($offset, $limit, $email) {
        $query = "SELECT * FROM `faculty_evaluation_summary` WHERE `faculty_email` = :email ORDER BY id DESC LIMIT $offset, $limit";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countfacultyEvaluation($email){
        $query = "SELECT COUNT(*) as total_records FROM `faculty_evaluation_summary` WHERE `faculty_email` = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_records'];
    }
    
    public function getIndividualEvaluationResult($token, $email){
        $query = "
            SELECT fe.*, eu.fullname AS faculty_name , eu.department AS faculty_dep, eu.photo AS faculty_img, eu.email AS faculty_email
            FROM faculty_evaluation_summary fe
            JOIN endusers eu ON fe.faculty_id = eu.code
            WHERE fe.faculty_id = ?
            AND fe.faculty_email = ?
            ORDER BY fe.id DESC
        ";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$token, $email]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    public function getPaginatedIndividualResultAdminSide($offset, $limit) {
        $query = "SELECT * FROM `faculty_evaluation_summary` ORDER BY id DESC LIMIT $offset, $limit";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countfacultyEvaluationAdminSide(){
        $query = "SELECT COUNT(*) as total_records FROM `faculty_evaluation_summary`";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_records'];
    }

    public function getIndividualEvaluationResultAdminSide($token){
        $query = "
            SELECT fe.*, eu.fullname AS faculty_name , eu.department AS faculty_dep, eu.photo AS faculty_img, eu.email AS faculty_email
            FROM faculty_evaluation_summary fe
            JOIN endusers eu ON fe.faculty_id = eu.code
            WHERE fe.faculty_id = ?
            ORDER BY fe.id DESC
        ";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$token]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }
    
    public function deleteEvaluationHistory($id) {
        $stmt = $this->db->prepare("DELETE FROM `faculty_evaluation_summary` WHERE `id` = ?");
        return $stmt->execute([$id]);
    }

}