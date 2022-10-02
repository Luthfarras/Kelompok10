<?php
include 'config.php';
session_start();
if (!$_SESSION['nip']) {
  header('location:index.php');
  exit;
}

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <title>Data Siswa</title>
  </head>
  <body>
    <div class="">
      <nav class="navbar navbar-expand-lg" style="background-color: #FFCB42">
        <div class="container-fluid">
          <a class="navbar-brand" href="home.php">Perpustakaan 10</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" href="data_bk.php">Data Buku</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="data_sw.php">Data Siswa</a>
              </li>
              <!-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Dropdown
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled">Disabled</a>
              </li> -->
            </ul>
            <a href="logout.php" class="btn btn-outline-danger">Logout</a>
            <!-- <form class="d-flex" role="search">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form> -->
          </div>
        </div>
      </nav>
    </div>

    <div class="container mt-5">
      <div class="d-flex">
        <a href="create_sw.php" class="btn btn-outline-primary me-auto">Tambah Data</a>
        <form class="d-flex col-6 ms-auto" action="search_sw.php" method="get">
            <input class="form-control me-2" type="text" placeholder="Cari Siswa" name="search">
            <input type="submit" value="Cari" class="btn btn-outline-success">
        </form>
      </div>
      <table class="table table-bordered table-hover mt-3">
        <thead>
          <tr>
            <th>NIS</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Alamat</th>
            <th>Kelas</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
            <?php
            $ambil = mysqli_query($conn, "SELECT * FROM siswa JOIN kelas ON siswa.id_kelas = kelas.id_kelas");
            while($data = mysqli_fetch_array($ambil)){
                ?>
                <tr>
                    <td><?= $data['nis']?></td>
                    <td><?= $data['nama']?></td>
                    <td><?= $data['jenis_kelamin']?></td>
                    <td><?= $data['alamat']?></td>
                    <td><?= $data['nama_kelas']?></td>
                    <td colspan="2">
                      <a href="update_sw.php?nis=<?= $data['nis']; ?>" class="btn btn-outline-warning" style="border-radius:50px">Edit</a>
                      <a href="delete_sw.php?nis=<?= $data['nis']; ?>" class="btn btn-outline-danger" style="border-radius:50px">Hapus</a>
                    </td>
                </tr>
            <?php
            }
            ?>
          </tr>
        </tbody>
      </table>
    </div>

    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
