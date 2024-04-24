<?php
require '../config.php';

$collection = $database->selectCollection("data_car");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_mobil = $_POST['nama_mobil'];
    $gambar = $_POST['gambar'];
    $brand = $_POST['brand'];
    $status = $_POST['status'];

    $collection->updateOne(
        ['_id' => new MongoDB\BSON\ObjectID($_GET['id'])],
        ['$set' => [
            'nama_mobil' => $nama_mobil,
            'gambar' => $gambar,
            'brand' => $brand,
            'status' => $status
        ]]
    );

    header("Location: admin.php");
    exit();
}

$id = $_GET['id'];

$document = $collection->findOne(['_id' => new MongoDB\BSON\ObjectID($id)]);

if (!$document || empty($document)) {
    echo "Document not found.";
    exit();
}

$nama_mobil = isset($document['nama_mobil']) ? $document['nama_mobil'] : '';
$gambar = isset($document['gambar']) ? $document['gambar'] : '';
$brand = isset($document['brand']) ? $document['brand'] : '';
$status = isset($document['status']) ? $document['status'] : '';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mobil</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <h2>Edit Mobil</h2>
    <form method="post">
        <div class="form-group">
            <label for="nama_mobil">Nama Mobil:</label>
            <input type="text" class="form-control" id="nama_mobil" name="nama_mobil" value="<?php echo $document['nama_mobil']; ?>">
        </div>
        <div class="form-group">
            <label for="gambar">URL Gambar:</label>
            <input type="text" class="form-control" id="gambar" name="gambar" value="<?php echo $document['gambar']; ?>">
        </div>
        <div class="form-group">
            <label for="Brand">Brand:</label>
            <input type="text" class="form-control" id="brand" name="brand" value="<?php echo $document['brand']; ?>">
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <input type="text" class="form-control" id="status" name="status" value="<?php echo $document['status']; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
