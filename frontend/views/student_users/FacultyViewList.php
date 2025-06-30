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
        <?php $token = base64_encode($faculty['code'] . '|' . $faculty['code']); ?>

          <div class="col-xl-4">
            <div class="card">
              <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                <img src="<?= BASE_URL ?>/<?= htmlspecialchars($faculty['photo']) ?>" alt="Profile" class="rounded-circle" width="150">
                <h2><?= htmlspecialchars($faculty['fullname']) ?></h2>
                <h3><?= htmlspecialchars($faculty['department']) ?></h3>
                <div class="social-links mt-2">
                  <a href="#" class="twitter"><i class="bi bi-file-earmark-bar-graph"></i></a>
                  <a href="#" class="facebook"><i class="bi bi-file-medical"></i></a>
                  <a href="#" class="google"><i class="bi bi-filetype-ai"></i></a>
                </div>
              </div>
              <div class="card-footer bg-primary-subtle">
                <a href="submitEvaluation?token=<?= urlencode($token); ?>" title="View">
                    <div class="btn btn-info mt-1 px-1 btn-sm text-white"><i class="bi bi-journal-text"></i> Submit Evaluation</div>
                </a>
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