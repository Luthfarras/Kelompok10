<?php
include '../config.php';
// session_start();
$id = $_GET['id_buku'];
$ambil = mysqli_query($conn, "SELECT * FROM buku WHERE id_buku='$id'");
while($dt = mysqli_fetch_array($ambil)){
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
            <div class="card mt-5">
            <div class="card-body">
                <form method="POST">
                    <div class="mb-2">
                      <img src="../assets/img/<?= $dt['cover']?>" alt="" style="width:100px">
                    </div>
                    <div class="mb-2">
                      <label class="form-label">Kode Buku</label>
                      <input type="number" class="form-control" name="id_buku" value="<?=$dt['id_buku']?>" disabled>
                    </div>
                    <div class="mb-2">
                        <input type="text" class="form-control" name="judul" value="<?=$dt['judul']?>">
                        <label>Judul</label>
                    </div>
                    <!-- <div class="mb-3">
                        <label class="form-label">NIS</label>
                        <select class="form-control" name="nis">
                         <option disabled selected>Pilih NIS siswa</option>

                          <?php
                          $sql = mysqli_query($conn, "SELECT * FROM siswa");
                          while ($data = mysqli_fetch_array($sql)) {
                           ?>
                           <option value="<?= $data['nis']?>"><?= $data['nama']?></option>
                         <?php } ?>
                        </select>
                    </div> -->
                    <div class="mb-2">
                        <select class="form-control text-start" name="siswa" id="peminjam">
                            <option disabled selected>Pilih Peminjam</option>
                            <?php
                            $result = read('nama', 'siswa', '');
                            while ($siswa = mysqli_fetch_assoc($result)) {
                            ?>
                            <option class="form-control text-dark" value="<?php echo $siswa['nama']?>"><?= $siswa['nama'] ?></option>
                            <?php } ?>
                        </select>
                        <label>Siswa</label>
                    </div>
                    <div class="">
                      <input type="text" class="form-control" name="petugas" value="<?=$_SESSION['nama']?>" disabled>
                      <label>Petugas</label>
                    </div>
                    <div class="mb-3">
                        <input type="date" class="form-control" name="tgl_p">
                        <label>Tanggal Pinjam</label>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="kuantitas" placeholder="kuantitas">
                        <label>Kuantitas</label>
                    </div>
                    <div class="d-flex justify-content-end">
                        <input class="btn btn-success" type="submit" name="pinjam" value="Pinjam">
                    </div>
                </form>
            </div>
            </div>
        </div>
</body>
</html>
<?php } ?>

<?php
if (isset($_POST['pinjam'])) {
  // $nis = $_POST['nis'];
  $nip = $_SESSION['nip'];
  $tgl_p = $_POST['tgl_p'];
  $tgl_k = date('Y-m-d', strtotime('+7 days', strtotime($tgl_p)));
  $total = $_POST['kuantitas'];

    // $pinjam = $_POST['tgl'];
    // $kembali = $_POST['kembali'];
    // $buku = $_POST['buku'];
    $peminjam = $_POST['siswa'];
    // $petugas = $_SESSION['nip'];


    $id_peminjam = read('nis', 'siswa', "WHERE nama='$peminjam'");
    $result= mysqli_fetch_assoc($id_peminjam);
    $id_sis = $result['nis'];

    // $id_buku = read('id_buku', 'buku', "WHERE judul='$buku'");
    // $ambil= mysqli_fetch_assoc($id_buku);
    // $id_buk = $ambil['id_buku'];
    $q1 = mysqli_query($conn, "SELECT * FROM buku WHERE id_buku='$id'");
    $r = mysqli_fetch_assoc($q1);
    $stok = $r['stok'];

    $sisa = $stok - $total;
    if ($stok < $total) {
      echo "<script>alert('Stok tidak cukup!');</script>";
    }else {
      $tambahpinjam = cread("peminjaman", "('', '$id_sis', '$nip', '$tgl_p', '$tgl_k')");
      $cetak = mysqli_fetch_assoc(read('*', 'peminjaman', "WHERE id_siswa='$id_sis'" ));

      if($cetak){
            $que = mysqli_query($conn, "UPDATE buku SET stok='$sisa' WHERE id_buku='$id'");
          $_SESSION['id_buku'] = $id;
          $_SESSION['id_peminjaman'] = $cetak['id_peminjaman'];
          $_SESSION['peminjam'] = $cetak['id_siswa'];
          $_SESSION['kuantitas'] = $_POST['kuantitas'];
          echo "<script> window.location.href = 'dtp.php' </script>";
      }

      // if ($tambahpinjam) {
      //   $last_id = mysqli_insert_id($conn);
      //   $q2 = cread("detail_peminjaman", "('', '$id', '$last_id', '$total')");
      //   if ($q2) {
      //     $que = mysqli_query($conn, "UPDATE buku SET stok='$sisa' WHERE id_buku='$id'");
      //     echo "<script>alert('Berhasil meminjam buku.');</script>";
      //     echo "<script> window.location.href = 'peminjaman.php' </script>";
      //   }
      // }
    }



    // $peminjaman = cread("peminjaman", "('', '$id_sis', '$nip', '$pinjam', '$kembali')");


  }


 ?>
