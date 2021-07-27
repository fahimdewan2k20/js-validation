<?php
  //require "functions.php";
  require "DBFunctions.php";

  $username = "";
  $password = "";
  $msg = "";

  // if ($_SERVER["REQUEST_METHOD"] === "GET") {
  //   if (isset($_COOKIE["username"])) {
  //     $username = $_COOKIE["username"];
  //   }
  //   else {
  //     $username = "";
  //   }
  //   if (isset($_COOKIE["password"])) {
  //     $password = $_COOKIE["password"];
  //   }
  //   else {
  //     $password = "";
  //   }
  // }

  if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (!empty($_POST['username'])) {
      $username = $_POST['username'];
    }
    if (!empty($_POST['password'])) {
      $password = $_POST['password'];
    }

    if ($username === "" or $password === "") {
      $msg = "error";
    }
    else {
      if(login($username, $password) == 1) {
        setcookie("username", $username, time() + 86400);
        $msg = "success";
      }
      else {
        $msg = "error";
      }
    }
  }
  echo $msg;
  return;
?>
