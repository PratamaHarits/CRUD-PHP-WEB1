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
</head>

<body>

    <!-- data tabel -->
    <table id="barang-table">
        <thead>
            <tr>
                <th colspan="4">Tabel Stok Barang</th>
            </tr>
            <tr></tr>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Kode Barang</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Harga Barang</th>
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
                </tr>
            <?php } ?>

        </tbody>
    </table>

    <!-- link cdn sheetJS -->
    <script lang="javascript" src="https://cdn.sheetjs.com/xlsx-0.20.3/package/dist/xlsx.full.min.js"></script>
</body>

</html>

<script>
    // function export html ke excel
    function exportToExcel() {
        var table = document.getElementById("barang-table");
        var convertTable = XLSX.utils.table_to_book(table, {
            sheet: "Data Barang"
        });
        XLSX.writeFile(convertTable, "data_barang.xlsx");
    }

    // jalankan function exportToExcel saat halaman di load
    window.onload = function() {
        exportToExcel();
    }
</script>