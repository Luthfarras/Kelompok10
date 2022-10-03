<?php
include 'config.php';
session_start();
if (!$_SESSION['nip']) {
  header('location:index.php');
  exit;
}
$id = $_GET['id_buku'];
$ambil = mysqli_query($conn, "SELECT * FROM buku WHERE id_buku='$id'");
while($data = mysqli_fetch_array($ambil)){

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <title>Dashboard</title>
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
      <div class="card mb-5 mx-auto" style="width:50rem">
        <div class="card-header">
          Peminjaman
        </div>
        <div class="card-body">
          <div class="">
              <img src="assets/img/<?= $data['cover']?>" alt="" style="width:100px">
          </div>
          <div class="">
            <form class="" action="" method="post">
              <div class="mb-3">
                <label for="" class="form-label">Kode Buku</label>
                <input type="number" class="form-control" name="kode" value="<?=$data['id_buku']?>" disabled>
              </div>
              <div class="mb-3">
                <label for="" class="form-label">Judul Buku</label>
                <input type="text" class="form-control" name="judul" value="<?=$data['judul']?>" disabled>
              </div>
              <div class="mb-3">
                  <label class="form-label">NIS</label>
                  <select class="form-control" name="nis">
                    <?php
                    $sql = mysqli_query($conn, "SELECT * FROM siswa");
                    while ($data = mysqli_fetch_array($sql)) {
                     ?>
                     <option value="<?= $data['nis']?>"><?= $data['nis']?></option>
                   <?php } ?>
                  </select>
              </div>
              <div class="mb-3">
                <label for="" class="form-label">Petugas</label>
                <input type="text" class="form-control" name="petugas" value="<?=$_SESSION['nama']?>" disabled>
              </div>
              <div class="mb-3">
                <label for="" class="form-label">Total</label>
                <input type="number" class="form-control" name="qty" value="">
              </div>
              <div class="mb-3">
                <label for="" class="form-label">Tanggal Peminjaman</label>
                <input type="date" class="form-control" name="tgl_p" value="">
              </div>
              <button type="submit" name="submit" class="btn btn-primary" style="border-radius:50px">Submit</button>
            </form>
          </div>
          </div>
        </div>
      </div>
    </div>

    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
<?php } ?>

<?php
if (isset($_POST['submit'])) {
  $nis = $_POST['nis'];
  $nip = $_SESSION['nip'];
  $tgl_p = $_POST['tgl_p'];
  $tgl_k = date('Y-m-d', strtotime('+7 days', strtotime($tgl_p)));
  $query = mysqli_query($conn, "INSERT INTO peminjaman(id_siswa, id_petugas, tanggal_peminjaman, tanggal_pengembalian) VALUES ('$nis', '$nip', '$tgl_p', '$tgl_k')");

  if ($query) {
    echo "<script>alert('Berhasil meminjam buku.');</script>";
  }
}

 ?>


                    <!-- botan -->
                    <!-- <div class="container pt-4 m-auto"> -->
                <!-- Tambah data -->
                <!-- <button class="btn btn-sm btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#pinjam">Pinjam</button>
                <div class="modal fade" id="pinjam" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Buku</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php
                        $id = $_GET['id_buku'];
                        $ambil = mysqli_query($conn, "SELECT * FROM buku WHERE id_buku='$id'");
                        while($data = mysqli_fetch_array($ambil)){
                        
                        ?>
                        <form method="POST" enctype="multipart/form-data">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="kode" placeholder="kode" value="<?=$data['id_buku']?>" disabled>
                            <label>Kode Buku</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input type="text" class="form-control" name="judul" placeholder="judul" value="<?=$data['judul']?>" disabled>
                            <label>Judul</label>
                        </div>
                        <div class="form-floating mb-2">
                            <select class="form-control text-start" name="nis" id="nis">
                                <?php
                                $sql = mysqli_query($conn, "SELECT * FROM siswa");
                                while ($data = mysqli_fetch_array($sql)) {
                                ?>
                                <option class="form-control text-dark" value="<?= $data['nis']?>"><?= $data['nis'] ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                            <label>NIS</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input type="text" class="form-control" name="petugas" placeholder="petugas" value="<?=$_SESSION['nama']?>">
                            <label>Petugas</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input type="text" class="form-control" name="total" placeholder="total">
                            <label>Total</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input type="data" class="form-control" name="tgl_pinjam" placeholder="tgl_pinjam">
                            <label>Tanggal Peminjaman</label>
                        </div>
                        <div class="mb-2">
                            <input type="file" class="form-control" name="cover" placeholder="cover">
                        </div>
                        <div class="form-floating mb-2">
                            <textarea class="form-control" placeholder="sinopsis" name="sinopsis" style="height: 200px;"></textarea>
                            <label>Sinopsis</label>
                        </div>
                        <div class="d-flex justify-content-end">
                            <input class="btn btn-success" type="submit" name="tambah" value="Submit">
                        </div>
                        </form>
                        <?php } ?>
                    </div>
                    </div>
                </div>
                </div>
 -->

