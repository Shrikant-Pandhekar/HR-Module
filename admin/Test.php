 <?php
    include('connect.php');
    if (isset($_POST['submit'])) {
        $shift = $_POST["shift"];
        $n1 = $_POST["cid"];
        $phone = $_POST["phone"];

        // if ($shift == 'c_worker1') {
        //     $new_shift = "Shift2";
        //     $old_shift = "Shift1";
        // } else if ($shift == 'c_worker2') {
        //     $new_shift = "Shift1";
        //     $old_shift = "Shift2";
        // }
        // $msg = "Your shift is changed from " . $old_shift . " To " . $new_shift;
        // //echo $msg;
        // $fields = array(
        //     "sender_id" => "TXTIND",
        //     "message" => $msg,
        //     "route" => "v3",
        //     "numbers" => $phone,
        // );

        // $curl = curl_init();

        // curl_setopt_array($curl, array(
        //     CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => "",
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 30,
        //     CURLOPT_SSL_VERIFYHOST => 0,
        //     CURLOPT_SSL_VERIFYPEER => 0,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => "POST",
        //     CURLOPT_POSTFIELDS => json_encode($fields),
        //     CURLOPT_HTTPHEADER => array(
        //         "authorization: 2NMJw8nqxIvtzB14KVymdF0HDLafE3cWk5jS7OPRXo6UrligCh5jsmt1B7MhxaREgVYHFcdPK8vN2o0u",
        //         "accept: */*",
        //         "cache-control: no-cache",
        //         "content-type: application/json"
        //     ),
        // ));

        // $response = curl_exec($curl);
        // $err = curl_error($curl);

        // curl_close($curl);

        // if ($err) {
        //     echo "cURL Error #:" . $err;
        // } else {
        //     // echo $response;
        // }

        $updatequery = "UPDATE cs_worker SET  Shift='$shift' WHERE cs_id='$n1'";
        if (mysqli_query($con, $updatequery)) {
            // echo '<meta http-equiv="refresh" content="0; URL=listcs.php">';
            echo "<script> alert(' Profile Successfully Updated !!');</script>";
        } else {
            echo "error" . $updatequery . "<br>" . mysqli_error($con);
        }
    }
    ?>

 <!DOCTYPE html>
 <html>

 <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">

     <title>HR Module | Change Shift Workers</title>

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

 <body style="overflow: hidden;">
     <div class="wrapper">
         <!-- Sidebar  -->

         <!-- Page Content  -->
         <div id="content" style="width:100%">


             <h1 class="h2 mx-3">List of Casual Workers</h1><br>

             <div class="row">

                 <div class="col-sm-10">
                     <form action="" method="post" enctype="multipart/form-data">
                         <div class="table-responsive">
                             <table class="table">
                                 <thead>
                                     <tr>
                                         <th>Casual Worker ID</th>
                                         <th>First Name</th>
                                         <th>Last Name</th>
                                         <th>Phone No.</th>
                                         <th>Shift</th>
                                         <th colspan="2" class="text-center">Change Shift</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <?php
                                        $query = mysqli_query($con, "select * from cs_worker");
                                        while ($row = mysqli_fetch_array($query)) {
                                            $fname = $row["firstname"];
                                            $lname = $row["lastname"];
                                            $id = $row['cs_id'];
                                            $phone = $row["phone"];
                                            $Shift = $row["Shift"];
                                        ?>
                                         <tr>
                                             <form action="" method="post" enctype="multipart/form-data">
                                                 <td><input type="text" class="form-control" readonly name="cid" value="<?php echo  "$id" ?>"></td>
                                                 <td><input type="text" class="form-control" readonly name="fname" value="<?php echo "$fname" ?>"></td>
                                                 <td><input type="text" class="form-control" readonly name="lname" value="<?php echo "$lname" ?>"></td>
                                                 <td><input type="text" class="form-control" readonly name="phone" value="<?php echo  "$phone" ?>"></td>
                                                 <td><?php if ($row['Shift'] == 'c_worker1') {
                                                            echo "Shift 1";
                                                        } else if ($row['Shift'] == 'c_worker2') {
                                                            echo "Shift 2";
                                                        }
                                                        ?></td>
                                                 <td>
                                                     <select class=" form-control" name="shift">
                                                         <option value="c_worker1" <?php if ($Shift == 'c_worker1') echo ' selected="selected"'; ?>>
                                                             Shift 1
                                                         </option>
                                                         <option value="c_worker2" <?php if ($Shift == 'c_worker2') echo ' selected="selected"'; ?>>
                                                             Shift 2
                                                         </option>
                                                     </select>
                                                 </td>
                                                 <td>
                                                     <button class="btn btn-primary btn-send pt-2 btn-block btn--radius-2  " name="submit" type="submit">Change</button>
                                                 </td>
                                             </form>
                                         </tr>
                                     <?php } ?>
                                 </tbody>
                             </table>
                         </div>
                     </form>
                 </div>

                 <div class="col-sm-2">
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


 </body>

 </html>