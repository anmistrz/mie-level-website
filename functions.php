<?php 
$conn = mysqli_connect("localhost", "root", "", "dbresto");

function query($query){
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)){
		$rows[] = $row;
	}
	return $rows;
}



// ADMIN

function upload_adm(){

    $namaFile = $_FILES['gambar_adm']['name'];
    $ukuranFile = $_FILES['gambar_adm']['size'];
    $error = $_FILES['gambar_adm']['error'];
    $tmpName = $_FILES['gambar_adm']['tmp_name'];

    if ($error == 6){
        echo "<script>
            alert('Gambar belum diupload');
        </script>";
        return false;
    } else {

        move_uploaded_file($tmpName, "photo/".$namaFile);

        return $namaFile;
    }
}


function tambah_admin($data){
    global $conn;
	$id_adm = $data['id_adm'];
    $nama_adm = htmlspecialchars($data["nama_adm"]);
	$telp_adm = htmlspecialchars($data["telp_adm"]);
    $alamat_adm = htmlspecialchars($data["alamat_adm"]);
	$username = htmlspecialchars($data["username"]);
	$password = htmlspecialchars($data["password"]);
	$gambar_adm = upload_adm();


	$query = "INSERT INTO admin VALUES ('$id_adm','$nama_adm', '$telp_adm', '$alamat_adm', '$username', '$password', '$gambar_adm')";
	mysqli_query($conn,$query);
	

    return mysqli_affected_rows($conn);
}


function edit_admin($data){
    global $conn;

    $id_adm = $data["id_adm"];
    $nama_adm = htmlspecialchars($data["nama_adm"]);
	$telp_adm = htmlspecialchars($data["telp_adm"]);
    $alamat_baru = htmlspecialchars($data["alamat_adm"]);
	$username = htmlspecialchars($data["username"]);
	$password = htmlspecialchars($data["password"]);
	$gambar_edit = upload_adm();

	if(isset($data['ubah_foto'])) {

			$query = "UPDATE admin SET
			nama_adm = '$nama_adm',
			telp_adm = '$telp_adm',
			alamat_adm = '$alamat_baru',
			username = '$username',
			password = '$password',
			gambar_adm = '$gambar_edit'

			WHERE id_adm = '$id_adm'";

			mysqli_query($conn,$query);	
	
	}else{

		$query = "UPDATE admin SET
		nama_adm = '$nama_adm',
		telp_adm = '$telp_adm',
		alamat_adm = '$alamat_baru',
		username = '$username',
		password = '$password'

		WHERE id_adm = '$id_adm'";

		mysqli_query($conn,$query);

	}

    

    return mysqli_affected_rows($conn);
}



function delete_admin($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM admin WHERE id_adm = '$id'");
    return mysqli_affected_rows($conn);
}




// MENU

function upload_menu(){

    $namaFile = $_FILES['foto_menu']['name'];
    $ukuranFile = $_FILES['foto_menu']['size'];
    $error = $_FILES['foto_menu']['error'];
    $tmpName = $_FILES['foto_menu']['tmp_name'];

    if ($error == 6){
        echo "<script>
            alert('Gambar belum diupload');
        </script>";
        return false;
    } else {

        move_uploaded_file($tmpName, "photo/".$namaFile);

        return $namaFile;
    }
}



function tambah_menu($data){
    global $conn;
	$id_menu = $data['id_menu'];
    $nama_menu = htmlspecialchars($data["nama_menu"]);
	$jenis_menu = htmlspecialchars($data["jenis_menu"]);
    $harga = htmlspecialchars($data["harga"]);
	$detail = htmlspecialchars($data["detail"]);
	$foto_menu = upload_menu();

	if(isset($data['jenis_menu'])){
		
		if($_POST['jenis_menu'] == "Makanan") {

			$sql = " SELECT max(id_menu) as mkn FROM menu WHERE id_menu LIKE '%MKN%' ";
			$hasil = mysqli_query($conn,$sql);
			$data = mysqli_fetch_array($hasil);
			$id_menu= $data['mkn'];
			
			$noUrut = (int) substr($id_menu, 3, 3);
			
			
			$noUrut++;
			
			
			$char = "MKN";
			$id_menu = $char . sprintf("%02s", $noUrut);
	
	
		}elseif ($_POST['jenis_menu'] == "Minuman") {
	 
			$sql = " SELECT max(id_menu) as mnm FROM menu WHERE id_menu LIKE '%MIN%' ";
			$hasil = mysqli_query($conn,$sql);
			$data = mysqli_fetch_array($hasil);
			$id_menu= $data['mnm'];
			
			$noUrut = (int) substr($id_menu, 3, 3);
			
			
			$noUrut++;
			
			
			$char = "MIN";
			$id_menu = $char . sprintf("%02s", $noUrut);
	
		}else{
	
			$sql = " SELECT max(id_menu) as dms FROM menu WHERE id_menu LIKE '%DIM%' ";
			$hasil = mysqli_query($conn,$sql);
			$data = mysqli_fetch_array($hasil);
			$id_menu= $data['dms'];
			
			$noUrut = (int) substr($id_menu, 3, 3);
			
			
			$noUrut++;
			
			
			$char = "DIM";
			$id_menu = $char . sprintf("%02s", $noUrut);
		}
		
	}


	$query = "INSERT INTO menu VALUES ('$id_menu','$nama_menu', '$jenis_menu', '$harga', '$detail', '$foto_menu')";
	mysqli_query($conn,$query);
	

    return mysqli_affected_rows($conn);
}



