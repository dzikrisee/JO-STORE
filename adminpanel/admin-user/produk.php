<?php
require "../koneksi.php";

$query = mysqli_query($con, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.kategori_id=b.id");
$jumlahProduk = mysqli_num_rows($query);

$queryKategori = mysqli_query($con, "SELECT * FROM kategori");

function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}

// Ambil nilai keyword dari URL
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

// Buat query pencarian
$searchQuery = "SELECT a.*, b.nama AS nama_kategori 
                FROM produk a 
                JOIN kategori b ON a.kategori_id=b.id
                WHERE a.nama LIKE '%$keyword%'
                ORDER BY a.nama ASC";

// Eksekusi query pencarian
$searchResult = mysqli_query($con, $searchQuery);
$jumlahProduk = mysqli_num_rows($searchResult);


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

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
                <form class="d-flex ms-auto my-4" method="get" action="produk.php">
                    <input class="form-control me-2" type="text" placeholder="Cari Barang Anda" aria-label="Search" name="keyword" />
                    <button class="btn btn-light" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                </form>
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

    <!-- Container -->
    <div class="container mt-5 mb-5">
        <!-- breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="admin-user.php" class="text-decoration-none text-muted"><i class="fas fa-home"></i> Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Produk
                </li>
            </ol>
        </nav>
        <!-- breadcrumb -->


        <!-- List Produk -->
        <div class="mt-3">
            <h2>List Produk</h2>
            <div class="table-responsive mt-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Ketersediaan Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($jumlahProduk == 0) {
                        ?>
                            <!-- Alert -->
                            <tr>
                                <td colspan=6 class="text-center">
                                    <?php if ($jumlahProduk == 0) : ?>
                                        <div class="alert alert-danger" role="alert">
                                            Data produk tidak ditemukan.
                                        </div>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <!-- Alert -->
                            <?php
                        } else {
                            $jumlah = 1;
                            while ($data = mysqli_fetch_array($searchResult)) {
                            ?>
                                <tr>
                                    <td> <?php echo $jumlah; ?></td>
                                    <td>
                                        <img src="../image/<?php echo $data['foto']; ?>" style="width: 70px;">
                                    </td>
                                    <td> <?php echo $data['nama']; ?></td>
                                    <td> <?php echo $data['nama_kategori']; ?></td>
                                    <td> <?php echo $data['harga']; ?></td>
                                    <td> <?php echo $data['ketersediaan_stok']; ?></td>
                                </tr>
                        <?php
                                $jumlah++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- List Produk -->
    </div>
    <!-- Container -->


    <!-- Footer -->
    <?php require "partials/footer.php" ?>
    <!-- Akhir Footer -->


    <!-- Script Fontawesome-->
    <script src="https://kit.fontawesome.com/84b8f8fd02.js" crossorigin="anonymous"></script>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>