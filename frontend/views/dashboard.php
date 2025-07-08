<?php 
require_once __DIR__ . '/../../backend/ViewModels/DashboardViewModel.php';
include_once __DIR__ . '/../components/header.php';
include_once __DIR__ . '/../components/navigation.php';
include_once __DIR__ . '/../components/sidebar.php';

$vm = new DashboardViewModel();
$totalStudent = null;
$totalFaculty = null;
$totalAdmin = null;

$totalStudent = $vm->getTotalStudent();
$totalFaculty = $vm->getTotalFaculty();
$totalAdmin = $vm->getTotalAdmins();

$studentResponses = $vm->getForEachStudentResponse();
$studentResponses = $studentResponses ?? [];

$StudentEmail = [];
$StudentEval = [];

foreach ($studentResponses as $row) {
    $StudentEmail[] = $row['student_email'];
    $StudentEval[] = (int)$row['total'];
}

// Faculty Rankings
$facultyRanking = $vm->getFacultyRankedScores();
$facultyNames = [];
$facultyScores = [];

foreach ($facultyRanking as $row) {
    $facultyNames[] = $row['fullname'];
    $facultyScores[] = (float)$row['average_score'];
}

?>
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Dashboard</h1>
  </div>
<!-- End Page Title -->
    <section class="section dashboard">
      <div class="row">
        <!-- Left side columns -->
                       
          <div class="col-lg-8">
              <?php 
                // if($role == "Admin"){ 
                ?>
              <div class="row">
                <!-- Sales Card -->
                  <div class="col-xxl-4 col-md-6">

                  </div>
                  <!-- End Sales Card -->
                <!-- Card Container -->
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Student Response for this semester<span>/Analytics</span></h5>
                      <div id="ResponseAnalytics" style="min-height: 400px;"></div>

                      <script>
                      document.addEventListener("DOMContentLoaded", () => {
                        const StudentEmail = <?php echo json_encode($StudentEmail); ?>;
                        const StudentEval = <?php echo json_encode($StudentEval); ?>;

                        new ApexCharts(document.querySelector("#ResponseAnalytics"), {
                          series: [{
                            name: "Student Evaluations",
                            data: StudentEval
                          }],
                          chart: {
                            type: 'bar',
                            height: 400
                          },
                          plotOptions: {
                            bar: {
                              borderRadius: 4,
                              horizontal: false,
                              distributed: true 
                            }
                          },
                          dataLabels: {
                            enabled: true
                          },
                          xaxis: {
                            categories: StudentEmail,
                            labels: {
                              show: false
                            },
                            title: {
                              text: ""
                            }
                          },
                          yaxis: {
                            title: {
                              text: "Evaluation Count"
                            }
                          },
                          tooltip: {
                            y: {
                              formatter: val => `${val} evaluation(s)`
                            }
                          },
                          legend: {
                            show: false 
                          },
                          colors: ['#80CBC4', '#B4EBE6', '#FFB433', '#FFA955', '#F75A5A', '#4DA1A9', '#1ABC9C', '#2E5077', '#347928']
                        }).render();
                      });
                      </script>

                    </div>
                  </div>
                </div>

                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Faculty Ranking for this semester <span>Evaluation Score</span></h5>
                      <div id="facultyRankingChart" style="min-height: 400px;"></div>

                      <script>
                        document.addEventListener("DOMContentLoaded", () => {
                          const facultyNames = <?php echo json_encode($facultyNames); ?>;
                          const facultyScores = <?php echo json_encode($facultyScores); ?>;

                          new ApexCharts(document.querySelector("#facultyRankingChart"), {
                            series: [{
                              name: "Avg Score",
                              data: facultyScores
                            }],
                            chart: {
                              type: 'bar',
                              height: 400
                            },
                            plotOptions: {
                              bar: {
                                borderRadius: 4,
                                horizontal: true,
                                distributed: true
                              }
                            },
                            dataLabels: {
                              enabled: true,
                              formatter: val => val.toFixed(2)
                            },
                            xaxis: {
                              categories: facultyNames,
                              title: {
                                text: "Faculty"
                              }
                            },
                            yaxis: {
                              title: {
                                text: "Average Evaluation Score"
                              },
                              min: 0,
                              max: 5
                            },
                            tooltip: {
                              y: {
                                formatter: val => `${val} / 5`
                              }
                            },
                            colors: ['#36A2EB', '#2ECC71', '#FFCE56', '#FF6384', '#8E44AD']
                          }).render();
                        });
                      </script>
                    </div>
                  </div>
                </div>
                
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Faculty Status for this semester<span> Evaluation Score</span></h5>
                        <div class="row">
                        <?php foreach ($facultyRanking as $i => $row): ?>
                          <div class="col-md-6 mb-4">
                            <div class="card text-center shadow-sm">
                              <div class="card-body">
                                <div id="facultyGauge<?= $i ?>" style="height: 250px;"></div>
                                <h6 class="mt-3"><?= htmlspecialchars($row['fullname']) ?></h6>
                              </div>
                            </div>
                          </div>

                          <script>
                            document.addEventListener("DOMContentLoaded", () => {
                              new ApexCharts(document.querySelector("#facultyGauge<?= $i ?>"), {
                                series: [<?= $row['average_score'] * 20 ?>],
                                chart: {
                                  height: 250,
                                  type: 'radialBar',
                                },
                                plotOptions: {
                                  radialBar: {
                                    hollow: {
                                      size: '60%',
                                    },
                                    dataLabels: {
                                      name: {
                                        show: true,
                                        fontSize: '14px',
                                        color: '#666',
                                        offsetY: -10,
                                        formatter: function () {
                                          return "Ratings";
                                        }
                                      },
                                      value: {
                                        fontSize: '22px',
                                        formatter: function () {
                                          return "<?= number_format($row['average_score'], 2) ?> / 5";
                                        }
                                      }
                                    }
                                  }
                                },
                                labels: ["Ratings"],
                                colors: ['#2ECC71']
                              }).render();
                            });
                          </script>
                        <?php endforeach; ?>
                        </div>

                    </div>
                  </div>
                </div>
                                
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Overall Faculty Semester Rankings<span> Evaluation Score</span></h5>
                      <div class="row">
                        <?php foreach ($facultyRanking as $i => $row): ?>
                          <?php
                            $facultyEmail = $row['email'];
                            $historicalData = $vm->historyRatings($facultyEmail);

                            // Prepare data
                            $dates = [];
                            $ratings = [];

                            foreach ($historicalData as $record) {
                                $dates[] = date("M Y", strtotime($record['created_at']));
                                $ratings[] = floatval($record['overall_rating']);
                            }

                            // Skip if no historical data
                            if (empty($dates)) continue;
                          ?>
                          <div class="col-md-6 mb-4">
                            <div class="card text-center shadow-sm">
                              <div class="card-body">
                                <h6 class="mb-2"><?= htmlspecialchars($row['fullname']) ?></h6>
                                <canvas id="facultyLineChart<?= $i ?>" height="200"></canvas>
                              </div>
                            </div>
                          </div>

                          <script>
                          document.addEventListener("DOMContentLoaded", () => {
                            new Chart(document.getElementById("facultyLineChart<?= $i ?>"), {
                              type: 'line',
                              data: {
                                labels: <?= json_encode($dates) ?>,
                                datasets: [{
                                  label: '<?= addslashes($row['fullname']) ?>',
                                  data: <?= json_encode($ratings) ?>,
                                  backgroundColor: 'rgba(46, 204, 113, 0.2)',
                                  borderColor: 'rgba(46, 204, 113, 1)',
                                  borderWidth: 2,
                                  fill: true,
                                  tension: 0.3,
                                  pointBackgroundColor: '#2ecc71'
                                }]
                              },
                              options: {
                                scales: {
                                  y: {
                                    beginAtZero: true,
                                    max: 5
                                  }
                                },
                                plugins: {
                                  legend: {
                                    display: true
                                  },
                                  tooltip: {
                                    callbacks: {
                                      label: function(ctx) {
                                        return ctx.dataset.label + ": " + ctx.formattedValue + " / 5.00";
                                      }
                                    }
                                  }
                                }
                              }
                            });
                          });
                          </script>
                        <?php endforeach; ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
        </div>
    <!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">
          <div class="card info-card sales-card">
            <div class="card-body">
              <h5 class="card-title">Number of <span>| Faculty</span></h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-people"></i>
                </div>
                <div class="ps-3">
                <?php 
                  if($totalFaculty):
                ?>
                  <h6 class="mb-0"> <?= htmlspecialchars($totalFaculty);?></h6>
                <?php else:?>
                  <h6 class="mb-0">No Registered Faculty</h6>
                <?php endif;?>
                  <span class="text-success small pt-1 fw-bold">Data Fetching</span> <span class="text-muted small pt-2 ps-1"></span>
                </div>
              </div>
            </div>
          </div>

          <div class="card info-card customers-card">
            <div class="card-body">
              <h5 class="card-title">Registered <span>| Student</span></h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-boxes"></i>
                </div>
                <div class="ps-3">
                  <?php 
                    if($totalStudent):
                  ?>
                    <h6 class="mb-0"> <?= htmlspecialchars($totalStudent);?></h6>
                  <?php else:?>
                    <h6 class="mb-0">No Registered Admin</h6>
                  <?php endif;?>
                  <span class="text-danger small pt-1 fw-bold">Data Fetching</span> <span class="text-muted small pt-2 ps-1"></span>
                </div>
              </div>
            </div>
          </div>

          <div class="card info-card revenue-card">
            <div class="card-body">
              <h5 class="card-title">Number of <span>| Administrators</span></h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-bookmarks"></i>
                </div>
                <div class="ps-3">
                  <?php 
                    if($totalAdmin):
                  ?>
                    <h6 class="mb-0"> <?= htmlspecialchars($totalAdmin);?></h6>
                  <?php else:?>
                    <h6 class="mb-0">No Registered Admin</h6>
                  <?php endif;?>
                  <span class="text-success small pt-1 fw-bold">Data Fetching</span> <span class="text-muted small pt-2 ps-1"></span>
                </div>
              </div>
            </div>
          </div>

          <div class="card info-card sales-card <?= $card_glow_class; ?>">
              <div class="card-body">
                  <h5 class="card-title text-center">Pending Download<span> | Request</span></h5>
                  <div class="d-flex align-items-center justify-content-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                          <i class="bi bi-cloud-arrow-down"></i>
                      </div>
                      <div class="ps-3">
                          <h6 class="mb-0">
                            <!-- <?= $user_total > 0 ? $user_total : 'No Pending Request'; ?> -->
                        </h6>
                        <span class="text-success small pt-1 fw-bold">Data Fetching</span> <span class="text-muted small pt-2 ps-1"></span>
                      </div>
                  </div>
              </div>
              <div class="card-footer bg-secondary-subtle">
                <a href="#" class="btn btn-sm btn-success text-white d-flex align-items-center justify-content-center"><i class="bi bi-eye mx-1"></i> View List</a>
              </div>
          </div>

          <div class="card">
                <div class="card-body pb-0">
                  <h5 class="card-title">Data Security<span>| News</span></h5>
                  <div class="news">
                      <div class="post-item clearfix">
                        <img src="../src/assets/img/prosec.jpg" alt="">
                        <h4><a href="#">Data Encryption</a></h4>
                        <p>Maintain security of the system through timely security updates, fixes, and patches to ensure data privacy and timely responses to threats. Maintain playbooks with guidelines for decommissioning. Establish standardized third-party governance and ensure that stakeholders meet the required standards and requirements.</p>
                      </div>
                      <div class="post-item clearfix">
                        <img src="../src/assets/img/prosales.png" alt="">
                        <h4><a href="#">Realtime Fetching</a></h4>
                        <p>Realtime fetching of results inevitably lead to greater profits. You need to increase your monthly sales volume, for example, to achieve greater profits. Profit margins are the most important barometer of a company's health, according to "Bloomberg Businessweek" online.</p>
                      </div>
                      <div class="post-item clearfix">
                        <img src="../src/assets/img/prostock.jpg" alt="">
                        <h4><a href="#">Data Storage</a></h4>
                        <p>Investment product is the umbrella term for all the stocks, bonds, options, derivatives and other financial instruments that people put money into in hopes of earning profits.</p>
                      </div>
                  </div>
              </div>
          </div>

        <!-- End News & Updates -->
      </div>
      </div>
    </section>
</main>


<?php 
include_once __DIR__ . '/../components/footer.php';
include_once __DIR__ . '/../components/footscript.php';
?>