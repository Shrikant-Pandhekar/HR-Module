<?php
session_start();
error_reporting(0);
include('connect.php');
if (strlen($_SESSION['login']) == 0) {
    header('location:login.html');
} else {
?>

    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Dashboard</title>

        <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <!-- Our Custom CSS -->
        <link rel="stylesheet" href="dashboard.css">

        <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <!-- Our Custom CSS -->


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
                <div class="container-fluid ">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4 ">
                        <h1 class="h3 mb-0 text-gray-800 mt-4 ">Dashboard</h1>
                    </div>

                    <?php
                    $chart_ontime = array("Mon" => 0, "Tue" => 0, "Wed" => 0, "Thu" => 0, "Fri" => 0, "Sat" => 0,);
                    $chart_late = array("Mon" => 0, "Tue" => 0, "Wed" => 0, "Thu" => 0, "Fri" => 0, "Sat" => 0,);

                    $chart_ontime1 = array("Mon" => 0, "Tue" => 0, "Wed" => 0, "Thu" => 0, "Fri" => 0, "Sat" => 0,);
                    $chart_late1 = array("Mon" => 0, "Tue" => 0, "Wed" => 0, "Thu" => 0, "Fri" => 0, "Sat" => 0,);

                    $chart_ontime2 = array("Mon" => 0, "Tue" => 0, "Wed" => 0, "Thu" => 0, "Fri" => 0, "Sat" => 0,);
                    $chart_late2 = array("Mon" => 0, "Tue" => 0, "Wed" => 0, "Thu" => 0, "Fri" => 0, "Sat" => 0,);
                    ?>
                    <?php
                    $date =  $_POST['date'];
                    $day1 = date('D', strtotime($date));

                    //Staff
                    do {
                        $count_onTime = 0;
                        $count_late = 0;
                        $count_emp = 0;
                        $total_staff = 0;

                        $selectQuery1 = "Select * from staff";
                        $result1 = mysqli_query($con, $selectQuery1);
                        $query = "SELECT start_time,buffer_time FROM emp_shifttime WHERE emp_type = 'staff'";
                        $result = mysqli_query($con, $query);
                        $row = mysqli_fetch_assoc($result);
                        $staff_start_time = $row["start_time"];
                        $buffer_min = $row["buffer_time"];
                        $staff_buffer_time = date('s:i:H', strtotime("+{$buffer_min} minutes", $staff_start_time));

                        if (mysqli_num_rows($result1) > 0) {

                            while ($row1 = mysqli_fetch_assoc($result1)) {
                                $total_staff += 1;
                                $id = $row1["staff_id"];
                                $fname = $row1["firstname"];
                                $lname = $row1["lastname"];
                                $query = "SELECT time FROM dummy_data WHERE emp_id= '$id' AND date='$date' ORDER BY time";
                                $result = mysqli_query($con, $query);
                                $total_rows = mysqli_num_rows($result);
                                // echo $total_rows;
                                $time_array = array();
                                if (
                                    $total_rows > 0
                                ) {
                                    // output data of each row
                                    for (
                                        $i = 0;
                                        $i < $total_rows;
                                        $i++
                                    ) {
                                        $row = mysqli_fetch_assoc($result);
                                        $time_array[$i] = $row["time"];
                                        //   echo $i." - ".$row["time"]."<br>";
                                    }
                                    // print_r($time_array);
                                    if (($time_array[0]) <= $staff_start_time) {
                                        //echo "On time"; 
                                        $count_onTime = $count_onTime + 1;
                                    } elseif (($time_array[0]) >= $staff_start_time) {
                                        // $islate = 'late';
                                        // echo $islate;
                                        $count_late = $count_late + 1;
                                    }
                                    $day = date('D', strtotime($date));
                                }
                            }
                        }



                        if ($day == 'Mon') {
                            $COT = $chart_ontime['Mon'];
                            $chart_ontime['Mon'] = $COT + $count_onTime;
                            $CL = $chart_late['Mon'];
                            $chart_late['Mon'] = $CL + $count_late;
                        } elseif ($day == 'Tue') {
                            $COT = $chart_ontime['Tue'];
                            $chart_ontime['Tue'] = $COT + $count_onTime;
                            $CL = $chart_late['Tue'];
                            $chart_late['Tue'] = $CL + $count_late;
                        } elseif ($day == 'Wed') {
                            $COT = $chart_ontime['Wed'];
                            // echo "$COT";
                            // echo "$count_onTime";
                            $total = $chart_ontime['Wed'] + $count_onTime;
                            $chart_ontime['Wed'] = $total;
                            // echo ("Total " . $chart_ontime['Wed']);
                            $CL = $chart_late['Wed'];
                            $chart_late['Wed'] = $CL + $count_late;
                        } elseif ($day == 'Thu') {
                            $COT = $chart_ontime['Thu'];
                            $chart_ontime['Thu'] = $COT + $count_onTime;
                            $CL = $chart_late['Thu'];
                            $chart_late['Thu'] = $CL + $count_late;
                        } elseif ($day == 'Fri') {
                            $COT = $chart_ontime['Fri'];
                            $chart_ontime['Fri'] = $COT + $count_onTime;
                            $CL = $chart_late['Fri'];
                            $chart_late['Fri'] = $CL + $count_late;
                        } elseif ($day == 'Sat') {
                            $COT = $chart_ontime['Sat'];
                            $chart_ontime['Sat'] = $COT + $count_onTime;
                            $CL = $chart_late['Sat'];
                            $chart_late['Sat'] = $CL + $count_late;
                        }

                        $date = date(
                            'Y-m-d',
                            strtotime($date . " -1 days")
                        );
                        $day = date('D', strtotime($date));
                    } while ($day != 'Sun');
                    // echo nl2br(" \n  ");
                    // print_r($chart_ontime);
                    // echo nl2br(" \n  ");

                    //Permanent_worker
                    $date =  $_POST['date'];
                    $day1 = date('D', strtotime($date));
                    do {
                        $islate = "";
                        $count_onTime1 = 0;
                        $count_late1 = 0;
                        $count_emp1 = 0;
                        $total_staff1 = 0;
                        $query = "SELECT start_time,buffer_time FROM emp_shifttime WHERE emp_type = 'p_worker'";
                        $result = mysqli_query($con, $query);
                        $row = mysqli_fetch_assoc($result);
                        $staff_start_time = $row["start_time"];
                        $buffer_min = $row["buffer_time"];
                        $staff_buffer_time = date('s:i:H', strtotime("+{$buffer_min} minutes", $staff_start_time));

                        $selectQuery1 = "Select * from p_worker";
                        $result1 = mysqli_query($con, $selectQuery1);

                        if (mysqli_num_rows($result1) > 0) {
                            while ($row1 = mysqli_fetch_assoc($result1)) {
                                $total_staff1 += 1;
                                $id = $row1["pw_id"];
                                $fname = $row1["firstname"];
                                $lname = $row1["lastname"];
                                $query = "SELECT time FROM dummy_data WHERE emp_id= '$id' AND date='$date' ORDER BY time";
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


                                    $count_emp1 = $count_emp1 + 1;
                                    if (($time_array[0]) <= $staff_start_time) {
                                        //echo "On time"; 
                                        $count_onTime1 = $count_onTime1 + 1;
                                    } elseif (($time_array[0]) >= $staff_start_time) {
                                        // $islate = 'late';
                                        echo $islate;
                                        $count_late1 = $count_late1 + 1;
                                    }
                                    $day = date('D', strtotime($date));
                                }
                            }
                        }


                        if ($day == 'Mon') {
                            $chart_ontime1['Mon'] = $count_onTime1;

                            $chart_late1['Mon'] = $count_late1;
                        } elseif ($day == 'Tue') {
                            $chart_ontime1['Tue'] = $count_onTime1;
                            $chart_late1['Tue'] = $count_late1;
                        } elseif ($day == 'Wed') {
                            $chart_ontime1['Wed'] = $count_onTime1;
                            $chart_late1['Wed'] = $count_late1;
                        } elseif ($day == 'Thu') {
                            $chart_ontime1['Thu'] = $count_onTime1;
                            $chart_late1['Thu'] = $count_late1;
                        } elseif ($day == 'Fri') {
                            $chart_ontime1['Fri'] = $count_onTime1;
                            $chart_late1['Fri'] = $count_late1;
                        } elseif ($day == 'Sat') {
                            $chart_ontime1['Sat'] = $count_onTime1;
                            $chart_late1['Sat'] = $count_late1;
                        }

                        $date = date('Y-m-d', strtotime($date . " -1 days"));
                        $day = date('D', strtotime($date));
                    } while ($day != 'Sun');
                    // echo nl2br(" \n  ");
                    // print_r($chart_ontime1);
                    // echo nl2br(" \n  ");

                    //Casual Worker
                    $date =  $_POST['date'];
                    $day1 = date('D', strtotime($date));

                    do {
                        $islate = "";
                        $count_onTime2 = 0;
                        $count_late2 = 0;
                        $count_emp = 0;
                        $total_staff2 = 0;
                        $selectQuery1 = "Select * from cs_worker";
                        $result1 = mysqli_query($con, $selectQuery1);


                        if (mysqli_num_rows($result1) > 0) {

                            while ($row1 = mysqli_fetch_assoc($result1)) {
                                $total_staff2 += 1;
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


                                $query = "SELECT time FROM dummy_data WHERE emp_id= '$id' AND date='$date' ORDER BY time";
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


                                    $count_emp = $count_emp + 1;
                                    if (($time_array[0]) <= $staff_start_time) {
                                        //echo "On time"; 
                                        $count_onTime2 = $count_onTime2 + 1;
                                    } elseif (($time_array[0]) >= $staff_start_time) {
                                        // $islate = 'late';
                                        // echo $islate;
                                        $count_late2 = $count_late2 + 1;
                                    }
                                    $day = date('D', strtotime($date));
                                }
                            }
                        }



                        if ($day == 'Mon') {
                            $chart_ontime2['Mon'] = $count_onTime2;

                            $chart_late2['Mon'] = $count_late2;
                        } elseif ($day == 'Tue') {
                            $chart_ontime2['Tue'] = $count_onTime2;
                            $chart_late2['Tue'] = $count_late2;
                        } elseif ($day == 'Wed') {
                            $chart_ontime2['Wed'] = $count_onTime2;
                            $chart_late2['Wed'] = $count_late2;
                        } elseif ($day == 'Thu') {
                            $chart_ontime2['Thu'] = $count_onTime2;
                            $chart_late2['Thu'] = $count_late2;
                        } elseif ($day == 'Fri') {
                            $chart_ontime2['Fri'] = $count_onTime2;
                            $chart_late2['Fri'] = $count_late2;
                        } elseif ($day == 'Sat') {
                            $chart_ontime2['Sat'] = $count_onTime2;
                            $chart_late2['Sat'] = $count_late2;
                        }

                        $date = date('Y-m-d', strtotime($date . " -1 days"));
                        $day = date('D', strtotime($date));
                    } while ($day != 'Sun');
                    // echo nl2br(" \n  ");
                    // print_r($chart_ontime2);

                    $f_on = array();
                    foreach (array_keys($chart_ontime + $chart_ontime1 + $chart_ontime2) as $currency) {
                        $f_on[$currency] = (isset($chart_ontime[$currency]) ? $chart_ontime[$currency] : 0) + (isset($chart_ontime1) ? $chart_ontime1[$currency] : 0) + (isset($chart_ontime2) ? $chart_ontime2[$currency] : 0);
                    }

                    $f_late = array();
                    foreach (array_keys($chart_late + $chart_late1 + $chart_late2) as $currency) {
                        $f_late[$currency] = (isset($chart_late[$currency]) ? $chart_late[$currency] : 0) + (isset($chart_late1) ? $chart_late1[$currency] : 0) + (isset($chart_late2) ? $chart_late2[$currency] : 0);
                    }
                    // echo nl2br(" \n  ");
                    // print_r($f_on);
                    // echo nl2br(" \n  ");
                    // print_r($f_late);
                    ?>


                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 col-sm-6 col-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Employess</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_staff + $total_staff1 + $total_staff2 ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user-friends fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 col-sm-6 col-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Present Today</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $f_on[$day1] + $f_late[$day1]  ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-chart-pie fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 col-sm-6 col-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">On Time Today
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo  $f_on[$day1]; ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 col-sm-6 col-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Late Today</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo  $f_late[$day1]; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!--Fixed tab example -->
                    <div class="card pmd-card" style="background-color: rgba(250,250,250, 0.4);border:none;">
                        <div class="pmd-tabs">
                            <ul role="tablist" class="nav nav-tabs nav-fill">
                                <li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab" role="tab" aria-controls="home" href="#home-fixed">Staff</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" role="tab" aria-controls="profile" href="#about-fixed">Permanent Worker</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" role="tab" aria-controls="messages" href="#work-fixed">Casual Worker</a></li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="home-fixed">
                                    <div class="container-fluid ">
                                        <div class="d-sm-flex align-items-center justify-content-between mb-4 ">
                                            <h1 class="h3 mb-0 text-gray-800 mt-4 ">Dashboard</h1>
                                            <nav class="mt-4">
                                                <!-- Topbar Search -->
                                                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="" method="post" id="my-form1">
                                                    <div class="input-group">
                                                        <input type="date" class="form-control  " value="<?php echo date('Y-m-d'); ?>" id="date" name="date">
                                                        <div class="input-group-append">
                                                            <button type="submit" id="check" class="btn btn-primary align-right  " name="btn" value="check">
                                                                <i class="fas fa-search fa-sm  "></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </nav>
                                        </div>
                                        <!-- Cards Row -->
                                        <div class="row">
                                            <div class="col-xl-3 col-md-6 col-sm-6 col-6 mb-4">
                                                <div class="card border-left-primary shadow h-100 py-2">
                                                    <div class="card-body">
                                                        <div class="row no-gutters align-items-center">
                                                            <div class="col mr-2">
                                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                                    Total Employess</div>
                                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_staff ?></div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <i class="fas fa-user-friends fa-2x text-gray-300"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Earnings (Monthly) Card Example -->
                                            <div class="col-xl-3 col-md-6 col-sm-6 col-6 mb-4">
                                                <div class="card border-left-success shadow h-100 py-2">
                                                    <div class="card-body">
                                                        <div class="row no-gutters align-items-center">
                                                            <div class="col mr-2">
                                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                                    Present Today</div>
                                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $chart_ontime[$day1] + $chart_late[$day1]; ?></div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <i class="fas fa-chart-pie fa-2x text-gray-300"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Earnings (Monthly) Card Example -->
                                            <div class="col-xl-3 col-md-6 col-sm-6 col-6 mb-4">
                                                <div class="card border-left-info shadow h-100 py-2">
                                                    <div class="card-body">
                                                        <div class="row no-gutters align-items-center">
                                                            <div class="col mr-2">
                                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">On Time Today
                                                                </div>
                                                                <div class="row no-gutters align-items-center">
                                                                    <div class="col-auto">
                                                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo  $chart_ontime[$day1]; ?></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <i class="fas fa-clock fa-2x text-gray-300"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Pending Requests Card Example -->
                                            <div class="col-xl-3 col-md-6 col-sm-6 col-6 mb-4">
                                                <div class="card border-left-warning shadow h-100 py-2">
                                                    <div class="card-body">
                                                        <div class="row no-gutters align-items-center">
                                                            <div class="col mr-2">
                                                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                                    Late Today</div>
                                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo  $chart_late[$day1]; ?></div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Graphic section -->
                                    <div class="row">
                                        <div class="col-xl-9 col-lg-7">
                                            <div class="card shadow mb-4">
                                                <!-- Card Header - Dropdown -->
                                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                    <h6 class="m-0 font-weight-bold text-primary">Bar Graph</h6>
                                                </div>
                                                <!-- Card Body -->
                                                <div class="card-body">
                                                    <div class="chart-area">
                                                        <div id="container1" style="height: 100%; width: 100%;">
                                                            <canvas id="canvas1"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Pie Chart -->
                                        <div class="col-xl-3 col-lg-5">
                                            <div class="card shadow mb-4">
                                                <!-- Card Header - Dropdown -->
                                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                    <h6 class="m-0 font-weight-bold text-primary">Pie Chart</h6>
                                                </div>
                                                <!-- Card Body -->
                                                <div class="card-body">
                                                    <div class="chart-pie pt-4 pb-2  ">
                                                        <canvas id="myPieChart" style="width:100%;"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="about-fixed">
                                    <div class="container-fluid ">
                                        <div class="d-sm-flex align-items-center justify-content-between mb-4 ">
                                            <h1 class="h3 mb-0 text-gray-800 mt-4 ">Dashboard</h1>
                                            <nav class="mt-4">
                                                <!-- Topbar Search -->
                                                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="" method="post" id="my-form1">
                                                    <div class="input-group">
                                                        <input type="date" class="form-control  " value="<?php echo date('Y-m-d'); ?>" id="date" name="date">
                                                        <div class="input-group-append">
                                                            <button type="submit" id="check" class="btn btn-primary align-right  " name="btn" value="check">
                                                                <i class="fas fa-search fa-sm  "></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </nav>
                                        </div>

                                        <!-- Card Row -->
                                        <div class="row">
                                            <div class="col-xl-3 col-md-6 col-sm-6 col-6 mb-4">
                                                <div class="card border-left-primary shadow h-100 py-2">
                                                    <div class="card-body">
                                                        <div class="row no-gutters align-items-center">
                                                            <div class="col mr-2">
                                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                                    Total Employess</div>
                                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_staff1 ?></div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <i class="fas fa-user-friends fa-2x text-gray-300"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Earnings (Monthly) Card Example -->
                                            <div class="col-xl-3 col-md-6 col-sm-6 col-6 mb-4">
                                                <div class="card border-left-success shadow h-100 py-2">
                                                    <div class="card-body">
                                                        <div class="row no-gutters align-items-center">
                                                            <div class="col mr-2">
                                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                                    Present Today</div>
                                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $chart_ontime1[$day1] + $chart_late1[$day1]; ?></div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <i class="fas fa-chart-pie fa-2x text-gray-300"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Earnings (Monthly) Card Example -->
                                            <div class="col-xl-3 col-md-6 col-sm-6 col-6 mb-4">
                                                <div class="card border-left-info shadow h-100 py-2">
                                                    <div class="card-body">
                                                        <div class="row no-gutters align-items-center">
                                                            <div class="col mr-2">
                                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">On Time Today
                                                                </div>
                                                                <div class="row no-gutters align-items-center">
                                                                    <div class="col-auto">
                                                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo  $chart_ontime1[$day1]; ?></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <i class="fas fa-clock fa-2x text-gray-300"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Pending Requests Card Example -->
                                            <div class="col-xl-3 col-md-6 col-sm-6 col-6 mb-4">
                                                <div class="card border-left-warning shadow h-100 py-2">
                                                    <div class="card-body">
                                                        <div class="row no-gutters align-items-center">
                                                            <div class="col mr-2">
                                                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                                    Late Today</div>
                                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo  $chart_late1[$day1]; ?></div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Graphic Section -->
                                    <div class="row">
                                        <div class="col-xl-9 col-lg-7">
                                            <div class="card shadow mb-4">
                                                <!-- Card Header - Dropdown -->
                                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                    <h6 class="m-0 font-weight-bold text-primary">Bar Graph</h6>
                                                </div>
                                                <!-- Card Body -->
                                                <div class="card-body">
                                                    <div class="chart-area">
                                                        <div id="container2" style="height: 100%; width: 100%;">
                                                            <canvas id="canvas2"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Pie Chart -->
                                        <div class="col-xl-3 col-lg-5">
                                            <div class="card shadow mb-4">
                                                <!-- Card Header - Dropdown -->
                                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                    <h6 class="m-0 font-weight-bold text-primary">Pie Chart</h6>
                                                </div>
                                                <!-- Card Body -->
                                                <div class="card-body">
                                                    <div class="chart-pie pt-4 pb-2  ">
                                                        <canvas id="myPieChart1" style="width:100%;"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="work-fixed">
                                    <div class="container-fluid ">
                                        <!-- Page Heading -->
                                        <div class="d-sm-flex align-items-center justify-content-between mb-4 ">
                                            <h1 class="h3 mb-0 text-gray-800 mt-4 ">Dashboard</h1>
                                            <nav class="mt-4">
                                                <!-- Topbar Search -->
                                                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="" method="post" id="my-form1">
                                                    <div class="input-group">
                                                        <input type="date" class="form-control  " value="<?php echo date('Y-m-d'); ?>" id="date" name="date">
                                                        <div class="input-group-append">
                                                            <button type="submit" id="check" class="btn btn-primary align-right  " name="btn" value="check">
                                                                <i class="fas fa-search fa-sm  "></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </nav>
                                        </div>
                                        <!-- Card Row -->
                                        <div class="row">
                                            <div class="col-xl-3 col-md-6 col-sm-6 col-6 mb-4">
                                                <div class="card border-left-primary shadow h-100 py-2">
                                                    <div class="card-body">
                                                        <div class="row no-gutters align-items-center">
                                                            <div class="col mr-2">
                                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                                    Total Employess</div>
                                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_staff2 ?></div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <i class="fas fa-user-friends fa-2x text-gray-300"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Earnings (Monthly) Card Example -->
                                            <div class="col-xl-3 col-md-6 col-sm-6 col-6 mb-4">
                                                <div class="card border-left-success shadow h-100 py-2">
                                                    <div class="card-body">
                                                        <div class="row no-gutters align-items-center">
                                                            <div class="col mr-2">
                                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                                    Present Today</div>
                                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $chart_ontime2[$day1] + $chart_late2[$day1]; ?></div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <i class="fas fa-chart-pie fa-2x text-gray-300"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Earnings (Monthly) Card Example -->
                                            <div class="col-xl-3 col-md-6 col-sm-6 col-6 mb-4">
                                                <div class="card border-left-info shadow h-100 py-2">
                                                    <div class="card-body">
                                                        <div class="row no-gutters align-items-center">
                                                            <div class="col mr-2">
                                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">On Time Today
                                                                </div>
                                                                <div class="row no-gutters align-items-center">
                                                                    <div class="col-auto">
                                                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo  $chart_ontime2[$day1]; ?></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <i class="fas fa-clock fa-2x text-gray-300"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Pending Requests Card Example -->
                                            <div class="col-xl-3 col-md-6 col-sm-6 col-6 mb-4">
                                                <div class="card border-left-warning shadow h-100 py-2">
                                                    <div class="card-body">
                                                        <div class="row no-gutters align-items-center">
                                                            <div class="col mr-2">
                                                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                                    Late Today</div>
                                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo  $chart_late2[$day1]; ?></div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Graphic Section -->
                                    <div class="row">
                                        <!-- Bar Graph -->
                                        <div class="col-xl-9 col-lg-7">
                                            <div class="card shadow mb-4">
                                                <!-- Card Header - Dropdown -->
                                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                    <h6 class="m-0 font-weight-bold text-primary">Bar Graph</h6>
                                                </div>
                                                <!-- Card Body -->
                                                <div class="card-body">
                                                    <div class="chart-area">
                                                        <div id="container3" style="height: 100%x; width: 100%;">
                                                            <canvas id="canvas3"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Pie Chart -->
                                        <div class="col-xl-3 col-lg-5">
                                            <div class="card shadow mb-4">
                                                <!-- Card Header - Dropdown -->
                                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                    <h6 class="m-0 font-weight-bold text-primary">Pie Chart</h6>
                                                </div>
                                                <!-- Card Body -->
                                                <div class="card-body">
                                                    <div class="chart-pie pt-4 pb-2  ">
                                                        <canvas id="myPieChart2" style="width:100%;"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Fixed tab example end-->
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

                <script type="text/javascript">
                    $(document).ready(function() {
                        $('#sidebarCollapse').on('click', function() {
                            $('#sidebar').toggleClass('active');
                        });
                    });
                </script>

                <script>
                    var xValues = ["On Time", "Late"];
                    var yValues = [<?php echo  $chart_ontime[$day1]; ?>, <?php echo  $chart_late[$day1]; ?>];
                    var barColors = [
                        "#00aba9",
                        "#b91d47",
                    ];

                    new Chart("myPieChart", {
                        type: "pie",
                        data: {
                            labels: xValues,
                            datasets: [{
                                backgroundColor: barColors,
                                data: yValues
                            }]
                        },

                    });
                </script>

                <script>
                    var barChartData = {
                        labels: [
                            "Mon",
                            "Tue",
                            "Wed",
                            "Thur",
                            "Fri",
                            "Sat",
                        ],
                        datasets: [{
                                label: "Ontime",
                                backgroundColor: "#35DE5F",
                                borderColor: "black",
                                borderWidth: 1,
                                data: [<?php echo $chart_ontime['Mon'] ?>, <?php echo $chart_ontime['Tue'] ?>, <?php echo $chart_ontime['Wed'] ?>, <?php echo $chart_ontime['Thur'] ?>, <?php echo $chart_ontime['Fri'] ?>, <?php echo $chart_ontime['Sat'] ?>]
                            },
                            {
                                label: "Late",
                                backgroundColor: "#DE3540",
                                borderColor: "black",
                                borderWidth: 1,
                                data: [<?php echo $chart_late['Mon'] ?>, <?php echo $chart_late['Tue'] ?>, <?php echo $chart_late['Wed'] ?>, <?php echo $chart_late['Thur'] ?>, <?php echo $chart_late['Fri'] ?>, <?php echo $chart_late['Sat'] ?>]
                            }
                        ]
                    };

                    var chartOptions = {
                        responsive: true,
                        legend: {
                            position: "top"
                        },
                        title: {
                            display: true,
                            text: "Chart.js Bar Chart"
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }

                    var ctx = document.getElementById("canvas1").getContext("2d");
                    window.myBar = new Chart(ctx, {
                        type: "bar",
                        data: barChartData,
                        options: {
                            plugins: {
                                title: {
                                    display: true,
                                    text: 'Ontime and Late Employee in a week'
                                }
                            }
                        }
                    });
                </script>


                <script>
                    var xValues = ["On Time", "Late"];
                    var yValues = [<?php echo  $chart_ontime1[$day1]; ?>, <?php echo  $chart_late1[$day1]; ?>];
                    var barColors = [
                        "#00aba9",
                        "#b91d47",
                    ];

                    new Chart("myPieChart1", {
                        type: "pie",
                        data: {
                            labels: xValues,
                            datasets: [{
                                backgroundColor: barColors,
                                data: yValues
                            }]
                        },

                    });
                </script>

                <script>
                    var barChartData = {
                        labels: [
                            "Mon",
                            "Tue",
                            "Wed",
                            "Thur",
                            "Fri",
                            "Sat",
                        ],
                        datasets: [{
                                label: "Ontime",
                                backgroundColor: "#35DE5F",
                                borderColor: "black",
                                borderWidth: 1,
                                data: [<?php echo $chart_ontime1['Mon'] ?>, <?php echo $chart_ontime1['Tue'] ?>, <?php echo $chart_ontime1['Wed'] ?>, <?php echo $chart_ontime1['Thur'] ?>, <?php echo $chart_ontime1['Fri'] ?>, <?php echo $chart_ontime1['Sat'] ?>]
                            },
                            {
                                label: "Late",
                                backgroundColor: "#DE3540",
                                borderColor: "black",
                                borderWidth: 1,
                                data: [<?php echo $chart_late1['Mon'] ?>, <?php echo $chart_late1['Tue'] ?>, <?php echo $chart_late1['Wed'] ?>, <?php echo $chart_late1['Thur'] ?>, <?php echo $chart_late1['Fri'] ?>, <?php echo $chart_late1['Sat'] ?>]
                            }
                        ]
                    };

                    var chartOptions = {
                        responsive: true,
                        legend: {
                            position: "top"
                        },
                        title: {
                            display: true,
                            text: "Chart.js Bar Chart"
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }

                    var ctx = document.getElementById("canvas2").getContext("2d");
                    window.myBar = new Chart(ctx, {
                        type: "bar",
                        data: barChartData,
                        options: {
                            plugins: {
                                title: {
                                    display: true,
                                    text: 'Ontime and Late Employee in a week'
                                }
                            }
                        }
                    });
                </script>



                <script>
                    var xValues = ["On Time", "Late"];
                    var yValues = [<?php echo  $chart_ontime2[$day1]; ?>, <?php echo  $chart_late2[$day1]; ?>];
                    var barColors = [
                        "#00aba9",
                        "#b91d47",
                    ];

                    new Chart("myPieChart2", {
                        type: "pie",
                        data: {
                            labels: xValues,
                            datasets: [{
                                backgroundColor: barColors,
                                data: yValues
                            }]
                        },

                    });
                </script>

                <script>
                    var barChartData = {
                        labels: [
                            "Mon",
                            "Tue",
                            "Wed",
                            "Thur",
                            "Fri",
                            "Sat",
                        ],
                        datasets: [{
                                label: "Ontime",
                                backgroundColor: "#35DE5F",
                                borderColor: "black",
                                borderWidth: 1,
                                data: [<?php echo $chart_ontime2['Mon'] ?>, <?php echo $chart_ontime2['Tue'] ?>, <?php echo $chart_ontime2['Wed'] ?>, <?php echo $chart_ontime2['Thur'] ?>, <?php echo $chart_ontime2['Fri'] ?>, <?php echo $chart_ontime2['Sat'] ?>]
                            },
                            {
                                label: "Late",
                                backgroundColor: "#DE3540",
                                borderColor: "black",
                                borderWidth: 1,
                                data: [<?php echo $chart_late2['Mon'] ?>, <?php echo $chart_late2['Tue'] ?>, <?php echo $chart_late2['Wed'] ?>, <?php echo $chart_late2['Thur'] ?>, <?php echo $chart_late2['Fri'] ?>, <?php echo $chart_late2['Sat'] ?>]
                            }
                        ]
                    };

                    var chartOptions = {
                        responsive: true,
                        legend: {
                            position: "top"
                        },
                        title: {
                            display: true,
                            text: "Chart.js Bar Chart"
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }

                    var ctx = document.getElementById("canvas3").getContext("2d");
                    window.myBar = new Chart(ctx, {
                        type: "bar",
                        data: barChartData,
                        options: {
                            plugins: {
                                title: {
                                    display: true,
                                    text: 'Ontime and Late Employee in a week'
                                }
                            }
                        }
                    });
                </script>
    </body>

    </html>
<?php } ?>