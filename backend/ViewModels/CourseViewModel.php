<?php 
require_once __DIR__ . '/../Models/CourseModel.php';

class CourseViewModel{
    private $model;
    public function __construct(){
        $this->model = new CourseModel(); 
    }

    public function getDepartmentPaginated($page = 1, $limit = 4) {
        $offset = ($page - 1) * $limit;
        return $this->model->getCoursePaginated($offset, $limit);
    }

    public function getTotalPages($limit = 4) {
        $totalRecords = $this->model->countAllCourse();
        return ceil($totalRecords / $limit);
    }
}

?>