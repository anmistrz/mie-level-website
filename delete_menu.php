<?php 
	require('functions.php');
	$id_menu = $_GET["id"];

	if(delete_menu($id_menu) > 0){
		echo "
				<script>
					alert ('Data berhasil dihapus');
					document.location.href='menu.php';
				</script>
			";
		}
		else{
			/*echo(mysqli_error($conn));*/
			echo "
				<script>
					alert ('Data gagal dihapus');
					document.location.href='menu.php';
				</script>
			";
		}
	
?>