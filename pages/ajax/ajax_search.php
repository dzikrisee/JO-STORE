<?php 
// koneksi database
$con = mysqli_connect("localhost", "root", "", "db_jostore");

// cek apakah parameter keyword ada
if (isset($_GET['keyword'])) {
  $keyword = $_GET['keyword'];

  // query produk berdasarkan keyword
  $queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE nama LIKE '%$keyword%'");
  
  // cek jumlah hasil query
  $jumlahProduk = mysqli_num_rows($queryProduk);

  // looping hasil query
  while ($produk = mysqli_fetch_array($queryProduk)) {
    // tampilkan hasil pencarian
    echo '<div class="col-md-4 mb-5 text-center">';
    echo '<div class="card h-100">';
    echo '<div class="image-box">';
    echo '<img src="../adminpanel/image/' . $produk['foto'] . '" class="card-img-top" alt="">';
    echo '</div>';
    echo '<div class="card-body">';
    echo '<h4 class="card-title">' . $produk['nama'] . '</h4>';
    echo '<p class="card-text mt-2">Rp.' . $produk['harga'] . '</p>';
    echo '<a href="produk-detail.php?nama=' . $produk['nama'] . '" class="btn btn-dark d-grid">Detail</a>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
  } 
  
  if ($jumlahProduk == 0) {
    echo '<h4 class="text-center my-5">Produk yang anda cari tidak tersedia</h4>';
  }
}

?>

