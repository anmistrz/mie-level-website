<?php 
session_start();
require "functions.php";

$menu = query("SELECT * FROM menu");



//untuk jumlah order
$sql = "SELECT max(no_order) as maxOr FROM order_customer";
$hasil = mysqli_query($conn,$sql);
$data = mysqli_fetch_assoc($hasil);
$no_order= $data['maxOr'];

$noUrut = (int) substr($no_order, 3, 3);

$card = $noUrut;

$noUrut++;



?>

<?php 

// array id_menu makanan (Untuk Button)
$sql1 = " SELECT id_menu FROM menu WHERE id_menu LIKE '%MKN%' ";
$result = mysqli_query($conn,$sql1);

$array = [];
while($row = mysqli_fetch_assoc($result)){
    array_push($array, $row['id_menu']);
 }

 
// array selain id_menu makanan (Untuk Button)
$query = " SELECT id_menu  FROM menu WHERE id_menu NOT LIKE '%MKN%'";
$result1 = mysqli_query($conn,$query);

$array1 = [];
while($row1 = mysqli_fetch_assoc($result1)){
    array_push($array1, $row1['id_menu']);
 }

//  var_dump($array);
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
            $('#search').on('keyup', function() {
                $.ajax({
                    type: 'POST',
                    url: 'search.php',
                    data: {
                        search: $(this).val()
                    },
                    cache: false,
                    success: function(data) {
                        $('#tampil').html(data);
                    }
                });
            });
        });
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
                    <a href="profile_cst.php">Profile</a>
                    <a href="report_cst.php">Reports</a>
            </div>
        </div>
    
   
        <div class="content" id="content">

                <div class="card">
		            <div class="card-header">
			            <h3>List Menu</h3>
		            </div>

                    <div class="card-body">
                        <label for="search" class="mt-3"><h5>Search Menu</h5></label>
                        <input type="text" id="search" class="form-control mb-2 " placeholder="Search nama menu ...">

                        <form action="dashboard_cst.php" method="POST">
                            <table id="tampil" class=" row justify-content-center content" >
                                <tr>
                                    <?php $i=1; ?>
                                    <?php foreach($menu as $value) { ?>
                                        <td>
                                            <div class="card row m-4" style="width: 18rem; height: 32rem;">
                                                <img src="photo/<?= $value["foto_menu"];?>" width="60" height="200" class="card-img-top" style="background-size:cover;">
                                                <div class="card-body">
                                                    <input type="hidden" class="form-control" name='id_menu' id="id_menu" value="<?= $value['id_menu'];?>">
                                                    <h5 class="card-title"><?= $value["nama_menu"]; ?></h5>

                                                        <p class="card-text"><?= substr($value["detail"],0, 120)."[...]" ?></p>
                                                    
                                                    <h3 class="card-text" style="color:green;">Rp.<?= $value["harga"]; ?></h3>

                                                    <?php 

                                                    foreach($array as $mkn){

                                                        // $link = $value['id_menu'];

                                                        if($value['id_menu'] == $mkn) { 
                                                            
                                                            echo "
                                                                <a href=\"detail_menu_mkn.php?id=$mkn\" class=\"btn btn-primary mt-2\"> Order  Menu </a>
                                                            ";           

                                                        }
                                                        
                                                    }

                                                    foreach($array1 as $md) {

                                                        // $link = $value['id_menu'];

                                                        if($value['id_menu'] == $md) { 
                                                            
                                                            echo "
                                                                <a href=\"detail_menu.php?id=$md\" class=\"btn btn-primary mt-2\"> Order Menu </a>
                                                            ";           

                                                        }
                                                   
                                                    }

                                                    ?>

                                                
                                                </div>
                                            </div>                                
                                        </td>
                                        <?php
                                        if ($i%4 == 0) echo "</tr><tr>";
                                        $i++;
                                        } ?>
                                </tr>
                            </table>                                       
                        </form>

               
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