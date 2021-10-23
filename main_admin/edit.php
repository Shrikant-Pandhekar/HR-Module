<?php
session_start();
error_reporting(0);
include('connect.php');
if (strlen($_SESSION['login']) == 0) {
    header('location:login.html');
} else {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Dashboard</title>

        <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <!-- Our Custom CSS -->
        <link rel="stylesheet" href="style.css">

        <!-- Font Awesome JS -->
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous">
        </script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    </head>

    <body>
        <div class="wrapper">
            <!-- Sidebar  -->
            <?php include("navbar.php"); ?>
            <!-- Page Content  -->
            <div id="content" style="width:100%">

                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">

                        <button type="button" id="sidebarCollapse" class="btn btn-info">
                            <i class="fas fa-align-left"></i>
                            <span>Toggle Sidebar</span>
                        </button>


                    </div>
                </nav>
                <?php
                if (isset($_GET["id"]) && !empty($_GET["id"])) {
                    $n1 = $_GET["id"];
                    $Query = "SELECT * from emp_shifttime WHERE id='$n1'";
                    $result = mysqli_query($con, $Query);
                    if (mysqli_num_rows($result) > 0) {

                        while ($row = mysqli_fetch_assoc($result)) {

                            $emp_type = $row["emp_type"];
                            $start_time = $row["start_time"];
                            $end_time = $row["end_time"];
                            $buffer_time = $row["buffer_time"];
                        }
                    }
                }

                ?>
                <div class="row">
                    <div class="col-sm-2">
                    </div>
                    <div class="col-sm-8">

                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Employee Type</label>
                                    <input type="text" class="form-control" name="l1" value="<?php echo "$emp_type"; ?>" disabled>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Start Time</label>
                                    <input type="time" class="form-control" name="starttime" value="<?php echo "$start_time"; ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail1">End Time</label>
                                    <input type="time" class="form-control" name="endtime" value="<?php echo "$end_time"; ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword2">Buffer TIme(In Minutes)</label>
                                    <input type="hidden" name="idup" value="<?php echo $n1; ?>">

                                    <input type="number" class="form-control" name="buffer" value="<?php echo "$buffer_time"; ?>">
                                </div>
                            </div>


                            <button type="submit" class="btn btn-primary" name="btn" value="submit">Submit</button>
                        </form>
                    </div>
                    <div class="col-sm-2">
                    </div>

                </div>
                <?php
                if (isset($_POST["btn"])) {
                    $start_time = $_POST["starttime"];
                    $end_time = $_POST["endtime"];
                    $buffer_time = $_POST["buffer"];
                    $n1 = $_POST["idup"];





                    $updatequery = "UPDATE emp_shifttime SET start_time='$start_time',end_time='$end_time',buffer_time='$buffer_time' WHERE id='$n1'";
                    if (mysqli_query($con, $updatequery)) {
                        echo '<meta http-equiv="refresh" content="0; URL=buffer.php">';
                        echo "<script> alert('Successfully Updated !!');</script>";
                    } else {
                        echo "error" . $updatequery . "<br>" . mysqli_error($con);
                    }
                }
                ?>




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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
        </script>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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