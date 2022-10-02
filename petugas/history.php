<?php
include '../config.php';
session_start();
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
                            <th>Judul</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Pengembalian</th>
                            <th>Nama</th>
                            <th>Tanggel Kembali</th>
                            <th>Denda</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                            $no=0;
                            $id = $_SESSION['nis'];
                            // history tinggal merubah di sql history
                            $history = read('b.judul, p.tanggal_peminjaman, p.tanggal_pengembalian, s.nama, n.tanggal_kembali, n.denda', 'buku b join peminjaman p ON b.id_buku = p.id_buku join siswa s ON s.nis = p.id_siswa JOIN pengembalian n ON p.id_peminjaman = n.id_peminjaman', "WHERE p.id_siswa='$id'");
                                    while($data = mysqli_fetch_array($history)){
                                    $no++;
                        ?>
                        <tr>
                            <th class="text-center" scope="row"><?=$no?></th>
                            <td><?=$data['judul']?></td>
                            <td><?=$data['tanggal_peminjaman']?></td>
                            <td><?=$data['tanggal_pengembalian']?></td>
                            <td><?=$data['nama']?></td>
                            <td><?=$data['tanggal_kembali']?></td>
                            <td><?=$data['denda']?></td>
                            <td class="text text-center">
                                <!-- aksi -->
                                <button class="btn btn-polos p-1">
                                    <a class="text-success" href="">
                                        <i class="fa-solid fa-right-to-bracket"></i>
                                    </a>
                                </button>
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