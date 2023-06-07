<?php 
	require_once 'koneksi.php';

	if (!isset($_SESSION['id_user'])) {
		header("Location: login.php");
		exit;
	}

	$tamu = mysqli_query($koneksi, "SELECT * FROM tamu ORDER BY nama_tamu ASC");
	if (isset($_POST['btnCari'])) {
		$cari = $_POST['cari'];
		$tamu = mysqli_query($koneksi, "SELECT * FROM tamu WHERE nama_tamu LIKE '%$cari%' OR alamat_tamu LIKE '%$cari%' OR no_telp_tamu  LIKE '%$cari%' ORDER BY nama_tamu ASC");
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include_once 'head.php'; ?>
	<title>Tamu</title>
</head>
<body>
	<?php include_once 'navbar.php'; ?>
    <div class="container anti-navbar">
		<h2>Daftar Tamu</h2>
		<a href="tambah_tamu.php" class="button">Tambah Tamu</a>
		<form method="post" class="form-cari">
			<input class="input" type="text" name="cari" id="cari" value="<?= (isset($_POST['cari']) ? $_POST['cari'] : ''); ?>" required>
			<button type="submit" class="button align-right" name="btnCari">Cari</button>
		</form>
		
		<?php if (isset($_POST['cari'])): ?>
			<h3>Data yang ditemukan: <?= mysqli_num_rows($tamu); ?></h3>
			<a href="tamu.php" class="button">Reset</a>
		<?php endif ?>

		<div class="table-responsive">
			<table border="1" cellpadding="10" cellspacing="0">
				<tr>
					<th>No.</th>
					<th>Nama Tamu</th>
					<th>Alamat Tamu</th>
					<th>No. Telp Tamu</th>
					<th>Aksi</th>
				</tr>
				<?php $i = 1; ?>
				<?php foreach ($tamu as $data): ?>
					<tr>
						<td><?= $i++; ?></td>
						<td><?= $data['nama_tamu']; ?></td>
						<td><?= $data['alamat_tamu']; ?></td>
						<td><?= $data['no_telp_tamu']; ?></td>
						<td>
							<a class="button" href="ubah_tamu.php?id_tamu=<?= $data['id_tamu']; ?>">Ubah</a>
							<a class="button" href="hapus_tamu.php?id_tamu=<?= $data['id_tamu']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus tamu <?= $data['nama_tamu']; ?>?')">Hapus</a>
						</td>
					</tr>
				<?php endforeach ?>
			</table>
		</div>
	</div>
</body>
</html>