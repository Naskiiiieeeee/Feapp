<?php
require_once __DIR__ . '/../../../backend/ViewModels/UserFacultyViewModel.php';
include_once __DIR__ . '/../../components/header.php';
include_once __DIR__ . '/../../components/navigation.php';
include_once __DIR__ . '/../../components/sidebar.php';

$vm = new UserFacultyViewModel();
$facultyData = null;

if (isset($_GET['token'])) {
    $decoded = base64_decode($_GET['token']);
    list($code, $salt) = explode('|', $decoded);

    if ($code === $salt) {
        $facultyData = $vm->getFacultyByCode($code);
    } else {
        echo '<script>alert("Invalid token!"); window.location="ManageAdminView.php";</script>';
        exit;
    }
}
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Faculty Profile</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="ManageFacultyView">Manage Faculty</a></li>
        <li class="breadcrumb-item active"><a href="AddNewFacultyUser">Add New Faculty User</a></li>
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
                <div class="col-lg-4 col-md-4 label"><i class="bi bi-envelope-at"></i> Email</div>
                <div class="col-lg-8 col-md-8"><?= $facultyData['email']; ?></div>
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

                <div class="row">
                    <div class="col-lg-4 col-md-4 label"><i class="bi bi-universal-access-circle"></i> Access Status</div>
                    <div class="col-lg-8 col-md-8">
                        <?php
                            switch ($facultyData['status']) {
                                case 1:
                                    echo '<span class="badge bg-success fs-7 rounded-5"><i class="bi bi-check-circle"></i> Verified</span>';
                                    break;
                                case 2:
                                    echo '<span class="badge bg-danger fs-7 rounded-5"><i class="bi bi-x-circle"></i> Restricted</span>';
                                    break;
                                case 0:
                                    echo '<span class="badge bg-warning fs-7 rounded-5"><i class="bi bi-exclamation-circle"></i> Pending</span>';
                                    break;
                                default:
                                    echo '<span class="badge bg-secondary fs-7 rounded-5"><i class="bi bi-recycle"></i> Archived</span>';
                                    break;
                            }
                        ?>
                    </div>
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
  </div>
</section>

</main>

<?php
include_once __DIR__ . '/../../components/footer.php';
include_once __DIR__ . '/../../components/footscript.php';
?>