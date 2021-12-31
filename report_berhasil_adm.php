<?php 
session_start();
require "functions.php";

$transaksi = $_GET['id'];

// $menu = query("SELECT bayar.no_bayar, bayar.no_transaksi, order_customer_fix.id_menu, menu.nama_menu, 
//         order_customer_fix.level, order_customer_fix.jumlah, order_customer_fix.total, order_customer_fix.tgl_order 
//         FROM bayar, transaksi, order_customer_fix, menu WHERE bayar.no_transaksi = transaksi.no_transaksi AND
//         transaksi.no_order = order_customer_fix.no_order AND order_customer_fix.id_menu = menu.id_menu AND
//         bayar.no_bayar = '$bayar' GROUP BY transaksi.no_order");

$menu = query("SELECT no_transaksi, no_order, id_menu, level, jumlah, total, tgl_order FROM 
        transaksi NATURAL INNER JOIN order_customer_fix WHERE no_transaksi IN 
        (SELECT no_transaksi FROM transaksi WHERE no_transaksi LIKE '%$transaksi%')");



// memindahkan data dari order_customer menuju order_customer_fix
$key3 = "SELECT * FROM bayar";

$go3 = mysqli_query($conn,$key3);
$array4 = [];
while($row1 = mysqli_fetch_assoc($go3)){
    array_push($array4, $row1);
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders Admin</title>
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
			            <h3>Report Berhasil</h3>
		            </div>

                    <div class="card-body">
                        <!-- <a class="btn btn-primary" href="input_menu.php">+ Input Menu</a> -->
                        <br><br>
                        <table border="1" id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Transaksi</th>
                                    <th>No Order</th>
                                    <th>Id Menu</th>
                                    <th>Level</th>
                                    <th>Jumlah Order</th>
                                    <th>Total</th>
                                    <th>Tanggal Order</th>

                                </tr>
                            </thead>
                            <?php $i=1; ?>
                            <?php foreach ($menu as $row): ?> 
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $row['no_transaksi']; ?></td>
                                    <td><?= $row['no_order']; ?></td>
                                    <td><?= $row['id_menu']; ?></td>
                                    <td><?= $row['level']; ?></td>
                                    <td><?= $row['jumlah']; ?></td>
                                    <td><?= $row['total']; ?></td>
                                    <td><?= $row['tgl_order']; ?></td>
                                </tr>
                                 <?php $i++;?>   
                            <?php endforeach ?> 
                        </table>

                        <div class="col-12 row justify-content-center mt-2 mb-3">
                                <a  href="report_adm.php"
                                    style="font-size: 20px;" name="detail" 
                                    class="btn btn-danger mt-4 ml-2">
                                     Kembali
                                </a>
                            </form>
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