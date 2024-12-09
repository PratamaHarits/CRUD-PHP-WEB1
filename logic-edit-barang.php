<?php

include 'conn.php';

if (isset($_POST['submit'])) {

    // ambil data dari form
    $barang_id = $_POST['idBarang'];
    $barang_kode = $_POST['kodeBarang'];
    $barang_nama = $_POST['namaBarang'];
    $barang_harga = $_POST['hargaBarang'];

    // Proses upload foto
    $barang_foto = $_FILES['fotoBarang']['name'];
    $tmp_foto = $_FILES['fotoBarang']['tmp_name'];
    $path_foto = "uploadFoto/" . $barang_foto;

    // jika ada foto baru diupload
    if (!empty($barang_foto)) {
        // pindahkan foto yang diupload
        if (move_uploaded_file($tmp_foto, $path_foto)) {
            // ambil foto lama
            $query_select = $conn->query("SELECT barang_foto FROM tb_barang WHERE barang_id = '$barang_id'");
            $data = $query_select->fetch_assoc();
            // hapus file foto pada folder
            if (file_exists("uploadFoto/" . $data['barang_foto'])) {
                unlink("uploadFoto/" . $data['barang_foto']);
            }
            // update data
            $query = $conn->query(
                "UPDATE tb_barang SET
                barang_kode='$barang_kode', barang_nama='$barang_nama', barang_harga='$barang_harga',barang_foto='$barang_foto' WHERE barang_id='$barang_id'"
            );
        }
    } else {
        // jika tidak ada foto diupload
        $query = $conn->query("UPDATE tb_barang SET 
            barang_kode = '$barang_kode',
            barang_nama = '$barang_nama',
            barang_harga = '$barang_harga'
            WHERE barang_id = '$barang_id'");
    }
    // notifikasi
    if ($query == true) {
        echo "<script>
        alert('Data Berhasil Diubah');
        window.location='view-barang.php'
        </script>";
    } else {
        echo "<script>
        alert('Data Gagal Diubah');
        window.location='view-barang.php'
        </script>";
    }
}
