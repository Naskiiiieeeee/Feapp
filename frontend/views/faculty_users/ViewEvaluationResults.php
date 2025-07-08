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

// Get paginated data and total pages
$facultyEvaluation = $vm->getPaginatedGroupBy($page_no, $limit);
$total_pages = $vm->getPages($limit);
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Faculty Evaluation Result</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>/frontend/views/dashboard">Dashboard</a></li>
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
                    <th>Faculty ID</th>
                    <th>Faculty Name</th>
                    <th>Department</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php if (!empty($facultyEvaluation)): ?>
                  <?php foreach ($facultyEvaluation as $row): ?>
                    <?php $token = base64_encode($row['faculty_token'] . '|' . $row['faculty_token']); ?>
                    <tr>
                      <td><?= $count++; ?></td>
                      <td class=""><?= htmlspecialchars($row['faculty_token']); ?></td>
                      <td class=""><?= htmlspecialchars($row['faculty_name']); ?></td>
                      <td class=""><?= htmlspecialchars($row['faculty_dep']); ?></td>
                      <td>
                        <a href="ViewUnitEval?token=<?= urlencode($token); ?>" title="View">
                          <div class="btn btn-secondary mt-1 px-1 btn-sm text-white"><i class="fa fa-eye mx-2"></i></div>
                        </a>
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

