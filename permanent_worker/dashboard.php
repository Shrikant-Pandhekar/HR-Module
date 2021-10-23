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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <!-- Our Custom CSS -->


        <!-- Font Awesome JS -->
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous">
        </script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <link rel="stylesheet" href="dashboard.css">

        <style>
            @media only screen and (max-width: 600px) {}
        </style>
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
                <div id="content">

                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar static-top shadow">
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

                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto ">

                            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                            <li class="nav-item dropdown no-arrow d-sm-none">
                                <a class="nav-link  " href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="height: 58px;">
                                    <i class="fas fa-search fa-fw mt-3 "></i>
                                </a>
                                <!-- Dropdown - Messages -->
                                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in mt-2  " aria-labelledby="searchDropdown">
                                    <form class="form-inline mr-auto mw-100 navbar-search" action="" method="post" id="my-form1">
                                        <div class="input-group">
                                            <input type="date" class="form-control " value="<?php echo date('Y-m-d'); ?>" id="date" name="date">
                                            <div class="input-group-append">
                                                <button type="submit" id="check" class="btn btn-primary align-right  " name="btn" value="check">
                                                    <i class="fas fa-search fa-sm"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </li>



                            <div class="topbar-divider d-none d-sm-block"></div>

                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link " href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="height: 58px;">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><b><?php echo $_SESSION['login']; ?></b></span>
                                    <img class="user mb-1 " src="https://img.icons8.com/bubbles/50/000000/user-male.png" />
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in mt-2" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Profile
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Settings
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Activity Log
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                </div>
                            </li>

                        </ul>

                    </nav>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid ">

                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4 ">
                            <h1 class="h3 mb-0 text-gray-800 mt-4 ">Dashboard</h1>
                        </div>

                        <?php
                        $chart_ontime = array("Mon" => 0, "Tue" => 0, "Wed" => 0, "Thu" => 0, "Fri" => 0, "Sat" => 0,);
                        $chart_late = array("Mon" => 0, "Tue" => 0, "Wed" => 0, "Thu" => 0, "Fri" => 0, "Sat" => 0,);


                        ?>

                        <?php

                        $date = $_POST["date"];
                        $day1 = date('D', strtotime($date));



                        do {
                            $islate = "";
                            $count_onTime = 0;
                            $count_late = 0;
                            $count_emp = 0;
                            $total_staff = 0;
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
                                    $total_staff += 1;
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


                                        $count_emp = $count_emp + 1;
                                        if (($time_array[0]) <= $staff_start_time) {
                                            //echo "On time"; 
                                            $count_onTime = $count_onTime + 1;
                                        } elseif (($time_array[0]) >= $staff_start_time) {
                                            // $islate = 'late';
                                            echo $islate;
                                            $count_late = $count_late + 1;
                                        }
                                        $day = date('D', strtotime($date));
                                    }
                                }
                            }


                            if ($day == 'Mon') {
                                $chart_ontime['Mon'] = $count_onTime;

                                $chart_late['Mon'] = $count_late;
                            } elseif ($day == 'Tue') {
                                $chart_ontime['Tue'] = $count_onTime;
                                $chart_late['Tue'] = $count_late;
                            } elseif ($day == 'Wed') {
                                $chart_ontime['Wed'] = $count_onTime;
                                $chart_late['Wed'] = $count_late;
                            } elseif ($day == 'Thu') {
                                $chart_ontime['Thu'] = $count_onTime;
                                $chart_late['Thu'] = $count_late;
                            } elseif ($day == 'Fri') {
                                $chart_ontime['Fri'] = $count_onTime;
                                $chart_late['Fri'] = $count_late;
                            } elseif ($day == 'Sat') {
                                $chart_ontime['Sat'] = $count_onTime;
                                $chart_late['Sat'] = $count_late;
                            }

                            $date = date('Y-m-d', strtotime($date . " -1 days"));
                            $day = date('D', strtotime($date));
                        } while ($day != 'Sun');

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

                        <!-- Content Row -->
                        <div class="row">

                            <!-- Area Chart -->
                            <div class="col-xl-9 col-lg-7">
                                <div class="card shadow mb-4">
                                    <!-- Card Header - Dropdown -->
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Bar Graph</h6>
                                        <div class="dropdown no-arrow">
                                            <a class="" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                                <div class="dropdown-header">Dropdown Header:</div>
                                                <a class="dropdown-item" href="#">Action</a>
                                                <a class="dropdown-item" href="#">Another action</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#">Something else here</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <div class="chart-area">
                                            <div id="chartContainer" style="height: 550px; width: 100%;"></div>
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
                                        <div class="dropdown no-arrow">
                                            <a class="" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                                <div class="dropdown-header">Dropdown Header:</div>
                                                <a class="dropdown-item" href="#">Action</a>
                                                <a class="dropdown-item" href="#">Another action</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#">Something else here</a>
                                            </div>
                                        </div>
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




                        <!-- /.container-fluid -->

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
                var xValues = ["Ontime", "Late"];
                var yValues = [<?php echo  $chart_ontime[$day1]; ?>, <?php echo  $chart_late[$day1]; ?>];
                var barColors = [
                    "#b91d47",
                    "#00aba9",
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
                window.onload = function() {

                    var chart = new CanvasJS.Chart("chartContainer", {
                        animationEnabled: true,
                        title: {
                            text: "Ontime and Late employee in a week"
                        },
                        axisY: {
                            title: "Ontime",
                            titleFontColor: "#4F81BC",
                            lineColor: "#4F81BC",
                            labelFontColor: "#4F81BC",
                            tickColor: "#4F81BC"
                        },
                        axisY2: {
                            title: "Late",
                            titleFontColor: "#C0504E",
                            lineColor: "#C0504E",
                            labelFontColor: "#C0504E",
                            tickColor: "#C0504E"
                        },
                        toolTip: {
                            shared: true
                        },
                        legend: {
                            cursor: "pointer",
                            itemclick: toggleDataSeries
                        },
                        data: [{
                                type: "column",
                                name: "Ontime",
                                legendText: "Ontime",
                                showInLegend: true,
                                dataPoints: [{
                                        label: "Mon",
                                        y: <?php echo $chart_ontime['Mon'] ?>
                                    },
                                    {
                                        label: "Tue",
                                        y: <?php echo $chart_ontime['Tue'] ?>
                                    },
                                    {
                                        label: "Wed",
                                        y: <?php echo $chart_ontime['Wed'] ?>
                                    },
                                    {
                                        label: "Thu",
                                        y: <?php echo $chart_ontime['Thu'] ?>
                                    },
                                    {
                                        label: "Fri",
                                        y: <?php echo $chart_ontime['Fri'] ?>
                                    },
                                    {
                                        label: "Sat",
                                        y: <?php echo $chart_ontime['Sat'] ?>
                                    }
                                ]
                            },
                            {
                                type: "column",
                                name: "Late",
                                legendText: "Late",
                                axisYType: "secondary",
                                showInLegend: true,
                                dataPoints: [{
                                        label: "Mon",
                                        y: <?php echo $chart_late['Mon'] ?>
                                    },
                                    {
                                        label: "Tue",
                                        y: <?php echo $chart_late['Tue'] ?>
                                    },
                                    {
                                        label: "Wed",
                                        y: <?php echo $chart_late['Wed'] ?>
                                    },
                                    {
                                        label: "Thu",
                                        y: <?php echo $chart_late['Thu'] ?>
                                    },
                                    {
                                        label: "Fri",
                                        y: <?php echo $chart_late['Fri'] ?>
                                    },
                                    {
                                        label: "Sat",
                                        y: <?php echo $chart_late['Sat'] ?>
                                    }
                                ]
                            }
                        ]
                    });
                    chart.render();

                    function toggleDataSeries(e) {
                        if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                            e.dataSeries.visible = false;
                        } else {
                            e.dataSeries.visible = true;
                        }
                        chart.render();
                    }

                }
            </script>

    </body>

    </html>
<?php } ?>