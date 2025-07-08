<?php
require_once __DIR__ . '/../../../backend/ViewModels/EvaluationViewModel.php';
include_once __DIR__ . '/../../components/header.php';
include_once __DIR__ . '/../../components/navigation.php';
include_once __DIR__ . '/../../components/sidebar.php';

// Pagination setup
$vm = new EvaluationViewModel();
$page_no = isset($_GET['page_no']) && $_GET['page_no'] !== "" ? (int)$_GET['page_no'] : 1;
$limit = 10;
$count = ($page_no - 1) * $limit + 1;

// Get paginated data and total pages
$facultyEvaluation = $vm->getPaginatedOverallFaculty($page_no, $limit);
$total_pages = $vm->getPages($limit);
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Unit Faculty Evaluation</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="ManageViewUnitEvaluation">Unit Evaluation</a></li>
        <li class="breadcrumb-item active"><a href="ViewFacultyEvalResult">Individual Faculty Result</a></li>
        <li class="breadcrumb-item active"><a href="ManageValidatedResponse">Uploaded Evaluation History</a></li>
      </ol>
    </nav>
  </div>

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Recent Records</h5>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Student Email</th>
                    <th>Faculty ID</th>
                    <th>Faculty Name</th>
                    <th>Academic Avg</th>
                    <th>Core Values Avg</th>
                    <th>Overall Evaluation</th>
                  </tr>
                </thead>
                <tbody>
                <?php if (!empty($facultyEvaluation)): ?>
                  <?php foreach ($facultyEvaluation as $row): ?>
                    <tr>
                      <td><?= $count++; ?></td>
                      <td class=""><?= htmlspecialchars($row['student_email']); ?></td>
                      <td class=""><?= htmlspecialchars($row['faculty_token']); ?></td>
                      <td class=""><?= htmlspecialchars($row['faculty_name']); ?></td>
                      <td class=""><span class="badge bg-success fs-6"><?= htmlspecialchars($row['academic_avg']); ?></span></td>
                      <td class=""><span class="badge bg-success fs-6"><?= htmlspecialchars($row['core_values_avg']); ?></span></td>
                      <td class=""><span class="badge bg-success fs-6"><?= htmlspecialchars($row['overall_score']); ?></span></td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr class="text-center"><td colspan="8">No Registered Data!</td></tr>
                <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>

          <div class="card-footer bg-bg-info-subtle d-flex align-items-center justify-content-between">
            <button id="deleteAllResponsesBtn" class="btn btn-danger">
              <i class="bi bi-trash"></i> Delete All Responses
            </button>
            <nav aria-label="Page navigation">
              <ul class="pagination justify-content-center fw-bold">
                <li class="page-item <?= ($page_no <= 1) ? 'disabled' : ''; ?>">
                  <a class="page-link" href="?page_no=1">First</a>
                </li>
                <li class="page-item <?= ($page_no <= 1) ? 'disabled' : ''; ?>">
                  <a class="page-link" href="<?= ($page_no <= 1) ? '#' : '?page_no=' . ($page_no - 1); ?>">Prev</a>
                </li>
                <li class="page-item <?= ($page_no >= $total_pages) ? 'disabled' : ''; ?>">
                  <a class="page-link" href="<?= ($page_no >= $total_pages) ? '#' : '?page_no=' . ($page_no + 1); ?>">Next</a>
                </li>
                <li class="page-item <?= ($page_no >= $total_pages) ? 'disabled' : ''; ?>">
                  <a class="page-link" href="?page_no=<?= $total_pages; ?>">Last</a>
                </li>
              </ul>
            </nav>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
const BASE_URL = "<?= BASE_URL ?>";

document.getElementById("deleteAllResponsesBtn").addEventListener("click", function () {
  Swal.fire({
    title: 'Are you sure?',
    text: "This will delete ALL student responses permanently!",
    icon: 'warning',
    input: 'password',
    inputLabel: 'Enter your admin password to confirm',
    inputPlaceholder: 'Enter password...',
    showCancelButton: true,
    confirmButtonText: 'Yes, delete all!',
    preConfirm: (password) => {
      if (!password) {
        Swal.showValidationMessage('Password is required');
        return false;
      }

      return fetch(BASE_URL + "/api/api.deleteAllResponses.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify({ password })
      })
      .then(response => response.json())
      .catch(() => {
        Swal.showValidationMessage("Request failed");
      });
    }
  }).then(result => {
    if (result.isConfirmed && result.value && result.value.status === 'success') {
      Swal.fire('Deleted!', result.value.message, 'success').then(() => {
        location.reload(); 
      });
    } else if (result.value && result.value.status === 'error') {
      Swal.fire('Error', result.value.message, 'error');
    }
  });
});
</script>

