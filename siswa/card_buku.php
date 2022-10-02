<?php
include '../config.php';
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
    <?php include 'nav.php' ?>
    <div class="container-fluid">
        <div class="row ms-auto me-auto row-cols-3 row-cols-md-5 g-3">
    <?php
            $no = 0;
            $buku = read('*', 'buku', '');
            while ($data = mysqli_fetch_array($buku)) {
                $no++;
    ?>
        <div class="col">
            <div class="card shadow-sm h-100">
            <img src="../assets/img/<?= $data['cover'] ?>" class="card-img-top" alt="...">
            <div class="card-body position-relative">
            <h5 class="card-title font"><?=strtoupper($data['judul'])?></h5>
            <h6 class="card-text text-muted"><?=$data['penulis']?></h6>
            <div class="position-absolute bottom-0 end-0">
                <!-- button detail -->
                    <button class="btn btn-sm btn-polos pe-0" type="button" data-bs-toggle="modal" data-bs-target="#sinopsis"><small><i class="fa-solid fa-file-lines"></i> Detail</small></button>
                    <div class="modal fade" id="sinopsis" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">SINOPSIS</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h5 class="card-text"><?=$data['penerbit']?>,&nbsp;<?=$data['tahun']?>,&nbsp;<?=$data['kota']?></h5>
                                    <?= $data['sinopsis'];?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- button pinjam -->
                    <button class="btn btn-sm btn-polos ps-2" type="button"><small><i class="fa-solid fa-right-to-bracket"></i> Pinjam</small></button>
            </div>
            </div>
            <div class="card-footer text-center">
                <small class="text-muted">Jumlah buku <?= $data['stok'];?> </small>
            </div>
            </div>
        </div>
    <?php
            }
    ?>
        </div>
    </div>
    <!-- Lanjutan dari nave -->
    </div>
    </div>
</body>

</html>