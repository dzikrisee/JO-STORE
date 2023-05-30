<?php
session_start();

// Koneksi ke database MySQL
$host = 'localhost'; // Ganti dengan host Anda
$db = 'db_jostore'; // Ganti dengan nama database Anda
$user = 'root'; // Ganti dengan username database Anda
$password = ''; // Ganti dengan password database Anda

$conn = new mysqli($host, $user, $password, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Periksa apakah data username dan password telah dikirimkan melalui form
if (isset($_POST['username']) && isset($_POST['password'])) {
    // Mengambil data dari form login
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Melakukan query ke database
    $query = "SELECT * FROM user WHERE username = '$username'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        // Login berhasil
        $row = $result->fetch_assoc();
        $role = $row['role'];

        // Set session untuk role
        $_SESSION['role'] = $role;

        // Redirect sesuai role
        if ($role == 'admin') {
            header("Location: adminpanel/admin.php");
            exit(); // Tambahkan exit() setelah header() untuk menghentikan eksekusi script
        } elseif ($role == 'user') {
            header("Location: adminpanel/admin-user/admin-user.php");
            exit(); // Tambahkan exit() setelah header() untuk menghentikan eksekusi script
        } else {
            // Role tidak valid
            echo "Role tidak valid.";
        }
    } else {
        // Login gagal
        $error = "Username atau password salah.";
    }
}

$conn->close();
?>

<!-- Form Login -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Jo.Store</title>

    <!-- link login.css -->
    <link rel="stylesheet" href="css/login.css" />

    <!-- script bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
</head>
<style>
  .login, .btn {
    margin-top: 10px;
  }
</style>

<body>
    <div class="container">
      <form class="form-container" action="" method="post">
        <div class="text-center mb-3">
          <div class="row align-items-start">
            <div class="col">
              <h3>
                <a class="navbar-brand text-dark" href="#">
                  <img src="assets/logo2.png" alt="Logo" width="30" height="30" class="" />
                  Jo.<strong>Store</strong>
                </a>
              </h3>
            </div>
            <div class="col"></div>
            <div class="col text-end">
              <button type="button" class="btn-close" aria-label="Close" onclick="location.href='index.php'"></button>
            </div>
          </div>
        </div>

        <div class="text-center mb-3">
          <h4>Masuk</h4>
        </div>

        <div class="mb-3">
          <label for="username" class="form-label textForm">Username</label>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
            <input type="text" name="username" class="form-control" id="username"  placeholder="Masukan Username" />
          </div>
        </div>
        <div class="mb-3">
          <label for="password" class="form-labe textForml">Password</label>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1"><i class="fa fa-unlock-alt" aria-hidden="true"></i></span>
            <input type="password" name="password" class="form-control" id="password" placeholder="Masukan Password" />
          </div>
        </div>

        

        <div class="d-grid login">
          <button type="submit" class="btn btn-outline-primary textForm" name="login">Masuk</button>
        </div>

        <div class="mt-1">
          <span class="textForm">Belum punya akun ? <a href="registrasi.php" class="textForm text-hover">Daftar</a></span>
        </div>

        <!-- cek username / password -->
          <?php if( isset($error) ) : ?>
            <div class="alert alert-danger mt-2" role="alert">
                Username / Password Salah
            </div>
          <?php endif; ?>
          <!-- cek username / password -->

      </form>
    </div>
    <!-- script fontawesome -->
    <script src="https://kit.fontawesome.com/84b8f8fd02.js" crossorigin="anonymous"></script>

    <!-- script bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
