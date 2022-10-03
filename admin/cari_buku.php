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
            <a class="btn btn-sm btn-success mb-3" href="buku.php"><i class="fa-solid fa-arrow-left"></i> Kembali</a>

              <!-- tabel -->
              <table class="table table-sm table-hover table-bordered mx-auto" style="width:40rem">
                  <thead class="text-center">
                      <tr>
                          <th>No</th>
                          <th>Cover</th>
                          <th>Judul</th>
                      </tr>
                  </thead>
                  <tbody class="table-group-divider">
                    <?php
                    $no=1;
                       if(isset($_GET['search'])){
                         $cari = $_GET['search'];
                         $data = mysqli_query($conn, "SELECT * FROM buku WHERE judul like '%".$cari."%'");
                       }else{
                         $data = mysqli_query($conn, "SELECT * FROM buku");
                       }
                       while($d = mysqli_fetch_array($data)){
                       ?>
                      <tr>
                          <th class="text-center" scope="row"><?=$no++?></th>
                          <td><img class="img-thumbnail" src="../assets/img/<?= $d['cover']?>" alt="" style="width:100px"></td>
                          <td><?=$d['judul']?></td>
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
