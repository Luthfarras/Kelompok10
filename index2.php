<?php
include 'config.php';
session_start();
// if(isset($_SESSION['nis'])){
//     header('location:home.php');
// }


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
        <div class="card-header text-center" style="background-color: #9ED2C6">
          <h5 class="card-title">Login</h5>
        </div>
        <div class="card-body bg-secondary bg-opacity-10">
          <form class="" action="" method="post">
            <div class="mb-3">
              <label for="" class="form-label">NIS</label>
              <input type="text" name="nis" class="form-control" placeholder="Masukkan NIS Anda" value="">
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
  $nis = $_POST['nis'];

  $query = mysqli_query($conn, "SELECT * FROM siswa WHERE nis='$nis'");
  $data = mysqli_fetch_assoc($query);

  if ($data) {
    if ($data['nis'] == $nis) {
      $_SESSION['nis'] = $data['nis'];
        header('location:siswa/home.php');
    }else {
      echo "<script>alert('NIS tidak sesuai.');</script>";
    }
  }else {
    echo "<script>alert('NIS tidak terdaftar.');</script>";
  }
}
 ?>
