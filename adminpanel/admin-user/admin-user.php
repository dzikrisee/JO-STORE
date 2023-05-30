<?php
// require "session.php";
require "../koneksi.php";

// session_start();

// if( !isset($_SESSION["login"]) ) {
//     header("Location: ../adminpanel/index.php");
//     exit;
// }
// require '../functions.php';

$queryKategori = mysqli_query($con, "SELECT * FROM kategori");
$jumlahKategori = mysqli_num_rows($queryKategori);

$queryProduk = mysqli_query($con, "SELECT * FROM produk");
$jumlahProduk = mysqli_num_rows($queryProduk);

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard | User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/darkmode.css">

</head>
<style>
  .kotak {
    border: solid;
  }

  .summary-kategori {
    background-color: #0a6b4a;
    border-radius: 15px;
  }

  .summary-produk {
    background-color: #0a516b;
    border-radius: 15px;

  }

  #footer {
    /* position: absolute; */
    margin-top: 425px;
    bottom: 0;
    width: 100%;
  }

  @media print {
    .breadcrumb {
      display: none;
    }
  }
</style>

<body>
  <!-- Awal Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-4 ">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="../../assets/logo2.png" alt="Logo" width="50" height="50" class="me-2" />
        Jo.<strong>Store</strong> | Dashboard
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">

        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link text-white" href="admin-user.php">Beranda</a>
          </li>

          <li class="nav-item">
            <a class="nav-link text-white" href="kategori.php">Kategori</a>
          </li>

          <li class="nav-item">
            <a class="nav-link text-white" href="produk.php">Produk</a>
          </li>

          <li class="nav-item">
            <a class="nav-link text-white" href="../../logout.php">
              Logout
              <i class="fa fa-sign-in text-white" aria-hidden="true"></i>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Akhir Navbar -->

  <!-- container -->
  <div class="container mt-5">
    <nav aria-label="breadcrumb" class="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-current="page">
          <i class="fas fa-home text-black-60"></i> Home
        </li>

      </ol>
    </nav>
    <h2></h2>
    <div class="container mt-5">
      <div class="row">
        <div class="col-lg-4 col-md-6 col-12 mb-3">
          <div class="summary-kategori p-3">
            <div class="row">
              <div class="col-6">
                <i class="fas fa-align-justify fa-7x text-black-60"></i>
              </div>
              <div class="col-6 text-white">
                <h3 class="fs-2">Kategori</h3>
                <p class="fs-4"><?php echo $jumlahKategori; ?> Kategori</p>
                <p><a href="kategori.php" class="text-decoration-none text-white">Lihat Detail</a></p>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 col-12">
          <div class="summary-produk p-3">
            <div class="row">
              <div class="col-6">
                <i class="fas fa-box fa-7x text-black-60"></i>
              </div>
              <div class="col-6 text-white">
                <h3 class="fs-2">Produk</h3>
                <p class="fs-4"><?php echo $jumlahProduk; ?> Produk</p>
                <p><a href="produk.php" class="text-decoration-none text-white">Lihat Detail</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- container -->


  <!-- footer -->
  <?php require "partials/footer.php" ?>
  <!-- footer -->

  <!--  -->
  <script src="../js/darkmode.js"></script>

  <!-- Script Fontawesome -->
  <script src="https://kit.fontawesome.com/84b8f8fd02.js" crossorigin="anonymous"></script>

  <!-- Script Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>