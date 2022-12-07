<?php
// Create database connection using config file
include_once("config.php");

if (isset($_GET['tampil']) && isset($_GET['tampil']) == 'true') {
    // Fetch all users data from database
    $result = mysqli_query($mysqli, "SELECT * FROM mhs");
}

if (isset($_GET['delete'])) {
    $npm = $_GET['delete'];

    // delete data
    $result = mysqli_query($mysqli, "DELETE
    FROM
      `crud_php_native`.`mhs`
    WHERE `npm` = '$npm';");

    header('location: /php_native?message=Delete Data Success');
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


        <h3>Data Mahasiswa</h3>

        <?php 
            if(isset($_GET['message'])) {
                echo '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    '. $_GET['message'] .'
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                ';
            }
        ?>

        <div class="row mt-4">

            <div class="col-md-6">
                <a class="btn btn-primary" href="/php_native?tampil=true">Tampil Data</a>
                <a class="btn btn-outline-secondary" href="/php_native">Reset</a>
            </div>
            <div class="col-md-6 d-flex">
                <a class="btn btn-success ms-auto" href="/php_native/add.php">Tambah Data</a>
            </div>
        </div>

        <table class="table mt-4">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">NPM</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Email</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Action </th>
                </tr>
            </thead>
            <tbody>
                <?php  
                    $no = 1;
                    while(isset($result) && $user_data = mysqli_fetch_array($result)) {  
                        echo '<tr>';       
                        echo '<th scope="row">'.$no.'</th>';
                        echo "<td>".$user_data['npm']."</td>";
                        echo "<td>".$user_data['nama']."</td>";
                        echo "<td>".$user_data['alamat']."</td>";
                        echo "<td>".$user_data['email']."</td>";    
                        echo "<td>".$user_data['gender']."</td>";    
                        echo '<td>
                        <a href="/php_native/edit.php?npm='. $user_data['npm']. '" class="badge bg-secondary text-decoration-none"><i class="bi-pencil-square"></i> Edit</a>
                        <a onclick="myFunction('. $user_data['npm']. ')" class="badge bg-danger text-decoration-none"><i class="bi-trash3"></i> Hapus</a>
                        </td>';    
                        echo '</tr>';       
                        $no++;
                    }
                ?>

            </tbody>
        </table>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>

<script>
function myFunction(npm) {
  var txt;
  if (confirm("Are you sure want to delete?")) {
    window.location.replace("/php_native?delete=" + npm);
  } 
}
</script>
</body>

</html>