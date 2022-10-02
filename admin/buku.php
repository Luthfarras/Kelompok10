<?php
include '../config.php';
// Tambah buku
if (isset($_POST['tambah'])) {
  $judul = $_POST['judul'];
  $penulis = $_POST['penulis'];
  $penerbit = $_POST['penerbit'];
  $tahun = $_POST['tahun'];
  $kota = $_POST['kota'];
  $file = $_FILES['cover']['name'];
  $tmp_name = $_FILES['cover']['tmp_name'];
  $upload = move_uploaded_file($tmp_name, "../assets/img/" . $file);
  $sinopsis = $_POST['sinopsis'];
  $stok = $_POST['stok'];
  
  $tambahbuku = cread("buku", "('', '$judul', '$penulis', '$penerbit', '$tahun', '$kota', '$file', '$sinopsis', '$stok')");

  if ($tambahbuku) {
    header('location:buku.php');
  }
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
                <!-- Tambah data -->
                <button class="btn btn-sm btn-success mb-3" data-bs-toggle="modal" data-bs-target="#tambah">Tambah +</button>
                <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Buku</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" enctype="multipart/form-data">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="judul" placeholder="judul">
                            <label>Judul</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input type="text" class="form-control" name="penulis" placeholder="penulis">
                            <label>Penulis</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input type="text" class="form-control" name="penerbit" placeholder="penerbit">
                            <label>Penerbit</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input type="text" class="form-control" name="tahun" placeholder="tahun">
                            <label>Tahun</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input type="text" class="form-control" name="kota" placeholder="kota">
                            <label>Kota</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input type="number" class="form-control" name="stok" placeholder="stok">
                            <label>Stok</label>
                        </div>
                        <div class="mb-2">
                            <input type="file" class="form-control" name="cover" placeholder="cover">
                        </div>
                        <div class="form-floating mb-2">
                            <textarea class="form-control" placeholder="sinopsis" name="sinopsis" style="height: 200px;"></textarea>
                            <label>Sinopsis</label>
                        </div>
                        <div class="d-flex justify-content-end">
                            <input class="btn btn-success" type="submit" name="tambah" value="Submit">
                        </div>
                        </form>
                    </div>
                    </div>
                </div>
                </div>
                <!-- tabel -->
                <table class="table table-sm table-hover table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th style="width:10%;">Cover</th>
                            <th style="width:20%;">Penulis</th>
                            <th style="width:10%;">Penerbit</th>
                            <th>Tahun</th>
                            <th>Kota</th>
                            <th>Stok</th>
                            <!-- <th>Sinopsis</th> -->
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                            $no=0;
                            $buku = read('*', 'buku', '');
                                    while($data = mysqli_fetch_array($buku)){
                                    $no++;
                        ?>
                        <tr>
                            <th class="text-center" scope="row"><?=$no?></th>
                            <td><?=$data['judul']?></td>
                            <td class="text-center" style="width:10%;">
                                <img class="img-thumbnail" src="../assets/img/<?=$data['cover']?>" style="max-width: 90%;">
                            </td>
                            <td style="width: 20%;"><?=$data['penulis']?></td>
                            <td style="width:10%;"><?=$data['penerbit']?></td>
                            <td><?=$data['tahun']?></td>
                            <td><?=$data['kota']?></td>
                            <td><?=$data['stok']?></td>
                            <!-- <td class="text-center">
                                <button type="button" class="btn btn-sm btn-polos" data-bs-toggle="modal" data-bs-target="#sinopsis"><small><i class="fa-solid fa-file-lines"></i> Sinopsis</small></button>
                                <div class="modal fade" id="sinopsis" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">SINOPSIS</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <?php
                                            echo $data['sinopsis'];
                                            ?>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </td> -->
                            <td class="text text-center">
                                <!-- Edit data -->
                                <button class="btn btn-polos p-1">
                                    <a class="text-primary" href="detail_buku.php?id_buku=<?= $data['id_buku']; ?>">
                                    <i class="fa-solid fa-circle-info"></i>
                                    </a>
                                </button> | 
                                <button class="btn btn-polos p-1">
                                    <a class="text-warning" href="edit_buku.php?id_buku=<?= $data['id_buku']; ?>">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                </button> |
                                <!-- Hapus data -->
                                <button class="btn btn-polos p-1">
                                    <a class="text-danger" href="hapus.php?id_buku=<?= $data['id_buku']; ?>">
                                    <i class="fa-solid fa-trash"></i>
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