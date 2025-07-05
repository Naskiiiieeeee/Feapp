<?php
require_once __DIR__ . '/../../../backend/ViewModels/UserFacultyViewModel.php';
include_once __DIR__ . '/../../components/header.php';
include_once __DIR__ . '/../../components/navigation.php';
include_once __DIR__ . '/../../components/sidebar.php';

$vm = new UserFacultyViewModel();
$facultyList = null;
$facultyData = null;

if (isset($_GET['token'])) {
    $decoded = base64_decode($_GET['token']);
    list($code, $salt) = explode('|', $decoded);

    if ($code === $salt) {
        $facultyData = $vm->getFacultyByCode($code);
    } else {
        echo '<script>alert("Invalid token!"); window.location="FacultyViewList";</script>';
        exit;
    }
  }
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Faculty Evaluation Portal</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>/frontend/views/student_users/FacultyViewList">Back</a></li>
      </ol>
    </nav>
  </div>

<section class="section profile">
  <div class="row">
    <div class="col-xl-4">
      <div class="card">
        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
        <?php if ($facultyData): ?>
            <img src="<?= BASE_URL ?>/<?= htmlspecialchars($facultyData['photo']) ?>" alt="Profile" class="rounded-circle" width="150">
            <h2><?= htmlspecialchars($facultyData['fullname']) ?></h2>
            <h3><?= htmlspecialchars($facultyData['department']) ?></h3>
        <?php else: ?>
            <p class="text-danger">User not found or invalid token.</p>
        <?php endif; ?>
          <div class="social-links mt-2">
            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="google"><i class="bi bi-google"></i></a>
          </div>
        </div>
        <div class="card-footer bg-primary-subtle">

        </div>
      </div>
    </div>

    <div class="col-xl-8">
      <div class="card">
        <div class="card-body pt-3">
          <ul class="nav nav-tabs nav-tabs-bordered">
            <li class="nav-item">
              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
            </li>
          </ul>
          <div class="tab-content pt-2">
            <div class="tab-pane fade show active profile-overview" id="profile-overview">

              <h5 class="card-title">Account Details</h5>
              <?php if ($facultyData): ?>

              <div class="row">
                <div class="col-lg-4 col-md-4 label"><i class="bi bi-upc-scan"></i> Fullname</div>
                <div class="col-lg-8 col-md-8"><?= $facultyData['fullname']; ?></div>
              </div>

              <div class="row">
                <div class="col-lg-4 col-md-4 label"><i class="bi bi-building-fill-lock"></i> Department</div>
                <div class="col-lg-8 col-md-8"><?= $facultyData['department']; ?></div>
              </div>

              <div class="row">
                <div class="col-lg-4 col-md-4 label"><i class="bi bi-calendar-check"></i> Registration Date</div>
                <div class="col-lg-8 col-md-8"><?= $facultyData['date_created']; ?></div>
              </div>

              <div class="row">
                <div class="col-lg-4 col-md-4 label"><i class="bi bi-person-rolodex"></i> Role</div>
                <div class="col-lg-8 col-md-8"><?= $facultyData['role']; ?></div>
              </div>
            <?php else: ?>
                <p class="text-danger">User information not found or invalid token.</p>
            <?php endif; ?>

            </div>
          </div>
        </div>
        <div class="card-footer bg-primary-subtle">

        </div>
      </div>
    </div>

    <div class="col-xl-12">
      <div class="card">
        <form id="evaluationForm">
        <div class="card-body pt-3">
          <ul class="nav nav-tabs nav-tabs-bordered">
            <li class="nav-item">
              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Evaluation Form</button>
            </li>
          </ul>
          <div class="tab-content pt-2">
            <div class="tab-pane fade show active profile-overview" id="profile-overview">

              <h5 class="card-title">Instructions: To support our institution in delivering the highest quality of education through effective teaching, please rate your teachers objectively. Your feedback provides valuable insights into the achievement of course and learning objectives, along with suggestions for improvement from the student perspective.
                <br><hr> 
                1 = Strongly Disagree
                2 = Disagree
                3 = Neutral
                4 = Agree
                5 = Strongly Agree
              </h5>
              <hr> 

              <div class="row">
                <div class="col-lg-12 col-md-6">
                    <h5 class="card-title"> Section 1: Academic Performance</h5>
                    <input type="hidden" name="faculty_token" value="<?= htmlspecialchars($_GET['token'] ?? '') ?>">
                </div>
              </div>
              <hr> 
              
              <div class="row">
                <div class="col-lg-12 col-md-6 label">1. Subject Knowledge and Content Delivery</div>
              </div>

              <div class="row">
                <ul class="col-lg-12 col-md-6">•	The teacher demonstrates a strong understanding of the subject material.</ul>
                <div class="col-lg-12 col-md-6 ">
                    <label for="">Rating:</label>
                    <input type="radio" class="mx-4 mt-3" name="section1_q1_1" id="" value="5"> 5
                    <input type="radio" class="mx-4 mt-3" name="section1_q1_1" id="" value="4"> 4
                    <input type="radio" class="mx-4 mt-3" name="section1_q1_1" id="" value="3"> 3
                    <input type="radio" class="mx-4 mt-3" name="section1_q1_1" id="" value="2"> 2
                    <input type="radio" class="mx-4 mt-3" name="section1_q1_1" id="" value="1"> 1
                </div>
              </div>

              <div class="row">
                <ul class="col-lg-12 col-md-6">•	Lessons are well-organized, and topics are explained clearly and thoroughly.</ul>
                <div class="col-lg-12 col-md-6 ">
                    <label for="">Rating:</label>
                    <input type="radio" class="mx-4 mt-3" name="section1_q1_2" id="" value="5"> 5
                    <input type="radio" class="mx-4 mt-3" name="section1_q1_2" id="" value="4"> 4
                    <input type="radio" class="mx-4 mt-3" name="section1_q1_2" id="" value="3"> 3
                    <input type="radio" class="mx-4 mt-3" name="section1_q1_2" id="" value="2"> 2
                    <input type="radio" class="mx-4 mt-3" name="section1_q1_2" id="" value="1"> 1
                </div>
              </div>

              <div class="row">
                <ul class="col-lg-12 col-md-6">•	The teacher relates course content to real-life situations, enhancing understanding.</ul>
                <div class="col-lg-12 col-md-6 ">
                    <label for="">Rating:</label>
                    <input type="radio" class="mx-4 mt-3" name="section1_q1_3" id="" value="5"> 5
                    <input type="radio" class="mx-4 mt-3" name="section1_q1_3" id="" value="4"> 4
                    <input type="radio" class="mx-4 mt-3" name="section1_q1_3" id="" value="3"> 3
                    <input type="radio" class="mx-4 mt-3" name="section1_q1_3" id="" value="2"> 2
                    <input type="radio" class="mx-4 mt-3" name="section1_q1_3" id="" value="1"> 1
                </div>
              </div>
              
              <div class="row">
                <ul class="col-lg-12 col-md-6">•	The teacher provides students with orientation on the subject and specific school policies, class rules, and regulations.</ul>
                <div class="col-lg-12 col-md-6 ">
                    <label for="">Rating:</label>
                    <input type="radio" class="mx-4 mt-3" name="section1_q1_4" id="" value="5"> 5
                    <input type="radio" class="mx-4 mt-3" name="section1_q1_4" id="" value="4"> 4
                    <input type="radio" class="mx-4 mt-3" name="section1_q1_4" id="" value="3"> 3
                    <input type="radio" class="mx-4 mt-3" name="section1_q1_4" id="" value="2"> 2
                    <input type="radio" class="mx-4 mt-3" name="section1_q1_4" id="" value="1"> 1
                </div>
              </div>

              <hr> 
              <div class="row">
                <div class="col-lg-12 col-md-6 label">2. Instructional Methods and Engagement</div>
              </div>

              <div class="row">
                <ul class="col-lg-12 col-md-6">•	The teacher uses varied instructional methods to keep students engaged and incorporate modern technology to learning.</ul>
                <div class="col-lg-12 col-md-6 ">
                    <label for="">Rating:</label>
                    <input type="radio" class="mx-4 mt-3" name="section1_q2_1" id="" value="5"> 5
                    <input type="radio" class="mx-4 mt-3" name="section1_q2_1" id="" value="4"> 4
                    <input type="radio" class="mx-4 mt-3" name="section1_q2_1" id="" value="3"> 3
                    <input type="radio" class="mx-4 mt-3" name="section1_q2_1" id="" value="2"> 2
                    <input type="radio" class="mx-4 mt-3" name="section1_q2_1" id="" value="1"> 1
                </div>
              </div>
              
              <div class="row">
                <ul class="col-lg-12 col-md-6">•	The teacher encourages class participation and values student input.</ul>
                <div class="col-lg-12 col-md-6 ">
                    <label for="">Rating:</label>
                    <input type="radio" class="mx-4 mt-3" name="section1_q2_2" id="" value="5"> 5
                    <input type="radio" class="mx-4 mt-3" name="section1_q2_2" id="" value="4"> 4
                    <input type="radio" class="mx-4 mt-3" name="section1_q2_2" id="" value="3"> 3
                    <input type="radio" class="mx-4 mt-3" name="section1_q2_2" id="" value="2"> 2
                    <input type="radio" class="mx-4 mt-3" name="section1_q2_2" id="" value="1"> 1
                </div>
              </div>
                            
              <div class="row">
                <ul class="col-lg-12 col-md-6">•	Assignments and activities are relevant and help reinforce learning objectives.</ul>
                <div class="col-lg-12 col-md-6 ">
                    <label for="">Rating:</label>
                    <input type="radio" class="mx-4 mt-3" name="section1_q2_3" id="" value="5"> 5
                    <input type="radio" class="mx-4 mt-3" name="section1_q2_3" id="" value="4"> 4
                    <input type="radio" class="mx-4 mt-3" name="section1_q2_3" id="" value="3"> 3
                    <input type="radio" class="mx-4 mt-3" name="section1_q2_3" id="" value="2"> 2
                    <input type="radio" class="mx-4 mt-3" name="section1_q2_3" id="" value="1"> 1
                </div>
              </div>
                                          
              <div class="row">
                <ul class="col-lg-12 col-md-6">•	The teacher provides timely feedback on assignments and assessments.</ul>
                <div class="col-lg-12 col-md-6 ">
                    <label for="">Rating:</label>
                    <input type="radio" class="mx-4 mt-3" name="section1_q2_4" id="" value="5"> 5
                    <input type="radio" class="mx-4 mt-3" name="section1_q2_4" id="" value="4"> 4
                    <input type="radio" class="mx-4 mt-3" name="section1_q2_4" id="" value="3"> 3
                    <input type="radio" class="mx-4 mt-3" name="section1_q2_4" id="" value="2"> 2
                    <input type="radio" class="mx-4 mt-3" name="section1_q2_4" id="" value="1"> 1
                </div>
              </div>

              <hr> 
              <div class="row">
                <div class="col-lg-12 col-md-6 label">3. Classroom Management and adaptability</div>
              </div>          
              
              <div class="row">
                <ul class="col-lg-12 col-md-6">•	The teacher maintains an environment conducive to learning and minimizes distractions.</ul>
                <div class="col-lg-12 col-md-6 ">
                    <label for="">Rating:</label>
                    <input type="radio" class="mx-4 mt-3" name="section1_q3_1" id="" value="5"> 5
                    <input type="radio" class="mx-4 mt-3" name="section1_q3_1" id="" value="4"> 4
                    <input type="radio" class="mx-4 mt-3" name="section1_q3_1" id="" value="3"> 3
                    <input type="radio" class="mx-4 mt-3" name="section1_q3_1" id="" value="2"> 2
                    <input type="radio" class="mx-4 mt-3" name="section1_q3_1" id="" value="1"> 1
                </div>
              </div>
                            
              <div class="row">
                <ul class="col-lg-12 col-md-6">•	The teacher is consistent and fair in enforcing classroom rules and expectations.</ul>
                <div class="col-lg-12 col-md-6 ">
                    <label for="">Rating:</label>
                    <input type="radio" class="mx-4 mt-3" name="section1_q3_2" id="" value="5"> 5
                    <input type="radio" class="mx-4 mt-3" name="section1_q3_2" id="" value="4"> 4
                    <input type="radio" class="mx-4 mt-3" name="section1_q3_2" id="" value="3"> 3
                    <input type="radio" class="mx-4 mt-3" name="section1_q3_2" id="" value="2"> 2
                    <input type="radio" class="mx-4 mt-3" name="section1_q3_2" id="" value="1"> 1
                </div>
              </div>
                                          
              <div class="row">
                <ul class="col-lg-12 col-md-6">•	The teacher demonstrates flexibility and adapts lesson plans to meet students' needs or changing situations.</ul>
                <div class="col-lg-12 col-md-6 ">
                    <label for="">Rating:</label>
                    <input type="radio" class="mx-4 mt-3" name="section1_q3_3" id="" value="5"> 5
                    <input type="radio" class="mx-4 mt-3" name="section1_q3_3" id="" value="4"> 4
                    <input type="radio" class="mx-4 mt-3" name="section1_q3_3" id="" value="3"> 3
                    <input type="radio" class="mx-4 mt-3" name="section1_q3_3" id="" value="2"> 2
                    <input type="radio" class="mx-4 mt-3" name="section1_q3_3" id="" value="1"> 1
                </div>
              </div>
              
              <div class="row">
                <ul class="col-lg-12 col-md-6">•	The teacher maintains being a good role model to students by adhering to the rules and regulations of the school.</ul>
                <div class="col-lg-12 col-md-6 ">
                    <label for="">Rating:</label>
                    <input type="radio" class="mx-4 mt-3" name="section1_q3_4" id="" value="5"> 5
                    <input type="radio" class="mx-4 mt-3" name="section1_q3_4" id="" value="4"> 4
                    <input type="radio" class="mx-4 mt-3" name="section1_q3_4" id="" value="3"> 3
                    <input type="radio" class="mx-4 mt-3" name="section1_q3_4" id="" value="2"> 2
                    <input type="radio" class="mx-4 mt-3" name="section1_q3_4" id="" value="1"> 1
                </div>
              </div>

              <hr> 
              <div class="row">
                <div class="col-lg-12 col-md-6 label">4. Preparedness and Organization</div>
              </div>  
                            
              <div class="row">
                <ul class="col-lg-12 col-md-6">•	The teacher is well-prepared for each class, with clear lesson plans and materials.</ul>
                <div class="col-lg-12 col-md-6 ">
                    <label for="">Rating:</label>
                    <input type="radio" class="mx-4 mt-3" name="section1_q4_1" id="" value="5"> 5
                    <input type="radio" class="mx-4 mt-3" name="section1_q4_1" id="" value="4"> 4
                    <input type="radio" class="mx-4 mt-3" name="section1_q4_1" id="" value="3"> 3
                    <input type="radio" class="mx-4 mt-3" name="section1_q4_1" id="" value="2"> 2
                    <input type="radio" class="mx-4 mt-3" name="section1_q4_1" id="" value="1"> 1
                </div>
              </div>

              <div class="row">
                <ul class="col-lg-12 col-md-6">•	The teacher effectively manages class time and transitions smoothly between activities.</ul>
                <div class="col-lg-12 col-md-6 ">
                    <label for="">Rating:</label>
                    <input type="radio" class="mx-4 mt-3" name="section1_q4_2" id="" value="5"> 5
                    <input type="radio" class="mx-4 mt-3" name="section1_q4_2" id="" value="4"> 4
                    <input type="radio" class="mx-4 mt-3" name="section1_q4_2" id="" value="3"> 3
                    <input type="radio" class="mx-4 mt-3" name="section1_q4_2" id="" value="2"> 2
                    <input type="radio" class="mx-4 mt-3" name="section1_q4_2" id="" value="1"> 1
                </div>
              </div>

              <div class="row">
                <ul class="col-lg-12 col-md-6">•	The teacher is consistently well-prepared and effectively delivers lessons in both synchronous and asynchronous formats, ensuring clarity and continuity of learning.</ul>
                <div class="col-lg-12 col-md-6 ">
                    <label for="">Rating:</label>
                    <input type="radio" class="mx-4 mt-3" name="section1_q4_3" id="" value="5"> 5
                    <input type="radio" class="mx-4 mt-3" name="section1_q4_3" id="" value="4"> 4
                    <input type="radio" class="mx-4 mt-3" name="section1_q4_3" id="" value="3"> 3
                    <input type="radio" class="mx-4 mt-3" name="section1_q4_3" id="" value="2"> 2
                    <input type="radio" class="mx-4 mt-3" name="section1_q4_3" id="" value="1"> 1
                </div>
              </div>
              
              <div class="row">
                <ul class="col-lg-12 col-md-6">•	The teacher has a well-prepared and organized syllabus, which is closely followed during class lessons to ensure a structured and cohesive learning experience.</ul>
                <div class="col-lg-12 col-md-6 ">
                    <label for="">Rating:</label>
                    <input type="radio" class="mx-4 mt-3" name="section1_q4_4" id="" value="5"> 5
                    <input type="radio" class="mx-4 mt-3" name="section1_q4_4" id="" value="4"> 4
                    <input type="radio" class="mx-4 mt-3" name="section1_q4_4" id="" value="3"> 3
                    <input type="radio" class="mx-4 mt-3" name="section1_q4_4" id="" value="2"> 2
                    <input type="radio" class="mx-4 mt-3" name="section1_q4_4" id="" value="1"> 1
                </div>
              </div>

              <hr> 

              <div class="row">
                <div class="col-lg-12 col-md-6">
                    <h5 class="card-title"> Section 2: Core Values and Personality Traits</h5>
                </div>
              </div>
              <hr> 

              <div class="row">
                <div class="col-lg-12 col-md-6 label">1. Professionalism and Integrity</div>
              </div>
                            
              <div class="row">
                <ul class="col-lg-12 col-md-6">•	The teacher shows dedication to their role and takes responsibility for students’ learning.</ul>
                <div class="col-lg-12 col-md-6 ">
                    <label for="">Rating:</label>
                    <input type="radio" class="mx-4 mt-3" name="section2_q1_1" id="" value="5"> 5
                    <input type="radio" class="mx-4 mt-3" name="section2_q1_1" id="" value="4"> 4
                    <input type="radio" class="mx-4 mt-3" name="section2_q1_1" id="" value="3"> 3
                    <input type="radio" class="mx-4 mt-3" name="section2_q1_1" id="" value="2"> 2
                    <input type="radio" class="mx-4 mt-3" name="section2_q1_1" id="" value="1"> 1
                </div>
              </div>
                                          
              <div class="row">
                <ul class="col-lg-12 col-md-6">•	The teacher upholds high ethical and moral values by practicing honesty and integrity inside and outside the classroom.</ul>
                <div class="col-lg-12 col-md-6 ">
                    <label for="">Rating:</label>
                    <input type="radio" class="mx-4 mt-3" name="section2_q1_2" id="" value="5"> 5
                    <input type="radio" class="mx-4 mt-3" name="section2_q1_2" id="" value="4"> 4
                    <input type="radio" class="mx-4 mt-3" name="section2_q1_2" id="" value="3"> 3
                    <input type="radio" class="mx-4 mt-3" name="section2_q1_2" id="" value="2"> 2
                    <input type="radio" class="mx-4 mt-3" name="section2_q1_2" id="" value="1"> 1
                </div>
              </div>

              <div class="row">
                <ul class="col-lg-12 col-md-6">•	The teacher maintains good grooming by wearing appropriate attire for a teacher?</ul>
                <div class="col-lg-12 col-md-6 ">
                    <label for="">Rating:</label>
                    <input type="radio" class="mx-4 mt-3" name="section2_q1_3" id="" value="5"> 5
                    <input type="radio" class="mx-4 mt-3" name="section2_q1_3" id="" value="4"> 4
                    <input type="radio" class="mx-4 mt-3" name="section2_q1_3" id="" value="3"> 3
                    <input type="radio" class="mx-4 mt-3" name="section2_q1_3" id="" value="2"> 2
                    <input type="radio" class="mx-4 mt-3" name="section2_q1_3" id="" value="1"> 1
                </div>
              </div>
              
              <div class="row">
                <ul class="col-lg-12 col-md-6">•	The teacher observes punctuality in attending classes regularly.</ul>
                <div class="col-lg-12 col-md-6 ">
                    <label for="">Rating:</label>
                    <input type="radio" class="mx-4 mt-3" name="section2_q1_4" id="" value="5"> 5
                    <input type="radio" class="mx-4 mt-3" name="section2_q1_4" id="" value="4"> 4
                    <input type="radio" class="mx-4 mt-3" name="section2_q1_4" id="" value="3"> 3
                    <input type="radio" class="mx-4 mt-3" name="section2_q1_4" id="" value="2"> 2
                    <input type="radio" class="mx-4 mt-3" name="section2_q1_4" id="" value="1"> 1
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-lg-12 col-md-6 label">2. Respect and Fairness</div>
              </div>
                            
              <div class="row">
                <ul class="col-lg-12 col-md-6">•	The teacher treats all students fairly, without favoritism, regardless of age, gender, beliefs, religion, attitudes, and personality.</ul>
                <div class="col-lg-12 col-md-6 ">
                    <label for="">Rating:</label>
                    <input type="radio" class="mx-4 mt-3" name="section2_q2_1" id="" value="5"> 5
                    <input type="radio" class="mx-4 mt-3" name="section2_q2_1" id="" value="4"> 4
                    <input type="radio" class="mx-4 mt-3" name="section2_q2_1" id="" value="3"> 3
                    <input type="radio" class="mx-4 mt-3" name="section2_q2_1" id="" value="2"> 2
                    <input type="radio" class="mx-4 mt-3" name="section2_q2_1" id="" value="1"> 1
                </div>
              </div>

              <div class="row">
                <ul class="col-lg-12 col-md-6">•	The teacher respects diverse backgrounds, opinions, and perspectives in the classroom.</ul>
                <div class="col-lg-12 col-md-6 ">
                    <label for="">Rating:</label>
                    <input type="radio" class="mx-4 mt-3" name="section2_q2_2" id="" value="5"> 5
                    <input type="radio" class="mx-4 mt-3" name="section2_q2_2" id="" value="4"> 4
                    <input type="radio" class="mx-4 mt-3" name="section2_q2_2" id="" value="3"> 3
                    <input type="radio" class="mx-4 mt-3" name="section2_q2_2" id="" value="2"> 2
                    <input type="radio" class="mx-4 mt-3" name="section2_q2_2" id="" value="1"> 1
                </div>
              </div>
              
              <div class="row">
                <ul class="col-lg-12 col-md-6">•	The teacher treats all students with respect and kindness, creating a safe learning space.</ul>
                <div class="col-lg-12 col-md-6 ">
                    <label for="">Rating:</label>
                    <input type="radio" class="mx-4 mt-3" name="section2_q2_3" id="" value="5"> 5
                    <input type="radio" class="mx-4 mt-3" name="section2_q2_3" id="" value="4"> 4
                    <input type="radio" class="mx-4 mt-3" name="section2_q2_3" id="" value="3"> 3
                    <input type="radio" class="mx-4 mt-3" name="section2_q2_3" id="" value="2"> 2
                    <input type="radio" class="mx-4 mt-3" name="section2_q2_3" id="" value="1"> 1
                </div>
              </div>

              <div class="row">
                <ul class="col-lg-12 col-md-6">•	The teacher respects and values the opinions and ideas of all students.</ul>
                <div class="col-lg-12 col-md-6 ">
                    <label for="">Rating:</label>
                    <input type="radio" class="mx-4 mt-3" name="section2_q2_4" id="" value="5"> 5
                    <input type="radio" class="mx-4 mt-3" name="section2_q2_4" id="" value="4"> 4
                    <input type="radio" class="mx-4 mt-3" name="section2_q2_4" id="" value="3"> 3
                    <input type="radio" class="mx-4 mt-3" name="section2_q2_4" id="" value="2"> 2
                    <input type="radio" class="mx-4 mt-3" name="section2_q2_4" id="" value="1"> 1
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-lg-12 col-md-6 label">3. Approachability and Support</div>
              </div>

              <div class="row">
                <ul class="col-lg-12 col-md-6">•	The teacher is approachable and available to answer questions or provide additional help.</ul>
                <div class="col-lg-12 col-md-6 ">
                    <label for="">Rating:</label>
                    <input type="radio" class="mx-4 mt-3" name="section2_q3_1" id="" value="5"> 5
                    <input type="radio" class="mx-4 mt-3" name="section2_q3_1" id="" value="4"> 4
                    <input type="radio" class="mx-4 mt-3" name="section2_q3_1" id="" value="3"> 3
                    <input type="radio" class="mx-4 mt-3" name="section2_q3_1" id="" value="2"> 2
                    <input type="radio" class="mx-4 mt-3" name="section2_q3_1" id="" value="1"> 1
                </div>
              </div>
              
              <div class="row">
                <ul class="col-lg-12 col-md-6">•	The teacher demonstrates empathy and understanding toward students’ needs and challenges.</ul>
                <div class="col-lg-12 col-md-6 ">
                    <label for="">Rating:</label>
                    <input type="radio" class="mx-4 mt-3" name="section2_q3_2" id="" value="5"> 5
                    <input type="radio" class="mx-4 mt-3" name="section2_q3_2" id="" value="4"> 4
                    <input type="radio" class="mx-4 mt-3" name="section2_q3_2" id="" value="3"> 3
                    <input type="radio" class="mx-4 mt-3" name="section2_q3_2" id="" value="2"> 2
                    <input type="radio" class="mx-4 mt-3" name="section2_q3_2" id="" value="1"> 1
                </div>
              </div>

              <div class="row">
                <ul class="col-lg-12 col-md-6">•	The teacher shows genuine concern for students’ learning and well-being.</ul>
                <div class="col-lg-12 col-md-6 ">
                    <label for="">Rating:</label>
                    <input type="radio" class="mx-4 mt-3" name="section2_q3_3" id="" value="5"> 5
                    <input type="radio" class="mx-4 mt-3" name="section2_q3_3" id="" value="4"> 4
                    <input type="radio" class="mx-4 mt-3" name="section2_q3_3" id="" value="3"> 3
                    <input type="radio" class="mx-4 mt-3" name="section2_q3_3" id="" value="2"> 2
                    <input type="radio" class="mx-4 mt-3" name="section2_q3_3" id="" value="1"> 1
                </div>
              </div>
              
              <div class="row">
                <ul class="col-lg-12 col-md-6">•	The teacher is patient and understanding with students who need extra help.</ul>
                <div class="col-lg-12 col-md-6 ">
                    <label for="">Rating:</label>
                    <input type="radio" class="mx-4 mt-3" name="section2_q3_4" id="" value="5"> 5
                    <input type="radio" class="mx-4 mt-3" name="section2_q3_4" id="" value="4"> 4
                    <input type="radio" class="mx-4 mt-3" name="section2_q3_4" id="" value="3"> 3
                    <input type="radio" class="mx-4 mt-3" name="section2_q3_4" id="" value="2"> 2
                    <input type="radio" class="mx-4 mt-3" name="section2_q3_4" id="" value="1"> 1
                </div>
              </div>

              <hr>
              <div class="row">
                <div class="col-lg-12 col-md-6 label">4. Enthusiasm and Motivation</div>
              </div>
                            
              <div class="row">
                <ul class="col-lg-12 col-md-6">•	The teacher displays enthusiasm for the subject and makes learning enjoyable.</ul>
                <div class="col-lg-12 col-md-6 ">
                    <label for="">Rating:</label>
                    <input type="radio" class="mx-4 mt-3" name="section2_q4_1" id="" value="5"> 5
                    <input type="radio" class="mx-4 mt-3" name="section2_q4_1" id="" value="4"> 4
                    <input type="radio" class="mx-4 mt-3" name="section2_q4_1" id="" value="3"> 3
                    <input type="radio" class="mx-4 mt-3" name="section2_q4_1" id="" value="2"> 2
                    <input type="radio" class="mx-4 mt-3" name="section2_q4_1" id="" value="1"> 1
                </div>
              </div>

              <div class="row">
                <ul class="col-lg-12 col-md-6">•	The teacher motivates students to do their best and fosters a love for learning.</ul>
                <div class="col-lg-12 col-md-6 ">
                    <label for="">Rating:</label>
                    <input type="radio" class="mx-4 mt-3" name="section2_q4_2" id="" value="5"> 5
                    <input type="radio" class="mx-4 mt-3" name="section2_q4_2" id="" value="4"> 4
                    <input type="radio" class="mx-4 mt-3" name="section2_q4_2" id="" value="3"> 3
                    <input type="radio" class="mx-4 mt-3" name="section2_q4_2" id="" value="2"> 2
                    <input type="radio" class="mx-4 mt-3" name="section2_q4_2" id="" value="1"> 1
                </div>
              </div>
              
              <div class="row">
                <ul class="col-lg-12 col-md-6">•	The teacher connects lesson content to real-life situations or applications.</ul>
                <div class="col-lg-12 col-md-6 ">
                    <label for="">Rating:</label>
                    <input type="radio" class="mx-4 mt-3" name="section2_q4_3" id="" value="5"> 5
                    <input type="radio" class="mx-4 mt-3" name="section2_q4_3" id="" value="4"> 4
                    <input type="radio" class="mx-4 mt-3" name="section2_q4_3" id="" value="3"> 3
                    <input type="radio" class="mx-4 mt-3" name="section2_q4_3" id="" value="2"> 2
                    <input type="radio" class="mx-4 mt-3" name="section2_q4_3" id="" value="1"> 1
                </div>
              </div>

              <div class="row">
                <ul class="col-lg-12 col-md-6">•	The teacher creates a positive learning atmosphere that motivates students to do their best.</ul>
                <div class="col-lg-12 col-md-6 ">
                    <label for="">Rating:</label>
                    <input type="radio" class="mx-4 mt-3" name="section2_q4_4" id="" value="5"> 5
                    <input type="radio" class="mx-4 mt-3" name="section2_q4_4" id="" value="4"> 4
                    <input type="radio" class="mx-4 mt-3" name="section2_q4_4" id="" value="3"> 3
                    <input type="radio" class="mx-4 mt-3" name="section2_q4_4" id="" value="2"> 2
                    <input type="radio" class="mx-4 mt-3" name="section2_q4_4" id="" value="1"> 1
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-lg-12 col-md-6">
                    <h5 class="card-title">Overall Evaluation</h5>
                </div>
              </div>
              <div class="row">
                <ul class="col-lg-12 col-md-6">•	Overall, how would you rate this teacher?</ul>
                <div class="col-lg-12 col-md-6 ">
                    <label for="">Rating:</label>
                    <input type="radio" class="mx-4 mt-3" name="overall_rating" id="" value="5"> Excellent
                    <input type="radio" class="mx-4 mt-3" name="overall_rating" id="" value="4"> Very Good
                    <input type="radio" class="mx-4 mt-3" name="overall_rating" id="" value="3"> Good
                    <input type="radio" class="mx-4 mt-3" name="overall_rating" id="" value="2"> Fair
                    <input type="radio" class="mx-4 mt-3" name="overall_rating" id="" value="1"> Poor
                </div>
              </div>
              <hr> 

              <div class="row">
                <div class="col-lg-12 col-md-6">
                    <h5 class="card-title">Open-Ended Feedback:</h5>
                </div>
              </div>

              <div class="row">
                <ul class="col-lg-12 col-md-6">1.	What do you think are the teacher's strengths?</ul>
                <div class="col-lg-12 col-md-6 ">
                  <textarea name="strengths" id="" cols="30" class="form-control"></textarea>
                </div>
              </div>
                            
              <div class="row">
                <ul class="col-lg-12 col-md-6">2.	In what areas could the teacher improve?</ul>
                <div class="col-lg-12 col-md-6 ">
                  <textarea name="improvements" id="" cols="30" class="form-control"></textarea>
                </div>
              </div>

              <div class="row">
                <ul class="col-lg-12 col-md-6">3.	Any additional comments:</ul>
                <div class="col-lg-12 col-md-6 ">
                  <textarea name="comments" id="" cols="30" class="form-control"></textarea>
                </div>
              </div>

            </div>
          </div>
        </div>
        <div class="card-footer bg-primary-subtle">
          <button type="submit" class="btn btn-primary mt-4" name="btnSubmitEvaluation">Submit Evaluation</button>
        </form>
        </div>
      </div>
    </div>
  </div>
