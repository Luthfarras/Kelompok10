<?php
include '../config.php';
session_start();

// Pinjam buku
if (isset($_POST['cetak'])) {
        $id_peminjam = $_SESSION['id_peminjaman'];
        $id_buku = $_SESSION['id_buku'];
        $kuantitas = $_SESSION['kuantitas'];

        $tambah_detail = cread('detail_peminjaman', "('', '$id_buku', '$id_peminjam', '$kuantitas')");

    unset($_SESSION['id_peminjaman']);
    unset($_SESSION['id_buku']);
    unset($_SESSION['peminjam']);
    unset($_SESSION['kuantitas']);

header("location:peminjaman.php");
}
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
                <!-- inisiasi untuk detail -->
                <?php
                $peminjambuku = $_SESSION['peminjam'];
                $detail_peminjaman = read('*', 'peminjaman p join siswa s ON  s.nis = p.id_siswa JOIN kelas k ON s.id_kelas=k.id_kelas', "WHERE p.id_siswa='$peminjambuku'");
                $detail = mysqli_fetch_array($detail_peminjaman)
                ?>
                <div class="row">
                    <div class="col-md-6 col-12">
                        <h1>ID : <?=$_SESSION['id_peminjaman']?></h1>
                        <h6>NISN : <?=$detail['nis']?></h6>
                        <h6>Nama : <?=$detail['nama']?></h6>
                    </div>
                    <div class="col-md-6 col-12 mt-4">
                        <h6>Kelas : <?=$detail['nama_kelas']?></h6>
                        <h6>Tanggal Peminjaman : <?=$detail['tanggal_peminjaman']?></h6>
                        <h6>Tanggal Pengembalian : <?=$detail['tanggal_pengembalian']?></h6>
                    </div>
                </div>
                <!-- tabel buku cekout -->
                <table class="table table-sm table-hover table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>No</th>
                            <th style="width: 50%;">Cover</th>
                            <th style="width: 20%;">Judul</th>
                            <th style="width: 20%;">Qty</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                            $no=0;
                            $peminjambuku = $_SESSION['peminjam'];
                            $id_buku = $_SESSION['id_buku'];
                            $detail_peminjaman = read('*', 'buku ', "WHERE id_buku='$id_buku'");
                                    while($data = mysqli_fetch_array($detail_peminjaman)){
                                    $no++;
                        ?>
                        <tr>
                            <th class="text-center" scope="row"><?=$no?></th>
                            <td class="text-center">
                                <img class="img-thumbnail" src="../assets/img/<?=$data['cover']?>" style="width: 40%;">
                            </td>
                            <td><?=$data['judul']?></td>
                            <td><?=$_SESSION['kuantitas']?></td>
                        </tr>
                        <?php
                    }
                        ?>
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                    <form method="POST">
                        <input class="btn btn-success mb-3" type="submit" name="cetak" value="Cetak Bukti">
                    </form>
                </div>
            </div>
        </div>
        <!-- Lanjutan dari nave -->
    </div>
</div>
</body>
</html>