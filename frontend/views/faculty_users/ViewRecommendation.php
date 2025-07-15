<?php
require_once __DIR__ . '/../../../backend/ViewModels/EvaluationViewModel.php';
include_once __DIR__ . '/../../components/header.php';
include_once __DIR__ . '/../../components/navigation.php';
include_once __DIR__ . '/../../components/sidebar.php';

$vm = new EvaluationViewModel();
$facultyRecommendationResults = $vm->fetchAllRecommendationsByEmail($email);
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>FEAPP Recommendations</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="ViewEvaluationResults">Back</a></li>
      </ol>
    </nav>
  </div>

  <section class="section profile">
    <div class="row">
      <?php foreach ($facultyRecommendationResults as $rec): ?>
        <?php
          $recommendations = explode(',', $rec['ai_recommendations']);
        ?>
        <div class="col-xl-6">
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
                    <tr>
                      <th>FEAPP Recommendations</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($recommendations as $item): ?>
                      <tr>
                        <td><li><?= htmlspecialchars(trim($item)) ?></li></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
                    <?php if($rec['status'] == 0):?>
                        <span class="badge bg-warning fs-6"><i class="bi bi-exclamation-circle"></i> Pending</span>
                    <?php else:?>
                         <span class="badge bg-success fs-6"><i class="bi bi-check-circle"></i> Completed</span>
                    <?php endif;?>
              </div>
            </div>
            <div class="card-footer bg-primary-subtle">
              <strong><?= htmlspecialchars($rec['created_at']); ?></strong>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </section>
</main>

<?php
include_once __DIR__ . '/../../components/footer.php';
include_once __DIR__ . '/../../components/footscript.php';
?>
