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

        <title>HR Module | Attendance</title>

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
                <h1 class="h2 mx-3">Attendance</h1>
                <div class="info">
                    <div>
                        <div class="container">
                            <br><br>

                            <form action="" method="post" id="my-form1">
                                <div class="form-group">
                                    <label for="name">Date:</label>
                                    <input type="date" class="form-control" id="date" name="date" style="width:50%"><br>
                                    <button type="submit" class="btn btn-primary align-right" name="btn" value="check">Check</button><br>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="name">Employee ID:</label>
                                            <input type="text" id="myInput" class="form-control" onkeyup="myFunction()" placeholder="To check for specific employee enter employee ID">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Shift:</label>
                                            <!-- <input type="text" id="myShift" class="form-control" onkeyup="myFunction1()" placeholder="To check for specific employee enter employee ID"> -->
                                            <select class="form-control" id="mylist" onchange="myFunction1()">
                                                <option disabled selected>Select Shift</option>
                                                <option>Shift 1</option>
                                                <option>Shift 2</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                            </form>

                            <div class="table-responsive">
                                <table class="table table-bordered" id="myTable">

                                    <thead>
                                        <tr>
                                            <th>Employee ID</th>
                                            <th>Name</th>
                                            <th>Punch In</th>
                                            <th>Punch Out</th>
                                            <th>Date</th>
                                            <th>Shift</th>
                                            <th>Status</th>
                                            <th>View Monthly</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $islate = "";
                                        $overlate = "";


                                        $staff_buffer_time = date('s:i:H', strtotime("+{$buffer_min} minutes", $staff_start_time));

                                        $selectQuery1 = "Select * from cs_worker";
                                        $result1 = mysqli_query($con, $selectQuery1);
                                        if (mysqli_num_rows($result1) > 0) {

                                            while ($row1 = mysqli_fetch_assoc($result1)) {
                                                $id = $row1["cs_id"];
                                                $fname = $row1["firstname"];
                                                $lname = $row1["lastname"];
                                                $shift = $row1["Shift"];

                                                $query = "SELECT * FROM emp_shifttime WHERE emp_type = '$shift'";
                                                $result = mysqli_query($con, $query);
                                                $row = mysqli_fetch_assoc($result);
                                                $staff_start_time = $row["start_time"];
                                                $buffer_min = $row["buffer_time"];
                                                $end_time = $row["end_time"];

                                                $staff_buffer_time = date('s:i:H', strtotime("+{$buffer_min} minutes", $staff_start_time));

                                                if (isset($_POST["date"])) {
                                                    $date = $_POST["date"];
                                                    // echo $date."<br>";



                                                    $query = "SELECT time FROM dummy_data WHERE emp_id= '$id' AND date='$date'";
                                                    $result = mysqli_query($con, $query);
                                                    $total_rows = mysqli_num_rows($result);
                                                    // echo $total_rows;
                                                    $time_array = array();
                                                    if ($total_rows > 0) {
                                                        // output data of each row
                                                        for ($i = 0; $i < $total_rows; $i++) {
                                                            $row = mysqli_fetch_assoc($result);
                                                            $time_array[$i] = $row["time"];
                                                            //   echo $i." - ".$row["time"]."<br>";
                                                        }
                                                        // print_r($time_array);
                                        ?>
                                                        <tr>
                                                            <td><?php echo $id; ?></td>
                                                            <td><?php echo $fname . " " . $lname; ?></td>
                                                            <td><?php echo $time_array[0]; ?></td>
                                                            <td><?php echo $time_array[$total_rows - 1]; ?></td>
                                                            <td><?php echo $date ?></td>
                                                            <td><?php if ($shift == 'c_worker1') {
                                                                    echo "Shift 1";
                                                                } else {
                                                                    echo "Shift 2";
                                                                }
                                                                ?></td>
                                                            <td><?php
                                                                if (($time_array[0]) >= $staff_start_time) {


                                                                    if (($time_array[0]) <= $staff_start_time) {
                                                                        echo "On time";
                                                                    } elseif (($time_array[0]) <= $staff_buffer_time) {
                                                                        echo "In buffer";
                                                                    } elseif (($time_array[0]) >= $staff_start_time) {
                                                                        $islate = 'late';
                                                                        echo $islate;
                                                                    }
                                                                }
                                                                ?></td>
                                                            <td><a class="btn btn-info" href="Test.php?mid=<?php echo date("m", strtotime($date)); ?>&sid=<?php echo $id; ?>&yid=<?php echo date("Y", strtotime($date)) ?>">View</a></td>
                                                        </tr>
                                        <?php }
                                                }
                                            }
                                        } ?>
                                    </tbody>

                                </table>
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
        <script>
            function myFunction() {
                // Declare variables
                var input, filter, table, tr, td, i, txtValue;
                input = document.getElementById("myInput");
                filter = input.value.toUpperCase();
                table = document.getElementById("myTable");
                tr = table.getElementsByTagName("tr");

                // Loop through all table rows, and hide those who don't match the search query
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[0];
                    if (td) {
                        txtValue = td.textContent || td.innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            }

            function myFunction1() {
                // Declare variables
                var input, filter, table, tr, td, i, txtValue;
                input = document.getElementById("mylist");
                if (input.selectedOptions[0].value === "both") {
                    clearFilter();
                    alert("Hello");
                }
                // alert(input);.selectedOptions[0].value
                filter = input.value.toUpperCase();
                // alert(input);
                table = document.getElementById("myTable");
                tr = table.getElementsByTagName("tr");

                // Loop through all table rows, and hide those who don't match the search query
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[5];
                    if (td) {
                        txtValue = td.textContent || td.innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            }

            function clearFilter() {
                var tr;
                table = document.getElementById("myTable");
                tr = table.getElementsByTagName("tr");

                tr.show();
            }
        </script>
    </body>

    </html>
<?php } ?>