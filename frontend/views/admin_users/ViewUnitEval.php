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
        $facultyData = $vm->getunitEvaluationResult($code);
    } else {
        echo '<script>alert("Invalid token!"); window.location="ViewFacultyEvalResult.php";</script>';
        exit;
    }
}
$firstRow = !empty($facultyData) ? $facultyData[0] : null;

$uniqueRecommendations = [];

if (!empty($facultyData)) {
    foreach ($facultyData as $row) {
        $rec = trim($row['ai_recommendation']);
        if (!empty($rec) && !in_array($rec, $uniqueRecommendations)) {
            $uniqueRecommendations[] = $rec;
        }
    }
}

$recommendationCount = [];
foreach ($facultyData as $row) {
    $rec = trim($row['ai_recommendation']);
    if (!empty($rec)) {
        $recommendationCount[$rec] = ($recommendationCount[$rec] ?? 0) + 1;
    }
}

?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Faculty Evaluation Overall Result</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="ManageViewUnitEvaluation">Unit Evaluation</a></li>
        <li class="breadcrumb-item active"><a href="ViewFacultyEvalResult">Individual Faculty Result</a></li>
      </ol>
    </nav>
  </div>

<section class="section profile">
  <div class="row">
    <div class="col-xl-4">
      <div class="card">
        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
        <?php if ($firstRow): ?>
            <img src="<?= BASE_URL ?>/<?= htmlspecialchars($firstRow['faculty_img']) ?>" alt="Profile" class="rounded-circle" width="150">
            <h2 id="FacultyName"><?= htmlspecialchars($firstRow['faculty_name']) ?></h2>
            <h3 id="FacultyID"><?= htmlspecialchars($firstRow['faculty_token']) ?></h3>
            <h3 id="FacultyDep"><?= htmlspecialchars($firstRow['faculty_dep']) ?></h3>
            <h3 id="FacultyEmail"><?= htmlspecialchars($firstRow['faculty_email']) ?></h3>
        <?php else: ?>
            <p class="text-danger">User not found or invalid token.</p>
        <?php endif; ?>
          <div class="social-links mt-2">
            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="google"><i class="bi bi-google"></i></a>
          </div>
        </div>
        <div class="card-footer bg-primary-subtle">

        </div>
      </div>
    </div>

    <div class="col-xl-8">
      <div class="card">
        <div class="card-body pt-3">
          <ul class="nav nav-tabs nav-tabs-bordered">
            <li class="nav-item">
              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">AI Recommendation</button>
            </li>
          </ul>
          <h5 class="card-title">Seminars And Training Programs</h5>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>FEAPP Recommendation</th>
                            <th>Mentions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($uniqueRecommendations as $rec): ?>
                            <?php $count = $recommendationCount[$rec] ?? 0; ?>
                            <tr>
                                <td class="AiRecommendations">* <?= htmlspecialchars($rec) ?></td>
                                <td><?= $count ?> mention<?= $count > 1 ? 's' : '' ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-primary-subtle">

        </div>
      </div>
    </div>

    <div class="col-xl-7">
        <div class="card">
            <div class="card-body pt-3">
                <ul class="nav nav-tabs nav-tabs-bordered">
                    <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Ratings</button>
                    </li>
                </ul>
                <div class="tab-content pt-2">
                    <div class="tab-pane fade show active profile-overview" id="profile-overview">
                    <h5 class="card-title">Faculty Evaluation Ratings</h5>
                    
                    <?php if (!empty($facultyData)): ?>
                        <?php
                        $academicTotal = 0;
                        $coreValuesTotal = 0;
                        $overallTotal = 0;
                        $count = count($facultyData);

                        foreach ($facultyData as $row) {
                            $academicTotal += floatval($row['academic_avg']);
                            $coreValuesTotal += floatval($row['core_values_avg']);
                            $overallTotal += floatval($row['overall_score']);
                        }

                        $academicAvg = $academicTotal / $count;
                        $coreValuesAvg = $coreValuesTotal / $count;
                        $overallAvg = $overallTotal / $count;

                        $overallRatings = ($academicAvg + $coreValuesAvg + $overallAvg) / 3;
                        ?>

                        <div class="row mb-2">
                            <div class="col-lg-4 col-md-4 label"><i class="bi bi-bar-chart"></i> Academic Rating:</div>
                            <div class="col-lg-8 col-md-8" id="AcadsRating"><?= number_format($academicAvg, 2) ?> / 5.00</div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-lg-4 col-md-4 label"><i class="bi bi-heart-pulse"></i> Core Values Rating:</div>
                            <div class="col-lg-8 col-md-8" id="CoreValuesRating"><?= number_format($coreValuesAvg, 2) ?> / 5.00</div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-lg-4 col-md-4 label"><i class="bi bi-award"></i> Overall Evaluation:</div>
                            <div class="col-lg-8 col-md-8" id="OverallEvaluation"><?= number_format($overallAvg, 2) ?> / 5.00</div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-lg-4 col-md-4 label"><i class="bi bi-star-half"></i> Overall Rating:</div>
                            <div class="col-lg-8 col-md-8" id="OverallRatings"><?= number_format($overallRatings, 2) ?> / 5.00</div>
                        </div>
                        

                    <?php else: ?>
                        <div class="text-center">No evaluation data found.</div>
                    <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-primary-subtle">
                <form id="postFacultyData">
                    <input type="text" name="FacultyName" class="form-control">
                    <input type="text" name="FacultyDep" class="form-control">
                    <input type="text" name="FacultyID" class="form-control">
                    <input type="text" name="FacultyEmail" class="form-control">
                    <input type="text" name="AiRecommendations[]" class="form-control">
                    <input type="text" name="FeedbacksStrengths[]" class="form-control">
                    <input type="text" name="FeedbackImprovements[]" class="form-control">
                    <input type="text" name="FeedbackComments[]" class="form-control">

                    <input type="text" name="AcadsRating" class="form-control">
                    <input type="text" name="CoreValuesRating" class="form-control">
                    <input type="text" name="OverallEvaluation" class="form-control">
                    <input type="text" name="OverallRatings" class="form-control">
                </form>
            </div>
        </div>
    </div>

    <div class="col-xl-5">
      <div class="card">
        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
          <?php if (!empty($facultyData)): ?>
          <?php
          $academicTotal = 0;
          $coreValuesTotal = 0;
          $overallTotal = 0;
          $count = count($facultyData);

          foreach ($facultyData as $row) {
              $academicTotal += floatval($row['academic_avg']);
              $coreValuesTotal += floatval($row['core_values_avg']);
              $overallTotal += floatval($row['overall_score']);
          }

          $academicAvg = $academicTotal / $count;
          $coreValuesAvg = $coreValuesTotal / $count;
          $overallAvg = $overallTotal / $count;

          $overallRatings = ($academicAvg + $coreValuesAvg + $overallAvg) / 3;
          ?>
          <canvas id="evaluationBarChart" width="400" height="300"></canvas>
          <?php else: ?>
              <div class="text-center">No evaluation data found.</div>
          <?php endif; ?>
        </div>
        <div class="card-footer bg-primary-subtle">

        </div>
      </div>
    </div>


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
                <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Strength</th>
                        <th>For Improvements</th>
                        <th>Open-Ended Feedback</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($facultyData)): ?>
                            <?php foreach ($facultyData as $row): ?>
                                <tr>
                                    <td class="FeedbacksStrengths"><?= htmlspecialchars($row['feedback_strengths']) ?></td>
                                    <td class="FeedbackImprovements"><?= htmlspecialchars($row['feedback_improvements']) ?></td>
                                    <td class="FeedbackComments"><?= htmlspecialchars($row['feedback_comments']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="3" class="text-center">No evaluation data found.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                </div>

            </div>
          </div>
        </div>
        <div class="card-footer bg-primary-subtle">

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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('evaluationBarChart').getContext('2d');

const evaluationChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Academic Avg', 'Core Values Avg', 'Overall Avg', 'Overall Rating'],
        datasets: [{
            label: 'Evaluation Scores',
            data: [
                <?= round($academicAvg, 2) ?>,
                <?= round($coreValuesAvg, 2) ?>,
                <?= round($overallAvg, 2) ?>,
                <?= round($overallRatings, 2) ?>
            ],
            backgroundColor: [
                'rgba(54, 162, 235, 0.7)',
                'rgba(255, 206, 86, 0.7)',
                'rgba(75, 192, 192, 0.7)',
                'rgba(153, 102, 255, 0.7)'
            ],
            borderColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                max: 5
            }
        }
    }
});
</script>
<script>

