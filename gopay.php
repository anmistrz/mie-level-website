<?php 
session_start();
require "functions.php";


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
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
                    </a>
                    <a href="profile_cst.php">Profile</a>
                    <a href="report_cst.php">Reports</a>
            </div>
        </div>
    
   
        <div class="content" id="content">

                <div class="card">
		            <div class="card-header">
			            <h3>Pembayaran</h3>
		            </div>

                    <div class="card-body">
                        <div class="col-12 row justify-content-center mt-3 mb-1">
                            <h1>Silahkan melakukan pembayaran ke nomor ini</h1>
                        </div>
                        <br>
                        <div class="col-12 row justify-content-center mt-3 mb-1">
                            <h1 style="color:red;">638148</h1>
                        </div>
                        <br>
                        <div class="col-12 row justify-content-center mt-3 mb-1">
                            <img src="img/gopay.png" style="width:150px; height: 50px;">  
                        </div>  
                        <br><br>
                        <div class="col-12 row justify-content-center mt-3 mb-1">
                                <a href="report_cst.php" class="btn btn-primary" 
                                    style="padding: 5px 100px 5px; font-size: 15pt">
                                    <span data-feather="credit-card" class="mb-1"></span>  Oke, Saya Mengerti
                                </a>  
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