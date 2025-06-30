   <!-- ======= Header ======= -->
   <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a href="#" class="logo d-flex align-items-center">
        <img src="<?= BASE_URL ?>/frontend/src/img/logo.png" alt="" class="rounded-circle">
        <span class="d-none d-lg-block">Faculty Evaluation MS<sup class="text-wrap">with AI recommender</sup></span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->
    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="<?= BASE_URL ?>/frontend/src/img/clientlogo.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">
              <?= htmlspecialchars($fullname) ?>
            </span>
          </a>

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            
            <li class="dropdown-header">
                  <h6>
                    <?= htmlspecialchars( $role) ?>
                  </h6>
                <span>Panel</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <?php 
              if($role == "Student"){
              ?>
              <a class="dropdown-item d-flex align-items-center" href="<?= BASE_URL ?>/frontend/views/student_users/profileStudent">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
              <?php 
              }else{
              ?>
              <a class="dropdown-item d-flex align-items-center" href="<?= BASE_URL ?>/frontend/views/profile">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
              <?php } ?>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <button class="dropdown-item d-flex align-items-center">
                <i class="bi bi-box-arrow-right"></i>
                <span>
                  <a href="<?= BASE_URL ?>/frontend/Authentication/logout" class="text-dark">Sign Out</a>
                </span>
              </button>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->