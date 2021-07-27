<?php
  //require "functions.php";
  require "DBFunctions.php";

  $username = "";
  $password = "";
  $error = "";

  if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (isset($_COOKIE["username"])) {
      $username = $_COOKIE["username"];
    }
    else {
      $username = "";
    }
    if (isset($_COOKIE["password"])) {
      $password = $_COOKIE["password"];
    }
    else {
      $password = "";
    }
  }

  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!empty($_POST['username'])) {
      $username = $_POST['username'];
    }
    if (!empty($_POST['password'])) {
      $password = $_POST['password'];
    }
    if ($username === "" or $password === "") {
      $error = "username or password cannot be empty";
    }
    else {
      if(login($username, $password) == 1) {
        header("Location: welcome.php");
      }
      else {
        $error = "username or password doesn't match";
      }
    }
  }
?>
