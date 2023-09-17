<?php

session_start();
require_once(__DIR__ . "/global/config.php");

if (isset($_SESSION["is_login"])) {
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

  <title>Login | Perdig</title>

  <!-- Custom fonts for this template-->
  <link href="<?= $baseUrl ?>/lib/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?= $baseUrl ?>/lib/sb-admin-2/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-5 col-lg-6 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Login</h1>
                  </div>

                  <?php if (isset($_SESSION['fm_failed'])) : ?>
                    <div class="alert alert-danger" role="alert">
                      <?= $_SESSION['fm_failed']; ?>
                    </div>
                    <?php unset($_SESSION['fm_failed']);  ?>
                  <?php endif; ?>

                  <form action="<?= $baseUrl; ?>/auth.php" method="POST" class="user">
                    <div class="form-group">
                      <input type="email" name="email" class="form-control form-control-user" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control form-control-user" placeholder="Password" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">
                      Login
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?= $baseUrl ?>/lib/jquery/jquery.min.js"></script>
  <script src="<?= $baseUrl ?>/lib/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= $baseUrl ?>/lib/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= $baseUrl ?>/lib/sb-admin-2/js/sb-admin-2.min.js"></script>

</body>

</html>