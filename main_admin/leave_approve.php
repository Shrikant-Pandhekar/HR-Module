<?php
session_start();
error_reporting(0);
include('connect.php');
if (strlen($_SESSION['login']) == 0) {
    header('location:login.html');
} else {
?>
<?php
    if (isset($_POST['Approve'])) {
        echo "inside";
        $n1 = $_GET["sid"];
        $n2 = $_GET["srno"];
        $status = $_POST["Approve"];
        $updatequery = "UPDATE leaves SET  Status='Approved' WHERE srno='$n2'";
        if (mysqli_query($con, $updatequery)) {
            echo "<script> alert('Leave Approved !!');</script>";
            echo '<meta http-equiv="refresh" content="0; URL=leave_approval.php">';
        } else {
            echo "error" . $updatequery . "<br>" . mysqli_error($con);
        }
        $days = $_SESSION['days'];
        if ($n1[0] == "S") {
            $updatequery1 = "UPDATE staff SET leaves=leaves+$days WHERE staff_id='$n1'";
            if (mysqli_query($con, $updatequery1)) {;
            } else {
                echo "error" . $updatequery1 . "<br>" . mysqli_error($con);
            }
        } else if ($n1[0] == "P") {
            $updatequery2 = "UPDATE p_worker SET leaves=leaves+$days WHERE pw_id='$n1'";
            if (mysqli_query($con, $updatequery2)) {
            } else {
                echo "error" . $updatequery2 . "<br>" . mysqli_error($con);
            }
        } else if ($n1[0] == "C") {
            $updatequery3 = "UPDATE cs_worker SET leaves=leaves+$days WHERE cs_id='$n1'";
            if (mysqli_query($con, $updatequery3)) {
            } else {
                echo "error" . $updatequery3 . "<br>" . mysqli_error($con);
            }
        }
    }
    if (isset($_POST['Reject'])) {
        $n1 = $_GET["sid"];
        $n2 = $_GET["srno"];
        $status = $_POST["Reject"];
        $updatequery = "UPDATE leaves SET  Status='Rejected' WHERE srno='$n2'";
        if (mysqli_query($con, $updatequery)) {
            echo "<script> alert('Leave Rejected !!');</script>";
            echo '<meta http-equiv="refresh" content="0; URL=leave_approval.php">';
        } else {
            echo "error" . $updatequery . "<br>" . mysqli_error($con);
        }
    }




    ?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>HR Module | Leave approval</title>

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

<body id="page-top" style="background-color:white;">
    <div class="wrapper">
        <?php include("navbar.php"); ?>
        <div id="content" style="width:100%">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <span>Toggle Sidebar</span>
                    </button>


                </div>
            </nav>
            <h1 class="h2 mx-3">Leave Approval</h1><br>
            <form action="" method="post" id="my-form1">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card border-info" style="max-width: 50rem;">
                            <div class="card-header"><b>Employee Leave Details</b></div>
                            <div class="card-body text-info">
                                <?php
                                    $id = $_GET['sid'];
                                    $srno = $_GET['srno'];
                                    $_SESSION['days'] = $_GET['days'];
                                    $query = mysqli_query($con, "Select * from leaves where Staff_ID='$id' and srno='$srno'");
                                    while ($row = mysqli_fetch_array($query)) {
                                    ?>
                                <p class="card-text"
                                    style="color:black;font-size:17px;font-family: Arial, Helvetica, sans-serif;text-transform:capitalize;">
                                    Employee ID: <?php echo $id; ?><br><br>
                                    Leave Type: <?php echo $row["Leave_Type"]; ?><br><br>
                                    <?php
                                            if ($row["Leave_Type"] == 'whole') {
                                            ?>
                                    Date: <?php echo $row["StartDate"];
                                                    }
                                                    if ($row["Leave_Type"] == 'long') {
                                                        ?>
                                    Start Date: <?php echo $row["StartDate"];  ?> <br>
                                    End Date: <?php echo $row["EndDate"];
                                                        }
                                                        if ($row["Leave_Type"] == 'short') {
                                                            ?>
                                    Date:<?php echo $row["StartDate"];  ?><br><br>
                                    Start Time: <?php echo $row["StartTime"];  ?> <br>
                                    End Time: <?php echo $row["EndTime"];
                                                        }
                                                            ?><br><br>
                                    Reason: <?php echo $row["Reason"];  ?>

                                </p>
                                <div class="card-footer bg-transparent border-info">
                                    <input type="submit" class="btn btn-success float-left" name="Approve"
                                        value="Approve">
                                    <input type="submit" class="btn btn-danger float-right" name="Reject"
                                        value="Reject">

                                </div>

                                <?php } ?>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="table-responsive">
                            <table class="table table-bordered ">
                                <thead>
                                    <tr>
                                        <th scope="col">Short Leaves</th>
                                        <th scope="col">Long Leaves</th>
                                        <th scope="col">Whole Leaves</th>
                                        <th scope="col">Total Leaves</th>
                                        <th scope="col">Remaining Leaves</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php

                                        $shortcount = 0;
                                        $longcount = 0;
                                        $wholecount = 0;

                                        $year = date("Y");
                                        $sql = "SELECT * FROM leaves WHERE Staff_ID='$id' and Leave_Type='short' and year(StartDate) =$year and Status='Approved'";
                                        $result = mysqli_query($con, $sql);
                                        if (mysqli_num_rows($result) > 0) {
                                            $shortcount = mysqli_num_rows($result);
                                        } else {
                                            $shortcount = 0;
                                        }
                                        $sql1 = "SELECT * FROM leaves WHERE Staff_ID='$id' and Leave_Type='long' and year(StartDate)=$year and Status='Approved'";
                                        $result1 = mysqli_query($con, $sql1);
                                        if (mysqli_num_rows($result1) > 0) {
                                            $longcount = mysqli_num_rows($result1);
                                        } else {
                                            $longcount = 0;
                                        }
                                        $sql2 = "SELECT * FROM leaves WHERE Staff_ID='$id' and Leave_Type='whole' and year(StartDate)=$year and Status='Approved'";
                                        $result2 = mysqli_query($con, $sql2);
                                        if (mysqli_num_rows($result2) > 0) {
                                            $wholecount = mysqli_num_rows($result2);
                                        } else {
                                            $wholecount = 0;
                                        }
                                        $total = $shortcount + $longcount + $wholecount;
                                        $rem = 33 - $total;
                                        ?>
                                    <tr>
                                        <td><?php echo $shortcount; ?></td>
                                        <td><?php echo $longcount; ?></td>
                                        <td><?php echo $wholecount; ?></td>
                                        <td><?php echo $total; ?></td>
                                        <td><?php echo $rem; ?></td>


                                    </tr>

                                </tbody>
                            </table>
                        </div>



                    </div>
                </div>


            </form>



        </div>
    </div>





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