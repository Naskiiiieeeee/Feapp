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
    <h1>System Settings</h1>
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
            <img src="<?= BASE_URL ?>/frontend/src/img/clientlogo.jpg" alt="Profile" class="rounded-circle" width="150">
            <h3 class="mt-2">ICTO</h3>
            <h3>College of Our Lady of Mercy</h3>
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
              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">History</button>
            </li>
            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Add New Schedule</button>
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
            <?php else: ?>
                <p class="text-danger">User information not found or invalid token.</p>
            <?php endif; ?>

            </div>

            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
              <form id="AddForm">
                <div class="row mb-3">
                  <label for="fullName" class="col-md-4 col-lg-3 col-form-label"><i class="bi bi-building-add"></i> Department</label>
                  <div class="col-md-8 col-lg-9">
                    <select name="" id="" class="form-control"></select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="about" class="col-md-4 col-lg-3 col-form-label"><i class="bi bi-calendar2-check"></i> Starting Date</label>
                  <div class="col-md-8 col-lg-9">
                    <input type="date" name="startDate" id="" class="form-control" required>
                  </div>
                </div>
                
                <div class="row mb-3">
                  <label for="about" class="col-md-4 col-lg-3 col-form-label"><i class="bi bi-calendar2-check-fill"></i> Ending Date</label>
                  <div class="col-md-8 col-lg-9">
                    <input type="date" name="endDate" id="" class="form-control" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Address" class="col-md-4 col-lg-3 col-form-label"><i class="bi bi-person-badge"></i> Upload By</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="adminAccount" type="text" class="form-control" value="<?= $email; ?>" readonly>
                  </div>
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary" name="btnSaveSched">Save Changes</button>
                </div>
              </form>
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

