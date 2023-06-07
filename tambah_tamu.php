<?php 
	require_once 'koneksi.php';

	if (!isset($_SESSION['id_user'])) {
		header("Location: login.php");
		exit;
	}

	if (isset($_POST['btnTambah'])) {
		$nama_tamu = $_POST['nama_tamu'];
		$no_telp_tamu = $_POST['no_telp_tamu'];
		$alamat_tamu = $_POST['alamat_tamu'];

		$tambah_tamu = mysqli_query($koneksi, "INSERT INTO tamu VALUES ('', '$nama_tamu', '$no_telp_tamu', '$alamat_tamu')");

		if ($tambah_tamu) {
			echo "
	            <script>
	                alert('Tamu berhasil ditambahkan!')
	                window.location.href='tamu.php'
	            </script>
	        ";
	        exit;
		} else {
			echo "
	            <script>
	                alert('Tamu gagal ditambahkan!')
	                window.history.back()
	            </script>
	        ";
	        exit;
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include_once 'head.php'; ?>
	<title>Tambah Tamu</title>
</head>
<body>
	<?php include_once 'navbar.php'; ?>
    <div class="container anti-navbar">
		<form method="post" class="form form-left">
			<h2>Tambah Tamu</h2>
			<div>
				<label class="label" for="nama_tamu">Nama Tamu</label>
				<input type="text" class="input" name="nama_tamu" id="nama_tamu" required>
			</div>
			<div>
				<label class="label" for="no_telp_tamu">No. Telp Tamu</label>
				<input class="input" type="number" name="no_telp_tamu" id="no_telp_tamu" required>
			</div>
			<div>
				<label class="label" for="alamat_tamu">Alamat Tamu</label>
				<textarea class="input" name="alamat_tamu" id="alamat_tamu" required></textarea>
			</div>
			<div>
				<button type="submit" class="button" name="btnTambah">Submit</button>
			</div>
		</form>
	</div>
</body>
</html>