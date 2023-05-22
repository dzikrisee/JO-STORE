<?php 
    require "koneksi.php";

    $query = mysqli_query($con, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori
    b ON a.kategori_id=b.id");
    $jumlahProduk = mysqli_num_rows($query);

    $queryKategori = mysqli_query($con, "SELECT * FROM kategori");

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>

    <?php require "navbar.php"; ?>
    
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

    <!-- tambah produk -->
    <div class="my-5 col-12 col-md-6">
        <h3>Tambah Produk</h3>

        <form action="" method="post" enctype="multipart/form-data">
            <div>
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" class="form-control" required>
            </div>
            <div>
                <label for="kategori">Kategori</label>
                <select name="kategori" id="kategori" class="form-control" required>
                    <option value="">Pilih Satu</option>
                   <?php 
                        while($data=mysqli_fetch_array($queryKategori)){
                    ?>  
                        <option value="<?php echo $data['id']; ?>"><?php echo $data['nama']; ?></option>
                    <?php
                        }
                    ?>
                </select>
            </div>
            <div>
                <label for="harga">Harga</label>
                <input type="number" class="form-control" name="harga" required>
            </div>
            <div>
                <label for="foto">Foto</label>
                <input type="file" name="foto" id="foto" class="form-control">
            </div>
            <div>
                <label for="detail">Detail</label>
                <textarea name="detail" id="detail" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <div>
                <label for="ketersediaan_stok">Ketersediaan Stok</label>
                <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-control">
                    <option value="tersedia">Tersedia</option>
                    <option value="habis">Habis</option>
                </select>
            </div>
            <div>
                <button type="submit" class="btn btn-primary mt-2" name="simpan">Simpan</button>
            </div>
        </form>

        <?php 
            if(isset($_POST['simpan'])){
                $nama = htmlspecialchars($_POST['nama']);
                $kategori = htmlspecialchars($_POST['kategori']);
                $harga = htmlspecialchars($_POST['harga']);
                $detail = htmlspecialchars($_POST['detail']);
                $ketersediaan_stok = htmlspecialchars($_POST['ketersediaan_stok']);

                $target_dir = "image/";
                $nama_file = basename($_FILES["foto"]["name"]);
                $target_file = $target_dir . $nama_file;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                $image_size = $_FILES['foto']['size'];
                $random_name = generateRandomString(20);
                $new_name = $random_name . "." . $imageFileType;

                if($nama=='' || $kategori=='' || $harga==''){
        ?>
            <div class="alert alert-warning mt-3" role="alert">
                    Nama, Kategori dan Harga wajib di isi
            </div>

        <?php
                }
                else{
                    if($nama_file!=''){
                       if($image_size > 500000){
        ?>
            <div class="alert alert-warning mt-3" role="alert">
                    File tidak boleh lebih dari 500kb
            </div>
        <?php
                       } 
                       else{
                        if($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'gif'){
        ?>
                        <div class="alert alert-warning mt-3" role="alert">
                            Format File harus jpg, png, atau gif
                        </div>
        <?php
                        }
                        else{
                           move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir .
                            $new_name);
                        }
                       }
                    }

                    // query insert to produk table
                    $queryTambah = mysqli_query($con, "INSERT INTO produk (kategori_id, nama, harga, foto, detail, ketersediaan_stok) 
                    VALUES ('$kategori', '$nama', '$harga', '$new_name', '$detail', '$ketersediaan_stok')");

                    if($queryTambah){
        ?>
                    <div class="alert alert-success mt-3" role="alert">
                        Produk berhasil tersimpan
                    </div>

                    <meta http-equiv="refresh" content="1; url=produk.php" />
        <?php
                    }
                    else{
                        echo mysqli_error($con);
                    }
                }
            }
        ?>
    </div>
    

    <div class="mt-3">
    <h2>List Produk</h2>

    <div class="table-responsive mt-5">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Ketersediaan Stok</th>
                    <th>Action.</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                 if($jumlahProduk==0){
                ?>
                    <tr>
                        <td colspan=6 class="text-center">Data produk tidak tersedia</td>
                    </tr>
                <?php
                 }
                 else{
                    $jumlah = 1;
                    while($data=mysqli_fetch_array($query)){
                ?>
                    <tr>
                        <td> <?php echo $jumlah; ?></td>
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






    </div>







    <!-- Footer -->
    <footer class="bg-dark text-white p-4 mt-5" id="footer">
      <div class="container">
        <div class="row mt-2">
          <div class="col-md-6 text-md-start text-center pt-2 pb-2">
            <a href="#" class="text-decoration-none">
              <img src="../assets/logo2.png" style="width: 40px" />
            </a>
            <span>Copyright @2023 | Created by <a href="#" class="text-decoration-none text-white fw-bold">Dzikri Setiawan</a> </span>
          </div>

          <div class="col-md-6 text-md-end text-center pt-2 pb-2">
            <a href="https://instagram.com/dzikrisee" target="_blank" class="text-decoration-none">
                <i class="fa fa-instagram fa-xl text-white " aria-hidden="true"></i>
            </a>
            <a href="#" class="text-decoration-none ms-1">
                <i class="fa fa-twitter fa-xl text-white" aria-hidden="true"></i>
            </a>
            <a href="#" class="text-decoration-none ms-1">
                <i class="fa fa-github fa-xl text-white" aria-hidden="true"></i>
            </a>
            
          </div>
        </div>
      </div>
    </footer>
    <!-- Akhir Footer -->


    <!-- Script -->
    <script src="https://kit.fontawesome.com/84b8f8fd02.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>