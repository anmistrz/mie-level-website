<?php 
session_start();
require "functions.php";

$menu = query("SELECT * FROM menu");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
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
			            <h3> Menu </h3>
		            </div>

                    <div class="card-body">
                        <a class="btn btn-primary" href="input_menu.php">+ Input Menu</a>
                        <br><br>
                        <table border="1" id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr align="center">
                                    <th>No</th>
                                    <th>Foto Menu</th>
                                    <th>Id Menu</th>
                                    <th>Nama Menu</th>
                                    <th>Jenis Menu</th>
                                    <th>Harga</th>
                                    <th>Detail</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <?php $i=1; ?>
                            <?php foreach ($menu as $row): ?>
                                <tr align="center">
                                    <td><?= $i; ?></td>
                                    <td><img src="photo/<?= $row["foto_menu"];?>" width="90"></td>
                                    <td><?= $row["id_menu"]; ?></td>
                                    <td><?= $row["nama_menu"]; ?></td>
                                    <td><?= $row["jenis_menu"]; ?></td>
                                    <td><?= $row["harga"]; ?></td>
                                    <td><?= $row["detail"]; ?></td>
                                    <td>
                                        <a href="edit_menu.php?id=<?=$row['id_menu']?>" class="link btn btn-info"><span data-feather="edit"></span></a>
                                        <a href="delete_menu.php?id=<?=$row['id_menu']?>" class="link btn btn-danger"> <span data-feather="trash-2"></span></a>
                                    </td>
                                </tr>
                            <?php $i++;?>   
                            <?php endforeach ?>
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