</section>

</main>

<?php
include_once __DIR__ . '/../../components/footer.php';
include_once __DIR__ . '/../../components/footscript.php';
?>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
const BASE_URL = "<?= BASE_URL ?>";
const token = <?php echo json_encode($_GET['token'] ?? ''); ?>;
const userEmail = <?php echo json_encode($_SESSION['email']); ?>;
const storageKey = `faculty_evaluation_${userEmail}_${token}`;

// Restore saved radios and textareas
window.addEventListener('DOMContentLoaded', () => {
  const saved = JSON.parse(localStorage.getItem(storageKey)) || {};
  Object.entries(saved).forEach(([name, value]) => {
    const input = document.querySelector(`[name="${name}"]`);
    if (input) {
      if (input.type === 'radio') {
        const selected = document.querySelector(`input[name="${name}"][value="${value}"]`);
        if (selected) selected.checked = true;
      } else if (input.tagName === 'TEXTAREA') {
        input.value = value;
      }
    }
  });
});

// Save user input
document.querySelectorAll('input[type=radio], textarea').forEach(input => {
  input.addEventListener('input', () => {
    const saved = JSON.parse(localStorage.getItem(storageKey)) || {};
    saved[input.name] = input.value;
    localStorage.setItem(storageKey, JSON.stringify(saved));
  });
});

