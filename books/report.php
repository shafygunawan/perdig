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

  <title>Books Report | Perdig</title>

  <!-- Custom fonts for this template-->
  <link href="<?= $baseUrl; ?>/lib/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?= $baseUrl; ?>/lib/sb-admin-2/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Begin Page Content -->
  <div class="container-fluid py-4">

    <!-- Page Heading -->
    <h1 class="h4 mb-5 text-gray-800 text-center">
      PERDIG
      <br>
      Books Report
    </h1>

    <!-- DataTales Example -->
    <div class="table-responsive table-hover">
      <table class="table" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No.</th>
            <th>Title</th>
            <th>Author</th>
            <th>Release Year</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>No.</th>
            <th>Title</th>
            <th>Author</th>
            <th>Release Year</th>
          </tr>
        </tfoot>
        <tbody>

          <?php $i = 1; ?>
          <?php foreach ($books as $book) : ?>
            <tr>
              <td><?= $i++; ?></td>
              <td><?= $book["title"]; ?></td>
              <td><?= $book["author"]; ?></td>
              <td><?= $book["release_year"]; ?></td>
            </tr>
          <?php endforeach; ?>

        </tbody>
      </table>
    </div>

  </div>
  <!-- /.container-fluid -->

  <!-- Bootstrap core JavaScript-->
  <script src="<?= $baseUrl; ?>/lib/jquery/jquery.min.js"></script>
  <script src="<?= $baseUrl; ?>/lib/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= $baseUrl; ?>/lib/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= $baseUrl; ?>/lib/sb-admin-2/js/sb-admin-2.min.js"></script>

  <script>
    window.addEventListener('load', () => {
      window.print()
    });
  </script>

</body>

</html>