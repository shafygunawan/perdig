<?php

session_start();
require_once(__DIR__ . "/../global/usersModel.php");

// check is valid access
if (isset($_SESSION["is_login"]) === false) {
  header("Location: $baseUrl/login.php");
  exit;
}
if ($_SESSION["level"] !== 'admin') {
  header("Location: $baseUrl/index.php");
  exit;
}
if (isset($_POST["update"]) === false || isset($_FILES["profile"]) === false) {
  header("Location: $baseUrl/employees/index.php");
  exit;
}

// check email is changed
$email = $_POST["email"];
$oldEmail = $_POST["old_email"];

if ($email !== $oldEmail) {
  // check email already exists
  $user = findUserByEmail($oldEmail);

  if ($user !== null) {
    $_SESSION["fm_failed"] = "Employee failed to update, email already registered!";
    header("Location: $baseUrl/employees/index.php");
    exit;
  }
}

// update user
$updateSuccess = updateUser($_POST) > 0;

if ($updateSuccess) {
  $_SESSION["fm_success"] = "Employee successfully updated!";
  header("Location: $baseUrl/employees/index.php");
  exit;
}

$_SESSION["fm_failed"] = "Employee failed to update!";
header("Location: $baseUrl/employees/index.php");
exit;
