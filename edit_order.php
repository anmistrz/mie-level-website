<?php
session_start();
require('functions.php');

$no_order = $_GET['id'];
$order = query("SELECT * FROM order_customer, menu WHERE order_customer.id_menu= menu.id_menu AND order_customer.no_order = '$no_order'")[0];

?>
<?php
if(isset($_POST['submit'])){

    //cek keberhasilan
    if(edit_order($_POST) > 0){
        echo "
            <script>
                alert('Data berhasil diedit');
                document.location.href = 'order_cst.php?id=$no_order';
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
			            <h3>  Edit Menu </h3>
		            </div>

                    <div class="card-body">
                        <div class="row align-items-center justify-content-center" style="kotak_input_room">
                            <form method="POST"  class="kotak_input_room" enctype="multipart/form-data">
                                <div class="row mb-4">
                                    <div class="col-sm-10">
                                        <input type="hidden" class="form-control" name='no_order' value="<?=$order['no_order'];?>" id="no_order" readonly>
                                        <input type="hidden" class="form-control" name='harga' value="<?=$order['harga'];?>" id="harga" readonly>  
                                    </div>
                                </div>  
                                <div class="row mb-4">
                                    <label for="nama_adm" class="col-sm-2 col-form-label">Id Customer</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name='id_cst' id="id_cst" required value="<?=$order['id_cst'];?>" readonly>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="username" class="col-sm-2 col-form-label">Id Menu</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name='id_menu' id="id_menu" required value="<?=$order['id_menu'];?>" readonly>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="password" class="col-sm-2 col-form-label">Jumlah Order</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name='jml_order' id="jml_order" required value="<?=$order['jumlah'];?>" required>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="password" class="col-sm-2 col-form-label">Tanggal Order</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name='tgl_order' id="tgl_order" required value="<?=$order['tgl_order'];?>" readonly>
                                    </div>
                                </div>
                                <br>
                                <button type="submit" name='submit' class="btn btn-primary">Edit Menu</button>
                                <a href="order_cst.php" class="btn btn-danger">Kembali</a>
                            </form>           
                        </div>         
                    </div>
                </div>



        </div>

    <script>

        //Sidebar
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