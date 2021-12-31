<?php
session_start();
require('functions.php');

$id_adm = $_GET['id'];
$adm = query("SELECT * FROM admin WHERE id_adm='$id_adm'")[0];

?>
<?php
if(isset($_POST['submit'])){

    //cek keberhasilan
    if(edit_admin($_POST) > 0){
        echo "
            <script>
                alert('Data berhasil diedit');
                document.location.href = 'admin.php?id=$id_adm'
            </script>
        ";
        echo (mysqli_error($conn));
        die;
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Menu</title>
    <link rel="stylesheet" href="style.css?=v1.0">

    <!--  Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


    <!-- online source -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
		$(document).ready(function() {
    	$('#example').DataTable();
		} );
	</script>

</head>
<body>

        <div class="judul sticky-top">
            <button class="openbtn" onclick="openNav()">&#9776;</button>
            <div class="brand row align-items-center justify-content-center">
                <img src="img/logo.png" class="logo">
                <h2>Mie level Huuhaah</h2>
            </div>
            <div class="account">
                <div class="dropdown">
                        <?php
                            $id = $_SESSION['id_adm'];    
                            $hasil = mysqli_query($conn,"SELECT * FROM admin WHERE id_adm = '$id'");
                            $data = mysqli_fetch_assoc($hasil); 
                        ?>
                    <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="true">
                        <img src="photo/<?= $data['gambar_adm'];?>" class="bulat" style="background-size:cover;"><?= $data['nama_adm'];?>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                        <li><a class="dropdown-item" href="#">About Me</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
                    </ul>
                </div>
            </div>

            <div id="mySidebar" class="sidebar">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                    <a href="dashboard.php">Dashboard</a>
                    <a href="menu.php">Menus</a>
                    <a href="order_admin.php">Orders</a>
                    <a href="admin.php">Admins</a>
                    <a href="customer.php">Customers</a>
                    <a href="report_adm.php">Reports</a>
            </div>
        </div>
    
   
        <div class="content" id="content">

                <div class="card">
		            <div class="card-header">
			            <h3>  Edit Menu </h3>
		            </div>

                    <div class="card-body">
                        <div class="row align-items-center justify-content-center" style="kotak_input_room">
                            <form method="POST"  class="kotak_input_room" enctype="multipart/form-data">
                                <div class="row mb-4">
                                    <div class="col-sm-10">
                                        <input type="hidden" class="form-control" name='id_adm' value="<?=$id_adm;?>" id="id_adm" readonly> 
                                    </div>
                                </div>  
                                <div class="row mb-4">
                                    <label for="nama_adm" class="col-sm-2 col-form-label">Nama Admin</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name='nama_adm' id="nama_adm" required value="<?=$adm['nama_adm'];?>">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name='username' id="username" required value="<?=$adm['username'];?>">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name='password' id="password" required value="<?=$adm['password'];?>">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="telp_adm" class="col-sm-2 col-form-label">No telp</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name='telp_adm' id="telp_adm" required value="<?=$adm['telp_adm'];?>"> 
                                    </div>
                                </div> 
                                <div class="row mb-4">
                                    <label  for="alamat_adm" class="col-sm-2 col-form-label">Alamat Baru</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" style="resize: none;" name="alamat_adm" id="alamat_adm" rows="3"><?=$adm['alamat_adm'];?></textarea>
                                        </div>                    
                                </div>
                                <div class="row mb-4">
                                    <label for="gambar_adm" class="col-sm-2 col-form-label">Foto</label>
                                        <div class="col-sm-10">
                                            <img src="photo/<?php echo $adm['gambar_adm']; ?>" width="120px" height="150px" /></br>
                                            <input type="checkbox"  name="ubah_foto" value="true"> Ceklis jika ingin mengubah foto<br>
                                        </div>                    
                                </div>
                                <div class="row mb-4">
                                    <label for="gambar_adm" class="col-sm-2 col-form-label">Foto Admin</label>
                                    <div class="col-sm-10">
                                        <input type="file" name="gambar_adm" id="gambar_adm">
                                    </div>
                                </div>
                                <br>
                                <button type="submit" name='submit' class="btn btn-primary">Edit Admin</button>
                                <a href="admin.php" class="btn btn-danger">Kembali</a>
                            </form>           
                        </div>         
                    </div>
                </div>



        </div>

    <script>
        function openNav() {
        document.getElementById("mySidebar").style.width = "250px";
        document.getElementById("content").style.marginLeft = "250px";
        }

        function closeNav() {
        document.getElementById("mySidebar").style.width = "0";
        document.getElementById("content").style.marginLeft= "0";
        }
    </script>
</body>
</html>