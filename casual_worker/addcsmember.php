<?php
session_start();
error_reporting(0);
include('connect.php');
if (strlen($_SESSION['login']) == 0) {
    header('location:login.html');
} else {
    if (isset($_POST['submit'])) {
        $firstname = $_POST['first_name'];
        $lastname = $_POST['last_name'];
        $address = $_POST['address'];
        $dob = $_POST['DOB'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $position = $_POST['position'];
        $sal = $_POST['sal'];
        $filename = $_FILES['photo']['name'];
        $shift = $_POST['id'];

        $imgnewfile = ($filename);


        //creating staffid
        $letters = 'C';
        $numbers = '';

        for ($i = 0; $i < 10; $i++) {
            $numbers .= $i;
        }
        $staff_id = $letters . substr(str_shuffle($numbers), 0, 3);



        move_uploaded_file($_FILES["photo"]["tmp_name"], "profilePhoto/" . $imgnewfile);
        $query = mysqli_query($con, "insert into cs_worker (cs_id, firstname, lastname, address, dob, gender, email, phone, position, sal, photo,Shift) values ('$staff_id', '$firstname', '$lastname', '$address', '$dob', '$gender', '$email' , '$phone' , '$position', '$sal', '$imgnewfile','$shift')");

        mysqli_query($con, $query);
        $last = mysqli_insert_id($con);
        $sid = mysqli_query($con, "SELECT cs_id FROM cs_worker where id='$last'");
        while ($row = mysqli_fetch_array($sid)) {
            echo '<script> alert("Casual Worker successfully inserted with cs id : "+"' . $row['cs_id'] . '")</script>';
        }
    }
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>HR Module | Add Casual Workers</title>

        <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <!-- Our Custom CSS -->
        <link rel="stylesheet" href="style.css">

        <!-- Font Awesome JS -->
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous">
        </script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous">
        </script>

        <style>
            .radio-container {
                display: inline-block;
                position: relative;
                padding-left: 30px;
                cursor: pointer;
                font-size: 16px;
                color: #666;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }

            .radio-container input {
                position: absolute;
                opacity: 0;
                cursor: pointer;
            }

            .radio-container input:checked~.checkmark {
                background-color: #e5e5e5;
            }

            .radio-container input:checked~.checkmark:after {
                display: block;
            }

            .radio-container .checkmark:after {
                top: 50%;
                left: 50%;
                -webkit-transform: translate(-50%, -50%);
                -moz-transform: translate(-50%, -50%);
                -ms-transform: translate(-50%, -50%);
                -o-transform: translate(-50%, -50%);
                transform: translate(-50%, -50%);
                width: 12px;
                height: 12px;
                -webkit-border-radius: 50%;
                -moz-border-radius: 50%;
                border-radius: 50%;
                background: #4272d7;
            }

            .checkmark {
                position: absolute;
                top: 50%;
                -webkit-transform: translateY(-50%);
                -moz-transform: translateY(-50%);
                -ms-transform: translateY(-50%);
                -o-transform: translateY(-50%);
                transform: translateY(-50%);
                left: 0;
                height: 20px;
                width: 20px;
                background-color: #e5e5e5;
                -webkit-border-radius: 50%;
                -moz-border-radius: 50%;
                border-radius: 50%;
                -webkit-box-shadow: inset 0px 1px 3px 0px rgba(0, 0, 0, 0.08);
                -moz-box-shadow: inset 0px 1px 3px 0px rgba(0, 0, 0, 0.08);
                box-shadow: inset 0px 1px 3px 0px rgba(0, 0, 0, 0.08);
            }

            .checkmark:after {
                content: "";
                position: absolute;
                display: none;
            }
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
                <h1 class="h2 mx-3">Add Casual Workers</h1><br>
                <div class="container">

                    <div class="row ">
                        <div class="col-lg-7 mx-auto">
                            <div class="card mt-2 mx-auto p-4 bg-light">
                                <div class="card-body bg-light">
                                    <div class="container">
                                        <form id="contact-form" role="form" method="post" enctype="multipart/form-data">
                                            <div class="controls">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="form_name">Firstname</label>
                                                            <input id="form_name" type="text" name="first_name" class="form-control" placeholder="Please enter your firstname" required="required" data-error="Firstname is required.">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="form_lastname">Lastname</label>
                                                            <input id="form_lastname" type="text" name="last_name" class="form-control" placeholder="Please enter your lastname" required="required" data-error="Lastname is required.">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="form_address">Address</label>
                                                            <input id="form_address" type="text" name="address" class="form-control" placeholder="Please enter address" required="required" data-error="Address is required.">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="form_dob">DOB</label>
                                                            <input id="form_dob" type="date" name="DOB" class="form-control" placeholder="Please enter DOB" required="required" data-error="DOB is required.">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="form_gender">Gender </label><br>
                                                            <label class="radio-container ">Male
                                                                <input type="radio" name="gender" value="Male">
                                                                <span class="checkmark"></span>
                                                            </label>
                                                            <label class="radio-container">Female
                                                                <input type="radio" name="gender" value="Female">
                                                                <span class="checkmark"></span>
                                                            </label>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="form_email">Email</label>
                                                            <input id="form_email" type="email" name="email" class="form-control" placeholder="Please enter your email" required="required" data-error="Email is required.">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="form_phone">Phone Number</label>
                                                            <input id="form_phone" type="text" name="phone" class="form-control" placeholder="Please enter phone number" required="required" data-error="Phone Number is required.">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="form_position">Position</label>
                                                            <input id="form_name" type="text" name="position" class="form-control" placeholder="Please enter position" required="required" data-error="Position is required.">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="form_salary">Salary</label>
                                                            <input id="form_lastname" type="text" name="sal" class="form-control" placeholder="Please enter salary" required="required" data-error="Salary is required.">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="form_salary">Shift</label>
                                                            <select class="form-control" name="id" id="id1" required>
                                                                <?php
                                                                $searchquery = "SELECT * FROM emp_shifttime WHERE emp_type = 'c_worker1' || emp_type = 'c_worker2'";
                                                                $result = mysqli_query($con, $searchquery);

                                                                if (mysqli_num_rows($result) > 0) {
                                                                    // output data of each row
                                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                                        $id = $row["start_time"];

                                                                        $id1 = $row["buffer_time"];
                                                                        $id2 = $row["end_time"];
                                                                        $id3 = $row["emp_type"];

                                                                ?>

                                                                        <option value="<?php echo $id3 ?>"> <?php echo $id . "-" . $id2; ?></option>
                                                                <?php
                                                                    }
                                                                } else {
                                                                    echo "0 results";
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="form_photo">Photo</label>
                                                            <input type="file" class="form-control-file" name="photo" accept=".jpg, .jpeg, .png, .gif, .JPG, .PNG" id="exampleFormControlFile1">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <button class="btn btn-primary btn-send pt-2 btn-block btn--radius-2  " name="submit" type="submit">Submit</button>

                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div> <!-- /.8 -->
                        </div> <!-- /.row-->
                    </div>
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