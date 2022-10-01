<?php
include '../config.php';
// Update
if(isset($_POST['update'])){
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $kelamin = $_POST['kelamin'];
    $alamat = $_POST['alamat'];
    $kelas = $_POST['kelas'];

    $kelas = read('id_kelas', 'kelas', "WHERE nama_kelas='$kelas'");
    $result = mysqli_fetch_assoc($kelas);
    $id_kelas = $result['id_kelas'];

    $nis = $_GET['nis'];
    $update = update("siswa", "nis='$nis', nama='$nama', jenis_kelamin='$kelamin', alamat='$alamat', id_kelas='$id_kelas' WHERE nis='$nis'");


    if($update){
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
</head>
<body>
    <?php include 'nav.php'?>
        <div class="container">
            <div class="container pt-4 m-auto">
                <a class="btn btn-sm btn-success mb-3" href="siswa.php"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
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
                            $nis = $_GET['nis'];
                            $siswa = read('s.nis, s.nama, s.jenis_kelamin, s.alamat, k.nama_kelas', 'siswa s JOIN kelas k ON s.id_kelas = k.id_kelas', "WHERE nis='$nis'");
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
                                    <a class="text-warning" href="edit_siswa.php?id_buku=<?= $data['nis']; ?>">
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
                <div class="row">
                    <h3 class="text-start font mt-4 mb-3">UPDATE SISWA</h3>
                    <!-- Input prevew -->
                    <div class="col-md-6 col-12">
                        <?php
                        $nis = $_GET['nis'];
                        $siswa = read('s.nis, s.nama, s.jenis_kelamin, s.alamat, k.nama_kelas', 'siswa s JOIN kelas k ON s.id_kelas = k.id_kelas', "WHERE nis='$nis'");
                        while($editsiswa = mysqli_fetch_assoc($siswa)){
                        ?>
                        <form method="POST" enctype="multipart/form-data">
                            <div class="form-floating mb-2">
                                <input type="text" class="form-control" name="nis" id="nis" oninput="document.getElementById('tnis').innerHTML =  document.getElementById('nis').value" placeholder="nis" value="<?=$editsiswa['nis']?>">
                                <label>NISN</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input type="text" class="form-control" name="nama" id="nama" oninput="document.getElementById('tnama').innerHTML =  document.getElementById('nama').value" placeholder="nama" value="<?=$editsiswa['nama']?>">
                                <label>Nama</label>
                            </div>
                            <div class="form-floating mb-2">
                                <select class="form-control text-start" name="kelamin" id="kelamin" oninput="document.getElementById('tkelamin').innerHTML =  document.getElementById('kelamin').value" placeholder="kelamin">
                                    <option disabled selected><?=$editsiswa['jenis_kelamin']?></option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                                <label>Kelamin</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input type="text" class="form-control" name="alamat" id="alamat" oninput="document.getElementById('talamat').innerHTML =  document.getElementById('alamat').value" placeholder="alamat" value="<?=$editsiswa['alamat']?>">
                                <label>Alamat</label>
                            </div>
                            <div class="form-floating mb-2">
                                    <select class="form-control text-start" name="kelas" id="kelas" oninput="document.getElementById('tkelas').innerHTML =  document.getElementById('kelas').value" placeholder="kelas">
                                        <option disabled selected><?=$editsiswa['nama_kelas']?></option>
                                        <?php
                                        $result = read('nama_kelas', 'kelas', "");
                                        while ($kelas = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <option class="form-control text-dark" value="<?php echo $kelas['nama_kelas']?>"><?= $kelas['nama_kelas'] ?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                <label>Kelas</label>
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
                                <h5 class="font card-title mb-0 pb-0" id="tnis"><?=$editsiswa['nis']?></h5>
                                <h6 class="card-text mt-0 pt-0"><small class="font text-muted"><span id="tnama"><?=$editsiswa['nama']?></span><span id="talamat"><?=' '.$editsiswa['alamat']?></span></small></h6>
                                <p class="card-text pt-2" id="tkelamin"><?=$editsiswa['jenis_kelamin']?></p>
                                <p class="card-text pt-2" id="tkelas"><?=$editsiswa['nama_kelas']?></p>
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
<script type="text/javascript">
    function fotopreview(){
        foto.src = URL.createObjectURL(event.target.files[0]);
    }
</script>
</body>
</html>