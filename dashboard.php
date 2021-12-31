<?php
        require('functions.php');
        session_start();
?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <link rel="stylesheet" href="style.css?v=1.0">

        <title>Admin Mie level Huuhaah </title>

        <!--  Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <!-- End of boostrap link -->

        <!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
        <script src="Chart.bundle.js"></script>

    </head>
    <body>
        <!-- Navbar -->
        <div class="judul sticky-top">
                <button class="openbtn" onclick="openNav()">&#9776;</button>
                <div class="brand row align-items-center justify-content-center">
                    <img src="img/logo.png" class="logo">
                    <h2>Mie level Huuhaah</h2>
                </div>
                <div class="account d-flex row align-items-center">
                    <div class="dropdown">
                        <?php
                            $id = $_SESSION['id_adm'];    
                            $hasil = mysqli_query($conn,"SELECT * FROM admin WHERE id_adm = '$id'");
                            $data = mysqli_fetch_assoc($hasil); 
                        ?>
                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="true">
                        <img src="photo/<?= $data['gambar_adm'];?>" class="bulat" style="background-size:cover; background-color:black;"><?= $data['nama_adm'];?>
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
        <!-- End of navbar-->

        <!-- Content-->
        <div class="content" id="content">
                <main role="main" class="col-11 ml-sm-auto  px-md-4 mr-10">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2">Dashboard</h1>
                    </div>

                <canvas class="my-4 w-80" id="myChart" width="800px" height="300px"></canvas>
        
                </main>
        </div>        
        <!-- End of Content-->
         
</div>
</div>
               
        <!-- Online Boostrap js-->
        <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.min.js"></script> -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>


        <!--End of Online Boostrap js-->
        <script>
            'use strict'

            feather.replace()
            var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Aug", "Sep", "Okt", "Nov", "Des"],
                    datasets: [{
                            label: 'Grafik Transaksi Berhasil',
                            data: [
                            <?php $jan = mysqli_query($conn, "SELECT * FROM bayar_berhasil WHERE MONTH(tgl_byr) = '01' AND YEAR(tgl_byr) = YEAR(CURRENT_DATE())");
                            echo (mysqli_num_rows($jan));
                            ?>,
                            <?php $feb = mysqli_query($conn, "SELECT * FROM bayar_berhasil WHERE MONTH(tgl_byr) = '02' AND YEAR(tgl_byr) = YEAR(CURRENT_DATE())");
                            echo (mysqli_num_rows($feb));
                            ?>,
                            <?php $mar = mysqli_query($conn, "SELECT * FROM bayar_berhasil WHERE MONTH(tgl_byr) = '03' AND YEAR(tgl_byr) = YEAR(CURRENT_DATE())");
                            echo (mysqli_num_rows($mar));
                            ?>,
                            <?php $apr = mysqli_query($conn, "SELECT * FROM bayar_berhasil WHERE MONTH(tgl_byr) = '04' AND YEAR(tgl_byr) = YEAR(CURRENT_DATE())");
                            echo (mysqli_num_rows($apr));
                            ?>,
                            <?php $mei = mysqli_query($conn, "SELECT * FROM bayar_berhasil WHERE MONTH(tgl_byr) = '05' AND YEAR(tgl_byr) = YEAR(CURRENT_DATE())");
                            echo (mysqli_num_rows($mei));
                            ?>,
                            <?php $jun = mysqli_query($conn, "SELECT * FROM bayar_berhasil WHERE MONTH(tgl_byr) = '06' AND YEAR(tgl_byr) = YEAR(CURRENT_DATE())");
                            echo (mysqli_num_rows($jun));
                            ?>,
                            <?php $jul = mysqli_query($conn, "SELECT * FROM bayar_berhasil WHERE MONTH(tgl_byr) = '07' AND YEAR(tgl_byr) = YEAR(CURRENT_DATE())");
                            echo (mysqli_num_rows($jul));
                            ?>,
                            <?php $aug = mysqli_query($conn, "SELECT * FROM bayar_berhasil WHERE MONTH(tgl_byr) = '08' AND YEAR(tgl_byr) = YEAR(CURRENT_DATE())");
                            echo (mysqli_num_rows($aug));
                            ?>,
                            <?php $sep = mysqli_query($conn, "SELECT * FROM bayar_berhasil WHERE MONTH(tgl_byr) = '09' AND YEAR(tgl_byr) = YEAR(CURRENT_DATE())");
                            echo (mysqli_num_rows($sep));
                            ?>,
                            <?php $okt = mysqli_query($conn, "SELECT * FROM bayar_berhasil WHERE MONTH(tgl_byr) = '10' AND YEAR(tgl_byr) = YEAR(CURRENT_DATE())");
                            echo (mysqli_num_rows($okt));
                            ?>,
                            <?php $nov = mysqli_query($conn, "SELECT * FROM bayar_berhasil WHERE MONTH(tgl_byr) = '11' AND YEAR(tgl_byr) = YEAR(CURRENT_DATE())");
                            echo (mysqli_num_rows($nov));
                            ?>,
                            <?php $des = mysqli_query($conn, "SELECT * FROM bayar_berhasil WHERE MONTH(tgl_byr) = '12' AND YEAR(tgl_byr) = YEAR(CURRENT_DATE())");
                            echo (mysqli_num_rows($des));
                            ?>

                            ],
                            lineTension: 0,
        backgroundColor: 'transparent',
        borderColor: '#007bff',
        borderWidth: 4,
        pointBackgroundColor: '#007bff'
      }]
    },
                options: {
                    scales: {
                        yAxes: [{
                                ticks: {
                                    beginAtZero: false
                                }
                            }]
                    }
                }
            });
        </script>

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

        <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->

    
    </body>
</html>