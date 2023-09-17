<?php

session_start();
require_once(__DIR__ . "/../global/booksModel.php");

// check is valid access
if (isset($_SESSION["is_login"]) === false) {
  header("Location: $baseUrl/login.php");
  exit;
}
if (isset($_POST["update"]) === false) {
  header("Location: $baseUrl/books/index.php");
  exit;
}

// update book
$updateSuccess = updateBook($_POST) > 0;

if ($updateSuccess) {
  $_SESSION["fm_success"] = "Book successfully updated!";
  header("Location: $baseUrl/books/index.php");
  exit;
}

$_SESSION["fm_failed"] = "Book failed to update!";
header("Location: $baseUrl/books/index.php");
exit;
