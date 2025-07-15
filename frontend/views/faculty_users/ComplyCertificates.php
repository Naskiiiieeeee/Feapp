<?php
require_once __DIR__ . '/../../../backend/ViewModels/EvaluationViewModel.php';
include_once __DIR__ . '/../../components/header.php';
include_once __DIR__ . '/../../components/navigation.php';
include_once __DIR__ . '/../../components/sidebar.php';

$vm = new EvaluationViewModel();

$facultyData = null;
if (isset($_GET['token'])) {
    $decoded = base64_decode($_GET['token']);
    list($code, $salt) = explode('|', $decoded);

    if ($code === $salt) {
        $facultyData = $vm->fetchIndividualFacultyRecommendations($code);
    } else {
        echo '<script>alert("Invalid token!"); window.location="ViewRecommendation";</script>';
        exit;
    }
}
?>
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Add New Seminars Certificate</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="ViewRecommendation">View Recommendations</a></li>
      </ol>
    </nav>
  </div>

  <form id="myForm" enctype="multipart/form-data">
    <section class="section profile">
      <div class="row">
        <div>
            <input type="hidden" name="faculty_email" value="<?= $email;?>">
            <input type="hidden" name="fullname" value="<?= $fullname;?>">
            <input type="hidden" name="CertificateID" value="<?= $code;?>">
        </div>
        <?php if (is_array($facultyData) && count($facultyData) > 0): ?>
          <?php foreach ($facultyData as $rec): ?>
            <?php $recommendations = explode(',', $rec['ai_recommendations']); ?>
            <div class="col-xl-12">
              <div class="card">
                <div class="card-body pt-3">
                  <ul class="nav nav-tabs nav-tabs-bordered">
                    <li class="nav-item">
                      <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">
                        AI Recommendation
                      </button>
                    </li>
                  </ul>
                  <h5 class="card-title">Seminars And Training Programs</h5>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr><th>FEAPP Recommendations</th></tr>
                      </thead>
                      <tbody>
                        <?php foreach ($recommendations as $index => $item): ?>
                        <tr>
                          <td>
                            <div class="form-group">
                              <li><?= htmlspecialchars(trim($item)) ?></li>
                              <input type="checkbox" name="selected[<?= $index ?>]" id="seminarCheck<?= $index ?>" class="float-end mb-3 mt-0" onchange="toggleUploadForm(<?= $index ?>)">
                            </div>

                            <div id="uploadForm<?= $index ?>" class="mt-3" style="display: none;">
                              <div class="row mb-2">

                                <div class="col-lg-6">
                                  <label>Certificate File</label>
                                  <input type="file" name="certificate[<?= $index ?>]" class="form-control">
                                </div>
                                <div class="col-lg-6">
                                  <label>Certificate Title</label>
                                  <input type="text" name="title[<?= $index ?>]" class="form-control">
                                </div>
                                <input type="hidden" name="seminar_text[<?= $index ?>]" value="<?= htmlspecialchars(trim($item)) ?>">
                              </div>
                            </div>
                          </td>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>

                    <?php if ($rec['status'] == 0): ?>
                      <span class="badge bg-warning fs-6"><i class="bi bi-exclamation-circle"></i> Pending</span>
                    <?php else: ?>
                      <span class="badge bg-success fs-6"><i class="bi bi-check-circle"></i> Completed</span>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="card-footer bg-primary-subtle">
                  <strong><?= htmlspecialchars($rec['created_at']); ?></strong>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div class="alert alert-warning">No faculty data found or invalid token.</div>
        <?php endif; ?>
      </div>
      <div class="text-center mt-4">
        <button type="submit" class="btn btn-primary" id="btnSaveCertificates">
          <i class="fa fa-floppy-o" aria-hidden="true"></i> Upload All Selected Certificates
        </button>
      </div>
    </section>
  </form>
</main>

<?php
include_once __DIR__ . '/../../components/footer.php';
include_once __DIR__ . '/../../components/footscript.php';
?>

<!-- SweetAlert2 and Toggle Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

const BASE_URL = "<?= BASE_URL ?>";

function toggleUploadForm(index) {
  const checkbox = document.getElementById('seminarCheck' + index);
  const form = document.getElementById('uploadForm' + index);
  form.style.display = checkbox.checked ? 'block' : 'none';
}

document.getElementById('btnSaveCertificates').addEventListener('click', function (e) {
  e.preventDefault();

  const form = document.getElementById('myForm');
  const checkboxes = form.querySelectorAll('input[type="checkbox"][name^="selected"]');

  let hasChecked = false;
  let allValid = true;
  let missingIndex = null;

  checkboxes.forEach((checkbox, index) => {
    if (checkbox.checked) {
      hasChecked = true;

      const certInput = form.querySelector(`input[name="certificate[${index}]"]`);
      const titleInput = form.querySelector(`input[name="title[${index}]"]`);

      if (!certInput || !certInput.files.length || !titleInput || !titleInput.value.trim()) {
        allValid = false;
        missingIndex = index;
      }
    }
  });

  if (!hasChecked) {
    Swal.fire('Oops!', 'Please select at least one seminar to upload a certificate.', 'warning');
    return;
  }

  if (!allValid) {
    Swal.fire('Incomplete Fields', `Please fill out both the certificate and title for selected seminar #${missingIndex + 1}.`, 'error');
    return;
  }

  Swal.fire({
    title: 'Are you sure you want to submit?',
    text: 'Make sure all fields are complete.',
    icon: 'question',
    showCancelButton: true,
    confirmButtonText: 'Yes, submit!',
    cancelButtonText: 'Cancel'
  }).then((result) => {
    if (result.isConfirmed) {
      const formData = new FormData(form);

      fetch( BASE_URL + '/api/api.certificates.php', {
        method: 'POST',
        body: formData
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          Swal.fire('Uploaded!', data.message, 'success').then(() => {
            location.reload();
          });
        } else {
          Swal.fire('Upload Failed', data.message, 'error');
        }
      })
      .catch(err => {
        Swal.fire('Oops!', 'Something went wrong.', 'error');
        console.error(err);
      });
    }
  });
});
</script>