// Get average per section
function getAverageScore(sectionPrefix) {
  let total = 0, count = 0;
  document.querySelectorAll(`input[type="radio"]:checked`).forEach(input => {
    if (input.name.startsWith(sectionPrefix)) {
      total += parseInt(input.value);
      count++;
    }
  });
  return count ? (total / count).toFixed(2) : 0;
}

// Handle submit
$('#evaluationForm').submit(function (e) {
  e.preventDefault();

  const formData = new FormData(this);
  formData.append("btnSubmitEvaluation", true);

  const academicAvg = getAverageScore("section1_");
  const coreValuesAvg = getAverageScore("section2_");
  const overallScore = getAverageScore("overall_rating");

  if (parseFloat(academicAvg) === 0 || parseFloat(coreValuesAvg) === 0 || parseFloat(overallScore) === 0) {
    Swal.fire('Incomplete', 'Please answer all required questions.', 'warning');
    return;
  }

  formData.append("academic_avg", academicAvg);
  formData.append("core_values_avg", coreValuesAvg);
  formData.append("overall_score", overallScore);
  formData.append("strengths", document.querySelector('textarea[name="strengths"]').value);
  formData.append("improvements", document.querySelector('textarea[name="improvements"]').value);
  formData.append("comments", document.querySelector('textarea[name="comments"]').value);
  formData.append("faculty_token", token); // Important!

  // Step 1: Submit evaluation
  $.ajax({
    url: BASE_URL + '/api/api.setuprecommender.php',
    type: 'POST',
    data: formData,
    contentType: false,
    processData: false,
    dataType: 'json',
    success: function (response) {
      if (response === "added") {
        // Step 2: Ask AI for recommendation
        $.ajax({
          url: 'http://localhost:5000/recommend-training',
          method: 'POST',
          contentType: 'application/json',
          data: JSON.stringify({
            subject_knowledge: academicAvg,
            engagement: academicAvg,
            management: coreValuesAvg,
            preparedness: academicAvg,
            professionalism: coreValuesAvg
          }),
          success: function (recommendation) {
            const aiTraining = recommendation.recommended_training || "None";

            Swal.fire({
              icon: 'success',
              title: 'Evaluation Submitted!',
              html: 'Recommended Training: <b>' + aiTraining + '</b>'
            }).then(() => {
              // Step 3: Save recommendation to DB
              $.ajax({
                url: BASE_URL + '/api/api.save_recommendation.php',
                method: 'POST',
                data: {
                  student_email: userEmail,
                  faculty_token: token,
                  ai_recommendation: aiTraining
                },
                success: function () {
                  localStorage.removeItem(storageKey);
                  location.href = 'FacultyViewList';
                }
              });
            });
          },
          error: function () {
            Swal.fire('AI Error', 'Evaluation saved but failed to get AI recommendation.', 'warning');
          }
        });
      } else if (response === "already_evaluated") {
        Swal.fire('Notice', 'You already evaluated this faculty.', 'info');
      } else {
        Swal.fire('Error', 'Something went wrong.', 'error');
      }
    },
    error: function () {
      Swal.fire('Error', 'PHP server error.', 'error');
    }
  });
});
</script>
