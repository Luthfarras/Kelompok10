<?php
include '../config.php';

if (isset($_POST['tambah'])) {
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $kelamin = $_POST['kelamin'];
    $alamat = $_POST['alamat'];
    $password = $_POST['password'];
    $level = $_POST['level'];
    
    // $id_kelas = read('id_kelas', 'kelas', "WHERE nama_kelas='$kelas'");
    // $data = mysqli_fetch_assoc($id_kelas);
    // $id = $data['id_kelas'];
  
    $petugas = cread('petugas', "('$nip', '$nama', '$kelamin', '$alamat', '$password', '$level')");
    if ($petugas) {
      header("Location:petugas.php");
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
                            <input type="text" class="form-control" name="nip" placeholder="nip">
                            <label>NIP</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input type="text" class="form-control" name="nama" placeholder="nama">
                            <label>Nama</label>
                        </div>
                        <div class="form-floating mb-2">
                            <select class="form-control text-start" name="kelamin">
                                <option disabled selected>Pilih kelamin anda</option>
                                <option value="L">Laki-Laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                            <label>Jenis kelamin</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input type="text" class="form-control" name="alamat" placeholder="alamat">
                            <label>Alamat</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input type="text" class="form-control" name="password" placeholder="password">
                            <label>Password</label>
                        </div>
                        <div class="form-floating mb-2">
                            <select class="form-control text-start" name="level">
                                <option disabled selected>Pilih level</option>
                                <option value="admin">Admin</option>
                                <option value="Petugas">Petugas</option>
                            </select>
                            <label>Level</label>
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
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>Password</th>
                            <th>Level</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                            $no=0;
                            $petugas = read('*', 'petugas', '');
                                    while($data = mysqli_fetch_assoc($petugas)){
                                    $no++;
                        ?>
                        <tr>
                            <th class="text-center" scope="row"><?=$no?></th>
                            <td><?=$data['nip']?></td>
                            <td><?=$data['nama']?></td>
                            <td><?=$data['jenis_kelamin']?></td>
                            <td><?=$data['alamat']?></td>
                            <td><?=$data['password']?></td>
                            <td><?=$data['level']?></td>
                            <td class="text text-center">
                                <!-- Edit data -->
                                <button class="btn btn-polos p-1">
                                    <a class="text-warning" href="edit_petugas.php?nip=<?= $data['nip']; ?>">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                </button> |
                                <!-- Hapus data -->
                                <button class="btn btn-polos p-1">
                                    <a class="text-danger" href="hapus.php?nip=<?= $data['nip']; ?>"><i class="fa-solid fa-trash"></i></a>
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