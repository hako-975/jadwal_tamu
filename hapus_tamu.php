<?php 
	require_once 'koneksi.php';

	if (!isset($_SESSION['id_user'])) {
		header("Location: login.php");
		exit;
	}

	$id_tamu = $_GET['id_tamu'];

	$hapus_tamu = mysqli_query($koneksi, "DELETE FROM tamu WHERE id_tamu = '$id_tamu'");

	if ($hapus_tamu) {
		echo "
			<script>
				alert('Tamu berhasil dihapus!')
				window.location.href='tamu.php'
			</script>
		";
		exit;
	} else {
		echo "
			<script>
				alert('Tamu gagal dihapus!')
				window.history.back()
			</script>
		";
		exit;

	}
