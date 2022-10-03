<?php
include '../config.php';
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
            <a class="btn btn-sm btn-success mb-3" href="siswa.php"><i class="fa-solid fa-arrow-left"></i> Kembali</a>

              <!-- tabel -->
              <table class="table table-sm table-hover table-bordered mx-auto" style="width:40rem">
                  <thead class="text-center">
                      <tr>
                        <th>No</th>
                          <th>NIS</th>
                          <th>Nama</th>
                          <th>Alamat</th>
                          <th>Kelas</th>
                      </tr>
                  </thead>
                  <tbody class="table-group-divider">
                    <?php
                    $no=1;
                       if(isset($_GET['search'])){
                         $cari = $_GET['search'];
                         $data = mysqli_query($conn, "SELECT * FROM siswa JOIN kelas ON siswa.id_kelas=kelas.id_kelas WHERE nama like '%".$cari."%'");
                       }else{
                         $data = mysqli_query($conn, "SELECT * FROM siswa");
                       }
                       while($d = mysqli_fetch_array($data)){
                       ?>
                      <tr>
                          <th class="text-center" scope="row"><?=$no++?></th>
                          <td><?=$d['nis']?></td>
                          <td><?=$d['nama']?></td>
                          <td><?=$d['alamat']?></td>
                          <td><?=$d['nama_kelas']?></td>
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
