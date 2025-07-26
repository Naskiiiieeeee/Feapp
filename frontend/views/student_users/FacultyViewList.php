<?php
require_once __DIR__ . '/../../../backend/ViewModels/UserFacultyViewModel.php';
include_once __DIR__ . '/../../components/header.php';
include_once __DIR__ . '/../../components/navigation.php';
include_once __DIR__ . '/../../components/sidebar.php';

$vm = new UserFacultyViewModel();
$facultyList = null;
$facultyList = $vm->getFacultyInfo();
$status = $vm->getIfStudentisActivated($email);
$groupedFaculty = [];
foreach ($facultyList as $faculty) {
    $dept = $faculty['department'];
    if (!isset($groupedFaculty[$dept])) {
        $groupedFaculty[$dept] = [];
    }
    $groupedFaculty[$dept][] = $faculty;
}
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

<?php if($status == 1):?>

<section class="section profile">
  <?php if (!empty($groupedFaculty)): ?>
    <?php foreach ($groupedFaculty as $department => $facultyMembers): ?>
      <div class="row mb-4">
        <div class="col-12">
          <h4 class="text-primary"><?= htmlspecialchars($department) ?></h4>
          <hr>
        </div>

        <?php foreach ($facultyMembers as $faculty): ?>
          <?php
            $facultyCode = $faculty['code'];
            $isEvaluated = $vm->getIfFacultyEvaluated($email, $facultyCode);
            $token = base64_encode($faculty['code'] . '|' . $faculty['code']); ?>
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
                <?php if($isEvaluated):?>
                  <span class="badge bg-success fs-7 rounded-5"><i class="bi bi-check-circle"></i> Completed</span>
                <?php else:?>
                <a href="submitEvaluation?token=<?= urlencode($token); ?>" title="View">
                  <div class="btn btn-info mt-1 px-1 btn-sm text-white">
                    <i class="bi bi-journal-text"></i> Submit Evaluation
                  </div>
                </a>
                <?php endif;?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p class="text-danger">No Registered Faculty Found</p>
  <?php endif; ?>
</section>

<?php else:?>

<section class="section profile">
  <div class="row mb-4">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-header bg-warning-subtle"></div>
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
            <h2><i class="bi bi-exclamation-circle"></i> Evaluation Not Set</h2>
            <p>Please wait for the system administrator to validate your evaluation module!</p>
            <div class="social-links mt-2">
            </div>
          </div>
          <div class="card-footer bg-warning-subtle">
          </div>
        </div>
      </div>
  </div>
</section>
<?php endif;?>

</main>


<?php
include_once __DIR__ . '/../../components/footer.php';
include_once __DIR__ . '/../../components/footscript.php';
?>