<?php

include '../config.php';

if(isset($_GET['id_buku'])){
    $id = $_GET['id_buku'];
    global $id;
    $hapus = delet("buku", "id_buku='$id'");
    header("location:buku.php");
}elseif(isset($_GET['nis'])){
    $id = $_GET['nis'];
    global $id;
    $hapus = delet("siswa", "nis='$id'");
    header("location:siswa.php");
}elseif(isset($_GET['nip'])){
    $id = $_GET['nip'];
    global $id;
    $hapus = delet("petugas", "nip='$id'");
    header("location:petugas.php");
}elseif(isset($_GET['id_kelas'])){
    $id = $_GET['id_kelas'];
    global $id;
    $hapus = delet("kelas", "id_kelas='$id'");
    header("location:kelas.php");
}

 ?>