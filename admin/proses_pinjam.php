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
        <div class="card mt-5 mb-5 mx-auto" style="width:50rem">
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
                   <option disabled selected>Pilih NIS siswa</option>

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
    </div>
</div>
</body>
</html>
<?php } ?>

<?php
if (isset($_POST['submit'])) {
  $nis = $_POST['nis'];
  $nip = $_SESSION['nip'];
  $tgl_p = $_POST['tgl_p'];
  $tgl_k = date('Y-m-d', strtotime('+7 days', strtotime($tgl_p)));
  $tambahpinjam = cread("peminjaman", "('', '$nis', '$nip', '$tgl_p', '$tgl_k')");

  if ($tambahpinjam) {
    header('location:peminjaman.php');
  }
}

 ?>
