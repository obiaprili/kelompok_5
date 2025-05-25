<?php
$con = mysqli_connect("localhost","root","","kelompok_5");

// Check connection
if (mysqli_connect_error()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}
?>