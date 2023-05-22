<?php 
    // require "session.php";
    require "koneksi.php";

    $id = $_GET['p'];

    $query = mysqli_query($con, "SELECT * FROM kategori WHERE id='$id'");
    $data = mysqli_fetch_array($query);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
    <?php require "navbar.php"; ?>
    <div class="container mt-5">   
        <h2>Detail Kategori</h2>

        <div class="col-12 col-md-6">
            
            <form action="" method="post">
                <div>
                    <label for="kategori">Kategori</label>
                    <input type="text" name="kategori" id="kategori" class="form-control" value="<?php echo $data['nama']; ?>">
                </div>

                <div class="mt-5 d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary" name="editBtn">Edit</button>
                    <button type="submit" class="btn btn-danger" name="deleteBtn">Hapus</button>
                </div>
            </form>

            <?php 
                if(isset($_POST['editBtn'])){
                    $kategori = htmlspecialchars($_POST['kategori']);

                    if($data['nama']==$kategori){
                        ?>
                            <meta http-equiv="refresh" content="0; url=kategori.php" />
                        <?php
                    }
                    else{
                        $query = mysqli_query($con, "SELECT * FROM kategori WHERE nama='$kategori'");
                        $jumlahData = mysqli_num_rows($query);
                        
                        if($jumlahData > 0){
                            ?>
                            <div class="alert alert-warning mt-3" role="alert">
                                Kategori sudah ada
                            </div>
                            <?php
                        }
                        else{
                            $querySimpan = mysqli_query($con, "UPDATE kategori SET nama='$kategori' WHERE id='$id'");
                            if($querySimpan){
                                ?>
                                    <div class="alert alert-success mt-3" role="alert">
                                        Kategori Berhasil Diupdate
                                    </div>
    
                                    <meta http-equiv="refresh" content="1; url=kategori.php" />
                                <?php
                            }
                            else{
                                echo mysqli_error($con);
                            }
                        }
                    }
                }

                if(isset($_POST['deleteBtn'])){
                    $queryCheck = mysqli_query($con, "SELECT * FROM produk WHERE kategori_id='$id'");
                    $dataCount = mysqli_num_rows($queryCheck);
                    
                    if($dataCount>0){
                        ?>
                            <div class="alert alert-warning mt-3" role="alert">
                                Kategori tidak bisa Dihapus karena sudah digunakan di produk
                            </div>

                            <meta http-equiv="refresh" content="1; url=kategori.php" />
                        <?php
                        die();
                    }

                    $queryDelete = mysqli_query($con, "DELETE FROM kategori WHERE id='$id'");

                    if($queryDelete){
                        ?>
                            <div class="alert alert-success mt-3" role="alert">
                                Kategori Berhasil Dihapus
                            </div>

                            <meta http-equiv="refresh" content="1; url=kategori.php" />
                        <?php
                    }
                    else{
                        echo mysqli_error($con);
                    }
                }
            ?>


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



    <!-- script -->
    <script src="https://kit.fontawesome.com/84b8f8fd02.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</body>
</html>