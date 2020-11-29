
<div id="wrapper">
  <!-- Sidebar -->
  <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar" >
    <a class="sidebar-brand d-flex align-items-center justify-content-center" style="background-color: skyblue;" href="">
     <div class="sidebar-brand-text mx-2 ">QUICK COUNT</div>
   </a>
   <li class="nav-item p-2" style="font-size: 15px">
    <center><b>Aplikasi Quick Count</b></center>
  </li>
  <hr class="sidebar-divider">
  <li class="nav-item ">
    <a class="nav-link" href="./index.php">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
    </li>

    <hr class="sidebar-divider">

    <li class="nav-item ">
      <a class="nav-link" href="dataUser.php">
        <i class="fas fa-users"></i>
        <span>Data User</span></a>
      </li>

      <hr class="sidebar-divider">

     <li class="nav-item">
      <a class="nav-link" href="kecamatan.php">
        <i class="fas fa-users"></i>
        <span>Data Kecamatan</span></a>
      </li>
      <hr class="sidebar-divider">

      <li class="nav-item">
      <a class="nav-link" href="desa.php">
        <i class="fas fa-users"></i>
        <span>Data Desa</span></a>
      </li>

      <hr class="sidebar-divider">

      <li class="nav-item">
      <a class="nav-link" href="tps.php">
        <i class="fas fa-users"></i>
        <span>Data TPS</span></a>
      </li>

      <hr class="sidebar-divider">

    <li class="nav-item">
    <a class="nav-link" href="teamKordes.php">
      <i class="fas fa-users"></i>
      <span>Data Team Kordes</span></a>
    </li>

    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
        aria-expanded="true" aria-controls="collapseBootstrap">
        <i class="far fa-fw fa-window-maximize"></i>
        <span>Aplikasi Cuick Count</span>
      </a>
      <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Report</h6>
          <a  class="collapse-item" href="../admin/index.php">Halaman Admin</a>
          <a class="collapse-item" href="../index_quickCount.php">Quick Count</a>
        </div>
      </div>
    </li>

      <div class="version" id="version-ruangadmin"></div>
    </ul>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <nav style="background-color: skyblue;" class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
          <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <ul class="navbar-nav ml-auto">


            <div class="topbar-divider d-none d-sm-block"></div>
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="img-profile rounded-circle" src="./assets/ruangAdmin/img/boy.png" style="max-width: 60px">
                <span class="ml-2 d-none d-lg-inline text-white small"><?php echo $_SESSION['username']  ?></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
        </nav>
        <!-- Topbar -->
