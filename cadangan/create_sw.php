<?php
include 'config.php';
ob_start();
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
     <title>Tambah Data Siswa</title>
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
     <div class="container mt-5 mb-5">
       <div class="card mx-auto" style="width: 50rem">
         <div class="card-header">
           <h5>Tambah Data Siswa</h5>
         </div>
         <div class="card-body">
           <form class="mt-2" action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
              <label class="form-label">NIS</label>
              <input type="number" class="form-control" name="nis">
            </div>
            <div class="mb-3">
              <label class="form-label">Nama</label>
              <input type="text" class="form-control" name="nama">
            </div>
            <div class="mb-3">
              <label class="form-label">Jenis Kelamin</label>
              <div class="">
                <input type="radio" name="jenis_kelamin" value="L">
                <label for="">Laki-Laki</label>
              </div>
              <div class="">
                <input type="radio" name="jenis_kelamin" value="P">
                <label for="">Perempuan</label>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Alamat</label>
              <input type="text" class="form-control" name="alamat">
            </div>
            <div class="mb-3">
                <label class="form-label">Kelas</label>
                <select class="form-control" name="kelas">
                  <?php
                  $sql = mysqli_query($conn, "SELECT * FROM kelas");
                  while ($data = mysqli_fetch_array($sql)) {
                   ?>
                   <option value="<?= $data['id_kelas']?>"><?= $data['nama_kelas']?></option>
                 <?php } ?>
                </select>
            </div>
            <button type="submit" class="btn btn-warning" name="submit">Tambah Data</button>
          </form>
         </div>
       </div>
     </div>

     <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
   </body>
 </html>

<?php
if (isset($_POST['submit'])) {
  $nis = $_POST['nis'];
  $nama = $_POST['nama'];
  $jenis_kelamin = $_POST['jenis_kelamin'];
  $alamat = $_POST['alamat'];
  $kelas = $_POST['kelas'];

  $query = mysqli_query($conn, "INSERT INTO siswa (nis, nama, jenis_kelamin, alamat, id_kelas)
  VALUES ('$nis', '$nama', '$jenis_kelamin', '$alamat', '$kelas')");

  if ($query) {
    header('location:data_sw.php');
  }
}
 ?>
