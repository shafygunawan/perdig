<?php

require_once(__DIR__ . "/../../global/usersModel.php");

// check has keyword
if (isset($_GET["keyword"]) === false) {
  $users = getUsers();
  echo json_encode(["results" => $users]);
  exit;
}

$keyword = $_GET["keyword"];
$users = searchUsers($keyword);
echo json_encode(["results" => $users]);
exit;
