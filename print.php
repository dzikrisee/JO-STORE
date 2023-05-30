<?php
require "adminpanel/koneksi.php";

require_once __DIR__ . '/vendor/autoload.php';

// query kategori
$queryKategori = mysqli_query($con, "SELECT * FROM kategori");
$jumlahKategori = mysqli_num_rows($queryKategori);

// query produk
$queryProduk = mysqli_query($con, "SELECT * FROM produk");
$jumlahProduk = mysqli_num_rows($queryProduk);

$mpdf = new \Mpdf\Mpdf();

$mpdf->WriteHTML('
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
        <div class="container mt-5">
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
                        <tbody>');

if ($jumlahKategori == 0) {
    $mpdf->WriteHTML('
                            <tr>
                                <td colspan=3 class="text-center">Data Kategori tidak tersedia</td>
                            </tr>');
} else {
    $jumlah = 1;
    while ($data = mysqli_fetch_array($queryKategori)) {
        $mpdf->WriteHTML('
                            <tr>
                                <td>' . $jumlah . '</td>
                                <td>' . $data['nama'] . '</td>
                            </tr>');
        $jumlah++;
    }
}

$mpdf->WriteHTML('
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- List Kategori -->
        </div>
    </body>
    </html>');


$mpdf->Output();