function edit_menu($data){
    global $conn;

    $id_menu = $data["id_menu"];
    $nama_menu = htmlspecialchars($data["nama_menu"]);
	$jenis_menu = htmlspecialchars($data["jenis_menu"]);
    $harga = htmlspecialchars($data["harga"]);
	$detail = htmlspecialchars($data["detail"]);
	$gambar_edit = upload_menu();

	if(isset($data['ubah_foto'])) {

			$query = "UPDATE menu SET
			nama_menu = '$nama_menu',
			jenis_menu = '$jenis_menu',
			harga = '$harga',
			detail = '$detail',
			foto_menu = '$gambar_edit'

			WHERE id_menu = '$id_menu'";

			mysqli_query($conn,$query);	
	
	}else{

		$query = "UPDATE menu SET
		nama_menu = '$nama_menu',
		jenis_menu = '$jenis_menu',
		harga = '$harga',
		detail = '$detail'

		WHERE id_menu = '$id_menu'";

		mysqli_query($conn,$query);

	}

    

    return mysqli_affected_rows($conn);
}


function delete_menu($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM menu WHERE id_menu = '$id'");
    return mysqli_affected_rows($conn);
}



// CUSTOMER

function upload_cst(){

    $namaFile = $_FILES['foto_cst']['name'];
    $ukuranFile = $_FILES['foto_cst']['size'];
    $error = $_FILES['foto_cst']['error'];
    $tmpName = $_FILES['foto_cst']['tmp_name'];

    if ($error == 6){
        echo "<script>
            alert('Gambar belum diupload');
        </script>";
        return false;
    } else {

        move_uploaded_file($tmpName, "photo/".$namaFile);

        return $namaFile;
    }
}



function tambah_cst($data){
    global $conn;
	$id_cst = $data['id_cst'];
    $nama_cst = htmlspecialchars($data["nama_cst"]);
	$alamat_cst = htmlspecialchars($data["alamat_cst"]);
    $nohp_cst = htmlspecialchars($data["nohp_cst"]);
	$username = htmlspecialchars($data["username"]);
	$password = htmlspecialchars($data["password"]);
	$foto_cst = upload_cst();


	$query = "INSERT INTO customer VALUES ('$id_cst','$nama_cst', '$alamat_cst', '$nohp_cst', '$username', '$password', '$foto_cst')";
	mysqli_query($conn,$query);
	

    return mysqli_affected_rows($conn);
}

function edit_cst($data){
    global $conn;

    $id_cst = $data["id_cst"];
    $nama_cst = htmlspecialchars($data["nama_cst"]);
	$nohp_cst = htmlspecialchars($data["nohp_cst"]);
    $alamat_baru = htmlspecialchars($data["alamat_cst"]);
	$username = htmlspecialchars($data["username"]);
	$password = htmlspecialchars($data["password"]);
	$foto_cst = upload_cst();

	if(isset($data['ubah_foto'])) {

			$query = "UPDATE customer SET
			nama_cst = '$nama_cst',
			nohp_cst = '$nohp_cst',
			alamat_cst = '$alamat_baru',
			username = '$username',
			password = '$password',
			foto_cst = '$foto_cst'

			WHERE id_cst = '$id_cst'";

			mysqli_query($conn,$query);	
	
	}else{

		$query = "UPDATE customer SET
		nama_cst = '$nama_cst',
		nohp_cst = '$nohp_cst',
		alamat_cst = '$alamat_baru',
		username = '$username',
		password = '$password'

		WHERE id_cst = '$id_cst'";

		mysqli_query($conn,$query);

	}

    

    return mysqli_affected_rows($conn);
}


function delete_cst($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM customer WHERE id_cst = '$id'");
    return mysqli_affected_rows($conn);
}



