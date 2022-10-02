<?php
include 'config.php';
$id = $_GET['nis'];
mysqli_query($conn, "DELETE FROM siswa WHERE nis='$id'");
header("location:data_sw.php");
 ?>
