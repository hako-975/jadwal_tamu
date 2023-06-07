<?php 
	require_once 'koneksi.php';

	if (!isset($_SESSION['id_user'])) {
		header("Location: login.php");
		exit;
	}

	$tamu = mysqli_query($koneksi, "SELECT * FROM tamu ORDER BY nama_tamu ASC");

	if (isset($_POST['btnTambah'])) {
		$id_tamu = $_POST['id_tamu'];
		$jadwal_tamu = $_POST['jadwal_tamu'];
		$tujuan = $_POST['tujuan'];
		$status = 'BELUM';
		
		$tambah_jadwal = mysqli_query($koneksi, "INSERT INTO jadwal VALUES ('', '$id_tamu', '$jadwal_tamu', '$tujuan', '$status')");

		if ($tambah_jadwal) {
			echo "
	            <script>
	                alert('Jadwal berhasil ditambahkan!')
	                window.location.href='jadwal.php'
	            </script>
	        ";
	        exit;
		} else {
			echo "
	            <script>
	                alert('Jadwal gagal ditambahkan!')
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
	<title>Tambah Jadwal</title>
</head>
<body>
	<?php include_once 'navbar.php'; ?>
    <div class="container anti-navbar">
		<form method="post" class="form form-left">
		<h2>Tambah Jadwal</h2>
			<div>
				<label class="label" for="id_tamu">Nama Tamu</label>
				<select class="input" name="id_tamu" id="id_tamu">
					<?php foreach ($tamu as $data): ?>
						<option value="<?= $data['id_tamu']; ?>"><?= $data['nama_tamu']; ?></option>
					<?php endforeach ?>
				</select>
			</div>
			<div>
				<label class="label" for="jadwal_tamu">Jadwal Tamu</label>
				<input type="datetime-local" class="input" name="jadwal_tamu" id="jadwal_tamu" required value="<?= date('Y-m-d H:i'); ?>">
			</div>
			<div>
				<label class="label" for="tujuan">Tujuan</label>
				<textarea class="input" name="tujuan" id="tujuan" required></textarea>
			</div>
			<div>
				<button type="submit" class="button" name="btnTambah">Submit</button>
			</div>
		</form>
	</div>
</body>
</html>