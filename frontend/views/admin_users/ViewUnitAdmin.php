<?php
require_once __DIR__ . '/../../../backend/ViewModels/UserAdminViewModel.php';
include_once __DIR__ . '/../../components/header.php';
include_once __DIR__ . '/../../components/navigation.php';
include_once __DIR__ . '/../../components/sidebar.php';

$vm = new UserAdminViewModel();
$adminData = null;

if (isset($_GET['token'])) {
    $decoded = base64_decode($_GET['token']);
    list($code, $salt) = explode('|', $decoded);

    if ($code === $salt) {
        $adminData = $vm->getAdminByCode($code);
    } else {
        echo '<script>alert("Invalid token!"); window.location="ManageAdminView.php";</script>';
        exit;
    }
}
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Administrator Profile</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="ManageAdminView">Manage Users</a></li>
        <li class="breadcrumb-item active"><a href="AddNewAdminUser">Add New Admin User</a></li>
      </ol>
    </nav>
  </div>

<section class="section profile">
  <div class="row">
    <div class="col-xl-4">
      <div class="card">
        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
        <?php if ($adminData): ?>
            <img src="<?= BASE_URL ?>/<?= htmlspecialchars($adminData['photo']) ?>" alt="Profile" class="rounded-circle" width="150">
            <h2><?= htmlspecialchars($adminData['fullname']) ?></h2>
            <h3><?= htmlspecialchars($adminData['department']) ?></h3>
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
              <?php if ($adminData): ?>

              <div class="row">
                <div class="col-lg-4 col-md-4 label"><i class="bi bi-upc-scan"></i> Fullname</div>
                <div class="col-lg-8 col-md-8"><?= $adminData['fullname']; ?></div>
              </div>

              <div class="row">
                <div class="col-lg-4 col-md-4 label"><i class="bi bi-envelope-at"></i> Email</div>
                <div class="col-lg-8 col-md-8"><?= $adminData['email']; ?></div>
              </div>
              
              <div class="row">
                <div class="col-lg-4 col-md-4 label"><i class="bi bi-building-fill-lock"></i> Department</div>
                <div class="col-lg-8 col-md-8"><?= $adminData['department']; ?></div>
              </div>

              <div class="row">
                <div class="col-lg-4 col-md-4 label"><i class="bi bi-calendar-check"></i> Registration Date</div>
                <div class="col-lg-8 col-md-8"><?= $adminData['date_created']; ?></div>
              </div>

              <div class="row">
                <div class="col-lg-4 col-md-4 label"><i class="bi bi-person-rolodex"></i> Role</div>
                <div class="col-lg-8 col-md-8"><?= $adminData['role']; ?></div>
              </div>

                <div class="row">
                    <div class="col-lg-4 col-md-4 label"><i class="bi bi-universal-access-circle"></i> Access Status</div>
                    <div class="col-lg-8 col-md-8">
                        <?php
                            switch ($adminData['status']) {
                                case 1:
                                    echo '<span class="badge bg-success fs-6"><i class="bi bi-check-circle"></i> Verified</span>';
                                    break;
                                case 2:
                                    echo '<span class="badge bg-danger fs-6"><i class="bi bi-x-circle"></i> Restricted</span>';
                                    break;
                                case 0:
                                    echo '<span class="badge bg-warning fs-6"><i class="bi bi-exclamation-circle"></i> Pending</span>';
                                    break;
                                default:
                                    echo '<span class="badge bg-secondary fs-6"><i class="bi bi-recycle"></i> Archived</span>';
                                    break;
                            }
                        ?>
                    </div>
                </div>
            <?php else: ?>
                <p class="text-danger">User not found or invalid token.</p>
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

<!-- Delete Button Logic -->
<script>
  const BASE_URL = "<?= BASE_URL ?>";
$('#updateForm').submit(function(e){
  e.preventDefault();

  var formData = new FormData(this);
  formData.append("btnUpdateAccess", true); 

  $.ajax({
    url: BASE_URL + '/api/api.adminuser.php',
    type: 'POST',
    data: formData,
    contentType: false,       
    processData: false,        
    dataType: 'json',
    success(data) {
      if (data === "updated") {
        Swal.fire({
          icon: 'success',
          title: 'Admin Updated',
          text: 'Admin information successfully updated!',
          timer: 2000,
          showConfirmButton: false
        }).then(() => {
          $('#verifyModal').modal('hide');
          location.reload();
        });
      } else {
        Swal.fire('Error', 'Failed to update', "error");
      }
    },
    error() {
      Swal.fire('Error', 'Server error. Try again.', "error");
    }
  });
});

</script>