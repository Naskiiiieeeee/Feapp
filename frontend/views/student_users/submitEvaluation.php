<?php
require_once __DIR__ . '/../../../backend/ViewModels/UserFacultyViewModel.php';
include_once __DIR__ . '/../../components/header.php';
include_once __DIR__ . '/../../components/navigation.php';
include_once __DIR__ . '/../../components/sidebar.php';

$vm = new UserFacultyViewModel();
$facultyList = null;

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

            </div>
          </div>
        </div>
        <div class="card-footer bg-primary-subtle">

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