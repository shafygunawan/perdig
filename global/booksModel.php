<?php

require_once(__DIR__ . "/config.php");

function findBook($id)
{
  global $conn;

  $query = "SELECT * FROM books WHERE id = $id";
  $results = mysqli_query($conn, $query);
  $book = mysqli_fetch_assoc($results);

  return $book;
}

function searchBooks($keyword)
{
  global $conn;

  $query = "SELECT * FROM books WHERE
            title LIKE '%$keyword%' OR
            author LIKE '%$keyword%' OR
            release_year LIKE '%$keyword%'
            ";
  $results = mysqli_query($conn, $query);

  $books = [];
  while ($book = mysqli_fetch_assoc($results)) {
    $books[] = $book;
  }

  return $books;
}

function getBooks()
{
  global $conn;

  $query = "SELECT * FROM books";
  $results = mysqli_query($conn, $query);
  $books = [];

  while ($book = mysqli_fetch_assoc($results)) {
    $books[] = $book;
  }

  return $books;
}

function saveBook($book)
{
  global $conn;

  $title = htmlspecialchars($book["title"]);
  $author = htmlspecialchars($book["author"]);
  $releaseYear = htmlspecialchars($book["release_year"]);

  $query = "INSERT INTO books VALUES
            (NULL, '$title', '$author', '$releaseYear')";
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

function updateBook($book)
{
  global $conn;

  $id = $book["id"];
  $title = htmlspecialchars($book["title"]);
  $author = htmlspecialchars($book["author"]);
  $releaseYear = htmlspecialchars($book["release_year"]);

  $query = "UPDATE books SET
            title = '$title',
            author = '$author',
            release_year = '$releaseYear'
            WHERE id = $id
            ";
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

function deleteBooks($bookIds)
{
  global $conn;

  while ($id = current($bookIds)) {
    $query = "DELETE FROM books WHERE id = $id";
    mysqli_query($conn, $query);
    next($bookIds);
  }

  return mysqli_affected_rows($conn);
}
