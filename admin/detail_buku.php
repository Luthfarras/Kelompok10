<?php
include '../config.php';
$id = $_GET['id_buku'];
$ambil = mysqli_query($conn, "SELECT * FROM buku WHERE id_buku='$id'");
while($data = mysqli_fetch_array($ambil)){

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
</head>
<body>
    <?php include 'nav.php'?>
        <div class="container">
            <div class="container pt-4 m-auto">
                <table class="table table-sm table-hover table-bordered">
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
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <tr>
                            <td><?=$data['judul']?></td>
                            <td class="text-center" style="width:10%;">
                            <img class="img-thumbnail" src="../assets/img/<?=$data['cover']?>" style="max-width: 90%;">
                            </td>
                            <td style="width: 20%;"><?=$data['penulis']?></td>
                            <td style="width:10%;"><?=$data['penerbit']?></td>
                            <td><?=$data['tahun']?></td>
                            <td><?=$data['kota']?></td>
                            <td><?=$data['stok']?></td>
                            <td><?=$data['sinopsis']?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<?php } ?>
