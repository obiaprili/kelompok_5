<?php
    require "session.php";
    require "../koneksi.php";

    $queryproduk = mysqli_query($con, "SELECT * FROM produk");
    $jumlahproduk = mysqli_num_rows($queryproduk);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Kelompok 5 | Home</title>
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    </head>

    <style>
        .kotak { 
          border: solid;
        }

        .summary-produk{
          background-color: #0a516b;
          border-radius: 15px;
        }

        .no-decoration{
          text-decoration: none;
        }

        form div{
        margin-bottom: 10px
    }
      
    </style>
    
    <body>
        <?php require "navbar.php";?>
        <div class="container">
          <nav arial-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item active" aria-current="page">
                <i class="fa-solid fa-house"></i> Home
              </li>
            </ol>
          </nav>
      
      <div class="container me-5">
        <div class="row">
          <div class="col-lg-4 col-md-6 summary-produk p-3">
            <div class="row">
              <div class="col-6">
              <a href="produk.php" class="no-decoration">
                <i class="fas fa-box fa-5x text-black-50"></i>
              </a>
              </div>
              <div class="col-6 text-white">
                <h3 class="fs-2">Produk</h3>
                <p class="fs-4"><?php echo $jumlahproduk ?></p>
                <p><a href="produk.php" class="text-white no-decoration">lihat detail</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="../fontawesome/js/all.min.js"></script>
    </body>
</html>