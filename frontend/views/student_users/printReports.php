<?php
require_once __DIR__ . '/../../../backend/ViewModels/EvaluationSummaryViewModel.php';
include_once __DIR__ . '/../../components/header.php';
include_once __DIR__ . '/../../components/navigation.php';
include_once __DIR__ . '/../../components/sidebar.php';

$vm = new EvaluationSummaryViewModel();

$from = $_GET['from'] ?? '';
$to = $_GET['to'] ?? '';
$results = [];

if (!empty($from) && !empty($to)) {
    $results = $vm->getIndividualResponse($from, $to, $email);
}

?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Evaluation Summary</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Reports</li>
        <li class="breadcrumb-item active">Evaluation Summary</li>
      </ol>
    </nav>
  </div>

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <form class="row g-3 mt-3 mb-3" method="GET">
              <div class="col-md-5">
                <label>From</label>
                <input type="date" name="from" class="form-control" value="<?= htmlspecialchars($from) ?>" required>
              </div>
              <div class="col-md-5">
                <label>To</label>
                <input type="date" name="to" class="form-control" value="<?= htmlspecialchars($to) ?>" required>
              </div>
              <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100"><i class="bi bi-filter"></i> Filter</button>
              </div>
            </form>

            <?php if (!empty($results)): ?>
              <div class="d-flex justify-content-end mb-3">
                <a href="ExportEvaluationSummary.php?from=<?= urlencode($from) ?>&to=<?= urlencode($to) ?>&type=pdf" class="btn btn-danger btn-sm me-2"><i class="bi bi-filetype-pdf"></i> Export PDF</a>
              </div>
            <?php endif; ?>

            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Faculty ID</th>
                    <th>Faculty Fullname</th>
                    <th>Date Submitted</th>
                    <th>Department</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (empty($results)): ?>
                    <tr>
                      <td colspan="9" class="text-center">No records found.</td>
                    </tr>
                  <?php else: ?>
                    <?php foreach ($results as $i => $row):
                      ?>
                      <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= htmlspecialchars($row['faculty_token']) ?></td>
                        <td><?= htmlspecialchars($row['faculty_name']) ?></td>
                        <td><?= date('Y-m-d', strtotime($row['submitted_at'])) ?></td>
                        <td><?= htmlspecialchars($row['faculty_dep']) ?></td>
                      </tr>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
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