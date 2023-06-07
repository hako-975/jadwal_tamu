<?php 
	require_once 'koneksi.php';

	if (!isset($_SESSION['id_user'])) {
		header("Location: login.php");
		exit;
	}

	$id_jadwal = $_GET['id_jadwal'];

	$hapus_jadwal = mysqli_query($koneksi, "DELETE FROM jadwal WHERE id_jadwal = '$id_jadwal'");

	if ($hapus_jadwal) {
		echo "
			<script>
				alert('Jadwal berhasil dihapus!')
				window.location.href='jadwal.php'
			</script>
		";
		exit;
	} else {
		echo "
			<script>
				alert('Jadwal gagal dihapus!')
				window.history.back()
			</script>
		";
		exit;

	}
