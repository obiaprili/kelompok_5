<?php
    require "session.php";
    require "../koneksi.php";

    $queryproduk = mysqli_query($con, "SELECT * FROM produk");
    $jumlahproduk = mysqli_num_rows($queryproduk);

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
</head>

<style>
    .no-decoration{
        text-decoration: none;
    }
    
    form div{
        margin-bottom: 10px
    }
</style>

<body>
    <?php require "navbar.php";?>

    <div class="container mt-5">
        <nav arial-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="../adminpanel" class="no-decoration text-muted">
                        <i class="fa-solid  fa-house"></i> Home 
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="fa-solid fa-box"></i> Produk
                </li>
            </ol>
        </nav>

        <!-- tambah produk -->
        <div class="my-5 col-12 col-md-6">
            <h3>Tambah Produk</h3>

            <form action="" method="post" enctype="multipart/form-data">
                <div>
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" class="form-control" autocomplete=off required>
                </div>
                <div>
                    <label for="harga">Harga</label>
                    <input type="number" class="form-control" name="harga" autocomplete=off required>
                </div>
                <div>
                    <label for="ketersediaan_stock">Ketersediaan Stock</label>
                    <select name="ketersediaan_stock" id="ketersediaan_stock" class="form-control">
                        <option value="tersedia">Tersedia</option>
                        <option value="habis">Habis</option>
                    </select>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                </div>
            </form>

            <?php
                if(isset($_POST['simpan'])){
                    $nama = htmlspecialchars($_POST['nama']);
                    $harga = htmlspecialchars($_POST['harga']);
                    $detail = htmlspecialchars($_POST['detail']);
                    $ketersediaan_stock = htmlspecialchars($_POST['ketersediaan_stock']);

                    if($nama=='' || $harga==""){
            ?>
                <div class="alert alert-warning mt-3" role="alert">
                    Nama dan Harga Wajib Di Isi
                </div>
            <?php
                    }
                        // query insert to produk table
                        $queryTambah = mysqli_query($con, "INSERT INTO produk (nama, harga, foto, detail, ketersediaan_stock) VALUES('$nama', '$harga', '$new_name', '$detail', '$ketersediaan_stock')");

                        if($queryTambah){
            ?>
                            <div class="alert alert-primary mt-3" role="alert">
                                Produk Berhasil Tersimpan
                            </div>

                            <meta http-equiv="refresh" content="1; url=produk.php" />
            <?php
                        }
                        else{
                            echo mysqli_error($con);
                        }
                    }
            ?>
        </div>

        <div class="mt-3">
            <h2>List Produk</h2>

            <div class="table-responsive mt-5">
                <table class="table">
                    <thead>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Ketersediaan Stock</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                <tbody>
                    <?php
                        if($jumlahproduk==0){
                    ?>
                        <tr>
                            <td colspan=5 class="text-center">Data Produk tidak tersedia</td>
                        </tr>
                    <?php
                        }
                        else{
                            $jumlah = 1;
                            while($data=mysqli_fetch_array($queryproduk)){
                    ?>
                            <tr>
                                <td><?php echo $jumlah++; ?></td>
                                <td><?php echo $data['nama'] ?></td>
                                <td><?php echo $data['harga'] ?></td>
                                <td><?php echo $data['ketersediaan_stock'] ?></td>
                                <td>
                                    <a href="produk-detail.php?p=<?php echo $data['id']; ?>" class="btn btn-info"><i class="fas fa-search"></i></a>
                                </td>
                            </tr>
                    <?php
                            }
                        }
                    ?>
                </tbody>
            </div>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>
</html>