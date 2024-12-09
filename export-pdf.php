<?php

// memanggil file koneksi
include 'conn.php';

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Informasi Swalayan</title>

    <!-- link cdn css bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>

    <h2 class="text-center">Tabel Stok Barang</h2>
    <hr><br>

    <!-- data tabel -->
    <table class="table">
        <thead>
            <tr class="table-warning">
                <th scope="col">No</th>
                <th scope="col">Kode Barang</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Harga Barang</th>
                <th scope="col">Foto Barang</th>
            </tr>
        </thead>
        <tbody>

            <!-- kode menampilkan data dengan php -->
            <?php
            $data = $conn->query("SELECT * FROM tb_barang");
            $no = 1;
            while ($dataBarang = $data->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $dataBarang['barang_kode'] ?></td>
                    <td><?php echo $dataBarang['barang_nama'] ?></td>
                    <td><?php echo $dataBarang['barang_harga'] ?></td>
                    <td><img src="uploadFoto/<?php echo $dataBarang['barang_foto'] ?>" alt="" width="100px"></td>
                </tr>
            <?php } ?>

        </tbody>
    </table>

    <!-- link cdn javascript bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>

<script>
    window.print();
</script>