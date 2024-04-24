<?php
require '../config.php';

$collection = $database->selectCollection("data_car");

// Periksa apakah parameter ID ada dalam URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Hapus item berdasarkan ID
    $deleteResult = $collection->deleteOne(['_id' => new MongoDB\BSON\ObjectID($id)]);
    
    // Periksa apakah penghapusan berhasil
    if ($deleteResult->getDeletedCount() > 0) {
        header('Location: admin.php');
        echo "Data berhasil dihapus.";
    } else {
        echo "Gagal menghapus data.";
    }
} else {
    echo "ID tidak ditemukan.";
}
?>
