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
                <h1 class="h2 mx-3">List of Employees</h1><br>


                <!--Fixed tab example -->
                <div class="card pmd-card" style="background-color: rgba(250,250,250, 0.4);border:none;">
                    <div class="pmd-tabs" style="font-size:20px;">
                        <ul role="tablist" class="nav nav-tabs nav-fill">
                            <li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab" role="tab" aria-controls="home" href="#home-fixed"><b>Staff</b></a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" role="tab" aria-controls="profile" href="#about-fixed"><b>Permanent Worker</b></a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" role="tab" aria-controls="messages" href="#work-fixed"><b>Casual Worker</b></a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="home-fixed">
                                <div class="row">

                                    <div class="col-sm-12">

                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Staff ID</th>
                                                        <th>First Name</th>
                                                        <th>Last Name</th>
                                                        <th>Gender</th>
                                                        <th>Email</th>
                                                        <th>Phone No.</th>
                                                        <th>Position</th>
                                                        <th>Salary</th>
                                                        <th>Monthly Attendance</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $query = mysqli_query($con, "select * from staff");
                                                    while ($row = mysqli_fetch_array($query)) {
                                                    ?>
                                                        <tr>
                                                            <td><?php echo  $row['staff_id']; ?></td>
                                                            <td><?php echo $row['firstname']; ?></td>
                                                            <td><?php echo $row['lastname']; ?></td>
                                                            <td><?php echo  $row['gender']; ?></td>
                                                            <td><?php echo  $row['email']; ?></td>
                                                            <td><?php echo  $row['phone']; ?></td>
                                                            <td><?php echo  $row['position']; ?></td>
                                                            <td><?php echo  $row['sal']; ?></td>
                                                            <td class="text-center"><a class="btn btn-info" href="Test.php?date=<?php echo date("Y-m-d"); ?>&sid=<?php echo $row['staff_id']; ?> ">View</a></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div role="tabpanel" class="tab-pane" id="about-fixed">
                                <div class="row">

                                    <div class="col-sm-12">

                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Permanent Worker ID</th>
                                                        <th>First Name</th>
                                                        <th>Last Name</th>
                                                        <th>Gender</th>
                                                        <th>Email</th>
                                                        <th>Phone No.</th>
                                                        <th>Position</th>
                                                        <th>Salary</th>
                                                        <th>Monthly Attendance</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $query = mysqli_query($con, "select * from p_worker");
                                                    while ($row = mysqli_fetch_array($query)) {
                                                    ?>
                                                        <tr>
                                                            <td><?php echo  $row['pw_id']; ?></td>
                                                            <td><?php echo $row['firstname']; ?></td>
                                                            <td><?php echo $row['lastname']; ?></td>
                                                            <td><?php echo  $row['gender']; ?></td>
                                                            <td><?php echo  $row['email']; ?></td>
                                                            <td><?php echo  $row['phone']; ?></td>
                                                            <td><?php echo  $row['position']; ?></td>
                                                            <td><?php echo  $row['sal']; ?></td>
                                                            <td class="text-center"><a class="btn btn-info" href="Test.php?date=<?php echo date("Y-m-d"); ?>&sid=<?php echo $row['pw_id']; ?> ">View</a></td>

                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>



                            </div>

                            <div role="tabpanel" class="tab-pane" id="work-fixed">
                                <div class="row">

                                    <div class="col-sm-12">

                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Casual Worker ID</th>
                                                        <th>First Name</th>
                                                        <th>Last Name</th>
                                                        <th>Gender</th>
                                                        <th>Email</th>
                                                        <th>Phone No.</th>
                                                        <th>Position</th>
                                                        <th>Salary</th>
                                                        <th>Shift</th>
                                                        <th>Monthly Attendance</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $query = mysqli_query($con, "select * from cs_worker");
                                                    while ($row = mysqli_fetch_array($query)) {
                                                    ?>
                                                        <tr>
                                                            <td><?php echo  $row['cs_id']; ?></td>
                                                            <td><?php echo $row['firstname']; ?></td>
                                                            <td><?php echo $row['lastname']; ?></td>
                                                            <td><?php echo  $row['gender']; ?></td>
                                                            <td><?php echo  $row['email']; ?></td>
                                                            <td><?php echo  $row['phone']; ?></td>
                                                            <td><?php echo  $row['position']; ?></td>
                                                            <td><?php echo  $row['sal']; ?></td>
                                                            <td> <?php if ($row['Shift'] == 'c_worker1') {
                                                                        echo "Shift 1";
                                                                    } else {
                                                                        echo "Shift 2";
                                                                    }
                                                                    ?></td>
                                                            <td class="text-center"><a class="btn btn-info" href="Test.php?date=<?php echo date("Y-m-d"); ?>&sid=<?php echo $row['cs_id']; ?> ">View</a></td>

                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
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