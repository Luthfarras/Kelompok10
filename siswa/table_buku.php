<?php
include '../config.php';
session_start();
// Pinjam buku
if (isset($_POST['pinjam'])) {
    $nis = $_SESSION['nis'];
    $pinjam = $_POST['tgl'];
    $kembali = $_POST['kembali'];
    $buku = $_POST['buku'];

    $id_buku = read('id_buku', 'buku', "WHERE judul='$buku'");
    $ambil= mysqli_fetch_assoc($id_buku);
    $id = $ambil['id_buku'];
    
    $peminjaman = cread("peminjaman", "('', '$nis', NULL, '$pinjam', '$kembali', '$id')");
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
                            <th>Sinopsis</th>
                            <th>Pinjam</th>
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
                            <td class="text-center">
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
                            </td>
                            <td class="text text-center">
                                <!-- Tombol pinjam -->
                                <button class="btn btn-polos p-1" data-bs-toggle="modal" data-bs-target="#pinjam">
                                        <a class="text-success" href="#">
                                            <i class="fa-solid fa-right-to-bracket"></i>
                                        </a>
                                </button>
                                <div class="modal fade text-start" id="pinjam" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Pinjam Buku</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" >
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="nis" placeholder="nis" value="<?=$_SESSION['nis']?>">
                                                <label>ID Peminjam</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="date" class="form-control" name="tgl" placeholder="tgl">
                                                <label>Tanggal Meminjam</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="date" class="form-control" name="kembali" placeholder="kembali">
                                                <label>Tanggal Mengembalikan</label>
                                            </div>
                                            <div class="form-floating mb-2">
                                                <select class="form-control text-start" name="buku" id="buku">
                                                    <option disabled selected>Pilih Buku</option>
                                                    <?php
                                                    $result = read('judul', 'buku', '');
                                                    while ($book = mysqli_fetch_assoc($result)) {
                                                    ?>
                                                    <option class="form-control text-dark" value="<?php echo $book['judul']?>"><?= $book['judul'] ?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                                <label>Buku</label>
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <input class="btn btn-success" type="submit" name="pinjam" value="Pinjam">
                                            </div>
                                            </form>
                                        </div>
                                        </div>
                                    </div>
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