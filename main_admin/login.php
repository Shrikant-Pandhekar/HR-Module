 <?php
  session_start();
  error_reporting(0);
  include("connect.php");
  if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = ($_POST['password']);

    if ($username == "admin" and $password == "Ad") {
      $extra = "loading.php";
      $_SESSION['login'] = $_POST['username'];
      $_SESSION['id'] = $num['id'];
      $host = $_SERVER['HTTP_HOST'];
      $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
      header("location:http://$host$uri/$extra");
      exit();
    } else {
      $_SESSION['errmsg'] = "Invalid username or password";
      $extra = "login.html";
      $host  = $_SERVER['HTTP_HOST'];
      $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
      echo '<script type="text/javascript"> alert("Invalid Password or Id !!!")
      window.location.href="login.html";
      </script>';

      exit();
    }
  }
  ?>