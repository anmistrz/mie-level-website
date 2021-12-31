<?php
session_start();
require('functions.php');
error_reporting(0);


$sql = "SELECT max(id_cst) as maxId FROM customer";
$hasil = mysqli_query($conn,$sql);
$data = mysqli_fetch_array($hasil);
$id_cst= $data['maxId'];

$noUrut = (int) substr($id_cst, 4, 4);


$noUrut++;


$char = "CST-";
$id_cst = $char . sprintf("%03s", $noUrut);

?>


<?php
if(isset($_POST['submit'])){
    //cek keberhasilan
    if(tambah_cst($_POST) > 0){
        echo "
            <script>
                alert('Data berhasil ditambahkan');
                document.location.href = 'index.php?id=$id_cst';
            </script>
        ";
    } else {
        // echo "
        //     <script>
        //         alert('Data gagal ditambahkan');
        //         document.location.href = 'admin.php';
        //     </script>
        // ";
        echo (mysqli_error($conn));
        die;
    }
}
?>

<!doctype html>
<html lang="en">
<head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Daftar Akun </title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
	    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
        <!-- End of boostrap link -->
	
	<link rel="stylesheet" type="text/css" href="daftar.css?v=1.0">
</head>
    <body>
    <div class="daftar-box">
        <div class="left-box">
            <h1 style="text-align: center;">Daftar Akun</h1>
        
            <form method="POST" action="daftar.php" enctype="multipart/form-data">

                <input type="hidden" class="form-control" name='id_cst' value="<?=$id_cst;?>" id="id_cst" readonly>       

                <label>Nama Lengkap</label>
                <input type="text" name="nama_cst" id="nama_cst" class="form-control" placeholder="Nama Lengkap .." required>

                <label>Username</label>
                <input type="text" name="username"  id="username" class="form-control" placeholder="Username .." required>

                <label>Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password .." required>

                <label>Alamat</label>
                <input type="text" name="alamat_cst" id="alamat_cst" class="form-control" placeholder="Alamat .." required>

                <label>No Hp</label>
                <input type="text" name="nohp_cst" id="nohp_cst" class="form-control" placeholder="Nomor Hp .." required>

                <label>Upload Foto</label>
                <input type="file" name="foto_cst" id="foto_cst" placeholder="Choose file" required><br>

                <button type="submit" name='submit' class="btn btn-primary button_daftar ">DAFTAR</button>
                <a href="index.php" class="btn btn-danger button_daftar">Kembali</a>
            </form>

        </div>

        <div class="right-box">

        </div>
    </div>

    </body>
</html>