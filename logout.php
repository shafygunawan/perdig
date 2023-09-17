<?php

session_start();
require_once(__DIR__ . "/global/config.php");

$_SESSION = [];
session_unset();
session_destroy();

header("Location: $baseUrl/login.php");
exit;
