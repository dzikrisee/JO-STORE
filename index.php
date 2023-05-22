<?php 
  // koneksi database
  $con = mysqli_connect("localhost", "root", "", "db_jostore");

  // query produk dan limit hanya 6 produk yang ditampilkan
  $queryProduk = mysqli_query($con, "SELECT id, nama, harga, foto, detail FROM produk LIMIT 6");

  // query kategori
  $queryKategori = mysqli_query($con, "SELECT * FROM kategori");

  if(isset($_GET['kategori'])){
    $queryGetKategoriId = mysqli_query($con, "SELECT id FROM kategori WHERE nama='$_GET[kategori]'");
    $kategoriId = mysqli_fetch_array($queryGetKategoriId);
 
    // query produk
    $queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE kategori_id='$kategoriId[id]'");
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jo.Store</title>
    <!-- script bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous" />

    <!-- link index.css -->
    <link rel="stylesheet" href="css/index.css" />

    <!-- kit font awesome -->
    <link rel="stylesheet" href="../fontawesome/all.min" />
</head>
<body>
    <!-- Awal Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="#">
          <img src="assets/logo2.png" alt="Logo" width="50" height="50" class="me-2" />
          Jo.<strong>Store</strong>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <form class="d-flex ms-auto my-4" method="get" action="pages/produk.php">
            <input class="form-control me-2" type="text" placeholder="Cari Barang Anda" aria-label="Search" name="keyword"/>
            <button class="btn btn-light" type="submit" ><i class="fa fa-search" aria-hidden="true"></i></button>
          </form>
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Beranda</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/produk.php">Produk </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login.php">Login admin <i class="fa fa-sign-out fa-md" aria-hidden="true"></i></a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Akhir Navbar -->

    <!-- Awal Carousel -->
    <div class="container">
      <div id="carouselExampleIndicators" class="carousel slide mt-5" data-bs-ride="carousel">
        <div class="carousel-indicators text-align-center">
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="5" aria-label="Slide 6"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="assets/img1.jpg" class="d-block w-100" alt="gambar 1" />
          </div>
          <div class="carousel-item">
            <img src="assets/img2.jpg" class="d-block w-100" alt="gambar 2" />
          </div>
          <div class="carousel-item">
            <img src="assets/img3.jpg" class="d-block w-100" alt="gambar 3" />
          </div>
          <div class="carousel-item">
            <img src="assets/img4.jpg" class="d-block w-100" alt="gambar 4" />
          </div>
          <div class="carousel-item">
            <img src="assets/img5.jpg" class="d-block w-100" alt="gambar 5" />
          </div>
          <div class="carousel-item">
            <img src="assets/img6.jpg" class="d-block w-100" alt="gambar 6" />
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
    <!-- Akhir Carosel -->

    <!-- Awal Kategori -->
    <div class="container mt-5">
      <div class="judul-kategori" style="background-color: #fff; padding: 5px 10px">
        <h5 class="text-center" style="margin-top: 5px">KATEGORI</h5>
      </div>
      <div class="row text-center row-container mt-2">

        <div class="col-lg-2 col-md-3 col-sm-4 col-6">
          <div class="menu-kategori">
            <a href="pages/produk.php?kategori=Baju"><img src="assets/kategori/baju.png" class="img-categori mt-3" alt="" /></a>
            <p class="mt-2">Baju</p>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 col-6">
          <div class="menu-kategori">
            <a href="pages/produk.php?kategori=Celana"><img src="assets/kategori/celana.png" class="img-categori mt-3" alt="" /></a>
            <p class="mt-2">Celana</p>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 col-6">
          <div class="menu-kategori">
            <a href="pages/produk.php?kategori=Sepatu"><img src="assets/kategori/sepatu.png" class="img-categori mt-4" alt="" /></a>
            <p class="mt-">Sepatu</p>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 col-6">
          <div class="menu-kategori">
            <a href="pages/produk.php?kategori=Laptop"><img src="assets/kategori/laptop.png" class="img-categori mt-3" alt="" /></a>
            <p class="mt-2">Laptop</p>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 col-6">
          <div class="menu-kategori">
            <a href="pages/produk.php?kategori=Smartphone"><img src="assets/kategori/hp.png" class="img-categori mt-3" alt="" /></a>
            <p class="mt-2">Smartphone & Aksesoris</p>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 col-6">
          <div class="menu-kategori">
            <a href="pages/produk.php?kategori=Jam Tangan"><img src="assets/kategori/jamtangan.png" class="img-categori mt-3" alt="" /></a>
            <p class="mt-2">Jam Tangan</p>
          </div>
        </div>
      </div>
    </div>
    <!-- Akhir Kategori -->

    <!-- Awal Produk -->
    <div class="container mt-5" id="produk">
      <div class="judul-produk" style="background-color: #fff; padding: 5px 10px">
        <h5 class="text-center" style="margin-top: 5px">PRODUK</h5>
      </div>
      <div class="row">
        <?php while($data = mysqli_fetch_array($queryProduk)){ ?>
        <div class="col-lg-2 col-md-2 col-sm-4 col-6 mt-2">
          <div class="card text-center">
            <img src="adminpanel/image/<?php echo $data['foto']; ?>" class="card-img-top" alt="..." />
            <div class="card-body">
              <h6 class="card-title"><?php echo $data['nama']; ?></h6>
              <p class="card-text mt-2">Rp.<?php echo $data['harga']; ?></p>
              <a href="pages/produk-detail.php?nama=<?php echo $data['nama']; ?>" class="btn btn-dark d-grid">Detail</a>
            </div>
          </div>   
        </div>
        <?php } ?>
      </div>
    </div>
    <!-- Akhir Produk -->

    <!-- Footer -->
    <footer class="bg-light text-dark p-5 mt-5" id="footer">
      <div class="container">
        <div class="row mt-2">
          <div class="col-md-6 text-md-start text-center pt-2 pb-2">
            
            <span>Copyright &#169;2023 | Powered by <a href="#" class="text-decoration-none text-dark fw-bold">Dzikri Setiawan</a> </span>
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

    <!-- Tombol Go-Top -->
    <a href="#" class="gotop rounded"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>
    <!-- Tombol Go-Top -->
    
    <!-- kit font awesome -->
    <script src="https://kit.fontawesome.com/84b8f8fd02.js" crossorigin="anonymous"></script>

    <!-- script bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
  </body>
</body>
</html>