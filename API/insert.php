<?php 
require('connect.php');
require('checkLate.php');

$password = $_POST['password'];
$eid = $_POST['eid'];
$date = $_POST['date'];
$time = $_POST['time'];


if($password == 'vatantexttile@2021')
{
     checkifLate($eid, $con, $time);
     $query=mysqli_query($con,"insert into dummy_data (emp_id, date, time) values ('$eid', '$date', '$time')");
     if($query)
     {
         echo "done";
        
     }
     else
     {
         echo "failed";
     }
}
