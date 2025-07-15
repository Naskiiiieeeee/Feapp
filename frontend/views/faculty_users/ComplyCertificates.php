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

    <section class="section profile">
        <div class="row">
            <?php foreach($facultyData as $rec): ?>
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
                                <td>
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <li><?= htmlspecialchars(trim($item)) ?></li>
                                            <input type="checkbox" name="selectseminar" id="selectseminar">
                                        </div>
                                    </form>
                                </td>
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

    <section class="section">
        <div class="row">
            <form id="AddForm" method="post" enctype="multipart/form-data">
                <div class="row mb-3">
                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Certificate Soft-Copy</label>
                    <div class="col-md-8 col-lg-9">
                        <input type="file" name="certificate" class="form-control" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Certificate Name</label>
                    <div class="col-md-8 col-lg-9">
                        <input name="title" type="text" class="form-control" required>
                    </div>
                </div>
                
                <div class="text-center">
                    <button type="submit" class="btn btn-primary" name="btnSaveAdminProfile"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save User Information</button>
                </div>
            </form>
        </div>
    </section>
</main>
<?php
include_once __DIR__ . '/../../components/footer.php';
include_once __DIR__ . '/../../components/footscript.php';
?>
