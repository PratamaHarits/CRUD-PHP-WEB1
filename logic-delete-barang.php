<?php
include 'conn.php';

$id = $_GET['id'];

// hapus data foto 
// ambil data foto
$query = $conn->query("SELECT barang_foto FROM tb_barang WHERE barang_id = '$id'");
$data = $query->fetch_assoc();
// hapus file foto pada folder
if (file_exists("uploadFoto/" . $data['barang_foto'])) {
    unlink("uploadFoto/" . $data['barang_foto']);
}

// hapus data barang
$delete = $conn->query("DELETE FROM tb_barang WHERE barang_id='$id'");

if ($delete == True) {
    echo "<script>
        alert('Data Berhasil Dihapus');
        window.location='view-barang.php'
        </script>";
} else {
    echo "<script>
        alert('Data Gagal Dihapus');
        window.location='view-barang.php'
        </script>";
}
