<?php

require_once(__DIR__ . "/../../global/booksModel.php");

// check has keyword
if (isset($_GET["keyword"]) === false) {
  $books = getBooks();
  echo json_encode(["results" => $books]);
  exit;
}

$keyword = $_GET["keyword"];
$books = searchBooks($keyword);
echo json_encode(["results" => $books]);
exit;
