<?php
include '../config.php';

if (isset($_POST['tambah'])) {
    $nisn = $_POST['nisn'];
    $nama = $_POST['nama'];
    $kelamin = $_POST['kelamin'];
    $alamat = $_POST['alamat'];
    $kelas = $_POST['kelas'];

    $id_kelas = read('id_kelas', 'kelas', "WHERE nama_kelas='$kelas'");
    $data = mysqli_fetch_assoc($id_kelas);
    $id = $data['id_kelas'];

    $siswa = cread('siswa', "('$nisn', '$nama', '$kelamin', '$alamat', '$id')");
    if ($siswa) {
      header("Location:siswa.php");
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
</head>
<body>
<?php include 'nav.php'?>
        <div class="container">
            <div class="container pt-4 m-auto">
                <!-- Tambah data -->
                <button class="btn btn-sm btn-success mb-3" data-bs-toggle="modal" data-bs-target="#tambah">Tambah +</button>
                <form class="d-flex input-group mb-2" role="search" method="get" action="cari_siswa.php">
                    <input class="form-control" type="search" placeholder="Cari Siswa" aria-label="Search" name="search">
                    <button class="btn btn-dark" type="search"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
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
                            <input type="text" class="form-control" name="nisn" placeholder="nisn">
                            <label>NISN</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input type="text" class="form-control" name="nama" placeholder="penulis">
                            <label>Nama</label>
                        </div>
                        <div class="form-floating mb-2">
                            <!-- <input type="text" class="form-control" name="kelamin" placeholder="penerbit"> -->
                            <select class="form-control text-start" name="kelamin">
                                <option disabled selected>Pilih kelamin anda</option>
                                <option value="L">Laki-Laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                            <label>Jenis kelamin</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input type="text" class="form-control" name="alamat" placeholder="tahun">
                            <label>Alamat</label>
                        </div>
                        <div class="form-floating mb-2">
                            <select class="form-control text-start" name="kelas" id="kelas">
                                <option disabled selected>Pilih Kelas anda</option>
                                <?php
                                $result = read('nama_kelas', 'kelas', '');
                                while ($kelas = mysqli_fetch_assoc($result)) {
                                ?>
                                <option class="form-control text-dark" value="<?php echo $kelas['nama_kelas']?>"><?= $kelas['nama_kelas'] ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                            <label>Kelas</label>
                            <!-- <input type="text" class="form-control" name="kota" placeholder="kota"> -->
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
                            <th>NISN</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>Kelas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                            $no=0;
                            $siswa = read('s.nis, s.nama, s.jenis_kelamin, s.alamat, k.nama_kelas', 'siswa s JOIN kelas k ON s.id_kelas = k.id_kelas', '');
                            // $buku = read('*', 'buku', '');
                                    while($data = mysqli_fetch_assoc($siswa)){
                                    $no++;
                        ?>
                        <tr>
                            <th class="text-center" scope="row"><?=$no?></th>
                            <td><?=$data['nis']?></td>
                            <td><?=$data['nama']?></td>
                            <td><?=$data['jenis_kelamin']?></td>
                            <td><?=$data['alamat']?></td>
                            <td><?=$data['nama_kelas']?></td>
                            <td class="text text-center">
                                <!-- Edit data -->
                                <button class="btn btn-polos p-1">
                                    <a class="text-warning" href="edit_siswa.php?nis=<?= $data['nis']; ?>">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                </button> |
                                <!-- Hapus data -->
                                <button class="btn btn-polos p-1">
                                    <a class="text-danger" href="hapus.php?nis=<?= $data['nis']; ?>"><i class="fa-solid fa-trash"></i></a>
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
