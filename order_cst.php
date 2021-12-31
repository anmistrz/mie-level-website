<?php 
session_start();
require "functions.php";

$order = query(
    "SELECT order_customer.no_order, menu.foto_menu, menu.id_menu, menu.nama_menu ,order_customer.level, 
    order_customer.jumlah, order_customer.total, order_customer.tgl_order  FROM menu, order_customer WHERE 
    menu.id_menu = order_customer.id_menu");



// untuk jumlah order (card)
$sql = "SELECT max(no_order) as maxOr FROM order_customer";
$hasil = mysqli_query($conn,$sql);
$data = mysqli_fetch_array($hasil);
$no_order= $data['maxOr'];

$noUrut = (int) substr($no_order, 3, 3);

$card = $noUrut;

$noUrut++;



// Mnegitung harga keseluruhan yang harus dibayar
$sql1 = "SELECT sum(total) as all_total FROM order_customer";
$hasil1 = mysqli_query($conn,$sql1);
$data1 = mysqli_fetch_array($hasil1);
$bayar= $data1['all_total'];
?>

<?php 

// array id_menu makanan (Untuk Button)
$query1 = " SELECT id_menu FROM menu WHERE id_menu LIKE '%MKN%' ";
$result = mysqli_query($conn,$query1);

$array = [];
while($row = mysqli_fetch_assoc($result)){
    array_push($array, $row['id_menu']);
 }

 
// array selain id_menu makanan (Untuk Button)
$query2 = " SELECT id_menu  FROM menu WHERE id_menu NOT LIKE '%MKN%'";
$result1 = mysqli_query($conn,$query2);

$array1 = [];
while($row1 = mysqli_fetch_assoc($result1)){
    array_push($array1, $row1['id_menu']);
 }


?>



<?php 
// Untuk Mengisi Nomor Transaksi dan Nomor Order di tabel transaksi
// Untuk Pengisian Nomor Order
$key = " SELECT no_order FROM order_customer ";
$go1 = mysqli_query($conn,$key);

$array3 = [];
while($row = mysqli_fetch_assoc($go1)){
    array_push($array3, $row['no_order']);
 }



// Untuk Pengisian Nomor ORDER di Transaksi
$kunci = "SELECT max(no_order) as maxOr FROM order_customer_fix";
$a = mysqli_query($conn,$kunci);
$belah = mysqli_fetch_array($a);
$no_order= $belah['maxOr'];
$sort= (int) substr($no_order, 4, 4);


// Untuk Pengisian Nomor ORDER di Order_customer_fix
$kunci1 = "SELECT max(no_order) as maxOr FROM order_customer_fix";
$b = mysqli_query($conn,$kunci1);
$belah1 = mysqli_fetch_array($b);
$no_order1= $belah1['maxOr'];
$sort1= (int) substr($no_order1, 4, 4);



// Untuk Pengisian Nomor Transaksi
$key1 = "SELECT max(no_transaksi) as maxTra FROM transaksi";
$go = mysqli_query($conn,$key1);
$pecah = mysqli_fetch_array($go);
$no_transaksi= $pecah['maxTra'];

$Urutan = (int) substr($no_transaksi, 4, 4);
$Urutan++;

// menambah nomor transaksi ke tabel transaksi 
function tambah_transaksi($array,$no_or, $no_transaksi, $pembayaran) {
    global $conn;
    global $id;

    foreach($array as $a){
        $no_or++;
        $huruf = "OR-";
        $or = $huruf . sprintf("%03s", $no_or);
        $char = "TRA-";
        $transaksi = $char . sprintf("%03s", $no_transaksi);
        $key2 ="INSERT INTO transaksi VALUES ('$transaksi','$or','$pembayaran')";
        $go2 = mysqli_query($conn,$key2);
    }
    $id = $transaksi;
    return mysqli_affected_rows($conn);
}


// memindahkan data dari order_customer menuju order_customer_fix
$key3 = "SELECT * FROM order_customer";
$go3 = mysqli_query($conn,$key3);
$array4 = [];
while($row1 = mysqli_fetch_assoc($go3)){
    array_push($array4, $row1);
 }

function move_temp_order($data, $no_or){
    global $conn;
    foreach($data as $row){
        $no_or++;
        $huruf = "OR-";
        $or = $huruf . sprintf("%03s", $no_or);


        $id_cst = $row['id_cst'];
        $id_menu = $row['id_menu'];
        $level = $row['level'];
        $jumlah = $row['jumlah'];
        $total = $row['total'];
        $tgl_order = $row['tgl_order'];

        $key4 = "INSERT INTO order_customer_fix VALUES 
        (null, '$or', '$id_cst', '$id_menu', '$level', '$jumlah', '$total', '$tgl_order')";

        $go4 = mysqli_query($conn,$key4);
    }
}


function delete_order_cst(){
    global $conn;
    $key5 = "DELETE FROM order_customer";
    $go5 = mysqli_query($conn,$key5);
}




if(isset($_POST['bayar'])) {
    tambah_transaksi($array3,$sort ,$Urutan, $bayar);
    move_temp_order($array4, $sort1);
    delete_order_cst();

    echo "
    <script>
        document.location.href = 'pembayaran_cst.php?id=$id';
    </script>
";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders Customer</title>
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

                        <table border="1" id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr align="center">
                                    <th>No</th>
                                    <th>No Order</th>
                                    <th>Foto Menu</th>
                                    <th>Id Menu</th>
                                    <th>Nama Menu</th>
                                    <th>Level</th>
                                    <th>Jumlah Order</th>
                                    <th>Total</th>
                                    <th>Tgl Order</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <?php $i=1; ?>
                            <?php foreach ($order as $row): ?>
                                <tr align="center">
                                    <td><?= $i; ?></td>
                                    <td><?= $row["no_order"]; ?></td>
                                    <td><img src="photo/<?= $row["foto_menu"];?>" width="90"></td>
                                    <td><?= $row["id_menu"]; ?></td>
                                    <td><?= $row["nama_menu"]; ?></td>
                                    <td><?= $row["level"]; ?></td>
                                    <td><?= $row["jumlah"]; ?></td>
                                    <td><?= $row["total"]; ?></td>
                                    <td><?= $row["tgl_order"]; ?></td>
                                    <td>

                                    <?php 

                                        foreach($array as $mkn){

                                            $link = $row['no_order'];

                                            if($row['id_menu'] == $mkn) { 
                                                
                                                echo "
                                                    
                                                    <a href=\"edit_order_mkn.php?id=$link\" class=\"link btn btn-info\"><span data-feather=\"edit\"></span></a>
                                                    <a href=\"delete_order_mkn.php?id=$link\" class=\"link btn btn-danger\"> <span data-feather=\"trash-2\"></span></a>

                                                ";           

                                            }
                                            
                                        }

                                        foreach($array1 as $md) {

                                            $link = $row['no_order'];

                                            if($row['id_menu'] == $md) { 
                                                
                                                echo "
                                                    <a href=\"edit_order.php?id=$link\"class=\"link btn btn-info\"><span data-feather=\"edit\"></span></a>
                                                    <a href=\"delete_order.php?id=$link\" class=\"link btn btn-danger\"> <span data-feather=\"trash-2\"></span></a>
                                                ";           

                                            }

                                        }

                                    ?>


                                    </td>
                                </tr>
                            <?php $i++;?>   
                            <?php endforeach ?>
                        </table>
                    
                        <div class="col-12 row justify-content-center mt-3 mb-3">
                            <h1>Total yang harus dibayar :</h1>
                            <h1 class="ml-3" style="color:red;">Rp. <?= $bayar; ?>,-</h1>
                        </div>

                        <div class="col-12 row justify-content-center mt-2 mb-3">
                            <form method="post">
                                <button 
                                    name="bayar" id="bayar" 
                                    style="font-size: 20px;" name="detail" 
                                    class="btn btn-primary mt-4">
                                    <span data-feather="credit-card"></span>   Bayar Order
                                </button>
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