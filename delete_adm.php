<?php 
	require('functions.php');
	$id_adm = $_GET["id"];

	if(delete_admin($id_adm) > 0){
		echo "
				<script>
					alert ('Data berhasil dihapus');
					document.location.href='admin.php';
				</script>
			";
		}
		else{
			/*echo(mysqli_error($conn));*/
			echo "
				<script>
					alert ('Data gagal dihapus');
					document.location.href='admin.php';
				</script>
			";
		}
	
?>