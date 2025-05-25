<?php
require "session.php";
require "../koneksi.php";

// Cek apakah parameter 'p' tersedia
if (!isset($_GET['p'])) {
    die("<div class='container mt-5 alert alert-danger'>ID produk tidak ditemukan di URL.</div>");
}

$id = $_GET['p'];

// Ambil data produk
$query = mysqli_query($con, "SELECT * FROM produk WHERE id='$id'");
$data = mysqli_fetch_array($query);

// Jika produk tidak ditemukan
if (!$data) {
    die("<div class='container mt-5 alert alert-danger'>Produk dengan ID $id tidak ditemukan.</div>");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <style>
        form div {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<?php require "navbar.php"; ?>

<div class="container mt-5">
    <h2>Detail produk</h2>

    <div class="col-12 col-md-6">
        <form action="" method="post" enctype="multipart/form-data">
            <div>
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" value="<?php echo htmlspecialchars($data['nama']); ?>">
            </div>
            <div class="mt-5">
                <button type="submit" class="btn btn-primary" name="editBtn">Edit</button>
                <button type="submit" class="btn btn-danger" name="deleteBtn">Delete</button>
            </div>
        </form>

        <?php
        if (isset($_POST['editBtn'])) {
            $produkBaru = htmlspecialchars($_POST['nama']);

            if ($data['nama'] === $produkBaru) {
                echo '<meta http-equiv="refresh" content="0; url=produk-detail.php?p=' . $id . '">';
            } else {
                $cek = mysqli_query($con, "SELECT * FROM produk WHERE nama='$produkBaru'");
                if (mysqli_num_rows($cek) > 0) {
                    echo '<div class="alert alert-warning mt-3" role="alert">Produk sudah ada.</div>';
                } else {
                    $update = mysqli_query($con, "UPDATE produk SET nama='$produkBaru' WHERE id='$id'");
                    if ($update) {
                        echo '<div class="alert alert-success mt-3">Produk berhasil diperbarui</div>';
                        echo '<meta http-equiv="refresh" content="2; url=produk.php?p=' . $id . '">';
                    } else {
                        echo '<div class="alert alert-danger mt-3">' . mysqli_error($con) . '</div>';
                    }
                }
            }
        }

        if (isset($_POST['deleteBtn'])) {
            $delete = mysqli_query($con, "DELETE FROM produk WHERE id='$id'");
            if ($delete) {
                echo '<div class="alert alert-warning mt-3">Produk berhasil dihapus</div>';
                echo '<meta http-equiv="refresh" content="2; url=produk.php">';
            } else {
                echo '<div class="alert alert-danger mt-3">' . mysqli_error($con) . '</div>';
            }
        }
        ?>
    </div>
</div>

<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
