<?php 
session_start();
require "functions.php";

$id = $_SESSION['id_cst'];
$menu = query("SELECT bayar.no_bayar, bayar.no_transaksi, bayar.id_cst, customer.nama_cst, bayar.total_byr, 
        bayar.jenis_byr, bayar.tgl_byr, bayar.status FROM bayar, customer WHERE bayar.id_cst = customer.id_cst AND bayar.id_cst='$id'");


// array jenis_byr OVO dari table bayar (Untuk Button)
$sql1 = " SELECT jenis_byr FROM bayar WHERE jenis_byr LIKE '%Ovo%' ";
$result = mysqli_query($conn,$sql1);

$array_ovo = [];
while($row = mysqli_fetch_assoc($result)){
    array_push($array_ovo, $row['jenis_byr']);
 }


// array jenis_byr Gopay dari table bayar (Untuk Button)
$sql2 = " SELECT jenis_byr FROM bayar WHERE jenis_byr LIKE '%Gopay%' ";
$result1 = mysqli_query($conn,$sql2);

$array_gopay = [];
while($row = mysqli_fetch_assoc($result1)){
    array_push($array_gopay, $row['jenis_byr']);
 }



// array jenis_byr Kartu ATM dari table bayar (Untuk Button)
$sql3 = " SELECT jenis_byr FROM bayar WHERE jenis_byr LIKE '%Kartu ATM%' ";
$result2 = mysqli_query($conn,$sql3);

$array_atm = [];
while($row = mysqli_fetch_assoc($result2)){
    array_push($array_atm, $row['jenis_byr']);
 }




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Customer</title>
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
			            <h3>List Order</h3>
		            </div>

                    <div class="card-body">
                        <div class="col-12 row justify-content-center mt-3 mb-1">
                                <a  href="report_berhasil_cst.php"
                                    name="bayar" id="bayar" 
                                    style="font-size: 20px;" name="detail" 
                                    class="btn btn-primary mt-4">
                                    Lihat Transaksi Berhasil
                                </a>
                        </div>
                        <br><br>
                        <table border="1" id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Pembayaran</th>
                                    <th>No Transaksi</th>
                                    <th>Id Customer</th>
                                    <th>Nama Customer</th>
                                    <th>Total Bayar</th>
                                    <th>Metode Pembayaran</th>
                                    <th>Tanggal Pembayaran</th>
                                    <th>Status</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                           <!-- <?php $i=1; ?>
                            <?php foreach ($menu as $row): ?> -->
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $row["no_bayar"]; ?></td>
                                    <td><?= $row["no_transaksi"]; ?></td>
                                    <td><?= $row["id_cst"]; ?></td>
                                    <td><?= $row["nama_cst"]; ?></td>
                                    <td><?= $row["total_byr"]; ?></td>
                                    <td><?= $row["jenis_byr"]; ?></td>
                                    <td><?= $row["tgl_byr"]; ?></td>
                                    <td style="color:red; font-weight:500;"><?= $row["status"]; ?></td>
                                    <td>

                                    <?php 
                                    
                                    
                                        foreach($array_ovo as $ovo) {

                                            $link = $row['no_transaksi'];

                                            if($row['jenis_byr'] == $ovo) {

                                                    echo "
                                                    <a href=\"report_order_cst.php?id=$link\" class=\"link btn btn-info\"> <span data-feather=\"shopping-cart\"></span> Detail Order</a>
                                                    <a href=\"ovo.php\" class=\"link btn btn-info\"> <span data-feather=\"shopping-cart\"></span> Cara Bayar</a>

                                                ";
                                            }
                                        }

                                        foreach($array_gopay as $gopay) {

                                            $link = $row['no_transaksi'];

                                            if($row['jenis_byr'] == $gopay) {

                                                    echo "
                                                    <a href=\"report_order_cst.php?id=$link\" class=\"link btn btn-info\"> <span data-feather=\"shopping-cart\"></span> Detail Order</a>
                                                    <a href=\"gopay.php\" class=\"link btn btn-info\"> <span data-feather=\"shopping-cart\"></span> Cara Bayar</a>

                                                ";
                                            }
                                        }

                                        
                                        foreach($array_atm as $atm) {

                                            $link = $row['no_transaksi'];

                                            if($row['jenis_byr'] == $atm) {

                                                    echo "
                                                    <a href=\"report_order_cst.php?id=$link\" class=\"link btn btn-info\"> <span data-feather=\"shopping-cart\"></span> Detail Order</a>
                                                    <a href=\"mandiri.php\" class=\"link btn btn-info\"> <span data-feather=\"shopping-cart\"></span> Cara Bayar</a>

                                                ";
                                            }
                                        }

                                    ?>

                                    </td>
                                </tr>
                            <!-- <?php $i++;?>   
                            <?php endforeach ?> --> -->
                        </table>
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