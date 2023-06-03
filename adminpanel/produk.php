<?php
require "koneksi.php";
require "../vendor/autoload.php"; // Include the mPDF library

$query = mysqli_query($con, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori
    b ON a.kategori_id=b.id");
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
        <title>Admin | Produk</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    </head>

    <body>
        <div class="container mt-5 mb-5">
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
                                <th>Stok</th>
                            </tr>
                        </thead>
                        <br><br>
                        <tbody>
                            <?php
                            if ($jumlahProduk == 0) {
                            ?>
                                <tr>
                                    <td colspan="6" class="text-center">Data produk tidak tersedia</td>
                                </tr>
                                <?php
                            } else {
                                $jumlah = 1;
                                while ($data = mysqli_fetch_array($query)) {
                                ?>
                                    <tr>
                                        <td><?php echo $jumlah; ?></td>
                                        <td>
                                            <img src="image/<?php echo $data['foto']; ?>" style="width: 70px;">
                                        </td>
                                        <td><?php echo $data['nama']; ?></td>
                                        <td><?php echo $data['nama_kategori']; ?></td>
                                        <td><?php echo $data['harga']; ?></td>
                                        <td><?php echo $data['ketersediaan_stok']; ?></td>
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
    <title>Produk</title>

    <!-- Link Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <!-- Script Sweet Alert  -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <!-- Navbar -->
    <?php require "partials/navbar.php"; ?>
    <!-- Navbar -->

    <div class="container mt-5">
        <!-- breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="admin.php" class="text-decoration-none text-muted"><i class="fas fa-home"></i> Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Produk
                </li>
            </ol>
        </nav>
        <!-- breadcrumb -->

        <!-- Container -->
        <div class="mt-4">
            <h2>List Produk</h2>
            <div>
                <button type="submit" class="btn btn-primary mt-2" name="" onclick="location.href='tambah-produk.php'">Tambah Produk</button>
            </div>
            <div class=" table-responsive mt-1">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Ketersediaan Stok</th>
                            <th>Action.</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($jumlahProduk == 0) {
                        ?>
                            <tr>
                                <td colspan=6 class="text-center">Data produk tidak tersedia</td>
                            </tr>
                            <?php
                        } else {
                            $jumlah = 1;
                            while ($data = mysqli_fetch_array($query)) {
                            ?>
                                <tr>
                                    <td> <?php echo $jumlah; ?></td>
                                    <td>
                                        <img src="image/<?php echo $data['foto']; ?>" style="width: 70px;">
                                    </td>
                                    <td> <?php echo $data['nama']; ?></td>
                                    <td> <?php echo $data['nama_kategori']; ?></td>
                                    <td> <?php echo $data['harga']; ?></td>
                                    <td> <?php echo $data['ketersediaan_stok']; ?></td>
                                    <td>
                                        <a href="produk-detail.php?p=<?php echo $data['id']; ?>" class="btn btn-info"><i class="fas fa-search"></i></a>
                                    </td>
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
        <!-- Generate PDF -->
        <div class="mb-5">
            <a href="?generate_pdf" class="btn btn-primary">Generate PDF</a>
        </div>
        <!-- Generate PDF -->
    </div>
    <!-- Container -->

    <!-- Footer -->
    <?php require "partials/footer.php" ?>
    <!-- Akhir Footer -->

    <!-- Script -->
    <script src="https://kit.fontawesome.com/84b8f8fd02.js" crossorigin="anonymous"></script>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>