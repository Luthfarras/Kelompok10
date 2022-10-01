<?php
$conn = mysqli_connect("localhost", "root", "", "perpus10");


function read($col, $tabel, $condisi){
    global $conn;
    $tampil = mysqli_query($conn, "SELECT $col FROM $tabel $condisi");
    return $tampil;
}
function cread($tabel,$value){
    global $conn;
    $buat = mysqli_query($conn, "INSERT INTO $tabel VALUES $value");
    return $buat;
}
function delet($tabel,$condisi){
    global $conn;
    $hapus = mysqli_query($conn, "DELETE FROM $tabel WHERE $condisi");
    return $hapus;
}
function update($tabel,$condisi){
    global $conn;
    $edit = mysqli_query($conn, "UPDATE $tabel SET $condisi");
    return $edit;
}

 ?>
