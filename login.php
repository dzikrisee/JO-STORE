<?php 
session_start();
require 'functions.php';

// cek cookie
if( isset($_COOKIE['id']) && isset($_COOKIE['key']))  {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // ambil username berdasarkan id
    $result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    // cek cookie dan username
    if( $key === hash('sha256', $row['username']) ) {
        $_SESSION['login'] = true;
    }
}

if( isset($_SESSION["login"]) ) {
    header("Location: adminpanel/admin.php");
    exit;
}



if( isset($_POST["login"]) ) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

    // cek username
    if( mysqli_num_rows($result) === 1 ) {

        // cek password
        $row = mysqli_fetch_assoc($result);
        if( password_verify($password, $row["password"]) ) {
            // set session
            $_SESSION["login"] = true;

            // cek remember me
            if( isset($_POST["remember"]) ) {
                // buat cookie
                setcookie('id', $row['id'], time() + 60);
                setcookie('key', hash('sha256', $row['username']),
            time()+60 );
            }

            header("Location: adminpanel/admin.php");
            exit;
        }
    }

    $error = true;
}
?>


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
<body>
    <div class="container">
      <form class="form-container" action="" method="post">
        <div class="text-center mb-3">
          <div class="row align-items-start">
            <div class="col">
              <h3>
                <a class="navbar-brand text-dark" href="#">
                  <img src="assets/logo2.png" alt="Logo" width="25" height="25" class="" />
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

          <!-- cek username / password -->
          <?php if( isset($error) ) : ?>
            <p style="color: red; font-style: italic; font-size: 10px;">Username / Password Salah !</p>
          <?php endif; ?>
          <!-- cek username / password -->
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

        <div style="margin-top: -13px" class="text-end mb-5">
          <a href="" class="textForm text-hover">Lupa Password ?</a>
        </div>

        <div class="d-grid ">
          <button type="submit" class="btn btn-outline-primary textForm" name="login">Masuk</button>
        </div>

        <div class="mt-1">
          <span class="textForm">Belum punya akun ? <a href="registrasi.php" class="textForm text-hover">Daftar</a></span>
        </div>
      </form>
    </div>
    <!-- script fontawesome -->
    <script src="https://kit.fontawesome.com/84b8f8fd02.js" crossorigin="anonymous"></script>

    <!-- script bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>