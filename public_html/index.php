<?php
$servername = "db";
$username = "admin";
$password = "1234";
$dbhandle = mysqli_connect($servername, $username, $password);
$selected = mysqli_select_db($dbhandle, "sample_db");

echo "Connected database server<br>";
echo "Selected database";
?>