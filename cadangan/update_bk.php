<?php
include 'config.php';
ob_start();
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
     <title>Edit Data Buku</title>
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
           <h5>Edit Data Buku</h5>
         </div>
         <div class="card-body">
           <form class="mt-2" action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
              <label class="form-label">Judul</label>
              <input type="text" class="form-control" name="judul" value="<?= $data['judul'] ?>">
            </div>
            <div class="mb-3">
              <label class="form-label">Penulis</label>
              <input type="text" class="form-control" name="penulis" value="<?= $data['penulis'] ?>">
            </div>
            <div class="mb-3">
              <label class="form-label">Penerbit</label>
              <input type="text" class="form-control" name="penerbit" value="<?= $data['penerbit'] ?>">
            </div>
            <div class="mb-3">
              <label class="form-label">Tahun</label>
              <input type="number" class="form-control" name="tahun" value="<?= $data['tahun'] ?>">
            </div>
            <div class="mb-3">
              <label class="form-label">Kota</label>
              <input type="text" class="form-control" name="kota" value="<?= $data['kota'] ?>">
            </div>
            <div class="mb-3">
              <label class="form-label">Cover</label>
              <input type="file" class="form-control" name="cover">
            </div>
            <div class="mb-3">
              <label class="form-label">Sinopsis</label>
              <textarea name="sinopsis" rows="8" cols="80" class="form-control"><?= $data['sinopsis'] ?></textarea>
            </div>
            <div class="mb-3">
              <label class="form-label">Stok</label>
              <input type="number" class="form-control" name="stok" value="<?= $data['stok'] ?>">
            </div>
            <button type="submit" class="btn btn-success" name="submit">Edit Data</button>
          </form>
         </div>
       </div>
     </div>

     <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
   </body>
 </html>
<?php } ?>

<?php
if (isset($_POST['submit'])) {
  $judul = $_POST['judul'];
  $penulis = $_POST['penulis'];
  $penerbit = $_POST['penerbit'];
  $tahun = $_POST['tahun'];
  $kota = $_POST['kota'];
  $file = $_FILES['cover']['name'];
  $tmp_name = $_FILES['cover']['tmp_name'];
  $upload = move_uploaded_file($tmp_name, "assets/img/" . $file);
  $sinopsis = $_POST['sinopsis'];
  $stok = $_POST['stok'];

  $query = mysqli_query($conn, "UPDATE buku SET judul='$judul', penulis='$penulis', penerbit='$penerbit', tahun='$tahun', kota='$kota', cover='$file', sinopsis='$sinopsis', stok='$stok' WHERE id_buku='$id'");

  if ($query) {
    header('location:data_bk.php');
  }
}
 ?>
