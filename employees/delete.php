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
if (isset($_POST["user_ids"]) === false) {
  header("Location: $baseUrl/employees/index.php");
  exit;
}

// delete selected users
$userIds = $_POST["user_ids"];
$deleteSuccess = deleteUsers($userIds) > 0;

if ($deleteSuccess) {
  $_SESSION["fm_success"] = "Employee successfully deleted!";
  header("Location: $baseUrl/employees/index.php");
  exit;
}

$_SESSION["fm_failed"] = "Employee failed to delete!";
header("Location: $baseUrl/employees/index.php");
exit;
