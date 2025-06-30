<?php 
  function PageName() {
    return substr( $_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"],"/") +1);
  }
  $current_page = PageName();

  if($role == "Admin"){
    ?>
  <!-- ======= Sidebar Admin ======= -->
  <aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
    <li class="nav-heading">Data Monitoring</li>
      <li class="nav-item <?= $current_page=='dashboard' ? 'active' : null ?>" >
        <a class="nav-link collapsed" href="<?= BASE_URL ?>/frontend/views/dashboard">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-heading">Users Account</li>
      <li class="nav-item <?= $current_page=='ManageAdminView' || $current_page=='AddNewAdminUser'  ? 'active' : null ?>">
        <a class="nav-link collapsed" href="<?= BASE_URL ?>/frontend/views/admin_users/ManageAdminView">
          <i class="bi-people"></i>
          <span>Manage Administrator Account</span>
        </a>
      </li>
      <li class="nav-item <?= $current_page=='ManageFacultyView' || $current_page=='AddNewFacultyUser'  ? 'active' : null ?>">
        <a class="nav-link collapsed" href="<?= BASE_URL ?>/frontend/views/admin_users/ManageFacultyView">
          <i class="bi-people"></i>
          <span>Manage Faculty Account</span>
        </a>
      </li>
      <li class="nav-item <?= $current_page=='#' || $current_page=='#'  ? 'active' : null ?>">
        <a class="nav-link collapsed" href="#">
          <i class="bi-people"></i>
          <span>Manage Student Account</span>
        </a>
      </li>
      <li class="nav-heading">AI Recommender</li>
      <li class="nav-item <?= $current_page=='#' || $current_page=='#'  ? 'active' : null ?>">
        <a class="nav-link collapsed" href="#">
          <i class="bi bi-app-indicator"></i>
          <span>Response Validation</span>
        </a>
      </li>
      <li class="nav-heading">Reports</li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#">
          <i class="bi-file-earmark-ruled"></i>
          <span>System Reports</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#">
          <i class="bi bi-gear"></i>
          <span>Export Files</span>
        </a>
      </li>
      <li class="nav-heading">User Account</li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="profile">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li>
    </ul>
  </aside>
  <!-- End Sidebar-->
<?php }elseif($role == "Faculty"){?>
  <aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
    <li class="nav-heading">Data Monitoring</li>
      <li class="nav-item <?= $current_page=='dashboard' ? 'active' : null ?>" >
        <a class="nav-link collapsed" href="<?= BASE_URL ?>/frontend/views/dashboard">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-heading">Evaluation Reports</li>
      <li class="nav-item <?= $current_page=='#' || $current_page=='#'  ? 'active' : null ?>">
        <a class="nav-link collapsed" href="#">
          <i class="bi bi-journal-text"></i>
          <span>View Student Evaluation</span>
        </a>
      </li>

      <li class="nav-heading">AI Recommender</li>
      <li class="nav-item <?= $current_page=='#' || $current_page=='#'  ? 'active' : null ?>">
        <a class="nav-link collapsed" href="#">
          <i class="bi bi-filetype-ai"></i>
          <span>System Recommendation</span>
        </a>
      </li>
      <li class="nav-heading">System Reports</li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#">
          <i class="bi bi-file-earmark-bar-graph"></i>
          <span>Overall Reports</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#">
          <i class="bi bi-file-earmark-lock"></i>
          <span>Print Evaluation Result</span>
        </a>
      </li>
      <li class="nav-heading">User Account</li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="profile">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li>
    </ul>
  </aside>
<?php }else{?>
  <aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
    <li class="nav-heading">Evaluation Status</li>
      <li class="nav-item <?= $current_page=='dashboardstudent' ? 'active' : null ?>" >
        <a class="nav-link collapsed" href="<?= BASE_URL ?>/frontend/views/student_users/dashboardstudent">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-heading">Evaluation Panel</li>
      <li class="nav-item <?= $current_page=='FacultyViewList' || $current_page=='#'  ? 'active' : null ?>">
        <a class="nav-link collapsed" href="<?= BASE_URL ?>/frontend/views/student_users/FacultyViewList">
          <i class="bi bi-file-break"></i>
          <span>Add Response</span>
        </a>
      </li>
      <li class="nav-item <?= $current_page=='#' || $current_page=='#'  ? 'active' : null ?>">
        <a class="nav-link collapsed" href="#">
          <i class="bi bi-file-earmark-check"></i>
          <span>View Faculty Evaluation</span>
        </a>
      </li>
      <li class="nav-heading">Reports</li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#">
          <i class="bi bi-file-earmark-arrow-down"></i>
          <span>Print Evaluation</span>
        </a>
      </li>
      <li class="nav-heading">User Account</li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= BASE_URL ?>/frontend/views/student_users/profileStudent">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li>
    </ul>
  </aside>
<?php }?>

