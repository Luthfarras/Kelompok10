<?php
include '../config.php';
session_start();
// Pinjam buku
if (isset($_POST['pinjam'])) {
    $pinjam = $_POST['tgl'];
    $kembali = $_POST['kembali'];
    $buku = $_POST['buku'];
    $peminjam = $_POST['peminjam'];
    $petugas = $_SESSION['nip'];


    $id_peminjam = read('nis', 'siswa', "WHERE nama='$peminjam'");
    $result= mysqli_fetch_assoc($id_peminjam);
    $id_sis = $result['nis'];

    $id_buku = read('id_buku', 'buku', "WHERE judul='$buku'");
    $ambil= mysqli_fetch_assoc($id_buku);
    $id_buk = $ambil['id_buku'];
    
    $peminjaman = cread("peminjaman", "('', '$id_sis', '$petugas', '$pinjam', '$kembali')");

    $cetak = mysqli_fetch_assoc(read('*', 'peminjaman', "WHERE id_siswa='$id_sis'" ));

    if($cetak){
        $_SESSION['id_buku'] = $id_buk;
        $_SESSION['id_peminjaman'] = $cetak['id_peminjaman'];
        $_SESSION['peminjam'] = $cetak['id_siswa'];
        $_SESSION['kuantitas'] = $_POST['kuantitas'];
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
                <button class="btn btn-success mb-3">
                    <a class="text-light" href="detail_pinjam.php"><i class="fa-solid fa-ticket"></i> List pinjaman</a>
                </button>
                <!-- tabel -->
                <table class="table table-sm table-hover table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>No</th>
                            <th style="width: 50%;">Cover</th>
                            <th style="width: 20%;">Judul</th>
                            <th style="width: 15%;">Pinjam</th>
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
                            <td class="text-center">
                                <img class="img-thumbnail" src="../assets/img/<?=$data['cover']?>" style="width: 40%;">
                            </td>
                            <td><?=$data['judul']?></td>
                            <td class="text text-center">
                                <!-- Tombol pinjam -->
                                <button class="btn btn-primary ps-3 pe-3 btn-bulat" data-bs-toggle="modal" data-bs-target="#pinjam">
                                    Pinjam
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
                                            <div class="form-floating mb-2">
                                                <select class="form-control text-start" name="peminjam" id="peminjam">
                                                    <option disabled selected>Pilih Peminjam</option>
                                                    <?php
                                                    $result = read('nama', 'siswa', '');
                                                    while ($siswa = mysqli_fetch_assoc($result)) {
                                                    ?>
                                                    <option class="form-control text-dark" value="<?php echo $siswa['nama']?>"><?= $siswa['nama'] ?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                                <label>Buku</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="date" class="form-control" name="tgl" placeholder="tgl">
                                                <label>Tanggal Meminjam</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="date" class="form-control" name="kembali" placeholder="kembali">
                                                <label>Tanggal Mengembalikan</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="kuantitas" placeholder="kuantitas">
                                                <label>Kuantitas</label>
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