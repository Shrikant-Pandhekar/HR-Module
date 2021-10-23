<?php
// require("../connect.php");
function isfirst($con)
{
    $month = date('m');
    $year = date('Y');
    $d = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    $first = true;
    for ($i = 1; $i <= $d; $i++) {
        $day = $i . "-" . $month . "-" . $year;
        $query = "SELECT * FROM dummy_data WHERE date= '$day'";
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) > 0) {
            $first = false;
            break;
        }
    }
    return $first;
}

function checkifLate($eid, $con, $time)
{
    $date = date('Y-m-d');
    // echo $date;
    $query = "SELECT time FROM dummy_data WHERE emp_id= '$eid' AND date='$date'";
    $result = mysqli_query($con, $query);
    $total_rows = mysqli_num_rows($result);
    $emp_type = "";
    if ($eid[0] == 'S') {
        $emp_type = "staff";
    } elseif ($eid[0] == 'P') {
        $emp_type = "p_worker";
    } else {
        $emp_type = "c_worker";
    }
    // echo $emp_type;
    // echo $total_rows;
    if ($total_rows % 2 == 0) {
        $query = "SELECT start_time,buffer_time FROM emp_shifttime WHERE emp_type = '$emp_type'";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);
        $start_time = new DateTime($row["start_time"]);
        $buffer_time = $row["buffer_time"];
        $time = new DateTime($time);
        $diff = $time->diff($start_time);
        $diff = floatval($diff->format("%i"));
        if (isfirst($con)) {
            mysqli_query($con, "UPDATE staff SET isLate = 0 where staff_id='$eid'");
        }
        if ($diff > $buffer_time) {
            $query1 = mysqli_query($con, "SELECT * FROM staff WHERE staff_id='$eid'");
            while ($row1 = mysqli_fetch_assoc($query1)) {
                $isl = $row1["isLate"];
                $overlate = $row1["leaves"];
            }
            if ($isl >= 3) {
                $overlate = $overlate + 1;
                $query2 = mysqli_query($con, "UPDATE staff SET leaves = '$overlate' where staff_id='$eid'");
            } else {
                $isl = $isl + 1;
                $query = mysqli_query($con, "UPDATE staff SET isLate = '$isl' where staff_id='$eid'");
            }
        } else {
            echo "not late<br>";
        }
    }
}
 

// checkifLate('S730', $con, '07:08:00');
