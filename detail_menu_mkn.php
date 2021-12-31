<?php 
session_start();
require "functions.php";
error_reporting(0);

$id_menu = $_GET['id'];
$menu = query("SELECT * FROM menu WHERE id_menu='$id_menu'")[0];


// Untuk Nomor Order 
$sql = "SELECT max(no_order) as maxOr FROM order_customer";
$hasil = mysqli_query($conn,$sql);
$data = mysqli_fetch_array($hasil);
$no_order= $data['maxOr'];

$noUrut = (int) substr($no_order, 3, 3);

$card = $noUrut;

$noUrut++;


$char = "OR-";
$no_order = $char . sprintf("%03s", $noUrut);


?>




<?php 

    if(isset($_POST['order'])){

        if(tambah_order_mkn($_POST) > 0){
            echo "
            <script>
                alert('Order berhasil ditambahkan');
                document.location.href = 'dashboard_cst.php?id=$no_order';
            </script>
        ";
        }else {
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
    <title>Detail Menu</title>
    <link rel="stylesheet" href="style.css?v=1.0">

    <!--  Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


    <!-- online source -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
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
            <a href="order_cst.php" type="button" class="btn btn-primary position-absolute" style="padding:10px 20px; margin-left: 30px;">
                <span data-feather="shopping-cart"></span> 

                    <?php if($card > 0){ 

                        echo " 
                            <span class =\"position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger\" style=\"font-size:12pt;\">$card</span>
                        ";

                    }else {

                        echo " 
                        <span class =\"position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger\" style=\"font-size:12pt;\"></span>
                        ";

                    } ?>

            </a>
            <div class="brand row align-items-center justify-content-center">
                <img src="img/logo.png" class="logo">
                <h2>Mie level Huuhaah</h2>
            </div>
            <div class="account">
                <div class="dropdown">
                        <?php
                            $id = $_SESSION['id_cst'];    
                            $hasil = mysqli_query($conn,"SELECT * FROM customer WHERE id_cst = '$id'");
                            $data = mysqli_fetch_assoc($hasil); 
                        ?>
                    <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="true">
                        <img src="photo/<?= $data['foto_cst'];?>" class="bulat" style="background-size:cover;"><?= $data['nama_cst'];?>
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
                    <a href="dashboard_cst.php">Dashboard</a>
                    <a href="order_cst.php">
                        Orders
                        <?php if($card > 0){ 

                            echo " 
                                <span class =\"position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger\" style=\"font-size:12pt;\">$card</span>
                            ";

                        }else {

                            echo " 
                            <span class =\"position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger\" style=\"font-size:12pt;\"></span>
                            ";

                        } ?>
                    </a>
                    <a href="order_admin.php">Profile</a>
                    <a href="index4.php">Reports</a>
            </div>
        </div>
    
   
        <div class="content" id="content">

                <div class="card">
		            <div class="card-header">
			            <h3>Detail Menu</h3>
		            </div>

                    <div class="card-body">

                        <div class="row">
                        
                            <div class="col-6 row justify-content-center mt-3">
                                
                                <div class="border-img" style="width=100%; height:500px;">
                                    <img src="photo/<?= $menu['foto_menu'];?>" style="width: 300px; height:300px;">
                                </div>

                            </div>
                            <div class="col-6 mt-3">
                                <h1><?= $menu['nama_menu']?></h1><br>
                                <p style="font-size: 25px;"><?= $menu['detail']?></p><br>
                                <h1 style="color:green;">Rp.<?= $menu["harga"]; ?></h1>

                                <form action="detail_menu_mkn.php" method="POST" class="col-12 mt-4 row justify-content-center align-items-center">
                                   
                                    <div class=" mb-4 mt-4 row justify-content-center " style="width: 800px;">
                                        <div class="col-sm-10 mt-3">
                                        <input type="hidden" class="form-control" name='no_order' id="no_order" value="<?= $no_order;?>" readonly> 
                                            <input type="hidden" class="form-control" name='id_cst' id="id_cst" value="<?= $_SESSION['id_cst']?>" readonly>
                                            <input type="hidden" class="form-control" name='id_menu' id="id_menu" value="<?= $id_menu; ?>" readonly>
                                            <input type="hidden" class="form-control" name='harga' id="harga" value="<?= $menu['harga']?>" readonly>
                                            <input type="hidden" class="form-control" name='tgl_order' id="tgl_order" value="<?=date('Y-m-d')?>" readonly>

                                            

                                            <label class="col-sm-3 col-form-label" style="font-size:20px;">Jumlah Order</label>
                                            <input type="text" class="form-control" name='jml_order' id="jml_order" required>
                                        </div>
                                        <div class="col-sm-10 mt-3">
                                            <label class="col-sm-3 col-form-label" style="font-size:20px;">Level</label>
                                            <select name="level" class="form-control" aria-label=".form-select-lg example" required>

                                                <option disabled selected>Choose...</option>
                                                <option value="level 1" >Level 1</option>
                                                <option value="level 2" >Level 2</option>
                                                <option value="level 3">Level 3</option>
                                                <option value="level 4">Level 4</option>
                                                <option value="level 5">Level 5</option>

                                            </select>
                                        </div>
                                        <button 
                                            name="order" id="order" 
                                            style="font-size: 20px;" name="detail" 
                                            class="btn btn-primary mt-4">
                                            <span data-feather="shopping-cart"></span>   Masukkan ke keranjang
                                        </button>
                                        <a href="dashboard_cst.php" class="btn btn-danger mt-4 ml-3" style="font-size: 15pt;">Kembali</a>
                                </form>

                            </div>

                        </div>
                            
                    </div>

                </div>



        </div>


    <script>feather.replace()</script>
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