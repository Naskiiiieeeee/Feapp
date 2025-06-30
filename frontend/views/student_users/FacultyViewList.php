<?php
require_once __DIR__ . '/../../../backend/ViewModels/UserFacultyViewModel.php';
include_once __DIR__ . '/../../components/header.php';
include_once __DIR__ . '/../../components/navigation.php';
include_once __DIR__ . '/../../components/sidebar.php';

$vm = new UserFacultyViewModel();
$facultyList = null;
$facultyList = $vm->getFacultyInfo();
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Faculty Profiles</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>/frontend/views/student_users/dashboardstudent">Back to Dashboard</a></li>
      </ol>
    </nav>
  </div>

  <section class="section profile">
    <div class="row">
      <?php if (!empty($facultyList)): ?>
        <?php foreach ($facultyList as $faculty): ?>
          <div class="col-xl-4">
            <div class="card">
              <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                <img src="<?= BASE_URL ?>/<?= htmlspecialchars($faculty['photo']) ?>" alt="Profile" class="rounded-circle" width="150">
                <h2><?= htmlspecialchars($faculty['fullname']) ?></h2>
                <h3><?= htmlspecialchars($faculty['department']) ?></h3>
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
        <?php endforeach; ?>
      <?php else: ?>
        <p class="text-danger">No Registered Faculty Found</p>
      <?php endif; ?>
    </div>
  </section>
</main>


<?php
include_once __DIR__ . '/../../components/footer.php';
include_once __DIR__ . '/../../components/footscript.php';
?>