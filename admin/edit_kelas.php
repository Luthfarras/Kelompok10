<?php
include '../config.php';
// Update
if(isset($_POST['update'])){
    $kelas = $_POST['kelas'];

    $nip = $_GET['nip'];
    $update = update("petugas", "nip='$nip', nama='$nama', jenis_kelamin='$kelamin', alamat='$alamat', password='$password', level='$level' WHERE nip='$nip'");

    if($update){
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
</head>
<body>
    <?php include 'nav.php'?>
        <div class="container">
            <div class="container pt-4 m-auto">
                <a class="btn btn-sm btn-success mb-3" href="kelas.php"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
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
                            $id_kelas = $_GET['id_kelas'];
                            $kelas = read('*', 'kelas', "WHERE id_kelas='$id_kelas'");
                                    while($data = mysqli_fetch_assoc($kelas)){
                                    $no++;
                        ?>
                        <tr>
                            <th class="text-center" scope="row"><?=$no?></th>
                            <td><?=$data['nama_kelas']?></td>
                            <td class="text text-center">
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
                <div class="row">
                    <h3 class="text-start font mt-4 mb-3">UPDATE SISWA</h3>
                    <!-- Input prevew -->
                    <div class="col-md-6 col-12">
                    <?php
                        $id_kelas = $_GET['id_kelas'];
                        $kelas = read('*', 'kelas', "WHERE id_kelas='$id_kelas'");
                        while($editkelas = mysqli_fetch_assoc($kelas)){
                    ?>
                        <form method="POST" enctype="multipart/form-data">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="kelas" id="kelas" oninput="document.getElementById('tkelas').innerHTML =  document.getElementById('kelas').value" placeholder="kelas" value="<?=$editkelas['nama_kelas']?>">
                                <label>Kelas</label>
                            </div>
                            <div class="d-flex justify-content-end">
                                <input class="btn btn-success" type="submit" name="update" value="Submit">
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6 col-12">
                    <!-- Card preview -->
                        <div class="card mb-3 ms-auto me-auto" style="max-width: 400px;">
                            <img class="card-img-top" src="../assets/img/class.jpg" alt="">
                            <div class="card-body">
                            <h1 class="card-title text-center" id="tkelas"><?=$editkelas['nama_kelas']?></h1>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>