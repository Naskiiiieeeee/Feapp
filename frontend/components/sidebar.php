<?php 
  function PageName() {
    return substr( $_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"],"/") +1);
  }
  $current_page = PageName();

  // if($role == "Admin"){
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
      <li class="nav-item <?= $current_page=='ManageAdminView' || $current_page=='#'  ? 'active' : null ?>">
        <a class="nav-link collapsed" href="<?= BASE_URL ?>/frontend/views/admin_users/ManageAdminView">
          <i class="bi-people"></i>
          <span>Manage Administrator Account</span>
        </a>
      </li>

      <li class="nav-item <?= $current_page=='#' || $current_page=='#'  ? 'active' : null ?>">
        <a class="nav-link collapsed" href="#">
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


