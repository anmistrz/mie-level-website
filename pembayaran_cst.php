<?php
session_start();
require('functions.php');
// error_reporting(0);

$no_transaksi = $_GET['id'];
$order = query("SELECT transaksi.no_transaksi, order_customer_fix.id_cst, transaksi.total_byr FROM 
        transaksi, order_customer_fix WHERE transaksi.no_order= order_customer_fix.no_order AND 
        transaksi.no_transaksi = '$no_transaksi'")[0];



// Untuk Nomor Pembayaran
$sql = "SELECT max(no_bayar) as maxBy FROM Bayar";
$hasil = mysqli_query($conn,$sql);
$data = mysqli_fetch_array($hasil);
$no_byr= $data['maxBy'];

$noUrut = (int) substr($no_byr, 4, 4);


$noUrut++;


$char = "BYR-";
$no_byr = $char . sprintf("%03s", $noUrut);


$status ='BELUM DICEK';


?>
<?php
if(isset($_POST['submit'])){

    //cek keberhasilan
    if(input_bayar($_POST) > 0){

        echo "
            <script>
                alert('Transaksi Sukses Terima Kasih :)');
                document.location.href = 'order_cst.php?id=$no_byr';
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
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
                    <a href="reports_cst.php">Reports</a>
            </div>
        </div>
    
   
        <div class="content" id="content">

                <div class="card">
		            <div class="card-header">
			            <h3>  Edit Menu </h3>
		            </div>

                    <div class="card-body">
                        <div class="row align-items-center justify-content-center" style="kotak_input_room">
                            <form method="POST"   class="kotak_input_room" enctype="multipart/form-data">
                                <div class="row mb-4">
                                    <input type="text" class="form-control" name='no_byr' id="no_byr" required value="<?=$no_byr;?>" readonly>
                                </div>  
                                <div class="row mb-4">
                                    <label for="nama_adm" class="col-sm-2 col-form-label">Id Customer</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name='id_cst' id="id_cst" required value="<?=$order['id_cst'];?>" readonly>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="username" class="col-sm-2 col-form-label">No Transaksi</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name='no_transaksi' id="no_transaksi" required value="<?=$order['no_transaksi'];?>" readonly>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="password" class="col-sm-2 col-form-label">Total Bayar</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name='total_byr' id="total_byr" required value="<?=$order['total_byr'];?>" readonly>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="password" class="col-sm-2 col-form-label">Tanggal Bayar</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name='tgl_byr' id="tgl_byr" required value="<?=date('Y-m-d')?>" readonly>
                                        <input type="hidden" class="form-control" name='status' id="status" required value="<?= $status;?>" readonly>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="password" class="col-sm-2 col-form-label">Cara Bayar</label>
                                    <div class="col-sm-10">
                                        <select name="jenis_byr" class="form-control" aria-label=".form-select-lg example" required>

                                            <option disabled selected>Choose....</option>
                                            <option value="Cash" >Cash</option>
                                            <option value="Gopay" >Gopay</option>
                                            <option value="Ovo" >Ovo</option>
                                            <option value="Kartu ATM" >Kartu ATM</option>

                                        </select>
                                </div>
                                <div class="row  mb-4 mt-4">
                                    <div class="col-sm-12 ml-4 row  justify-content-center">
                                        <button type="submit" name='submit' class="btn btn-primary" 
                                                style="padding: 5px 100px 5px; font-size: 15pt">
                                                <span data-feather="credit-card" class="mb-1"></span>  Bayar
                                        </button>
                                    </div>
                                </div>
                            </form>           
                        </div>         
                    </div>
                </div>



        </div>

    <script>feather.replace()</script>
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