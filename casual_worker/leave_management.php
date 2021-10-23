<?php 
session_start();
error_reporting(0);
include('connect.php');
if(strlen($_SESSION['login'])==0)
  { 
header('location:login.html');
}
else{
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>HR Module | Apply Leaves</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
        integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="style.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"
        integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous">
    </script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"
        integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous">
    </script>
</head>

<body>

    <div class="wrapper">
        <?php include("navbar.php");?>
        <div id="content" style="width:100%">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <span>Toggle Sidebar</span>
                    </button>


                </div>
            </nav>
            <h1 class="h2 mx-3">Apply for Leaves</h1><br>

            <div class="info">
                <div>
                    <div class="row">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-4">
                            <form action="" method="post" name="form1">
                                <div class="form-group">
                                    <label for="lbl1">Employee ID:</label>

                                    <input type="text" class="form-control" id="langname"
                                        placeholder="Enter Employee ID" name="id">



                                </div>
                                <input type="submit" class="btn btn-primary" name="btn" value="Check">


                            </form>
                            <?php
                                           if (isset($_POST["id"]) && !empty($_POST["id"]))
                                           {                            
                                               $lbl = $_POST["btn"];
                                           if ($lbl == "Check") {
                                               $id = $_POST['id'];
                                               $selectQuery = "Select * from cs_worker where cs_id = '$id'";
                                               $result = mysqli_query($con, $selectQuery);
                                               if (mysqli_num_rows($result) == 1) {
                                                   if ($row1 = mysqli_fetch_assoc($result)) {
                                                       $fn = $row1['firstname'];
                                                       $ln = $row1['lastname'];
                                                       $userphoto=$row1['photo'];
                                                       $_SESSION['id']=$_POST['id'];

                                                   }
                                               }
                                                ?>
                            <hr>
                            <div class="card" style="width: 70%;">
                                <div class="card-body">
                                    <h5 class="card-title">Employee Details</h5>

                                    <p>
                                        <?php
                                            if($userphoto==""):
                                            ?>
                                        <img src="asset/img.png" width="100" height="100" style="border-radius : 50px; align:center"
                                            alt="Photo Size Is More Than 2MB Can't Be Displayed">
                                        <?php else:?>
                                        <img src="profilePhoto/<?php echo htmlentities($userphoto);?>" width="100"
                                            height="100" style="border-radius : 50px; align:center"
                                            alt="Photo Size Is More Than 2MB Can't Be Displayed">

                                        <?php endif;?>

                                    </p>
                                    <br><br>
                                    <h6 class="card-subtitle mb-2 text-muted">Name:</h6>
                                    <?php
                                            if($fn==""):
                                            ?>
                                            <h5>No Data Found</h5>
                                            <?php else:?>
                                    <p class="card-text" style="color:black;"><?php echo $fn.' '.$ln;?></p>
                                    <?php endif;?>
                                </div>
                            </div>
                            <?php
                                }
                                }
                                ?>

                        </div>
                        <div class="col-sm-4">
                        <?php
                                            if($fn==""):
                                            ?>
                                             <br>
                                             <?php else:?>
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="lbl3" class="form-label">Duration:</label>
                                    <select class="form-control" name="type" id="type" onchange="yesnoCheck(this);"
                                        required>
                                        <option value="">--Select--</option>
                                        <option value="short">Short</option>
                                        <option value="long">Long</option>
                                        <option value="whole">Whole day</option>
                                    </select><br>
                                    <div class="form-group" id="ifYes" style="display: none;">
                                        <label for="example-date-input" class="form-label">Date:</label>
                                        <input class="form-control" type="date" id="example-date-input" name="date">
                                        <br>
                                        <div class="row">
                                            <div class="col">
                                                <input type="time" class="form-control" name="time1">
                                            </div>
                                            <div class="col">
                                                <input type="time" class="form-control" name="time2">
                                            </div>
                                        </div>


                                    </div>
                                    <div class="form-group" id="long" style="display: none;">
                                        <label for="example-date-input" class="form-label">Start Date:</label>
                                        <input class="form-control" type="date" id="example-date-input"
                                            name="startdate"><br>
                                        <label for="example-date-input" class="form-label">End Date:</label>
                                        <input class="form-control" type="date" id="example-date-input" name="enddate">

                                    </div>
                                    <div class="form-group" id="whole" style="display: none;">
                                        <label for="example-date-input" class="form-label"> Date:</label>
                                        <input class="form-control" type="date" id="example-date-input"
                                            name="date1"><br>
                                    </div><br>

                                    <div class="form-group">
                                        <label for="comment">Reason:</label>
                                        <textarea class="form-control" rows="3" id="reason1" name="reason"></textarea>
                                    </div>
                                    <input type="submit" class="btn btn-success" name="btn1" value="Submit">

                                </div>
                            </form>
                            <?php endif;?>
                            <?php
                                            if (isset($_POST["type"]) && !empty($_POST["type"]) && !empty($_POST["date"]) && isset($_POST["date"]))
                                            {                           
                                               $type = $_POST["type"];
                                               $reason = $_POST["reason"];
                                               $date=$_POST["date"];
                                               $time1=$_POST["time1"];
                                               $time2=$_POST["time2"];
                                               $n1=$_SESSION['id'];
                                               $lbl = $_POST["btn1"];
                                               $status="pending";

                                               if ($lbl == "Submit") {
                                                   $insertQuery = "INSERT INTO `leaves`(`Staff_ID`, `Leave_Type`, `StartDate`, `StartTime`, `EndTime`, `Reason`,`Status`) 
                                                   VALUES ('$n1','$type','$date','$time1','$time2','$reason','$status')";
                                                   if (mysqli_query($con, $insertQuery)) {
                                                       echo "<script>alert('Successfully Apply For the Leave');</script>";
                                                   } else {
                                                       echo "error" . $insertQuery . "<br>" . mysqli_error($con);
                                                   }
                                                   #mysqli_close($con);
                                               }
                                           }
                                           if (isset($_POST["type"]) && !empty($_POST["type"]) && !empty($_POST["startdate"]) && isset($_POST["startdate"]))
                                            {                           
                                                
                                               $type = $_POST["type"];
                                               $reason = $_POST["reason"];
                                               $n1=$_SESSION['id'];
                                               $lbl = $_POST["btn1"];
                                               $startdate=$_POST["startdate"];
                                               $enddate=$_POST["enddate"];
                                               $status="pending";


                
                                               if ($lbl == "Submit") {
                                                   $insertQuery = "INSERT INTO `leaves`(`Staff_ID`, `Leave_Type`, `StartDate`, `EndDate`, `Reason`,`Status`)  
                                                   VALUES ('$n1','$type','$startdate','$enddate','$reason','$status')";
                                                   if (mysqli_query($con, $insertQuery)) {
                                                       echo "<script>alert('Successfully Apply For the Leave');</script>";
                                                   } else {
                                                       echo "error" . $insertQuery . "<br>" . mysqli_error($con);
                                                   }
                                                   #mysqli_close($con);
                                               }
                                           }
                                           if (isset($_POST["type"]) && !empty($_POST["type"]) && !empty($_POST["date1"]) && isset($_POST["date1"]))
                                            {                           
                                                
                                               $type = $_POST["type"];
                                               $reason = $_POST["reason"];
                                               $n1=$_SESSION['id'];
                                               $lbl = $_POST["btn1"];
                                               $date1=$_POST["date1"];
                                               $status="pending";
                                               if ($lbl == "Submit") {
                                                   $insertQuery = "INSERT INTO `leaves`(`Staff_ID`, `Leave_Type`, `StartDate`, `Reason`,`Status`)  
                                                   VALUES ('$n1','$type','$date1','$reason','$status')";
                                                   if (mysqli_query($con, $insertQuery)) {
                                                       echo "<script>alert('Successfully Apply For the Leave');</script>";
                                                   } else {
                                                       echo "error" . $insertQuery . "<br>" . mysqli_error($con);
                                                   }
                                                   #mysqli_close($con);
                                               }
                                           }
                                           
                           
                           
                            ?>
                        </div>
                        <div class="col-sm-2">
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
    function yesnoCheck(that) {
        if (that.value == "short") {
            document.getElementById("ifYes").style.display = "block";
        } else {
            document.getElementById("ifYes").style.display = "none";

        }
        if (that.value == "long") {
            document.getElementById("long").style.display = "block";
        } else {
            document.getElementById("long").style.display = "none";

        }

        if (that.value == "whole") {
            document.getElementById("whole").style.display = "block";

        } else {
            document.getElementById("whole").style.display = "none";

        }

    }
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
        integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous">
    </script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
        integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous">
    </script>

    <script type="text/javascript">
    $(document).ready(function() {
        $('#sidebarCollapse').on('click', function() {
            $('#sidebar').toggleClass('active');
        });
    });
    </script>




</body>

</html>
<?php } ?>