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
          <div class="card mt-5 mb-5 mx-auto" style="width:50rem">
          <div class="card-header">
            Pengembalian
          </div>
          <div class="card-body">
            <div class="">
                <img src="assets/img/<?= $data['cover']?>" alt="" style="width:100px">
            </div>
            <div class="">
              <form class="" action="" method="post">
                <div class="mb-3">
                  <label for="" class="form-label">ID Peminjaman</label>
                  <select class="form-control" name="id_pinjam">
                   <option disabled selected>Pilih ID Peminjaman</option>

                    <?php
                    $sql = mysqli_query($conn, "SELECT * FROM peminjaman WHERE status = 'dipinjam'");
                    while ($data = mysqli_fetch_array($sql)) {
                     ?>
                     <option value="<?= $data['id_peminjaman']?>"><?= $data['id_peminjaman']?></option>
                   <?php } ?>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="" class="form-label">Tanggal Pengembalian</label>
                  <input type="date" class="form-control" name="tgl_kembali" value="">
                </div>
                <div class="mb-3">
                    <label class="form-label">Barang Ada</label>
                    <input type="number" class="form-control" name="ada" value="">
                </div>
                <div class="mb-3">
                    <label class="form-label">Barang Hilang</label>
                    <input type="number" class="form-control" name="hilang" value="">
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

<?php
if (isset($_POST['submit'])) {
  $id_pinjam = $_POST['id_pinjam'];
  $tgl_kembali = $_POST['tgl_kembali'];
  $ada = $_POST['ada'];
  $hilang = $_POST['hilang'];

  $q1 = mysqli_query($conn, "SELECT * FROM peminjaman WHERE id_peminjaman='$id_pinjam'");
  $r = mysqli_fetch_assoc($q1);
  $tgl_asli = $r['tanggal_pengembalian'];
  $diff = date_diff(date_create($tgl_asli), date_create($tgl_kembali));
  $hari = $diff->format('%a');
  $denda = $hari * 1000;
  $status = "dikembalikan";

  $tambahkembali = cread("pengembalian", "('', '$id_pinjam', '$tgl_kembali', '$denda')");
  if ($tambahkembali) {
      $last_id = mysqli_insert_id($conn);
      $q2 = cread("detail_pengembalian", "('', '$last_id', '$ada', '$hilang')");
      if ($q2) {
        $q3 = mysqli_query($conn, "UPDATE peminjaman SET status='$status' WHERE id_peminjaman='$id_pinjam'");
        echo "<script>alert('Berhasil mengembalikan buku.');</script>";
        echo "<script> window.location.href = 'pengembalian.php' </script>";
      }
  }
  // $diff = abs(strtotime($tgl_asli) - strtotime($tgl_kembali));
  // $years = floor($diff / (365*60*60*24));
  // $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
  // $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

  // $terlambat = date_diff(DateTimeInterface($tgl_asli), DateTimeInterface($tgl_kembali));
  // $hari = $terlambat->format("%a");
  // $denda = $days * 1000;
  //
  // $tambahkembali = cread("pengembalian", "('', '$id_pinjam', '$tgl_kembali', '$denda')");
  // if ($tambahkembali) {
  //   // $last_id = mysqli_insert_id($conn);
  //   // $q2 = cread("detail_pengembalian", "('', '$last_id', '$ada', '$hilang')");
  //   // if ($q2) {
  //   //   echo "<script>alert('Berhasil mengembalikan buku.');</script>";
  //   //   echo "<script> window.location.href = 'pengembalian.php' </script>";
  //   // }
  //   echo "<script>alert('Berhasil mengembalikan buku.');</script>";
  //   echo "<script> window.location.href = 'pengembalian.php' </script>";
  //
  // }

}
 ?>
