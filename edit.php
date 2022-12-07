<?php
// Create database connection using config file
include_once("config.php");

if (!isset($_GET['npm'])) {
    header('location: /php_native?message=Cannot Update Data!');
}

// get data from database
$data = mysqli_query($mysqli, "SELECT * FROM mhs WHERE npm='{$_GET['npm']}'");
$user_data = mysqli_fetch_array($data);

if (isset($_POST['gender']) && isset($_POST['nama']) && isset($_POST['alamat']) && isset($_POST['email'])) {

    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    
    // Store data to database
    $result = mysqli_query($mysqli, "UPDATE
    `crud_php_native`.`mhs`
  SET
    `nama` = '$nama',
    `alamat` = '$alamat',
    `email` = '$email',
    `gender` = '$gender'
  WHERE `npm` = '{$_GET['npm']}';
  ");

    header('location: /php_native?message=Update Data Success');
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="container pt-5">


        <h3>Ubah Data Mahasiswa</h3>

        <form action="edit.php?npm=<?= $_GET['npm'] ?>" method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nama</label>
                <input type="text" value="<?= $user_data['nama'] ?>" name="nama" required class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Alamat</label>
                <input type="text" value="<?= $user_data['alamat'] ?>" name="alamat" required class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" value="<?= $user_data['email'] ?>" name="email" required class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp">
            </div>
            <label for="inputGroupSelect02" class="form-label">Gender</label>
            <div class="input-group mb-3">
                <select name="gender" class="form-select" id="inputGroupSelect02">
                    <option value="laki-laki">Laki-laki</option>
                    <option value="perempuan">Perempuan</option>
                </select>
                <label class="input-group-text" for="inputGroupSelect02">Pilih</label>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <button type="submit" class="btn btn-primary me-2" href="#">Simpan</button>
                <a class="btn btn-outline-secondary" href="/php_native">Batal</a>
            </div>
        </form>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>