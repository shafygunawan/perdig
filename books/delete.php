<?php

session_start();
require_once(__DIR__ . "/../global/booksModel.php");

// check is valid access
if (isset($_SESSION["is_login"]) === false) {
  header("Location: $baseUrl/login.php");
  exit;
}
if (isset($_POST["book_ids"]) === false) {
  header("Location: $baseUrl/books/index.php");
  exit;
}

// delete selected books
$bookIds = $_POST["book_ids"];
$deleteSuccess = deleteBooks($bookIds) > 0;

if ($deleteSuccess) {
  $_SESSION["fm_success"] = "Book successfully deleted!";
  header("Location: $baseUrl/books/index.php");
  exit;
}

$_SESSION["fm_failed"] = "Book failed to delete!";
header("Location: $baseUrl/books/index.php");
exit;