const BASE_URL = "<?= BASE_URL ?>";
$(document).ready(function () {
    $("[id]").each(function () {
        const id = $(this).attr("id");
        const text = $(this).text().trim();
        const input = $("input[name='" + id + "']");
        if (input.length > 0) {
            const numeric = text.split(" /")[0].trim(); // Remove " / 5.00"
            input.val(numeric);
        }
    });

    // Handle multiple AiRecommendations (array data)
    $(".AiRecommendations").each(function () {
        const value = $(this).text().replace("*", "").trim();
        $("<input>").attr({
            type: "hidden",
            name: "AiRecommendations[]",
            value: value
        }).appendTo("#postFacultyData");
    });

    $(".FeedbacksStrengths").each(function (){
        const value = $(this).text().trim();
        $("<input>").attr({
            type: "hidden",
            name: "FeedbacksStrengths[]",
            value: value
        }).appendTo("#postFacultyData");
    });

    
    $(".FeedbackImprovements").each(function (){
        const value = $(this).text().trim();
        $("<input>").attr({
            type: "hidden",
            name: "FeedbackImprovements[]",
            value: value
        }).appendTo("#postFacultyData");
    });

    
    $(".FeedbackComments").each(function (){
        const value = $(this).text().trim();
        $("<input>").attr({
            type: "hidden",
            name: "FeedbackComments[]",
            value: value
        }).appendTo("#postFacultyData");
    });

  $.ajax({
    url: BASE_URL + '/api/api.evaluation.php',
    type: 'POST',
    data: $("#postFacultyData").serialize(),
    contentType: false,
    processData: false,
    dataType: 'json',
    success: function (response) {
      if (response === "added") {
        Swal.fire({
          icon: 'success',
          title: 'Faculty Evaluation',
          text: 'Evaluation has been posted successfully!',
          timer: 2000,
          showConfirmButton: false
        }).then(() => {
          location.href = 'ViewFacultyEvalResult';
        });
      } else {
        Swal.fire('Error', 'Duplicate for this year evaluation', 'error');
      }
    },
    error: function () {
      Swal.fire('Error', 'Server error. Try again.', 'error');
    }
  });
});
</script>


<!-- <script>
$(document).ready(function () {
    // Loop through all elements with an ID
    $("[id]").each(function () {
        const id = $(this).attr("id");
        const text = $(this).text().trim();

        // Try to find a matching input with the same name
        const input = $("input[name='" + id + "']");
        if (input.length > 0) {
            const numeric = text.split(" /")[0].trim(); // Optional: clean value
            input.val(numeric);
        }
    });

    // Optional: Submit the form via AJAX
    $.ajax({
        url: 'your-handler.php', // Replace with actual handler
        method: 'POST',
        data: $("#postFacultyData").serialize(),
        success: function (response) {
            console.log("Server response:", response);
        },
        error: function () {
            console.error("AJAX error.");
        }
    });
});
</script> -->