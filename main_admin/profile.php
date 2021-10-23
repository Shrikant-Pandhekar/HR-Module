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

        <title>HR Module | Profile</title>

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
                <h1 class="h2 mx-3">Edit Profile</h1><br>

                <br>
                <?php
                if (isset($_GET["id"]) && !empty($_GET["id"])) {
                    $n1 = $_GET["id"];
                    $Query = "SELECT * from admin WHERE admin_id='$n1'";
                    $result = mysqli_query($con, $Query);
                    if (mysqli_num_rows($result) > 0) {

                        while ($row = mysqli_fetch_assoc($result)) {

                            $fname = $row["firstname"];
                            $lname = $row["lastname"];
                            $sal = $row["sal"];
                            $position = $row["position"];
                            $email = $row["email"];
                            $photo = $row["photo"];
                            $phone = $row["phone"];
                        }
                    }
                }

                //mysqli_close($conn);

                ?>
                <div class="row">
                    <div class="col-sm-2">
                    </div>
                    <div class="col-sm-8">

                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Firstname</label>
                                    <input type="text" class="form-control" name="firstname" value="<?php echo "$fname"; ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Lastname</label>
                                    <input type="text" class="form-control" name="lastname" value="<?php echo "$lname"; ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail1">Phone No.</label>
                                    <input type="text" class="form-control" name="phone" value="<?php echo "$phone"; ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword2">Email</label>
                                    <input type="email" class="form-control" name="email" value="<?php echo "$email"; ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail8">Position</label>
                                    <input type="text" class="form-control" name="position" value="<?php echo "$position"; ?>">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputPassword9">Salary</label>
                                    <input type="text" class="form-control" name="sal" value="<?php echo "$sal"; ?>">
                                    <input type="hidden" name="idup" value="<?php echo $n1; ?>">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputPassword9">User Photo</label>
                                    <?php
                                    if ($photo == "") :
                                    ?>
                                        <img src="Asset\img.png" width="256" height="256" alt="Photo Size Is More Than 2MB Can't Be Displayed">
                                    <?php else : ?>
                                        <img src="profilePhoto\<?php echo htmlentities($photo); ?>" width="256" height="256" alt="Photo Size Is More Than 2MB Can't Be Displayed">

                                    <?php endif; ?>
                                    <input type="file" accept=".jpg, .jpeg, .png, .gif, .JPG, .PNG" name="image" />
                                </div>
                            </div>



                            <button type="submit" class="btn btn-primary" name="btn" value="submit">Submit</button>
                        </form>
                    </div>
                    <div class="col-sm-2">
                    </div>

                </div>
                <?php
                //$lbl=$_GET["btn"];
                // $n1=$_GET["edit"];
                if (isset($_POST["btn"])) {
                    $fn = $_POST["firstname"];
                    $ln = $_POST["lastname"];
                    $sal = $_POST["sal"];
                    $position = $_POST["position"];
                    $email = $_POST["email"];
                    $phone = $_POST["phone"];
                    $n1 = $_POST["idup"];
                    $imgfile = $_FILES["image"]["name"];

                    $imgnewfile = ($imgfile);




                    move_uploaded_file($_FILES["image"]["tmp_name"], "profilePhoto/" . $imgnewfile);
                    $updatequery = "UPDATE admin SET firstname='$fn',lastname='$ln',email='$email',phone='$phone',
                position='$position',sal='$sal', photo='$imgnewfile' WHERE admin_id='$n1'";
                    if (mysqli_query($con, $updatequery)) {
                        echo '<meta http-equiv="refresh" content="0; URL=listadmin.php">';
                        echo "<script> alert(' Profile Successfully Updated !!');</script>";
                    } else {
                        echo "error" . $updatequery . "<br>" . mysqli_error($con);
                    }
                }
                ?>


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