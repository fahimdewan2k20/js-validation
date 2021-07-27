<?php
  require "DBFunctions.php";
  //require "User.php";

  $fname = "";
  $lname = "";
  $gender = "";
  $dob = "";
  $ageErr = "";
  $religion = "";
  $present = "";
  $permanent = "";
  $tel = "";
  $email = "";
  $emailErr = "";
  $weblink = "";
  $username = "";
  $password = "";
  $verify_password = "";
  $flag = false;

  function input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if(!empty($_POST['fname'])) {
      $fname = input($_POST['fname']);
    }
    else {
      $flag = true;
    }
    if(!empty($_POST['lname'])) {
      $lname = input($_POST['lname']);
    }
    else {
      $flag = true;
    }
    if(!empty($_POST['gender'])) {
      $gender = input($_POST['gender']);
    }
    else {
      $flag = true;
    }
    if(!empty($_POST['dob'])) {
      $dob = input($_POST['dob']);
      if (strtotime($dob) >= (strtotime('now') - 86400*365*15)) {
        $flag = true;
      }
    }
    else {
      $flag = true;
    }
    if(!empty($_POST['religion'])) {
      $religion = input($_POST['religion']);
    }
    else {
      $flag = true;
    }
    if(!empty($_POST['present'])) {
      $present = input($_POST['present']);
    }
    if(!empty($_POST['permanent'])) {
      $permanent = input($_POST['permanent']);
    }
    if(!empty($_POST['tel'])) {
      $tel = input($_POST['tel']);
    }
    if(!empty($_POST['email'])) {
      $email = input($_POST['email']);
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "invalid email format";
      }
    }
    else {
      $flag = true;
    }
    if(!empty($_POST['weblink'])) {
      $weblink = input($_POST['weblink']);
    }
    if(!empty($_POST['username'])) {
      $username = input($_POST['username']);
      echo $username;
    }
    else {
      $flag = true;
    }
    if(!empty($_POST['password'])) {
      $password = input($_POST['password']);
    }
    else {
      $flag = true;
    }
    if(!empty($_POST['verify_password'])) {
      $verify_password = input($_POST['verify_password']);
    }
    if ($password != $verify_password) {
      $flag = true;
    }

    if(!$flag) {
      $user = new User($username, $password, $fname, $lname, $gender, $dob, $religion, $email, $present, $permanent, $tel, $weblink);

      if(addUser($user) === TRUE) {
        setcookie("username", $username, time() + 86400);
    		setcookie("password", $password, time() + 86400);

        $msg["status"] = "success";
      }
      $msg["status"] = "error";
      $msg["body"] = "error adding user";
    }
    else {
      $msg["status"] = "error";
  	}
    return json_encode($msg);
  }
?>
