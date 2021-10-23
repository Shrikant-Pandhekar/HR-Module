<?php
define('DB_SERVER', 'localhost');
define('DB_USER', 'shrikant_hrmodul');
define('DB_PASS' , 'AiEHi+,Vk(bE');
define('DB_NAME', 'hrmodule1');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);


if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
