<?php
require_once __DIR__ . '/../../../backend/ViewModels/EvaluationViewModel.php';
include_once __DIR__ . '/../../components/header.php';
include_once __DIR__ . '/../../components/navigation.php';
include_once __DIR__ . '/../../components/sidebar.php';

// Pagination setup
$vm = new EvaluationViewModel();
$page_no = isset($_GET['page_no']) && $_GET['page_no'] !== "" ? (int)$_GET['page_no'] : 1;
$limit = 4;
$count = ($page_no - 1) * $limit + 1;

$studentView = $vm->getPaginatedEvaluatedFaculty($page_no, $limit, $email);
$total_pages = $vm->getTotalPages($limit, $email);

?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>View Evaluated Faculties</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboardstudent">Dashboard</a></li>
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
                    <th>Faculty Code</th>
                    <th>Faculty Fullname</th>
                    <th>Date Submitted</th>
                  </tr>
                </thead>
                <tbody>
                <?php if (!empty($studentView)): ?>
                  <?php foreach ($studentView as $row): ?>
                    <tr>
                      <td><?= $count++; ?></td>
                      <td class=""><?= htmlspecialchars($row['faculty_token']); ?></td>
                      <td class=""><?= htmlspecialchars($row['faculty_name']); ?></td>
                      <td class=""><?= htmlspecialchars($row['submitted_at']); ?></td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr class="text-center"><td colspan="4">No Registered Data!</td></tr>
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