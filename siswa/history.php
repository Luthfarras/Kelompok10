//azzam menambah history
<?php
include '../config.php';
session_start();
// $id = $_SESSION['nis'];
// echo $id;
// Tambah buku
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
</head>
<body>
    <?php include 'nav.php'?>
        <div class="container">
            <div class="container pt-4 m-auto">
                <!-- tabel -->
                <table class="table table-sm table-hover table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>No</th>
                            <th>Cover</th>
                            <th>Judul</th>
                            <th>ID Peminjaman</th>
                            <th>Tanggal Pengembalian</th>
                            <!-- <th>Denda</th> -->
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                                <?php
                                    $no=0;
                                    $id = $_SESSION['nis'];
                                    // history tinggal merubah di sql history
                                    $history = mysqli_query($conn, "SELECT * From buku b join detail_peminjaman p ON b.id_buku = p.id_buku JOIN peminjaman j ON p.id_peminjaman=j.id_peminjaman WHERE j.id_siswa = '$id'");
                                    while($data = mysqli_fetch_assoc($history)){
                                    mysqli_query($conn, "SELECT * From buku b join detail_peminjaman p ON b.id_buku = p.id_buku JOIN peminjaman j ON p.id_peminjaman=j.id_peminjaman WHERE j.id_siswa = '$id'") or die(mysqli_error());
                                    $no++;
                        ?>
                        <tr>
                            <td class="text-center" scope="row"><?=$no?></td>
                            <td>
                              <img class="img-thumbnail" src="../assets/img/<?=$data['cover']?>" style="width: 50px;">
                            </td>
                            <td><?=$data['judul']?></td>
                            <td><?=$data['id_peminjaman']?></td>
                            <td><?=$data['tanggal_pengembalian']?></td>
                            <td>
                                <?php
                                    $q1 = mysqli_query($conn, "SELECT * FROM peminjaman");

                                    $date = date('Y-m-d');
                                    // echo $date;
                                    $tgl = mysqli_fetch_assoc($q1);
                                    $tgl_k = strtotime($tgl['tanggal_pengembalian']);
                                    $tgl_s = strtotime($date);
                                    // belum bisa jalan statusnya
                                    if ($tgl_s > $tgl_k) {
                                        echo "dipinjam";
                                    } else{
                                        echo "telat";
                                    }
                                ?>
                            </td>
                        </tr>
                        <?php

                                    }
                                ?>
                            </tbody>
                          </table>
            </div>
        </div>
        <!-- Lanjutan dari nave -->
    </div>
</div>
</body>
</html>