// ORDER

function total_order() {

	$jml_order = $_POST['jml_order'];
	$harga = $_POST['harga'];

	$hasil = $jml_order * $harga;
	return $hasil;
}


function tambah_order($data){
    global $conn;
	$no_order = $data['no_order'];
    $id_cst = htmlspecialchars($data["id_cst"]);
	$id_menu = htmlspecialchars($data["id_menu"]);
    $jml_order = htmlspecialchars($data["jml_order"]);
	$harga = htmlspecialchars($data["harga"]);
	$total = total_order();
	$tgl_order = htmlspecialchars($data["tgl_order"]);


	$query = "INSERT INTO order_customer VALUES ('$no_order','$id_cst', '$id_menu','', '$jml_order', '$total', '$tgl_order')";
	mysqli_query($conn,$query);
	

    return mysqli_affected_rows($conn);
}


function edit_order($data) {
    global $conn;
	$no_order = $data['no_order'];
    $id_cst = htmlspecialchars($data["id_cst"]);
	$id_menu = htmlspecialchars($data["id_menu"]);
    $jml_order = htmlspecialchars($data["jml_order"]);
	$total = total_order();
	$tgl_order = htmlspecialchars($data["tgl_order"]);

		$query = "UPDATE order_customer SET
		id_cst = '$id_cst',
		id_menu = '$id_menu',
		jumlah = '$jml_order',
		total = '$total',
		tgl_order = '$tgl_order'
	
		WHERE no_order = '$no_order'";

		mysqli_query($conn,$query);

		return mysqli_affected_rows($conn);

}

function delete_order($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM order_customer WHERE no_order = '$id'");
    return mysqli_affected_rows($conn);
}



function tambah_order_mkn($data){
    global $conn;
	$no_order = $data['no_order'];
    $id_cst = htmlspecialchars($data["id_cst"]);
	$id_menu = htmlspecialchars($data["id_menu"]);
	$level = htmlspecialchars($data["level"]);
    $jml_order = htmlspecialchars($data["jml_order"]);
	$harga = htmlspecialchars($data["harga"]);
	$tgl_order = htmlspecialchars($data["tgl_order"]);
	$total = total_order();


	$query = "INSERT INTO order_customer VALUES ('$no_order','$id_cst', '$id_menu','$level', '$jml_order', '$total', '$tgl_order')";
	mysqli_query($conn,$query);

	

    return mysqli_affected_rows($conn);
}


function edit_order_mkn($data) {
    global $conn;
	$no_order = $data['no_order'];
    $id_cst = htmlspecialchars($data["id_cst"]);
	$id_menu = htmlspecialchars($data["id_menu"]);
	$level = htmlspecialchars($data["level"]);
	$lvl_old = htmlspecialchars($data["lvl_old"]);
    $jml_order = htmlspecialchars($data["jml_order"]);
	$total = total_order();
	$tgl_order = htmlspecialchars($data["tgl_order"]);

	if($level == ""){
		$level = $lvl_old;
		$query = "UPDATE order_customer SET
		id_cst = '$id_cst',
		id_menu = '$id_menu',
		level = '$level',
		jumlah = '$jml_order',
		total = '$total',
		tgl_order = '$tgl_order'
	
		WHERE no_order = '$no_order'";

		mysqli_query($conn,$query);

	}else{
		$query = "UPDATE order_customer SET
		id_cst = '$id_cst',
		id_menu = '$id_menu',
		level = '$level',
		jumlah = '$jml_order',
		total = '$total',
		tgl_order = '$tgl_order'
	
		WHERE no_order = '$no_order'";

		mysqli_query($conn,$query);
	}


	return mysqli_affected_rows($conn);

}


function delete_order_mkn($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM order_customer WHERE no_order = '$id'");
    return mysqli_affected_rows($conn);
}





// PEMBAYARAN

function input_bayar($data){
	global $conn;
	$no_bayar = htmlspecialchars($data["no_byr"]);
	$no_transaksi =  htmlspecialchars($data["no_transaksi"]);
	$id_cst = htmlspecialchars($data["id_cst"]);
	$total_byr = htmlspecialchars($data["total_byr"]);
	$jenis_byr = htmlspecialchars($data["jenis_byr"]);
	$tgl_byr = htmlspecialchars($data["tgl_byr"]);
	$status = htmlspecialchars($data["status"]);

	$query = "INSERT INTO bayar VALUES ('$no_bayar','$no_transaksi','$id_cst', '$total_byr','$jenis_byr', '$tgl_byr', '$status')";
	mysqli_query($conn,$query);
	return mysqli_affected_rows($conn);
}



// CUSTOMER



?>
