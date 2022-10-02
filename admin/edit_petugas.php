<?php
include '../config.php';
// Update
if(isset($_POST['update'])){
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $kelamin = $_POST['kelamin'];
    $alamat = $_POST['alamat'];
    $password = $_POST['password'];
    $level = $_POST['level'];

    $nip = $_GET['nip'];
    $update = update("petugas", "nip='$nip', nama='$nama', jenis_kelamin='$kelamin', alamat='$alamat', password='$password', level='$level' WHERE nip='$nip'");

    if($update){
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
</head>
<body>
    <?php include 'nav.php'?>
        <div class="container">
            <div class="container pt-4 m-auto">
                <a class="btn btn-sm btn-success mb-3" href="petugas.php"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
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
                            $nip = $_GET['nip'];
                            $petugas = read('*', 'petugas', "WHERE nip='$nip'");
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
                <div class="row">
                    <h3 class="text-start font mt-4 mb-3">UPDATE PETUGAS</h3>
                    <!-- Input prevew -->
                    <div class="col-md-6 col-12">
                    <?php
                        $nip = $_GET['nip'];
                        $petugas = read('*', 'petugas', "WHERE nip='$nip'");
                        while($editpetugas = mysqli_fetch_assoc($petugas)){
                    ?>
                        <form method="POST" enctype="multipart/form-data">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="nip" id="nip" oninput="document.getElementById('tnip').innerHTML =  document.getElementById('nip').value" placeholder="nis" value="<?=$editpetugas['nip']?>">
                                <label>NIP</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input type="text" class="form-control" name="nama" id="nama" oninput="document.getElementById('tnama').innerHTML =  document.getElementById('nama').value" placeholder="nama" value="<?=$editpetugas['nama']?>">
                                <label>Nama</label>
                            </div>
                            <div class="form-floating mb-2">
                                <select class="form-control text-start" name="kelamin">
                                    <?php
                                    echo "<option value=$editpetugas[jenis_kelamin]>$editpetugas[jenis_kelamin]</option>";
                                    ?>
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                </select>
                                <label>Jenis Kelamin</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input type="text" class="form-control" name="alamat" id="alamat" oninput="document.getElementById('talamat').innerHTML =  document.getElementById('alamat').value" placeholder="alamat" value="<?=$editpetugas['alamat']?>">
                                <label>Alamat</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input type="text" class="form-control" name="password" id="password" oninput="document.getElementById('tpassword').innerHTML =  document.getElementById('password').value" placeholder="password" value="<?=$editpetugas['password']?>">
                                <label>Password</label>
                            </div>
                            <div class="form-floating mb-2">
                                <select class="form-control text-start" name="level">
                                    <?php
                                    echo "<option value=$editpetugas[level]>$editpetugas[level]</option>";
                                    ?>
                                        <option value="admin">Admin</option>
                                        <option value="petugas">Petugas</option>
                                </select>
                                <label>Level</label>
                            </div>
                            <div class="d-flex justify-content-end">
                                <input class="btn btn-success" type="submit" name="update" value="Submit">
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6 col-12">
                    <!-- Card preview -->
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                            <img id="foto" src="../assets/img/person.jpg" class="img-fluid rounded-start" alt="">
                            </div>
                            <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="font card-title mb-0 pb-0" id="tnis"><?=$editpetugas['nip']?></h5>
                                <h6 class="card-text mt-0 pt-0"><small class="font text-muted"><span id="tnama"><?=$editpetugas['nama']?></span><span id="talamat"><?=' '.$editpetugas['alamat']?></span></small></h6>
                                <p class="card-text pt-2" id="tkelamin"><?=$editpetugas['jenis_kelamin']?></p>
                                <p class="card-text pt-2" id="tlevel"><?=$editpetugas['level']?></p>
                            </div>
                            </div>
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