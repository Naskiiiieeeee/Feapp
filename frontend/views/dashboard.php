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
                  <div class="col-xxl-4 col-md-12">
                      <?php
                    //   $date = date('Y-m-d');
                    //   $dash_user = "SELECT * FROM `request_download` WHERE `status` = 0 AND `date` = '$date'";
                    //   $dash_users = mysqli_query($con, $dash_user);
                    //   $user_total = 0; 
                    //   if ($dash_users) {
                    //       $user_total = mysqli_num_rows($dash_users);
                    //   }

                    //   $card_glow_class = ''; 
                    //   if ($user_total > 0) {
                    //       $card_glow_class = ' pending-glow-card'; 
                    //   }
                      ?>
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
                            <a href="adminmanagerequest" class="btn btn-sm btn-success text-white d-flex align-items-center justify-content-center"><i class="bi bi-eye mx-1"></i> View List</a>
                          </div>
                      </div>
                  </div>

                  <div class="col-xxl-4 col-md-6">
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
                  </div>
                  <!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-6">
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
                    </div><!-- End Revenue Card -->

                <!-- Customers Card -->
                    <div class="col-xxl-4 col-xl-12">
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
                    </div><!-- End Customers Card -->
                <!-- Reports -->

                <?php
                    // $query = "
                    //     SELECT e.fullname, COUNT(d.ud_id) AS device_count
                    //     FROM user_devices d
                    //     INNER JOIN endusers e ON d.email = e.email
                    //     GROUP BY e.fullname
                    //     ORDER BY device_count DESC
                    // ";

                    // $result = mysqli_query($con, $query);

                    // $owners = [];
                    // $deviceCounts = [];

                    // while ($row = mysqli_fetch_assoc($result)) {
                    //     $owners[] = $row['fullname'];
                    //     $deviceCounts[] = (int)$row['device_count'];
                    // }
                ?>

                <!-- Card Container -->
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">User Response <span>/Analytics</span></h5>
                      <div id="deviceAnalyticsChart" style="min-height: 400px;"></div>

                      <script>
                        document.addEventListener("DOMContentLoaded", () => {
                          const owners = <?php echo json_encode($owners); ?>;
                          const deviceCounts = <?php echo json_encode($deviceCounts); ?>;

                          new ApexCharts(document.querySelector("#deviceAnalyticsChart"), {
                            series: [{
                              name: "Registered Devices",
                              data: deviceCounts
                            }],
                            chart: {
                              type: 'bar',
                              height: 400
                            },
                            plotOptions: {
                              bar: {
                                borderRadius: 4,
                                horizontal: false,
                              }
                            },
                            dataLabels: {
                              enabled: true
                            },
                            xaxis: {
                              categories: owners,
                              title: {
                                text: "End Users"
                              }
                            },
                            yaxis: {
                              title: {
                                text: "Device Count"
                              }
                            },
                            tooltip: {
                              y: {
                                formatter: val => `${val} device(s)`
                              }
                            },
                            colors: ['#255F38']
                          }).render();
                        });
                      </script>
                    </div>
                  </div>
                </div>

                <?php
                //   $dates = [];
                //   $registered = [];
                //   $dataReadings = [];

                //   for ($i = 6; $i >= 0; $i--) {
                //       $date = date('Y-m-d', strtotime("-$i days"));
                      
                //       $query = "SELECT COUNT(*) AS total_reg FROM `preregistration` WHERE DATE(dateSubmitted) = '$date'";
                //       $result = mysqli_query($con, $query);
                //       $data = mysqli_fetch_assoc($result);
                //       $reg_count = $data['total_reg'] ?? 0;
                //       $registered[] = $reg_count;
                      
                //       $dates[] = date('Y-m-d\TH:i:s.000\Z', strtotime($date));
                //   }
                ?>
              <!-- Reports -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Registration <span>/Reports</span></h5>
                            <div id="reportChart"></div>
                        </div>
                    </div>
                </div>
              </div>
        </div>
    <!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">
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


<script>
    document.addEventListener("DOMContentLoaded", () => {
        const dates = <?php echo json_encode($dates); ?>;
        const registered = <?php echo json_encode($registered); ?>;
        const logout = <?php echo json_encode($logout); ?>;

        new ApexCharts(document.querySelector("#reportsChart"), {
            series: [
                {
                    name: 'Login',
                    data: registered
                },
                {
                    name: 'Logout',
                    data: logout
                }
            ],
            chart: {
                height: 350,
                type: 'area',
                toolbar: {
                    show: false
                }
            },
            markers: {
                size: 4
            },
            colors: ['#E57068', '#2eca6a'],
            fill: {
                type: "gradient",
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.3,
                    opacityTo: 0.4,
                    stops: [0, 90, 100]
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 2
            },
            xaxis: {
                type: 'datetime',
                categories: dates
            },
            tooltip: {
                x: {
                    format: 'dd/MM/yy HH:mm'
                }
            }
        }).render();
    });
</script>


<script>
    document.addEventListener("DOMContentLoaded", () => {
        const dates = <?php echo json_encode($dates); ?>;
        const registered = <?php echo json_encode($registered); ?>;

        new ApexCharts(document.querySelector("#reportChart"), {
            series: [
                {
                    name: 'Login',
                    data: registered
                }
            ],
            chart: {
                height: 350,
                type: 'area',
                toolbar: {
                    show: false
                }
            },
            markers: {
                size: 4
            },
            colors: ['#E57068', '#2eca6a'],
            fill: {
                type: "gradient",
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.3,
                    opacityTo: 0.4,
                    stops: [0, 90, 100]
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 2
            },
            xaxis: {
                type: 'datetime',
                categories: dates
            },
            tooltip: {
                x: {
                    format: 'dd/MM/yy HH:mm'
                }
            }
        }).render();
    });
</script>

<?php 
include_once __DIR__ . '/../components/footer.php';
include_once __DIR__ . '/../components/footscript.php';
?>