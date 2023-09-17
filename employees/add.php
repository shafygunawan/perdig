<?php

session_start();
require_once(__DIR__ . "/../global/config.php");

if (isset($_SESSION["is_login"]) === false) {
  header("Location: $baseUrl/login.php");
  exit;
}
if ($_SESSION["level"] !== "admin") {
  header("Location: $baseUrl/index.php");
  exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Add Employee | Perdig</title>

  <!-- Custom fonts for this template-->
  <link href="<?= $baseUrl; ?>/lib/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?= $baseUrl; ?>/lib/sb-admin-2/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= $baseUrl; ?>/index.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-book-reader"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Perdig</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="<?= $baseUrl; ?>/books/index.php">
          <i class="fas fa-fw fa-book"></i>
          <span>Books</span></a>
      </li>

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="<?= $baseUrl; ?>/employees/index.php">
          <i class="fas fa-fw fa-users"></i>
          <span>Employees</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION["name"]; ?></span>
                <img class="img-profile rounded-circle" src="<?= $baseUrl; ?>/img<?= $_SESSION["profile_path"]; ?>">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add Employee</h1>
          </div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <form action="<?= $baseUrl; ?>/employees/save.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                  <label for="first-name" class="form-label">First Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="first-name" name="first_name" required>
                </div>
                <div class="mb-3">
                  <label for="last-name" class="form-label">Last Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="last-name" name="last_name" required>
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                  <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                  <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                  <label for="level" class="form-label">Level <span class="text-danger">*</span></label>
                  <select class="custom-select" id="level" name="level">
                    <option selected value="employee">Employee</option>
                    <option value="admin">Admin</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="profile" class="form-label">Profile <span class="text-black-50">( jpg | jpeg | png ) (Size < 2MB)</span></label>
                  <div class="custom-file mb-3">
                    <input type="file" class="custom-file-input" id="profile" name="profile">
                    <label class="custom-file-label" for="profile">Choose file</label>
                  </div>
                </div>
                <div class="row justify-content-end mt-5">
                  <div class="col-sm-auto order-first order-sm-last mb-2 mb-sm-0">
                    <button type="submit" name="save" class="btn btn-primary w-100">Save</button>
                  </div>
                  <div class="col-sm-auto">
                    <a href="<?= $baseUrl; ?>/employees/index.php" class="btn btn-danger w-100">Cancel</a>
                  </div>
                </div>
              </form>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; <a href="https://www.linkedin.com/in/shafygunawan/">Shafy Gunawan</a> 2021. GitHub: <a href="https://github.com/shafygunawan/perdig">Perdig</a></span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to quit?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Click "Logout" below if you are sure to sign out of your current account.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-danger" href="<?= $baseUrl; ?>/logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?= $baseUrl; ?>/lib/jquery/jquery.min.js"></script>
  <script src="<?= $baseUrl; ?>/lib/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= $baseUrl; ?>/lib/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= $baseUrl; ?>/lib/sb-admin-2/js/sb-admin-2.min.js"></script>

</body>

</html>