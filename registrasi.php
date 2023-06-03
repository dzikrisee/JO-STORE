<?php
require 'functions.php';

if (isset($_POST["register"])) {
  if (registrasi($_POST) > 0) {
    $message = "User baru berhasil ditambahkan!";
?>
    <meta http-equiv="refresh" content="1; url=login.php" />
<?php
  } else {
    echo mysqli_error($conn);
  }
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Jo.Store | Registrasi</title>

  <!-- Link CSS -->
  <link rel="stylesheet" href="css/registrasi.css" />

  <!-- Link Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous" />
  <style>
    label {
      display: block;
    }

    body {
      background-image: url("assets/bg/desk-concept-cyber-monday.jpg");
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .form-container {
      background-color: white;
      padding: 20px;
      border-radius: 20px;
    }
  </style>
</head>

<body>
  <div class="container">

    <body>
      <div class="container">
        <form class="form-container" action="" method="post">
          <div class="text-center mb-3">
            <div class="row align-items-start">
              <div class="col">
                <h3>
                  <a class="navbar-brand" href="#">
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
            <h4>Daftar</h4>
          </div>

          <div class="mb-3">
            <label for="username" class="form-label textForm">Username</label>
            <div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
              <input type="text" class="form-control" id="username" name="username" placeholder="Masukan Username" />
            </div>
          </div>

          <div class="mb-3">
            <label for="password" class="form-labe textForml">Password</label>
            <div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon1"><i class="fa fa-unlock-alt" aria-hidden="true"></i></span>
              <input type="password" class="form-control" name="password" id="password" placeholder="Masukan Password" />
            </div>
          </div>

          <div class="mb-3">
            <label for="password2" class="form-labe textForml">Ulangi Password</label>
            <div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon1"><i class="fa fa-unlock-alt" aria-hidden="true"></i></span>
              <input type="password" class="form-control" name="password2" id="password2" placeholder="Masukan Password" />
            </div>
          </div>

          <div class="d-grid">
            <button type="submit" name="register" class="btn btn-outline-primary textForm">Daftar</button>
          </div>

          <div class="mt-1">
            <span class="textForm">Sudah Punya Akun ? <a href="login.php" class="textForm text-hover">Login Disini</a></span>
          </div>

          <!-- Alert -->
          <?php if (!empty($message)) : ?>
            <div class="alert alert-success mt-2" role="alert">
              <?php echo $message; ?>
            </div>
          <?php endif; ?>
          <!-- Alert -->

        </form>
      </div>

      <!-- Script Fontawesome -->
      <script src="https://kit.fontawesome.com/84b8f8fd02.js" crossorigin="anonymous"></script>

      <!-- Scrippt Bootstrap -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
    </body>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>

</body>

</html>