<?php 
include_once __DIR__ . '/../../components/header.php';
include_once __DIR__ . '/../../components/navigation.php';
include_once __DIR__ . '/../../components/sidebar.php';
?>

<style>
  .vision-mission-card {
    position: relative;
    overflow: hidden;
  }
  .vision-mission-card::before {
    content: "";
    background: url('<?= BASE_URL ?>/frontend/src/img/clientlogo.jpg') no-repeat center center;
    background-size: contain;
    opacity: 0.1;
    filter: blur(2px);
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 0;
    margin-top: 10px;
    margin-bottom: 10px;
  }
  .vision-mission-content {
    position: relative;
    z-index: 1;
  }
</style>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Dashboard</h1>
  </div>

  <section class="section dashboard">
    <div class="row">

      <!-- Left: Vision & Mission -->
      <div class="col-lg-8">
        <div class="card vision-mission-card shadow">
          <div class="card-body vision-mission-content">
            <h5 class="card-title text-center">Our School Philosophy</h5>
            <p class="fs-5 text-center">
              Teaching the way students learn.
            </p>

            <h5 class="card-title text-center">Vision</h5>
            <p class="fs-5 text-center">
              College of Our Lady of Mercy envisions itself as a Center of excellence within the region in the areas of Instructions, Research and Community Service.
            </p>

            <h5 class="card-title text-center mt-4">Mission</h5>
            <p class="fs-5 text-center">
              College of Our Lady of Mercy as a non-profit organization, commits itself to offer relevant affordable programs through high quality education responsive to the needs of the industries and the communities that will develop well-rounded and competent graduates imbued with Christian Values.
            </p>
          </div>
        </div>
      </div>

      <!-- Right: News Section -->
      <div class="col-lg-4">
        <div class="card">
          <div class="card-body pb-0">
            <h5 class="card-title">Data Security<span>| News</span></h5>
            <div class="news">
              <div class="post-item clearfix">
                <img src="<?= BASE_URL ?>/frontend/src/assets/img/prosec.jpg" alt="">
                <h4><a href="#">Data Encryption</a></h4>
                <p>Maintain security of the system through timely security updates, fixes, and patches to ensure data privacy and timely responses to threats. Maintain playbooks with guidelines for decommissioning. Establish standardized third-party governance and ensure that stakeholders meet the required standards and requirements.</p>
              </div>
              <div class="post-item clearfix">
                <img src="<?= BASE_URL ?>/frontend/src/assets/img/prosales.png" alt="">
                <h4><a href="#">Realtime Fetching</a></h4>
                <p>Realtime fetching of results inevitably lead to greater profits. You need to increase your monthly sales volume, for example, to achieve greater profits. Profit margins are the most important barometer of a company's health, according to "Bloomberg Businessweek" online.</p>
              </div>
              <div class="post-item clearfix">
                <img src="<?= BASE_URL ?>/frontend/src/assets/img/prostock.jpg" alt="">
                <h4><a href="#">Data Storage</a></h4>
                <p>Investment product is the umbrella term for all the stocks, bonds, options, derivatives and other financial instruments that people put money into in hopes of earning profits.</p>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div> <!-- row -->
  </section>
</main>

<?php 
include_once __DIR__ . '/../../components/footer.php';
include_once __DIR__ . '/../../components/footscript.php';
?>
