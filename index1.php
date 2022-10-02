<?php
include 'config.php';
session_start();
if(isset($_SESSION['nip'])){
    header('location:admin/home.php');
}


 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <title>Login Page</title>
</head>
<body>
    <div class="container">
      <div class="card mx-auto my-5" style="width: 30rem">
        <div class="card-header text-center" style="background-color: #C7F2A4">
          <h5 class="card-title">Login</h5>
        </div>
        <div class="card-body bg-secondary bg-opacity-10">
          <form class="" action="" method="post">
            <div class="mb-3">
              <label for="" class="form-label">NIP</label>
              <input type="text" name="nip" class="form-control" placeholder="Masukkan NIP Anda" value="">
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Password</label>
              <input type="password" name="password" class="form-control" placeholder="Masukkan Password" value="">
            </div>
            <button type="submit" name="login" class="btn btn-outline-success">Login</button>
          </form>
        </div>
      </div>
    </div>

    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
if(isset($_POST['login'])){
  $nip = $_POST['nip'];
  $password = $_POST['password'];

  $query = mysqli_query($conn, "SELECT * FROM petugas WHERE nip='$nip'");
  $data = mysqli_fetch_assoc($query);

  if ($data) {
    if ($data['password'] == $password) {
      $_SESSION['nip'] = $data['nip'];
      $_SESSION['nama'] = $data['nama'];
      $_SESSION['level'] = $data['level'];
        header('location:admin/home.php');
    }else {
      echo "<script>alert('Password tidak sesuai.');</script>";
    }
  }else {
    echo "<script>alert('NIP tidak terdaftar.');</script>";
  }
}
 ?>
