<?php
session_start();
error_reporting(0);
include("connect.php");


if (isset($_POST['submit'])) {
  $email = mysqli_real_escape_string($con, $_POST['username']);
  $password = mysqli_real_escape_string($con, $_POST['password']);
  $check_email = "SELECT * FROM admin WHERE email = '$email' and password= '$password'";
  $res = mysqli_query($con, $check_email);
  if (mysqli_num_rows($res) > 0) {
    $fetch = mysqli_fetch_assoc($res);
    $role = $fetch['position'];
    if ($role == 'p_worker') {
      $_SESSION['email'] = $email;
      $status = $fetch['setPass'];
      if ($status == 'SET') {
        $extra = "loading.php";
        $_SESSION['login'] = $_POST['username'];
        $_SESSION['id'] = $num['id'];
        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        header("location:http://$host$uri/$extra");
        exit();
      } else {
        $extra = "changePass.php";
        $_SESSION['login'] = $_POST['username'];
        $_SESSION['id'] = $num['id'];
        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        header("location:http://$host$uri/$extra");
        exit();
      }
    } else {
      echo '<script type="text/javascript"> alert("Invalid Password or Id !!!")
       window.location.href="login.html";
       </script>';
      // $errors['email'] = "Incorrect email or password!";
    }
  } else {
    echo '<script type="text/javascript"> alert("You Are Not Member of staff !!!")
       window.location.href="login.html";
       </script>';
  }
}
