<?php

require_once(__DIR__ . "/config.php");

function findUser($id)
{
  global $conn;

  $query = "SELECT * FROM users WHERE id = $id";
  $results = mysqli_query($conn, $query);
  $user = mysqli_fetch_assoc($results);

  return $user;
}

function findUserByEmail($email)
{
  global $conn;

  $query = "SELECT * FROM users WHERE email = '$email'";
  $results = mysqli_query($conn, $query);
  $user = mysqli_fetch_assoc($results);

  return $user;
}

function searchUsers($keyword)
{
  global $conn;

  $query = "SELECT * FROM users WHERE
            first_name LIKE '%$keyword%' OR
            last_name LIKE '%$keyword%' OR
            email LIKE '%$keyword%' OR
            level LIKE '%$keyword%'
            ";
  $results = mysqli_query($conn, $query);

  $users = [];
  while ($user = mysqli_fetch_assoc($results)) {
    $users[] = $user;
  }

  return $users;
}

function getUsers()
{
  global $conn;

  $query = "SELECT * FROM users";
  $results = mysqli_query($conn, $query);

  $users = [];
  while ($user = mysqli_fetch_assoc($results)) {
    $users[] = $user;
  }

  return $users;
}

function saveUser($user)
{
  global $conn;

  $firstName = htmlspecialchars($user["first_name"]);
  $lastName = htmlspecialchars($user["last_name"]);
  $email = htmlspecialchars($user["email"]);
  $password = htmlspecialchars($user["password"]);
  $level = htmlspecialchars($user["level"]);
  $profilePath = uploadProfile($_FILES["profile"]);

  // password encrypting
  $password = password_hash($password, PASSWORD_DEFAULT);

  $query = "INSERT INTO users VALUES
            (NULL, '$firstName', '$lastName', '$email', '$password', '$level', '$profilePath')";
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

function updateUser($user)
{
  global $conn;

  $id = $user["id"];
  $firstName = htmlspecialchars($user["first_name"]);
  $lastName = htmlspecialchars($user["last_name"]);
  $email = htmlspecialchars($user["email"]);
  $password = htmlspecialchars($user["password"]);
  $level = htmlspecialchars($user["level"]);
  $profilePath = uploadProfile($_FILES["profile"]);
  $oldProfilePath = $user["old_profile_path"];

  // check is not default image
  if ($oldProfilePath !== "/no-profile.png") {
    unlink(__DIR__ . "/../img$oldProfilePath");
  }

  // check password has changed
  if ($password === "") {
    $query = "UPDATE users SET
            first_name = '$firstName',
            last_name = '$lastName',
            email = '$email',
            level = '$level',
            profile_path = '$profilePath'
            WHERE id = $id
            ";
  } else {
    // password encrypting
    $password = password_hash($password, PASSWORD_DEFAULT);
    $query = "UPDATE users SET
            first_name = '$firstName',
            last_name = '$lastName',
            email = '$email',
            level = '$level',
            password = '$password',
            profile_path = '$profilePath'
            WHERE id = $id
            ";
  }

  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

function deleteUsers($bookIds)
{
  global $conn;

  while ($id = current($bookIds)) {
    $user = findUser($id);

    if ($user["profile_path"] !== "/no-profile.png") {
      unlink(__DIR__ . "/../img{$user['profile_path']}");
    }

    $query = "DELETE FROM users WHERE id = $id";
    mysqli_query($conn, $query);

    next($bookIds);
  }

  return mysqli_affected_rows($conn);
}

function uploadProfile($profile)
{
  $filename = $profile["name"];
  $tmpFilename = $profile["tmp_name"];
  $fileSize = $profile["size"];
  $error = $profile["error"];

  // check has uploaded profile
  if ($error === 4) {
    return "/no-profile.png";
  }

  // check file size
  if ($fileSize > 2000000) {
    return "/no-profile.png";
  }

  // check image type
  $validImageExtensions = ["jpg", "jpeg", "png"];
  $imageExtension = explode(".", $filename);
  $imageExtension = end($imageExtension);
  $imageExtension = strtolower($imageExtension);

  if (in_array($imageExtension, $validImageExtensions) === false) {
    return "/no-profile.png";
  }

  // generate uniq filename
  $newFilename = uniqid();
  $newFilename = "/$newFilename.$imageExtension";

  move_uploaded_file($tmpFilename, __DIR__ . "/../img$newFilename");

  return $newFilename;
}
