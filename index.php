<?php 
	require_once 'koneksi.php';

	if (!isset($_SESSION['id_user'])) {
		header("Location: login.php");
		exit;
	}

	$total_jadwal_tamu_hari_ini = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(jadwal.id_jadwal) AS total_tamu FROM jadwal INNER JOIN tamu ON jadwal.id_tamu = tamu.id_tamu WHERE DATE(jadwal.jadwal_tamu) = CURDATE()"));
	$total_jadwal_tamu_hari_ini_belum = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(jadwal.id_jadwal) AS total_tamu FROM jadwal INNER JOIN tamu ON jadwal.id_tamu = tamu.id_tamu WHERE DATE(jadwal.jadwal_tamu) = CURDATE() AND status = 'BELUM'"));
	$total_jadwal_tamu_hari_ini_sudah = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(jadwal.id_jadwal) AS total_tamu FROM jadwal INNER JOIN tamu ON jadwal.id_tamu = tamu.id_tamu WHERE DATE(jadwal.jadwal_tamu) = CURDATE() AND status = 'SUDAH'"));

	$jadwal = mysqli_query($koneksi, "SELECT * FROM jadwal INNER JOIN tamu ON jadwal.id_tamu = tamu.id_tamu ORDER BY jadwal_tamu ASC");

	if (isset($_POST['btnCari'])) {
		$cari = $_POST['cari'];
		$jadwal = mysqli_query($koneksi, "SELECT * FROM jadwal INNER JOIN tamu ON jadwal.id_tamu = tamu.id_tamu WHERE jadwal.jadwal_tamu LIKE '%$cari%' OR jadwal.tujuan LIKE '%$cari%' OR tamu.nama_tamu LIKE '%$cari%' OR tamu.alamat_tamu LIKE '%$cari%' OR tamu.no_telp_tamu  LIKE '%$cari%' ORDER BY jadwal_tamu ASC");
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include_once 'head.php'; ?>
	<title>Dashboard</title>
</head>
<body>
	<?php include_once 'navbar.php'; ?>
	<div class="container anti-navbar">
		<div class="row justify-content-between">
			<div class="col">
				<div class="card">
		    		<h4>Total Jadwal Tamu Hari ini:<br><?= str_replace(",", ".", number_format($total_jadwal_tamu_hari_ini['total_tamu'])); ?> Tamu</h4>
		    	</div>
			</div>
			<div class="col">
				<div class="card">
		    		<h4>Total Jadwal Tamu Hari ini Belum:<br><?= str_replace(",", ".", number_format($total_jadwal_tamu_hari_ini_belum['total_tamu'])); ?> Tamu</h4>
		    	</div>
			</div>
			<div class="col">
				<div class="card">
		    		<h4>Total Jadwal Tamu Hari ini Sudah:<br><?= str_replace(",", ".", number_format($total_jadwal_tamu_hari_ini_sudah['total_tamu'])); ?> Tamu</h4>
		    	</div>
			</div>
		</div>
		<form method="post" class="form-cari">
			<input class="input" type="text" name="cari" id="cari" value="<?= (isset($_POST['cari']) ? $_POST['cari'] : ''); ?>" required>
			<button type="submit" class="button align-right" name="btnCari">Cari</button>
		</form>
		
		<?php if (isset($_POST['cari'])): ?>
			<h3>Data yang ditemukan: <?= mysqli_num_rows($jadwal); ?></h3>
			<a href="index.php" class="button">Reset</a>
		<?php endif ?>
		<div class="table-responsive">
			<table border="1" cellpadding="10" cellspacing="0">
				<tr>
					<th>No.</th>
					<th>Nama Tamu</th>
					<th>Jadwal Tamu</th>
					<th>Tujuan</th>
					<th>Status</th>
					<th>Aksi</th>
				</tr>
				<?php $i = 1; ?>
				<?php foreach ($jadwal as $data): ?>
					<tr>
						<td><?= $i++; ?></td>
						<td><?= $data['nama_tamu']; ?></td>
						<td><?= date("d-m-Y, H:i", strtotime($data['jadwal_tamu'])); ?></td>
						<td><?= $data['tujuan']; ?></td>
						<td><?= $data['status']; ?></td>
						<td>
							<?php if ($data['status'] == 'BELUM'): ?>
								<a class="button" href="ubah_status.php?id_jadwal=<?= $data['id_jadwal']; ?>">Ubah Status</a>
							<?php endif ?>
							<a class="button" href="ubah_jadwal.php?id_jadwal=<?= $data['id_jadwal']; ?>">Ubah</a>
							<a class="button" href="hapus_jadwal.php?id_jadwal=<?= $data['id_jadwal']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal tamu <?= $data['nama_tamu']; ?>?')">Hapus</a>
						</td>
					</tr>
				<?php endforeach ?>
			</table>
		</div>
	</div>
</body>
</html>