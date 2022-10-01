<?php
include '../config.php';
// Update
if(isset($_POST['update'])){
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahun = $_POST['tahun'];
    $kota = $_POST['kota'];
    $cover = $_FILES['cover']['name'];
    $tmp_name = $_FILES['cover']['tmp_name'];
    $upload = move_uploaded_file($tmp_name, "../assets/img/" . $cover);
    $sinopsis = $_POST['sinopsis'];
    $stok = $_POST['stok'];

    $id = $_GET['id_buku'];

    if($cover==""){
        $update = update("buku", "judul='$judul', penulis='$penulis', penerbit='$penerbit', tahun='$tahun', kota='$kota', sinopsis='$sinopsis', stok='$stok' WHERE id_buku='$id'");
    }else{
        $update = update("buku", "judul='$judul', penulis='$penulis', penerbit='$penerbit', tahun='$tahun', kota='$kota', cover='$cover', sinopsis='$sinopsis', stok='$stok' WHERE id_buku='$id'");
        // $update = mysqli_query($con,"UPDATE data_mahasiswa SET id_mhs='$id', nama_mhs='$nama', nim_mhs='$nim',alamat_mhs='$alamat', tgl_lahir='$tgl', foto='$foto', jurusan_in='$jurusan' where id_mhs=$id");
    }

    if($update){
        header("Location:buku.php");
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
                <a class="btn btn-sm btn-success mb-3" href="buku.php"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
                <!-- tabel -->
                <table class="table table-sm table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>Judul</th>
                            <th style="width:10%;">Cover</th>
                            <th style="width:20%;">Penulis</th>
                            <th style="width:10%;">Penerbit</th>
                            <th>Tahun</th>
                            <th>Kota</th>
                            <th>Stok</th>
                            <th>Sinopsis</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                            $id = $_GET['id_buku'];
                            $buku = read('*', 'buku', "WHERE id_buku='$id'");
                                    while($data = mysqli_fetch_array($buku)){
                        ?>
                        <tr>
                            <td><?=$data['judul']?></td>
                            <td style="width:10%;">
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
                                <!-- Hapus data -->
                                <button class="btn btn-polos p-1">
                                    <a class="text-danger" href="hapus.php?id_buku=<?= $data['id_buku']; ?>"><i class="fa-solid fa-trash"></i></a>
                                </button>
                            </td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
                <div class="row">
                    <h3 class="text-start font mt-4 mb-3">UPDATE BUKU</h3>
                    <!-- Input prevew -->
                    <div class="col-md-6 col-12">
                        <?php
                        $id = $_GET['id_buku'];
                        $buku = read('*', 'buku', "WHERE id_buku='$id'");
                        while($editbuku = mysqli_fetch_assoc($buku)){
                        ?>
                        <form method="POST" enctype="multipart/form-data">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="judul" id="judul" oninput="document.getElementById('tjudul').innerHTML =  document.getElementById('judul').value" placeholder="judul" value="<?=$editbuku['judul']?>">
                                <label>Judul</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input type="text" class="form-control" name="penulis" id="penulis" oninput="document.getElementById('tpenulis').innerHTML =  document.getElementById('penulis').value" placeholder="penulis" value="<?=$editbuku['penulis']?>">
                                <label>Penulis</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input type="text" class="form-control" name="penerbit" id="penerbit" oninput="document.getElementById('tpenerbit').innerHTML =  document.getElementById('penerbit').value" placeholder="penerbit" value="<?=$editbuku['penerbit']?>">
                                <label>Penerbit</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input type="text" class="form-control" name="tahun" id="tahun" oninput="document.getElementById('ttahun').innerHTML =  document.getElementById('tahun').value" placeholder="tahun" value="<?=$editbuku['tahun']?>">
                                <label>Tahun</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input type="text" class="form-control" name="kota" id="kota" oninput="document.getElementById('tkota').innerHTML =  document.getElementById('kota').value" placeholder="kota" value="<?=$editbuku['kota']?>">
                                <label>Kota</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input type="number" class="form-control" name="stok" id="stok" oninput="document.getElementById('tstok').innerHTML =  document.getElementById('stok').value" placeholder="stok" value="<?=$editbuku['stok']?>">
                                <label>Stok</label>
                            </div>
                            <div class="mb-2">
                                <input type="file" class="form-control" name="cover" onchange="fotopreview()" placeholder="cover">
                            </div>
                            <div class="form-floating mb-2">
                                <textarea class="form-control" placeholder="sinopsis" name="sinopsis" id="sinopsisb" oninput="document.getElementById('tsinopsis').textContent =  document.getElementById('sinopsisb').value" style="height: 200px;"><?=$editbuku['sinopsis']?></textarea>
                                <label>Sinopsis</label>
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
                            <img id="foto" src="../assets/img/<?=$editbuku['cover']?>" class="img-fluid rounded-start" alt="">
                            </div>
                            <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="font card-title mb-0 pb-0" id="tjudul"><?=$editbuku['judul']?></h5>
                                <h6 class="card-text mt-0 pt-0"><small class="font text-muted" id="tpenulis"><?=$editbuku['penulis']?></small></h6>
                                <p class="card-text pt-2" id="tsinopsis"><?=$editbuku['sinopsis']?></p>
                                <p class="card-text mb-0 pb-0"><small class="text-muted" id="tpenerbit"><?=$editbuku['penerbit']?></small></p>
                                <p class="card-text mt-0 pt-0" ><small class="text-muted"><span id="ttahun"><?=$editbuku['tahun'].' </span> '.' <span id="tkota">'.$editbuku['kota'].'</span> dengan stok buku '.'<span id="tstok"> '.$editbuku['stok'].'</span>'?></small></p>
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