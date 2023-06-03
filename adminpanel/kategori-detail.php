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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<style>
    #footer {
        margin-top: 485px;
        bottom: 0;
        width: 100%;
    }
</style>

<body>
    <!-- Navbar -->
    <?php require "partials/navbar.php"; ?>
    <!-- Navbar -->

    <!-- Container -->
    <div class="container mt-5 mb-5">
        <!-- breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="admin.php" class="text-decoration-none text-muted"><i class="fas fa-home"></i> Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="kategori.php" class="text-decoration-none text-muted">Kategori</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Detail Kategori
                </li>
            </ol>
        </nav>
        <!-- breadcrumb -->
        <h2>Detail Kategori</h2>

        <div class="col-12 col-md-6">

            <form action="" method="post">
                <div>
                    <label for="kategori">Kategori</label>
                    <input type="text" name="kategori" id="kategori" class="form-control" value="<?php echo $data['nama']; ?>">
                </div>

                <div class="mt-2 d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary" name="editBtn">Edit</button>
                    <button type="submit" class="btn btn-danger" name="deleteBtn">Hapus</button>
                </div>
            </form>

            <?php
            if (isset($_POST['editBtn'])) {
                $kategori = htmlspecialchars($_POST['kategori']);

                if ($data['nama'] == $kategori) {
            ?>
                    <meta http-equiv="refresh" content="0; url=kategori.php" />
                    <?php
                } else {
                    $query = mysqli_query($con, "SELECT * FROM kategori WHERE nama='$kategori'");
                    $jumlahData = mysqli_num_rows($query);

                    if ($jumlahData > 0) {
                    ?>
                        <div class="alert alert-warning mt-3" role="alert">
                            Kategori sudah ada
                        </div>
                        <?php
                    } else {
                        $querySimpan = mysqli_query($con, "UPDATE kategori SET nama='$kategori' WHERE id='$id'");
                        if ($querySimpan) {
                        ?>
                            <script>
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Kategori Berhasil di Ubah',
                                    showConfirmButton: false,
                                    timer: 2000
                                })
                            </script>

                            <meta http-equiv="refresh" content="2; url=kategori.php" />
                    <?php
                        } else {
                            echo mysqli_error($con);
                        }
                    }
                }
            }

            if (isset($_POST['deleteBtn'])) {
                $queryCheck = mysqli_query($con, "SELECT * FROM produk WHERE kategori_id='$id'");
                $dataCount = mysqli_num_rows($queryCheck);

                if ($dataCount > 0) {
                    ?>
                    <div class="alert alert-warning mt-3" role="alert">
                        Kategori tidak bisa Dihapus karena sudah digunakan di produk
                    </div>

                    <meta http-equiv="refresh" content="1; url=kategori.php" />
                <?php
                    die();
                }

                $queryDelete = mysqli_query($con, "DELETE FROM kategori WHERE id='$id'");

                if ($queryDelete) {
                ?>
                    <script>
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Kategori Berhasil di Hapus',
                            showConfirmButton: false,
                            timer: 2000
                        })
                    </script>

                    <meta http-equiv="refresh" content="2; url=kategori.php" />
            <?php
                } else {
                    echo mysqli_error($con);
                }
            }
            ?>
        </div>
    </div>
    <!-- Container -->

    <!-- Footer -->
    <?php require "partials/footer.php" ?>
    <!-- Akhir Footer -->

    <!-- Script Fontawesome -->
    <script src="https://kit.fontawesome.com/84b8f8fd02.js" crossorigin="anonymous"></script>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</body>

</html>