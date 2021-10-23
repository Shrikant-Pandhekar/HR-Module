<?php
session_start();
error_reporting(0);
include('connect.php');
if (strlen($_SESSION['login']) == 0) {
    header('location:login.html');
} else {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>HR Module | Leave History</title>

        <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <!-- Our Custom CSS -->
        <link rel="stylesheet" href="style.css">

        <!-- Font Awesome JS -->
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous">
        </script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous">
        </script>
    </head>

    <body>

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
                <h1 class="h2 mx-3">Leave History</h1><br>

                <div class="info">
                    <div>
                        <div class="row">
                            <div class="col-sm-2">
                            </div>
                            <div class="col-sm-8">
                                <form action="" method="post" name="form1">
                                    <div class="form-group">
                                        <label for="lbl1">Employee ID:</label>

                                        <input type="text" class="form-control" id="langname" placeholder="Enter Employee ID" name="id" style="width:50%">




                                    </div>
                                    <input type="submit" class="btn btn-primary" name="btn" value="Check">


                                </form><br>
                                <?php
                                if (isset($_POST["id"]) && !empty($_POST["id"])) {
                                    $lbl = $_POST["btn"];
                                    if ($lbl == "Check") {
                                        $id = $_POST['id'];
                                        $test = "select pw_id from p_worker where pw_id = '$id'";
                                        $res = mysqli_query($con, $test);
                                        while ($r1 = mysqli_fetch_assoc($res)) {
                                        $count = $r1['pw_id'];
                                        }
                                        $selectQuery = "Select * from leaves where Staff_ID = '$count'";
                                        $result = mysqli_query($con, $selectQuery);
                                        if (mysqli_num_rows($result) == 0){
                                            ?>
                                            <h5>No Data Found</h5>
                                            <?php  
                                        }
                                        if (mysqli_num_rows($result) > 0) {
                                ?>
                                            <div class="table-responsive">

                                                <table class="table table-hover table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Emp ID</th>
                                                            <th scope="col">Leave Type</th>
                                                            <th scope="col">Start Date</th>
                                                            <th scope="col">End Date</th>
                                                            <th scope="col">From</th>
                                                            <th scope="col">To</th>
                                                            <th scope="col">Reason</th>
                                                            <th scope="col">Status</th>


                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <tr>
                                                            <?php

                                                            // output data of each row
                                                            while ($row1 = mysqli_fetch_assoc($result)) {
                                                                $id = $row1['Staff_ID'];
                                                                $lt = $row1['Leave_Type'];
                                                                $sd = $row1['StartDate'];
                                                                $ed = $row1['EndDate'];
                                                                $st = $row1['StartTime'];
                                                                $et = $row1['EndTime'];
                                                                $reason = $row1['Reason'];
                                                                $status = $row1["Status"];
                                                                $_SESSION['id'] = $_POST['id'];

                                                            ?>

                                                                <td><?php echo $id ?></td>
                                                                <td><?php echo $lt ?></td>
                                                                <td><?php echo $sd ?></td>
                                                                <td><?php echo $ed ?></td>
                                                                <td><?php echo $st ?></td>
                                                                <td><?php echo $et ?></td>
                                                                <td><?php echo $reason ?></td>
                                                                <td> <button type="button" class="btn btn-success"><?php echo $status ?></button></td>



                                                        </tr>
                                                    <?php
                                                            }

                                                    ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                <?php
                                        }
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

    </body>


    </html>
<?php } ?>