<?php
// panggil file koneksi
include 'conn.php';

// login
// sesi dimulai
session_start();

// jika sudah login
if (isset($_SESSION['user_login'])) {
    header("Location: index.php");
    exit();
}

// validasi login
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = $conn->query("SELECT * FROM tb_user WHERE user_nama = '$username'");

    if (mysqli_num_rows($query) === 1) {

        //cek password
        $data = mysqli_fetch_assoc($query);
        if ($password === $data["user_password"]) {

            // set session
            $_SESSION["user_login"] = true;

            header("location: index.php");
            exit();
        }
    }
    $error = true;
}


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body class="vh-100 d-flex justify-content-center align-items-center">

    <form class="p-4 border rounded shadow-sm" method="POST">
        <div class="mb-3">
            <h3 class="text-center">Login User</h3>
            <hr>
        </div>
        <div class="mb-3">
            <?php
            if (isset($error)) { ?>
                <p class="text-danger">Login Gagal</p>
            <?php } ?>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Username</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="username">
        </div>
        <div class="mb-4">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password">
        </div>
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary" name="login">Login</button>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>