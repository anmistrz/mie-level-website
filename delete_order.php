<?php 
	require('functions.php');
	$no_order = $_GET["id"];

	
	$sql = "SELECT max(no_order) as maxOr FROM order_customer";
	$hasil = mysqli_query($conn,$sql);
	$data = mysqli_fetch_array($hasil);
	$no_order= $data['maxOr'];

	$noUrut = (int) substr($no_order, 3, 3);

	$card = $noUrut;

	$noUrut--;


	if(delete_order($no_order) > 0){
		echo "
				<script>
					alert ('Data berhasil dihapus');
					document.location.href='order_cst.php';
				</script>
			";
		}
		else{
			/*echo(mysqli_error($conn));*/
			echo "
				<script>
					alert ('Data gagal dihapus');
					document.location.href='order_cst.php';
				</script>
			";
		}
	
?>