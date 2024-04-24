<?php

require '../config.php';

// Fungsi untuk mengambil data mobil dari database

$collection = $database->selectCollection("data_car");
function getDataMobil($collection) {
    return $collection->find([]);
}

// Fungsi untuk menyimpan data mobil baru
function simpanDataMobil($collection, $nama_mobil, $gambar, $brand, $status) {
    $collection->insertOne([
        'nama_mobil' => $nama_mobil,
        'gambar' => $gambar,
        'brand' => $brand,
        'status' => $status
    ]);
}

function updateDataMobil($collection, $nama_mobil, $gambar, $penyewa, $status) {
    $collection->updateOne(
        ['nama_mobil' => $nama_mobil],
        ['$set' => [
            'nama_mobil' => $nama_mobil,
            'gambar' => $gambar,
            'penyewa' => $penyewa,
            'status' => $status
        ]]
    );
}


// Proses jika form disubmit untuk menambahkan mobil baru
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tambah'])) {
    simpanDataMobil($collection, $_POST['nama_mobil'], $_POST['gambar'], $_POST['brand'], $_POST['status']);
}

// Mendapatkan data mobil
$dataMobil = getDataMobil($collection);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <h2>Data Mobil</h2>
    <a href="insert.php" class="btn btn-primary mb-2">Tambah Mobil</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Mobil</th>
                <th>Gambar</th>
                <th>Brand</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dataMobil as $mobil): ?>
                <tr>
                    <td><?php echo $mobil['_id']; ?></td>
                    <td><?php echo $mobil['nama_mobil']; ?></td>
                    <td><img src="<?php echo $mobil['gambar']; ?>" width="200" height="auto"></td>
                    <td><?php echo $mobil['brand']; ?></td>
                    <td><?php echo $mobil['status']; ?></td>
                    <td>
                    <a href="edit.php?id=<?php echo $mobil['_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="delete.php?id=<?php echo $mobil['_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
