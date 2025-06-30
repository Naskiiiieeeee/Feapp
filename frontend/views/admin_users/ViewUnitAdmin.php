<?php
require_once __DIR__ . '/../../../backend/ViewModels/UserAdminViewModel.php';
include_once __DIR__ . '/../../components/header.php';
include_once __DIR__ . '/../../components/navigation.php';
include_once __DIR__ . '/../../components/sidebar.php';

// Pagination setup
$vm = new UserAdminViewModel();
$page_no = isset($_GET['page_no']) && $_GET['page_no'] !== "" ? (int)$_GET['page_no'] : 1;
$limit = 4;
$count = ($page_no - 1) * $limit + 1;

// Get paginated data and total pages
$adminUsers = $vm->getPaginatedAdmins($page_no, $limit);
$total_pages = $vm->getTotalPages($limit);
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
        <?php
            if (isset($_GET['token'])) {
              $decoded = base64_decode($_GET['token']);
              list($code, $salt) = explode('|', $decoded);
              if ($salt === $code) {
                $sql = "SELECT * FROM `endusers` WHERE `code` = '$code' ";
                $result = mysqli_query($con,$sql);
                while($row = mysqli_fetch_array($result)){
              ?>
          <img src="./src/img/logo.png" alt="Profile" class="rounded-circle">
          <h2><?= $row['deviceName']; ?></h2>
          <h3><?= $so->decrypt($row['deviceType']); ?></h3>
          <?php
                }} else {
                  echo '<script> alert("Invalid Token!"); window.location="manageuser"; </script>';
              }
          } ?>
          <div class="social-links mt-2">
            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="google"><i class="bi bi-google"></i></a>
          </div>
        </div>
        <div class="card-footer bg-secondary">

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
              <?php
              if (isset($_GET['token'])) {
                $decoded = base64_decode($_GET['token']);
                list($candCode, $salt) = explode('|', $decoded);
                if ($salt === $candCode) {
                  $sql = "SELECT * FROM `endusers` WHERE `code` = '$code' ";
                  $result = mysqli_query($con,$sql);
                  while($row = mysqli_fetch_array($result)){
              ?>

              <h5 class="card-title">Devices Details</h5>

              <div class="row">
                <div class="col-lg-4 col-md-4 label"><i class="bi bi-upc-scan"></i> Device Name</div>
                <div class="col-lg-8 col-md-8"><?= $row['deviceName']; ?></div>
              </div>

              <div class="row">
                <div class="col-lg-4 col-md-4 label"><i class="bi bi-telephone"></i> Phone Number</div>
                <div class="col-lg-8 col-md-8"><?= $so->decrypt($row['pnumber']); ?></div>
              </div>

              <div class="row">
                <div class="col-lg-4 col-md-4 label"><i class="bi bi-clipboard-data"></i> Remote IP</div>
                <div class="col-lg-8 col-md-8"><?= $so->decrypt($row['ip_address']); ?></div>
              </div>

              <div class="row">
                <div class="col-lg-4 col-md-4 label"><i class="bi bi-braces-asterisk"></i> Browser</div>
                <div class="col-lg-8 col-md-8"><?= $so->decrypt($row['browser']); ?></div>
              </div>

              <div class="row">
                <div class="col-lg-4 col-md-4 label"><i class="bi bi-cpu"></i> Operating System</div>
                <div class="col-lg-8 col-md-8"><?= $so->decrypt($row['os']); ?></div>
              </div>

              <div class="row">
                <div class="col-lg-4 col-md-4 label"><i class="bi bi-motherboard"></i> Device Type</div>
                <div class="col-lg-8 col-md-8"><?= $so->decrypt($row['deviceType']); ?></div>
              </div>

              <div class="row">
                <div class="col-lg-4 col-md-4 label"><i class="bi bi-geo-alt"></i> Latitude</div>
                <div class="col-lg-8 col-md-8"><?= $so->decrypt($row['latitude']); ?></div>
              </div>

              <div class="row">
                <div class="col-lg-4 col-md-4 label"><i class="bi bi-geo-alt-fill"></i> Longitude</div>
                <div class="col-lg-8 col-md-8"><?= $so->decrypt($row['longitude']); ?></div>
              </div>

                            <div class="row">
                <div class="col-lg-4 col-md-4 label"><i class="bi bi-crosshair"></i> City</div>
                <div class="col-lg-8 col-md-8"><?= $so->decrypt($row['city']); ?></div>
              </div>

              <div class="row">
                <div class="col-lg-4 col-md-4 label"><i class="bi bi-geo"></i> Region</div>
                <div class="col-lg-8 col-md-8"><?= $so->decrypt($row['region']); ?></div>
              </div>

              <div class="row">
                <div class="col-lg-4 col-md-4 label"><i class="bi bi-pin-map"></i> Country</div>
                <div class="col-lg-8 col-md-8"><?= $so->decrypt($row['country']); ?></div>
              </div>

              <div class="row">
                <div class="col-lg-4 col-md-4 label"><i class="bi bi-universal-access-circle"></i> Access Status</div>
                <div class="col-lg-8 col-md-8">
                    <?php
                      if($row['status'] == 1){
                        echo '<span class="badge bg-success fs-6"><i class="bi bi-check-circle"></i> Activated</span>';
                      }elseif($row['status'] == 2){
                        echo '<span class="badge bg-danger fs-6"><i class="bi bi-x-circle"></i> Restricted</span>';
                      }elseif($row['status'] == 0){
                         echo '<span class="badge bg-warning fs-6"><i class="bi bi-exclamation-circle"></i> Pending</span>';
                      }else{
                        echo '<span class="badge bg-secondary text-white fs-6"><i class="bi bi-recycle"></i> Archieved</span>';
                      }
                    ?>
                </div>
              </div>
              <?php
                  }} else {
                    echo '<script> alert("Invalid Token!"); window.location="manageuser.php"; </script>';
                }
              }
              ?>
            </div>
          </div>
        </div>
        <div class="card-footer bg-secondary">

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