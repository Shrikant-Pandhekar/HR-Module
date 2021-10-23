<?php
session_start();
error_reporting(0);
include('connect.php');


if (isset($_POST['submit'])) {
    $sql = mysqli_query($con, "SELECT password FROM admin where email='" . $_SESSION['login'] . "'");
    $num = mysqli_fetch_array($sql);
    if ($num > 0) {
        $con = mysqli_query($con, "update admin set password='" . $_POST['confirmpassword'] . "' , setPass = 'SET' where email='" . $_SESSION['login'] . "'");
        echo '<script type="text/javascript" > alert("Password Updated Successfully !!")
        window.location.href="loading.php";
        </script>';
    } else {
        echo "<script> alert('Please Fill the value !!'); </script>";
    }
}


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>HR Module |Change Password</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="style.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous">
    </script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous">
    </script>

    <style>
        .title {
            text-align: center;
        }

        input {
            display: block;
            border: 2px solid #ccc;
            width: 95%;
            padding: 10px;
            margin: 10px auto;
            border-radius: 5px;
        }

        label {
            color: #888;
            font-size: 18px;
            padding: 10px;
        }

        button {
            float: right;
            background: #555;
            padding: 10px 15px;
            color: #fff;
            border-radius: 5px;
            margin-right: 10px;
            border: none;
        }

        button:hover {
            opacity: .7;
        }

        #message {
            padding: 10px;
            width: 95%;
            border-radius: 5px;
            margin: 20px auto;
            text-align: center;
        }

        .ca {
            font-size: 14px;
            display: inline-block;
            padding: 10px;
            text-decoration: none;
            color: #444;
        }

        .ca:hover {
            text-decoration: underline;
        }

        .home-nav a {
            padding: 10px;
            color: #f7bd65;
            text-transform: uppercase;
            text-decoration: none;
        }
    </style>
</head>

<body>

    <div class="wrapper">
        <!-- Sidebar  -->

        <!-- Page Content  -->
        <div id="content" style="width:100%">



            <div class="container">
                <div class="row ">
                    <div class="col-lg-7 mt-50 mx-auto">
                        <div class="card mt-2 mx-auto p-4 bg-light">
                            <div class="card-body bg-light">
                                <div class="container">
                                    <h1 class="h2 mx-3 title">Change Password</h1><br>
                                    <form action=" " method="post">
                                        <h5 id='message'></h5>
                                        <label>New Password</label>
                                        <input type="password" name="password" id="password" placeholder="New Password" required>
                                        <br>
                                        <label>Confirm New Password</label>
                                        <input type="password" name="confirmpassword" id="confirmpassword" placeholder="Confirm New Password" required onkeyup="check();">
                                        <br>

                                        <button type="submit" name="submit" class="btn btn-primary btn-send pt-2 btn-block btn--radius-2  ">CHANGE</button>

                                    </form>
                                </div>
                            </div>
                        </div> <!-- /.8 -->
                    </div> <!-- /.row-->

                </div>
            </div>




        </div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous">
    </script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous">
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
    <script type="text/javascript">
        var check = function() {
            if (document.getElementById('password').value ==
                document.getElementById('confirmpassword').value) {
                document.getElementById('message').style.color = 'green';
                document.getElementById('message').style.background = '#D4EDDA';

                document.getElementById('message').innerHTML = 'Mathcing';
            } else {
                document.getElementById('message').style.color = 'red';
                document.getElementById('message').style.background = '#ffb4bc';

                document.getElementById('message').innerHTML = 'Not Matching';
            }
        }
    </script>

</body>

</html>