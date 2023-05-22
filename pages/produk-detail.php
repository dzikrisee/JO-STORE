<?php 
  $con = mysqli_connect("localhost", "root", "", "db_jostore");

  $nama = htmlspecialchars($_GET['nama']);
  $queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE nama='$nama'");
  $produk = mysqli_fetch_array($queryProduk);

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/styleProduk.css" />
    <link rel="stylesheet" href="../fontawesome/all.min" />
</head>
<body>
    <!-- Awal Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="#">
          <img src="../assets/logo2.png" alt="Logo" width="50" height="50" class="me-2" />
          Jo.<strong>Store</strong>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <form class="d-flex ms-auto my-4" method="get" action="produk.php">
            <input class="form-control me-2" type="text" placeholder="Cari Barang Anda" aria-label="Search" name="keyword"/>
            <button class="btn btn-light" type="submit" ><i class="fa fa-search" aria-hidden="true"></i></button>
          </form>
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="../index.php">Beranda</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="produk.php">Produk </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../login.php">Login admin <i class="fa fa-sign-out fa-md" aria-hidden="true"></i></a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Akhir Navbar -->

    <!-- Detail Produk -->
    <div class="container-fluid py-5">
      <div class="container">
        <div class="row">
          <div class="col-md-5">
            <img src="../adminpanel/image/<?php echo $produk['foto']; ?>" class="w-100">
          </div>
          <div class="col-md-6 offset-md-1">
            <h1><?php echo $produk['nama']; ?></h1>
            <div class="garis-nama"></div>
            <h5>Deskripsi Produk :</h5>
            <p class="fs-5"><?php echo $produk['detail']; ?></p>
            <p class="fs-3 fw-bold">Rp.<?php echo $produk['harga']; ?></p>
            <a href="https://wa.me/6281223093242" target="blank" class="btn btn-dark text-white btn-lg me-2 btn-custom">Hubungi Via Whatsapp<i class="fa fa-whatsapp fa-xl ms-3"></i></a>
            <p class="mt-1">Status Ketersediaan : <strong><?php echo $produk['ketersediaan_stok']; ?></strong></p>
          </div>
        </div>
      </div>
    </div>
    <!-- Detail Produk -->













    <!-- Footer -->
    <footer class="bg-light p-5 mt-5">
      <div class="container">
        <div class="row mt-2">
          <div class="col-md-6 text-md-start text-center pt-2 pb-2">
            <a href="#" class="text-decoration-none">
              <img src="../assets/logo2.png" style="width: 40px" />
            </a>
            <span>Copyright @2023 | Created with feel by <a href="#" class="text-decoration-none text-dark fw-bold">Dzikri Setiawan</a> </span>
          </div>

          <div class="col-md-6 text-md-end text-center pt-2 pb-2">
            <a href="https://instagram.com/dzikrisee" target="_blank" class="text-decoration-none">
              <i class="fa fa-instagram fa-2xl text-dark" aria-hidden="true"></i>
            </a>
            <a href="#" class="text-decoration-none ms-2">
              <i class="fa fa-twitter-square fa-2xl text-dark" aria-hidden="true"></i>
            </a>
            <a href="#" class="text-decoration-none ms-2">
              <i class="fa fa-github-square fa-2xl text-dark" aria-hidden="true"></i>
            </a>
          </div>
        </div>
      </div>
    </footer>
    <!-- Akhir Footer -->

    
    <script src="https://kit.fontawesome.com/84b8f8fd02.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>
</html>