<?php 
	require_once 'koneksi.php';

	if (!isset($_SESSION['id_user'])) {
		header("Location: login.php");
		exit;
	}
	
	$id_tamu = $_GET['id_tamu'];
	$data_tamu = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tamu WHERE id_tamu = '$id_tamu'"));

	if (isset($_POST['btnUbah'])) {
		$nama_tamu = $_POST['nama_tamu'];
		$no_telp_tamu = $_POST['no_telp_tamu'];
		$alamat_tamu = $_POST['alamat_tamu'];

		$ubah_tamu = mysqli_query($koneksi, "UPDATE tamu SET nama_tamu = '$nama_tamu', no_telp_tamu = '$no_telp_tamu', alamat_tamu = '$alamat_tamu' WHERE id_tamu = '$id_tamu'");

		if ($ubah_tamu) {
			echo "
	            <script>
	                alert('Tamu berhasil diubah!')
	                window.location.href='tamu.php'
	            </script>
	        ";
	        exit;
		} else {
			echo "
	            <script>
	                alert('Tamu gagal diubah!')
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
	<title>Ubah Tamu - <?= $data_tamu['nama_tamu']; ?></title>
</head>
<body>
	<?php include_once 'navbar.php'; ?>
    <div class="container anti-navbar">
		<form method="post" class="form form-left">
			<h2>Ubah Tamu - <?= $data_tamu['nama_tamu']; ?></h2>
			<div>
				<label class="label" for="nama_tamu">Nama Tamu</label>
				<input class="input" type="text" name="nama_tamu" id="nama_tamu" required value="<?= $data_tamu['nama_tamu']; ?>">
			</div>
			<div>
				<label class="label" for="no_telp_tamu">No. Telp Tamu</label>
				<input class="input" type="number" name="no_telp_tamu" id="no_telp_tamu" required value="<?= $data_tamu['no_telp_tamu']; ?>">
			</div>
			<div>
				<label class="label" for="alamat_tamu">Alamat Tamu</label>
				<textarea class="input" name="alamat_tamu" id="alamat_tamu" required><?= $data_tamu['alamat_tamu']; ?></textarea>
			</div>
			<div>
				<button type="submit" name="btnUbah" class="button">Submit</button>
			</div>
		</form>
	</div>
</body>
</html>