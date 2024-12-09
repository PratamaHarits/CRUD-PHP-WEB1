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
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="view-barang.php">Stok Barang</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <button class="btn btn-danger" type="submit">Logout</button>
                </form>
            </div>
        </div>
    </nav>
    <br><br>

    <h2 class="text-center">Tabel Stok Barang</h2>
    <br>

    <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-2">
        <a onclick="window.open('export-pdf.php', '_blank')" class="btn btn-success ">Export PDF</a>
        <a onclick="window.open('export-excel.php', '_blank')" class="btn btn-success ">Export Excel</a>
        <!-- Button trigger modal Add-->
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalAdd">
            Add
        </button>
    </div>

    <!-- data tabel -->
    <table class="table">
        <thead>
            <tr class="table-warning">
                <th scope="col">No</th>
                <th scope="col">Kode Barang</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Harga Barang</th>
                <th scope="col">Foto Barang</th>
                <th scope="col">Aksi</th>
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
                    <td>
                        <!-- button edit dan hapus -->
                        <!-- Button trigger modal Edit-->
                        <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modalEdit<?php echo $dataBarang['barang_id'] ?>">
                            Edit
                        </button>
                        <a href="logic-delete-barang.php?id=<?= $dataBarang['barang_id']; ?>" class="btn btn-outline-danger" onclick=" return confirm('Hapus data <?php echo $dataBarang['barang_nama'] ?>')">Delete</a>
                    </td>
                </tr>
            <?php } ?>

        </tbody>
    </table>

    <!-- link cdn javascript bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>

<!-- Modal Add-->
<div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" action="logic-input-barang.php">
                    <div class="row mb-3">
                        <label for="kodeBarang" class="col-sm-2 col-form-label">Kode Barang</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="kodeBarang" name="kodeBarang">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="namaBarang" class="col-sm-2 col-form-label">Nama Barang</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="namaBarang" name="namaBarang">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="hargaBarang" class="col-sm-2 col-form-label">Harga Barang</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="hargaBarang" name="hargaBarang">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="fotoBarang" class="col-sm-2 col-form-label">Foto Barang</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" id="fotoBarang" name="fotoBarang">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<?php
$data = $conn->query("SELECT * FROM tb_barang ORDER BY barang_id");
while ($data_barang = mysqli_fetch_array($data)) { ?>
    <div class="modal fade" id="modalEdit<?php echo $data_barang['barang_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" action="logic-edit-barang.php">
                        <!-- input barang_id -->
                        <input type="hidden" class="form-control" id="idBarang" name="idBarang" value="<?= $data_barang['barang_id'] ?>">
                        <div class="row mb-3">
                            <label for="kodeBarang" class="col-sm-2 col-form-label">Kode Barang</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="kodeBarang" name="kodeBarang" value="<?php echo $data_barang['barang_kode'] ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="namaBarang" class="col-sm-2 col-form-label">Nama Barang</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="namaBarang" name="namaBarang" value="<?php echo $data_barang['barang_nama'] ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="hargaBarang" class="col-sm-2 col-form-label">Harga Barang</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="hargaBarang" name="hargaBarang" value="<?php echo $data_barang['barang_harga'] ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="fotoBarang" class="col-sm-2 col-form-label">Foto Barang</label>
                            <div class="col-sm-10">
                                <img src="uploadFoto/<?php echo $data_barang['barang_foto'] ?>" alt="" width="100px">
                                <input type="file" class="form-control" id="fotoBarang" name="fotoBarang">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>