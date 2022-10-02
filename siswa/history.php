<?php
include '../config.php';

$id = $_SESSION['nis'];
$ambil = mysqli_query($conn, "SELECT * FROM siswa WHERE nis='$id'");
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
                            <th>No</th>
                            <th>Cover</th>
                            <th>Judul</th>
                            <th>Tanggal Pengembalian</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                            $no=0;
                            $list = read('p., s.nama, s.jenis_kelamin, s.alamat, k.nama_kelas', 'siswa s JOIN kelas k ON s.id_kelas = k.id_kelas', '');
                            // $buku = read('*', 'buku', '');
                                    while($data = mysqli_fetch_assoc($list)){
                                    $no++;
                        ?>
                        <tr>
                            <th class="text-center" scope="row"><?=$no?></th>
                            <td><img class="img-thumbnail" src="../assets/img/<?=$data['cover']?>" style="max-width: 90%;"></td>
                            <td><?=$data['judul']?></td>
                            <td><?=$data['tgl_p']?></td>
                            <td><?=$data['status']?></td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<?php } ?>