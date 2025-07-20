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
$facultyEvaluation = $vm->getPaginatedIndividualResultAdmin($page_no, $limit);
$total_pages = $vm->getFacultyEvaluationPagesAdmin($limit);
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Uploaded Faculty Evaluation Result</h1>
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
              <div class="mb-3">
                <input type="text" class="form-control" id="searchBox" placeholder="Search by Faculty ID, Fullname, Date Created">
              </div>
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Faculty ID</th>
                    <th>Faculty Name</th>
                    <th>Department</th>
                    <th>Date Posted</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php if (!empty($facultyEvaluation)): ?>
                  <?php foreach ($facultyEvaluation as $row): ?>
                    <?php $token = base64_encode($row['faculty_id'] . '|' . $row['faculty_id']); ?>
                    <tr>
                      <td><?= $count++; ?></td>
                      <td class="facultyID"><?= htmlspecialchars($row['faculty_id']); ?></td>
                      <td class="facultyName"><?= htmlspecialchars($row['faculty_name']); ?></td>
                      <td class="facultyDep"><?= htmlspecialchars($row['faculty_department']); ?></td>
                      <td class="dateCreate"><?= htmlspecialchars($row['created_at']); ?></td>
                      <td>
                        <a href="ViewEvaluationUnitHistory?token=<?= urlencode($token); ?>" title="View">
                          <div class="btn btn-secondary mt-1 px-1 btn-sm text-white"><i class="fa fa-eye mx-2"></i></div>
                        </a>
                        <button type="button"
                                class="btn btn-danger mt-1 px-1 btn-sm deleteuser"
                                id="<?= $row['id']; ?>"
                                data-name="<?= htmlspecialchars($row['faculty_name']); ?>"
                                title="Delete">
                          <i class="fas fa-trash mx-2" aria-hidden="true"></i>
                        </button>
                      </td>
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

<script>
  const BASE_URL = "<?= BASE_URL ?>";
  $(document).ready(function () {
    $(document).on('click', '.deleteuser', function () {
      var id = $(this).attr('id');
      var name = $(this).data('name') || "this user";

      const msg = new SpeechSynthesisUtterance(`Are you sure you want to delete ${name}?`);
      msg.lang = 'en-US';
      msg.pitch = 1;
      msg.rate = 1;
      speechSynthesis.speak(msg);

      setTimeout(() => {
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: BASE_URL + '/api/api.evaluation.php',
              type: 'POST',
              data: { deleteUser: id },
              success: function (data) {
                if (data.trim() === "success") {
                  Swal.fire({
                    title: 'Success',
                    icon: 'success',
                    text: 'Faculty Evaluation deleted successfully.',
                    showConfirmButton: false,
                    timer: 2000,
                  }).then(() => {
                    window.location.reload();
                  });
                } else {
                  Swal.fire("Error", "Failed to delete user", "error");
                }
              }
            });
          } else {
            Swal.fire("Cancelled", "Delete operation cancelled", "info");
          }
        });
      }, 500);
    });
  });

$(document).ready(function () {
  $('#searchBox').on('keyup', function () {
    let query = $(this).val();

    $.ajax({
      url: "<?= BASE_URL ?>/api/api.EvaluationSearch.php",
      type: "POST",
      data: {
        action: "search",
        keyword: query
      },
      success: function (response) {
        $('tbody').html(response);
      }
    });
  });
});


</script>
