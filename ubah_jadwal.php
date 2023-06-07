<?php 
	require_once 'koneksi.php';

	if (!isset($_SESSION['id_user'])) {
		header("Location: login.php");
		exit;
	}

	$tamu = mysqli_query($koneksi, "SELECT * FROM tamu ORDER BY nama_tamu ASC");

	$id_jadwal = $_GET['id_jadwal'];
	$data_jadwal = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM jadwal INNER JOIN tamu ON jadwal.id_tamu = tamu.id_tamu WHERE id_jadwal = '$id_jadwal'"));

	if (isset($_POST['btnJadwal'])) {
		$id_tamu = $_POST['id_tamu'];
		$jadwal_tamu = $_POST['jadwal_tamu'];
		$tujuan = $_POST['tujuan'];
		$status = $_POST['status'];

		$ubah_jadwal = mysqli_query($koneksi, "UPDATE jadwal SET id_tamu = '$id_tamu', jadwal_tamu = '$jadwal_tamu', tujuan = '$tujuan', status = '$status' WHERE id_jadwal = '$id_jadwal'");

		if ($ubah_jadwal) {
			echo "
	            <script>
	                alert('Jadwal berhasil diubah!')
	                window.location.href='jadwal.php'
	            </script>
	        ";
	        exit;
		} else {
			echo "
	            <script>
	                alert('Jadwal gagal diubah!')
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
	<title>Ubah Jadwal - <?= $data_jadwal['nama_tamu']; ?></title>
</head>
<body>
	<?php include_once 'navbar.php'; ?>
    <div class="container anti-navbar">
		<form method="post" class="form form-left">
			<h2>Ubah Jadwal - <?= $data_jadwal['nama_tamu']; ?></h2>
			<div>
				<label class="label" for="id_tamu">Nama Tamu</label>
				<select class="input" name="id_tamu" id="id_tamu">
					<option value="<?= $data_jadwal['id_tamu']; ?>"><?= $data_jadwal['nama_tamu']; ?></option>
					<?php foreach ($tamu as $data): ?>
						<?php if ($data_jadwal['id_tamu'] != $data['id_tamu']): ?>
							<option value="<?= $data['id_tamu']; ?>"><?= $data['nama_tamu']; ?></option>
						<?php endif ?>
					<?php endforeach ?>
				</select>
			</div>
			<div>
				<label class="label" for="jadwal_tamu">Jadwal Tamu</label>
				<input class="input" type="datetime-local" name="jadwal_tamu" id="jadwal_tamu" required value="<?= $data_jadwal['jadwal_tamu']; ?>">
			</div>
			<div>
				<label class="label" for="tujuan">Tujuan</label>
				<textarea class="input" name="tujuan" id="tujuan" required><?= $data_jadwal['tujuan']; ?></textarea>
			</div>
			<div>
				<label class="label" for="status">Status</label>
				<select class="input" name="status" id="status">
					<option value="SUDAH">SUDAH</option>
					<option value="BELUM">BELUM</option>
				</select>
			</div>
			<div>
				<button type="submit" class="button" name="btnJadwal">Submit</button>
			</div>
		</form>
	</div>
</body>
</html>