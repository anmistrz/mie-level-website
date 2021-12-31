<?php
    require("functions.php");

    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        //cek user login admin
        $cek_login_adm= mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username' and password='$password'");
        $result_adm = $cek_login_adm->num_rows;
        $rows_adm= $cek_login_adm->fetch_assoc();

        //cek user login customer
        $cek_login_cst= mysqli_query($conn, "SELECT * FROM customer WHERE username = '$username' and password='$password'");
        $result_cst = $cek_login_cst->num_rows;
        $rows_cst= $cek_login_cst->fetch_assoc();    
    
        if($result_adm >= 1){
            //login username cocok
            //verify password 
            if($password == $rows_adm['password'] && $username== $rows_adm['username']){
                session_start();
                $_SESSION['username']=$rows_adm['username'];
                $_SESSION['id_adm']=$rows_adm['id_adm'];
                $_SESSION['nama_adm']=$rows_adm['nama_adm'];
                $_SESSION['gambar_adm']=$rows_adm['gambar_adm'];
    
                echo "
                    <script>
                        alert ('Login Admin Berhasil');
                        document.location.href = 'dashboard.php';
                    </script>
                ";
    
            }

        }elseif($result_cst >= 1){

            if($password == $rows_cst['password'] && $username== $rows_cst['username']){
                session_start();
                $_SESSION['username']=$rows_cst['username'];
                $_SESSION['id_cst']=$rows_cst['id_cst'];
                $_SESSION['nama_cst']=$rows_cst['nama_cst'];
                $_SESSION['foto_cst']=$rows_cst['foto_cst'];
    
                echo "
                    <script>
                        alert ('Login Customer Berhasil');
                        document.location.href = 'dashboard_cst.php';
                    </script>
                ";
                //silakan buat session dan redirect disini 

            }

        }else{
            //login gagal
            echo "
                    <script>
                        alert ('Username dan Password yang anda masukkan salah');
                    </script>
                ";
        }
    }
    
?>


<!doctype html>
<html lang="en">
<head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Mie Level Huuhaah </title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
	    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
        <!-- End of boostrap link -->
	
	<link rel="stylesheet" type="text/css" href="index.css">
</head>
    <body>
    
    <div class="login">
        
        <div class="kotak_login  shadow">
            <div class="judul">

            </div>
            <h4 style="text-align: center; margin: 20px auto; text-transform: uppercase;">Login Akun</h4>
            <div class="container-form" style="padding: 10px 20px;">
                <form method="post">
                    <label>Username</label>
                    <input type="text" name="username" class="form_login" placeholder="Username .." required>

                    <label>Password</label>
                    <input type="password" name="password" class="form_login" placeholder="Password .." required>

                    <input type="submit" name="login" class=" btn btn-primary tombol_login" value="LOGIN">

                    <p class="sign_up"> Do you haven't account ?  <a href="daftar.php"> Sign up </a> </p>
                </form>
            </div>  
        </div>
    </div>
        
    </body>
</html>