<?php

include 'conn.php';

if (isset($_POST['submit'])) {

    // Ambil data dari form
    $barang_kode = $_POST['kodeBarang'];
    $barang_nama = $_POST['namaBarang'];
    $barang_harga = $_POST['hargaBarang'];

    // Proses upload foto
    $barang_foto = $_FILES['fotoBarang']['name'];
    $tmp_foto = $_FILES['fotoBarang']['tmp_name'];
    $path_foto = "uploadFoto/" . $barang_foto;

    // Pindahkan file yang diupload
    if (move_uploaded_file($tmp_foto, $path_foto)) {

        // insert data
        $query = $conn->query("INSERT INTO tb_barang (barang_kode, barang_nama, barang_harga, barang_foto) VALUES ('$barang_kode', '$barang_nama', '$barang_harga', '$barang_foto')");

        if ($query == true) {
            echo "<script>
            alert('Data Berhasil Disimpan');
            window.location='view-barang.php'
            </script>";
        } else {
            echo "<script>
            alert('Data Gagal Disimpan');
            window.location='view-barang.php'
            </script>";
        }
    } else {
        echo "<script>
        alert('Foto Gagal Disimpan');
        window.location='view-barang.php'
        </script>";
    }
}
