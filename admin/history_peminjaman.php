<?php
include '../config.php';
// session_start();
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
                            <th>ID Peminjaman</th>
                            <th>Peminjam</th>
                            <th>Judul</th>
                            <th>Cover</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                            $no=0;
                            $id = $_SESSION['nip'];
                            // history tinggal merubah di sql history
                            $history = read('a.id_peminjaman, c.nama, d.judul, d.cover', 'peminjaman a JOIN detail_peminjaman b ON a.id_peminjaman=b.id_peminjaman JOIN siswa c ON c.nis=a.id_siswa JOIN buku d ON d.id_buku=b.id_buku', "");
                                    while($data = mysqli_fetch_array($history)){
                                    $no++;

                        ?>
                        <tr>
                            <th class="text-center" scope="row"><?=$no?></th>
                            <td><?=$data['id_peminjaman']?></td>
                            <td><?=$data['nama']?></td>
                            <td><?=$data['judul']?></td>
                            <td class="text-center" style="width:10%;">
                                <img class="img-thumbnail" src="../assets/img/<?=$data['cover']?>" style="max-width: 90%;">
                            </td>
                            <?php
                            ?>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <?php
                                    $status = mysqli_fetch_assoc(read('id_peminjaman', 'pengembalian', ''));
                                    $s = $status['id_peminjaman'];
                                    $d = $data['id_peminjaman'];
                                    if($s == $d){
                                        echo "<div class='btn btn-sm btn-danger'>Sudah Kembali</div>";
                                    }else{
                                        echo "<div class='btn btn-sm btn-primary'>Dipinjam</div>";
                                    }

                                    ?>
                                </div>
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