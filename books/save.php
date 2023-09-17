<?php

session_start();
require_once(__DIR__ . "/../global/booksModel.php");

// check is valid access
if (isset($_SESSION["is_login"]) === false) {
  header("Location: $baseUrl/login.php");
  exit;
}
if (isset($_POST["save"]) === false) {
  header("Location: $baseUrl/books/add.php");
  exit;
}

// save new book
$saveSuccess = saveBook($_POST) > 0;

if ($saveSuccess) {
  $_SESSION["fm_success"] = "Book successfully saved!";
  header("Location: $baseUrl/books/index.php");
  exit;
}

$_SESSION["fm_failed"] = "Book failed to save!";
header("Location: $baseUrl/books/index.php");
exit;
