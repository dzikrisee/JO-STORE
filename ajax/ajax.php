<?php 
require '../functions.php';

$keyword = $_GET["keyword"];
$query = "SELECT * FROM produk
        WHERE
        foto LIKE '%$keyword%' OR
        nama LIKE '%$keyword%' OR
        harga LIKE '%$keyword%'
        ";
$produk = query($query);

?>

<?php foreach ($produk as $data): ?>
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
<?php endforeach; ?>
