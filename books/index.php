<?php

session_start();
require_once(__DIR__ . "/../global/booksModel.php");

if (isset($_SESSION["is_login"]) === false) {
  header("Location: $baseUrl/login.php");
  exit;
}

$books = getBooks();

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Books | Perdig</title>

  <!-- Custom fonts for this template-->
  <link href="<?= $baseUrl; ?>/lib/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?= $baseUrl; ?>/lib/sb-admin-2/css/sb-admin-2.min.css" rel="stylesheet">

  <link rel="stylesheet" href="<?= $baseUrl; ?>/css/table.css">

</head>

<body id="page-top">

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
      <li class="nav-item active">
        <a class="nav-link disabled" href="<?= $baseUrl; ?>/books/index.php">
          <i class="fas fa-fw fa-book"></i>
          <span>Books</span></a>
      </li>

      <!-- Nav Item - Dashboard -->
      <?php if ($_SESSION["level"] === "admin") : ?>
        <li class="nav-item">
          <a class="nav-link" href="<?= $baseUrl; ?>/employees/index.php">
            <i class="fas fa-fw fa-users"></i>
            <span>Employees</span></a>
        </li>
      <?php endif; ?>

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
            <h1 class="h3 mb-2 mb-sm-0 text-gray-800">Books</h1>
            <a href="<?= $baseUrl; ?>/books/report.php" target="_blank" class="btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Print Report</a>
          </div>

          <?php if (isset($_SESSION["fm_success"])) : ?>
            <div class="alert alert-success" role="alert">
              <?= $_SESSION["fm_success"]; ?>
            </div>
            <?php unset($_SESSION["fm_success"]); ?>
          <?php endif; ?>

          <?php if (isset($_SESSION["fm_failed"])) : ?>
            <div class="alert alert-danger" role="alert">
              <?= $_SESSION["fm_failed"]; ?>
            </div>
            <?php unset($_SESSION["fm_failed"]) ?>
          <?php endif; ?>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <div class="row justify-content-between">
                <div class="col-sm mb-sm-0 mb-3">
                  <label class="btn btn-secondary btn-sm mb-0 select-all-container">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="" id="select-all">
                      <p class="form-check-label d-inline-block" for="select-all">
                        Select all
                      </p>
                    </div>
                  </label>
                  <a href="#" class="btn btn-danger btn-sm ml-2 delete-modal-toggler disabled" data-toggle="modal" data-target="#deleteModal">
                    <i class="fas fa-trash-alt"></i>
                  </a>
                  <a href="<?= $baseUrl; ?>/books/add.php" class="btn btn-primary btn-sm ml-2">
                    <i class="fas fa-plus"></i>
                  </a>
                </div>
                <div class="col-sm-auto">
                  <form class="form-inline mw-100 search-form">
                    <div class="input-group">
                      <input type="search" class="form-control form-control-sm small" placeholder="Cari buku . . ." aria-label="Search" aria-describedby="basic-addon2">
                      <div class="input-group-append">
                        <button class="btn btn-outline-secondary btn-sm" type="button">
                          <i class="fas fa-search fa-sm"></i>
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form action="<?= $baseUrl; ?>/books/delete.php" method="POST" class="multiple-delete-form">
                <div class="table-responsive table-hover">
                  <table class="table" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th></th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Release Year</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th></th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Release Year</th>
                        <th></th>
                      </tr>
                    </tfoot>
                    <tbody>

                      <?php foreach ($books as $book) : ?>
                        <tr>
                          <td>
                            <input type="checkbox" class="check-item" name="book_ids[]" value="<?= $book["id"]; ?>">
                          </td>
                          <td><?= $book["title"]; ?></td>
                          <td><?= $book["author"]; ?></td>
                          <td><?= $book["release_year"]; ?></td>
                          <td>
                            <a href="<?= $baseUrl; ?>/books/edit.php?id=<?= $book["id"]; ?>" class="btn btn-link btn-sm py-0 edit-btn edit-btn-hide">
                              <i class="fas fa-edit"></i>
                            </a>
                          </td>
                        </tr>
                      <?php endforeach; ?>

                    </tbody>
                  </table>
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

  <!-- Delete Modal-->
  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete a book?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Click "Delete" below if you are sure to delete the selected book. (this action cannot be undone)</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-danger delete-btn">Delete</button>
        </div>
      </div>
    </div>
  </div>

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

  <script>
    const BASE_URL = '<?= $baseUrl; ?>';
    const ENDPOINT = '/books/search.php';
  </script>
  <script src="<?= $baseUrl; ?>/js/table.js"></script>

</body>

</html>