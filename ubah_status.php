<?php 
	require_once 'koneksi.php';

	if (!isset($_SESSION['id_user'])) {
		header("Location: login.php");
		exit;
	}

	$id_jadwal = $_GET['id_jadwal'];

	$hapus_jadwal = mysqli_query($koneksi, "UPDATE jadwal SET status = 'SUDAH' WHERE id_jadwal = '$id_jadwal'");

	if ($hapus_jadwal) {
		echo "
			<script>
				alert('Status Jadwal berhasil diubah!')
				window.location.href='index.php'
			</script>
		";
		exit;
	} else {
		echo "
			<script>
				alert('Status Jadwal gagal diubah!')
				window.history.back()
			</script>
		";
		exit;

	}
