<?php
    session_start();
    error_reporting(0);
    include('connect.php');
    if(strlen($_SESSION['login'])==0)
    { 
    header('location:login.html');
    }
    else{
        if(isset($_GET["id"]) && !empty($_GET["id"]))
        {
            $id = $_GET["id"];
            $sql = "DELETE FROM staff WHERE staff_id='$id'";
            if (mysqli_query($con, $sql)) 
            {
                echo "Deleted";
            } 
            else 
            {
                echo "Error deleting record: " . mysqli_error($con);
            }
        }
        header("Location: listStaff.php");
    }
?>