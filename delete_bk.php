<?php
include 'config.php';
$id = $_GET['id_buku'];
mysqli_query($conn, "DELETE FROM buku WHERE id_buku='$id'");
header("location:data_bk.php");
 ?>
