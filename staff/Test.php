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

        <title>HR Module | Monthly Attendance</title>

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
                <h1 class="h2 mx-3">Attendance</h1>

                <div class="info">
                    <div>
                        <div class="container">
                            <?php

                            $month = $_GET['mid'];
                            $year = $_GET['yid'];

                            $start_date = "01-" . $month . "-" . $year;
                            $start_time = strtotime($start_date);

                            $end_time = strtotime("+1 month", $start_time);

                            function minusTime($laterTime, $earlierTime)
                            {
                                $a = new DateTime($laterTime);
                                $b = new DateTime($earlierTime);
                                $interval = $a->diff($b);
                                return intval($interval->format("%H")) * 60 + intval($interval->format("%i"));
                            }
                            ?>
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-6">

                                    <div class="table-responsive">

                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Attendance</th>
                                                </tr>
                                            </thead>
                                            <?php

                                            $att = "";

                                            for ($i = $start_time; $i < $end_time; $i += 86400) {
                                                $check = date('Y-m-d', $i) . " ";
                                                #echo date('Y-m-d', $i)." ";
                                                $query = "SELECT time FROM dummy_data WHERE emp_id='" . $_GET['sid'] . "' and date = '$check' ";
                                                $result = mysqli_query($con, $query);
                                                $total_rows = mysqli_num_rows($result);
                                                #echo $total_rows;
                                                $time_array = array();
                                                if ($total_rows > 0) {
                                                    for ($j = 0; $j < $total_rows; $j++) {
                                                        $row = mysqli_fetch_assoc($result);
                                                        $time_array[$j] = $row["time"];
                                                    }

                                                    $total_time = 0;
                                                    $x = 0;
                                                    while ($x < $total_rows) {
                                                        $total_time += minusTime($time_array[$x + 1], $time_array[$x]);
                                                        $x += 2;
                                                    }

                                                    if ($total_time > 54) {
                                                        $att = "Present";

                                                        // echo "<br>First in time is ".$time_array[0]." and last out time is ".$time_array[$total_rows-1]."Total time calculated is ".$total_time."<br>";
                                                    }

                                            ?>

                                                <?php
                                                } else {
                                                    $att = "Absent";
                                                }
                                                ?>
                                                <tbody>
                                                    <tr>
                                                        <td><?php echo date('Y-m-d', $i) . " "; ?></td>
                                                        <td><?php if ($att == 'Absent') {
                                                            ?>
                                                                <button type="submit" class="btn btn-danger" name="btn"><?php echo $att; ?></button>
                                                            <?php
                                                            }
                                                            if ($att == 'Present') {
                                                            ?>
                                                                <button type="submit" class="btn btn-success" name="btn"><?php echo $att; ?></button>
                                                            <?php
                                                            }
                                                            ?>


                                                        </td>
                                                    </tr>
                                                </tbody>
                                            <?php

                                            }


                                            ?>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-sm-3"></div>
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