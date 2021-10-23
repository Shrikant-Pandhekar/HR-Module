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

    <title>HR Module | Salary</title>

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
            <h1 class="h2 mx-3">Salary Calculation</h1><br>


            <div class="info">
                <div>
                    <div class="container">


                        <div class="row">

                            <div class="col-sm-12 col-md-12 col-lg-5">
                                <form action="" method="post" id="my-form1">
                                    <div class="form-group"><br><br>
                                        <label for="name">Employee ID:</label>
                                        <input type="text" class="form-control" id="langname"
                                            placeholder="Enter Employee ID" name="sid">
                                    </div>
                                    <button type="submit" class="btn btn-primary align-right" name="btn"
                                        value="check">Check</button>

                                </form>
                                <pre id="result"></pre>
                                <?php
                                            if (isset($_POST["sid"]) && !empty($_POST["sid"]))
                                            {                            
                                                $lbl = $_POST["btn"];
                                            if ($lbl == "check") {
                                                $id = $_POST['sid'];
                                                $selectQuery = "Select * from staff where staff_id = '$id'";
                                                $result = mysqli_query($con, $selectQuery);
                                                if (mysqli_num_rows($result) == 1) {
                                                    if ($row1 = mysqli_fetch_assoc($result)) {
                                                    
                                                        $userphoto=$row1['photo'];
                                                        $_SESSION['id']=$_POST['sid'];

                                                    }
                                                }
                                                ?>

                                <hr>
                                <div class="card" style="width: 100%;">
                                    <div class="card-body">
                                        <h4 class="card-title">Employee Details</h4>
                                        <p>
                                            <?php
                                            if($userphoto==""):
                                            ?>
                                            <img src="asset/img.png" width="100" height="100"
                                                alt="Photo Size Is More Than 2MB Can't Be Displayed">
                                            <h5>NO DATA FOUND</h5>
                                            <?php else:?>
                                            <img src="profilePhoto/<?php echo htmlentities($userphoto);?>" width="100"
                                                height="100" style="border-radius : 50px; align:center"
                                                alt="Photo Size Is More Than 2MB Can't Be Displayed">
                                                </p><br><br>
                                        <h5 class="card-subtitle mb-2 text-muted">First name:
                                            <?php echo $row1['firstname']; ?></h5>
                                        <h5 class="card-subtitle mb-2 text-muted">Last name:
                                            <?php echo $row1['lastname']; ?></h5>
                                        <h5 class="card-subtitle mb-2 text-muted">Address:
                                            <?php echo $row1['address']; ?></h5>
                                        <h5 class="card-subtitle mb-2 text-muted">Date of Birth:
                                            <?php echo $row1['dob']; ?></h5>
                                        <h5 class="card-subtitle mb-2 text-muted">Contact number:
                                            <?php echo $row1['phone']; ?></h5>
                                        <h5 class="card-subtitle mb-2 text-muted">Email: <?php echo $row1['email']; ?>
                                        </h5>
                                        <h5 class="card-subtitle mb-2 text-muted">Desgination:
                                            <?php echo $row1['position']; ?></h5>
                                        <h5 class="card-subtitle mb-2 text-muted">Salary: <?php echo $row1['sal']; ?>
                                        </h5>

                                           

                                        
                                    </div>
                                </div>


                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-5">
                                <form action="" method="post" id="my-form">
                                    <div class="form-group"><br><br>
                                        <label for="name">Salary:</label>
                                        <input type="text" class="form-control" id="langname" readonly
                                            placeholder="Enter Salary" name="salary" value=<?php echo $row1['sal']; ?>>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">PF Percentage:</label>
                                        <input type="text" class="form-control" id="langname"
                                            placeholder="Enter PF Percentage" name="pf" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary align-right" name="btnn"
                                        value="calc">Calculate</button>
                                        <?php endif;?>
                                </form>
                                <?php
                                    }
                                }
                
                            ?>
                                <pre id="result"></pre>
                                <?php
                            if (isset($_POST["btnn"]) && !empty($_POST["btnn"])) {
                                $id1 = $_SESSION['id'];
                                $sal = $_POST["salary"];
                                $_SESSION['sal'] = $sal;
                                $pf = $_POST["pf"];
                                $_SESSION['pf'] = $pf;
                                $ded = ($pf / 100) * $sal;
                                $netsal = $sal - $ded;
                                $_SESSION['netsal'] = $netsal;
                                // $insertQuery = "INSERT INTO staffsalary(staff_id,salary,pfpercent,netsal) VALUES ('$id1','$sal','$pf','$netsal')";
                                // if (mysqli_query($con, $insertQuery)) {
                                //     ?>

                            </div>
                            <div class="col-sm-1 col-md-1 col-lg-1">
                            </div>


                        </div>

                        <div class="row">

                            <div class="col-12 col-md-12 col-lg-12 table-responsive">
                                <h4>Salary Details</h4>
                                <table class="table table-bordered">
                                    <?php
                        $id = $_SESSION['id'];
                                                $selectQuery = "Select * from staff where staff_id = '$id'";
                                                $result = mysqli_query($con, $selectQuery);
                                                if (mysqli_num_rows($result) == 1) {
                                                    if ($row1 = mysqli_fetch_assoc($result)) {
                                                        $fname=$row1['firstname'];
                                                        $lname=$row1['lastname'];
                                                        $email=$row1['email'];
                                                        $position=$row1['position'];
                                                          
                        $sal=$_SESSION['sal'];
                        $pf=$_SESSION['pf'];
                        $netsal=$_SESSION['netsal'];
                        ?>
                                    <thead>
                                        <tr>
                                            <th>First name</th>
                                            <th>Last name</th>
                                            <th>Email</th>
                                            <th>Position</th>
                                            <th>Salary</th>
                                            <th>PF Percentage</th>
                                            <th>Net Salary</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $fname; ?></td>
                                            <td><?php echo $lname; ?></td>
                                            <td><?php echo $email; ?></td>
                                            <td><?php echo $position; ?></td>
                                            <td><?php echo $sal; ?></td>
                                            <td><?php echo $pf; ?></td>
                                            <td><?php echo $netsal; ?></td>
                                        </tr>
                                    </tbody><br>
                                    <?php
                                                    }
                                                }
                                                ?>
                                </table>
                            </div>
                            <?php
                //} 
                // else {
                //     echo "error" . $insertQuery . "<br>" . mysqli_error($con);
                // }
            }
            ?>
                        </div>
                    </div>

                </div>
                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
                    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
                    crossorigin="anonymous">
                </script>
                <!-- Popper.JS -->
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
                    integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
                    crossorigin="anonymous">
                </script>
                <!-- Bootstrap JS -->
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
                    integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
                    crossorigin="anonymous">
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