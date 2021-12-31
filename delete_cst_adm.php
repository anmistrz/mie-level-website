<?php 
	require('functions.php');
	$id_cst = $_GET["id"];

	if(delete_cst($id_cst) > 0){
		echo "
				<script>
					alert ('Data berhasil dihapus');
					document.location.href='customer.php';
				</script>
			";
		}
		else{
			/*echo(mysqli_error($conn));*/
			echo "
				<script>
					alert ('Data gagal dihapus');
					document.location.href='customer.php';
				</script>
			";
		}
	
?>