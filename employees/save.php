<?php

session_start();
require_once(__DIR__ . "/../global/usersModel.php");

// check is valid access
if (isset($_SESSION["is_login"]) === false) {
  header("Location: $baseUrl/login.php");
  exit;
}
if ($_SESSION["level"] !== "admin") {
  header("Location: $baseUrl/index.php");
  exit;
}
if (isset($_POST["save"]) === false || isset($_FILES["profile"]) === false) {
  header("Location: $baseUrl/employees/add.php");
  exit;
}

// check user already exists
$email = $_POST["email"];
$user = findUserByEmail($email);

if ($user !== null) {
  $_SESSION["fm_failed"] = "Employee failed to save, email already registered!";
  header("Location: $baseUrl/employees/index.php");
  exit;
}

// save user
$saveSuccess = saveUser($_POST) > 0;

if ($saveSuccess) {
  $_SESSION["fm_success"] = "Employee successfully saved!";
  header("Location: $baseUrl/employees/index.php");
  exit;
}

$_SESSION["fm_failed"] = "Employee failed to save!";
header("Location: $baseUrl/employees/index.php");
exit;
