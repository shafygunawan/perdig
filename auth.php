<?php

session_start();
require_once(__DIR__ . "/global/usersModel.php");

// check is valid access
if (isset($_SESSION["is_login"])) {
  header("Location: $baseUrl/index.php");
  exit;
}
if (isset($_POST["submit"]) === false) {
  header("Location: $baseUrl/login.php");
  exit;
}

// check is valid user
$email = $_POST["email"];
$password = $_POST["password"];
$user = findUserByEmail($email);

if ($user === null) {
  $_SESSION["fm_failed"] = "Incorrect Email or Password!";
  echo "<script>history.back();</script>";
  exit;
}
if (password_verify($password, $user["password"]) === false) {
  $_SESSION["fm_failed"] = "Incorrect Email or Password!";
  echo "<script>history.back();</script>";
  exit;
}

// set session for this user
$_SESSION["is_login"] = true;
$_SESSION["name"] = $user['first_name'] . " " . $user['last_name'];
$_SESSION["email"] = $user["email"];
$_SESSION["level"] = $user["level"];
$_SESSION["profile_path"] = $user["profile_path"];

header("Location: $baseUrl/index.php");
exit;
