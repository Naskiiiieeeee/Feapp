<?php
require_once __DIR__ . '/../../backend/ViewModels/UserViewModel.php';
include_once __DIR__ . '/../components/header.php';
include_once __DIR__ . '/../components/navigation.php';
include_once __DIR__ . '/../components/sidebar.php';

$vm = new UserViewModel();
$ProfileData = null;
$ProfileData = $vm->getUserEmail($email);
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Profile Information</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>/frontend/views/dashboard">Back to Dashboard</a></li>
      </ol>
    </nav>
  </div>

<section class="section profile">
  <div class="row">
    <div class="col-xl-4">
      <div class="card">
        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
        <?php if ($ProfileData): ?>
            <img src="<?= BASE_URL ?>/<?= htmlspecialchars($ProfileData['photo']) ?>" alt="Profile" class="rounded-circle" width="150">
            <h2><?= htmlspecialchars($ProfileData['fullname']) ?></h2>
            <h3><?= htmlspecialchars($ProfileData['department']) ?></h3>
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
              <?php if ($ProfileData): ?>

              <div class="row">
                <div class="col-lg-4 col-md-4 label"><i class="bi bi-upc-scan"></i> Fullname</div>
                <div class="col-lg-8 col-md-8"><?= $ProfileData['fullname']; ?></div>
              </div>

              <div class="row">
                <div class="col-lg-4 col-md-4 label"><i class="bi bi-envelope-at"></i> Email</div>
                <div class="col-lg-8 col-md-8"><?= $ProfileData['email']; ?></div>
              </div>
              
              <div class="row">
                <div class="col-lg-4 col-md-4 label"><i class="bi bi-building-fill-lock"></i> Department</div>
                <div class="col-lg-8 col-md-8"><?= $ProfileData['department']; ?></div>
              </div>

              <div class="row">
                <div class="col-lg-4 col-md-4 label"><i class="bi bi-calendar-check"></i> Registration Date</div>
                <div class="col-lg-8 col-md-8"><?= $ProfileData['date_created']; ?></div>
              </div>

              <div class="row">
                <div class="col-lg-4 col-md-4 label"><i class="bi bi-person-rolodex"></i> Role</div>
                <div class="col-lg-8 col-md-8"><?= $ProfileData['role']; ?></div>
              </div>

                <div class="row">
                    <div class="col-lg-4 col-md-4 label"><i class="bi bi-universal-access-circle"></i> Access Status</div>
                    <div class="col-lg-8 col-md-8">
                        <?php
                            switch ($ProfileData['status']) {
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
include_once __DIR__ . '/../components/footer.php';
include_once __DIR__ . '/../components/footscript.php';
?>