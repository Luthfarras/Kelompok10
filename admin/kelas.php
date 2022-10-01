<?php
include '../config.php';

if (isset($_POST['tambah'])) {
    $kelas = $_POST['kelas'];
  
    $kelas = cread('kelas', "('', '$kelas')");
    if ($kelas) {
      header("Location:kelas.php");
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
                        <div class="form-floating mb-2">
                            <input type="text" class="form-control" name="kelas" placeholder="kelas">
                            <label>Kelas</label>
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
                            <th>Kelas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                            $no=0;
                            $kelas = read('*', 'kelas', '');
                                    while($data = mysqli_fetch_assoc($kelas)){
                                    $no++;
                        ?>
                        <tr>
                            <th class="text-center" scope="row"><?=$no?></th>
                            <td><?=$data['nama_kelas']?></td>
                            <td class="text text-center">
                                <!-- Edit data -->
                                <button class="btn btn-polos p-1">
                                    <a class="text-warning" href="edit_kelas.php?id_kelas=<?= $data['id_kelas']; ?>">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                </button> |
                                <!-- Hapus data -->
                                <button class="btn btn-polos p-1">
                                    <a class="text-danger" href="hapus.php?id_kelas=<?= $data['id_kelas']; ?>"><i class="fa-solid fa-trash"></i></a>
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