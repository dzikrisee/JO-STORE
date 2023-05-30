<?php
// require "session.php";
require "../koneksi.php";
require "../../vendor/autoload.php"; // Include the mPDF library

// query kategori
$queryKategori = mysqli_query($con, "SELECT * FROM kategori");
$jumlahKategori = mysqli_num_rows($queryKategori);

// query produk
$queryProduk = mysqli_query($con, "SELECT * FROM produk");
$jumlahProduk = mysqli_num_rows($queryProduk);

// Generate PDF report
if (isset($_GET['generate_pdf'])) {
    $mpdf = new \Mpdf\Mpdf(); // Create an instance of mPDF

    ob_start(); // Start output buffering

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin | Kategori</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    </head>

    <body>
        <div class="container mt-5">
            <div class="mt-3">
                <h2>List Kategori</h2>
                <div class="table-responsive mt-5">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama.</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($jumlahKategori == 0) {

                            ?>
                                <tr>
                                    <td colspan=3 class="text-center">Data Kategori tidak tersedia</td>
                                </tr>
                                <?php
                            } else {
                                $jumlah = 1;
                                while ($data = mysqli_fetch_array($queryKategori)) {


                                ?>
                                    <tr>
                                        <td><?php echo $jumlah; ?></td>
                                        <td><?php echo $data['nama']; ?></td>
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
    </body>

    </html>
<?php

    $html = ob_get_contents();
    ob_end_clean();

    // Set PDF configuration
    $mpdf->SetHeader('Jo.Store'); // Set header
    $mpdf->WriteHTML($html);
    $mpdf->Output(); // Output the PDF as a download

    exit();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<style>
    #footer {
        margin-top: 250px;
        bottom: 0;
        width: 100%
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

    <div class="container mt-5">
        <!-- breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="admin-user.php" class="text-decoration-none text-muted"><i class="fas fa-home "></i> Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Kategori
                </li>
            </ol>
        </nav>
        <!-- breadcrumb -->

        <!-- List Kategori -->
        <div class="mt-3">
            <h2>List Kategori</h2>

            <div class="table-responsive mt-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama.</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($jumlahKategori == 0) {

                        ?>
                            <tr>
                                <td colspan=3 class="text-center">Data Kategori tidak tersedia</td>
                            </tr>
                            <?php
                        } else {
                            $jumlah = 1;
                            while ($data = mysqli_fetch_array($queryKategori)) {


                            ?>
                                <tr>
                                    <td><?php echo $jumlah; ?></td>
                                    <td><?php echo $data['nama']; ?></td>
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
        <!-- List Kategori -->

        <!-- Generate button -->
        <div class="mt-3">
            <a href="?generate_pdf" class="btn btn-primary">Generate PDF</a>
        </div>
        <!-- Generate button -->

    </div>

    <!-- Footer -->
    <?php require "partials/footer.php" ?>
    <!-- Akhir Footer -->

    <!-- Script Fontawesome -->
    <script src="https://kit.fontawesome.com/84b8f8fd02.js" crossorigin="anonymous"></script>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>