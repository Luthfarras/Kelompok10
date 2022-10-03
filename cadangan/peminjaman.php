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
        <div class="container mt-5">
      <div class="card mx-auto" style="width:50rem">
        <div class="card-header">
          Peminjaman
        </div>
        <div class="card-body">
          <div class="">
            <form class="d-flex" action="" method="get">
              <input class="form-control me-2" type="text" placeholder="Search" name="search">
              <input type="submit" value="Cari" class="btn btn-outline-success">
            </form>
          </div>
          <div class="">
            <table class="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Cover</th>
                  <th>Judul</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sql = mysqli_query($conn, "SELECT * FROM buku");
                while ($data=mysqli_fetch_array($sql)) {
                  ?>
                <tr>
                  <td><?=$data['id_buku']?></td>
                  <td><img src="../assets/img/<?= $data['cover']?>" alt="" style="width:100px"></td>
                  <td><?=$data['judul']?></td>
                  <td>
                    <a href="proses_pinjam.php?id_buku=<?= $data['id_buku']; ?>" class="btn btn-sm btn-outline-primary" style="border-radius:50px">Pinjam</a>

                </td>
                </tr>
              </tbody>
            <?php } ?>
            </table>
          </div>
        </div>
      </div>
    </div>

        </div>
    </div>
</div>
</body>
</html>
