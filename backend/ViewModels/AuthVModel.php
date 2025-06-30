<?php
require_once __DIR__ . '/UserAdminViewModel.php';
require_once __DIR__ . '/UserFacultyViewModel.php';

class AuthViewModel {
    private $adminVM;
    private $facultyVM;

    public function __construct() {
        $this->adminVM = new UserAdminViewModel();
        $this->facultyVM = new UserFacultyViewModel();
    }

    public function login($email, $password) {
        // Try Admin
        $admin = $this->adminVM->getUserEmail($email);
        if ($admin && password_verify($password, $admin['password'])) {
            return ['role' => 'Admin', 'user' => $admin];
        }

        // Try Faculty
        $faculty = $this->facultyVM->getUserEmail($email);
        if ($faculty && password_verify($password, $faculty['password'])) {
            return ['role' => 'Faculty', 'user' => $faculty];
        }

        return false;
    }
}
