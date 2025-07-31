<?php
require_once __DIR__ . '/../../../backend/ViewModels/CertificateViewModel.php';
include_once __DIR__ . '/../../components/header.php';
include_once __DIR__ . '/../../components/navigation.php';
include_once __DIR__ . '/../../components/sidebar.php';

$vm = new CertificateViewModel();
$certificateData = null;

if (isset($_GET['token'])) {
    $decoded = base64_decode($_GET['token']);
    list($code, $salt) = explode('|', $decoded);

    if ($code === $salt) {
        $certificateData = $vm->getcertificateByID($code);
    } else {
        echo '<script>alert("Invalid token!"); window.location="ManageAdminView.php";</script>';
        exit;
    }
}
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Certificate Information</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="ManageCertificates">Certificates</a></li>
      </ol>
    </nav>
  </div>

<section class="section profile">
  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-body pt-3">
          <ul class="nav nav-tabs nav-tabs-bordered">
            <li class="nav-item">
              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
            </li>
          </ul>
          <div class="tab-content pt-2">
            <div class="tab-pane fade show active profile-overview" id="profile-overview">

              <h5 class="card-title">Certificate Details</h5>
              <?php if ($certificateData): ?>

              <div class="row">
                <div class="col-lg-4 col-md-4 label"><i class="bi bi-upc-scan"></i> Certificate Title</div>
                <div class="col-lg-8 col-md-8"><?= $certificateData['seminar_title']; ?></div>
              </div>

              <div class="row">
                <div class="col-lg-4 col-md-4 label"><i class="bi bi-bezier"></i> FEAPP Recommendation</div>
                <div class="col-lg-8 col-md-8"><?= $certificateData['seminar_name']; ?></div>
              </div>
              
              <div class="row">
                <div class="col-lg-4 col-md-4 label"><i class="bi bi-envelope-at"></i> Faculty Email</div>
                <div class="col-lg-8 col-md-8"><?= $certificateData['faculty_email']; ?></div>
              </div>

              <div class="row">
                <div class="col-lg-4 col-md-4 label"><i class="bi bi-person-check"></i> Faculty Name</div>
                <div class="col-lg-8 col-md-8"><?= $certificateData['faculty_name']; ?></div>
              </div>

              <div class="row">
                <div class="col-lg-4 col-md-4 label"><i class="bi bi-calendar-check"></i> Date Uploaded</div>
                <div class="col-lg-8 col-md-8"><?= $certificateData['uploaded_at']; ?></div>
              </div>
            <?php else: ?>
                <p class="text-danger">Certificate information not found or invalid token.</p>
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
                <!-- <embed src="<?= BASE_URL ?>/<?= $certificateData['certificate_path'];?>" type="application/pdf" style="width: 100%; height: 100%; border: none;"> -->
                 <iframe 
                    src="<?= BASE_URL ?>/<?= $certificateData['certificate_path'];?>" 
                    style="width: 100%; height: 70vh; border: none;" 
                    frameborder="0">
                </iframe>
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