<?php

require '../config.php';


$collection = $database->selectCollection("data_car");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap data dari form
    $nama_mobil = $_POST['nama_mobil'];
    $gambar = $_POST['gambar'];
    $brand = $_POST['brand'];
    $status = $_POST['status'];

    // Simpan data ke dalam koleksi MongoDB
    $collection->insertOne([
        'nama_mobil' => $nama_mobil,
        'gambar' => $gambar,
        'brand' => $brand,
        'status' => $status
    ]);

    // Redirect kembali ke halaman utama setelah berhasil menyimpan data
    header("Location: admin.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mobil</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <h2>Tambah Mobil</h2>
    <form method="post">
        <div class="form-group">
            <label for="nama_mobil">Nama Mobil: </label>
            <input type="text" class="form-control" id="nama_mobil" name="nama_mobil">
        </div>
        <div class="form-group">
            <label for="gambar">URL Gambar:</label>
            <input type="text" class="form-control" id="gambar" name="gambar">
        </div>
        <div class="form-group">
            <label for="brand">Brand:</label>
            <input type="text" class="form-control" id="brand" name="brand">
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <input type="text" class="form-control" id="status" name="status">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
