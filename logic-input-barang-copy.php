<?php

include 'conn.php';

if (isset($_POST['submit'])) {

    $kode_barang = $_POST['kodeBarang'];
    $nama_barang = $_POST['namaBarang'];
    $harga_barang = $_POST['hargaBarang'];

    //proses gambar
    $nama_foto = $_FILES['fotoBarang']['name'];
    $tmp_foto = $_FILES['fotoBarang']['tmp_name'];
    $path_foto = 'uploadFoto' . $nama_foto;
}
