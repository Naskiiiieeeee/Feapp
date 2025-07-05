<?php
require_once __DIR__ . '/../Models/UserStudentModel.php';
class AuthViewModel {
    private $studentVM;

    public function __construct() {
        $this->studentVM = new UserStudentModel();
    }

    public function login($email, $password) {
        $student = $this->studentVM->getByEmail($email);
        if ($student && $password === $student['student_no']) {
            return [
                'role' => 'Student',
                'user' => $student
            ];
        }
        return false;
    }
}
