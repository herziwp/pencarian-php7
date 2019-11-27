<!DOCTYPE html>
<html>
<head>
	<title>PENCARIAN GILACODING</title>
	<style type="text/css">
		* {
			font-family: "Trebuchet MS";
		}
		h1 {
			text-transform: uppercase;
			color: salmon;
		}
		table {
			border: 1px solid #ddeeee;
			border-collapse: collapse;
			border-spacing: 0;
			width: 70%;
			margin: 10px auto 10px auto;
		}
		th, td {
			border: 1px solid #ddeeee;
			padding: 20px;
			text-align: left;
		}
	</style>
</head>
<body>
	<center><h1>Pencarian Produk - Gilacoding</h1></center>
	<form method="GET" action="index.php" style="text-align: center;">
		<label>Kata Pencarian : </label>
		<input type="text" name="kata_cari" value="<?php if(isset($_GET['kata_cari'])) { echo $_GET['kata_cari']; } ?>"  />
		<button type="submit">Cari</button>
	</form>
	<table>
		<thead>
			<tr>
				<th>Kode Produk</th>
				<th>Nama Produk</th>
				<th>Keterangan</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			//untuk meinclude kan koneksi
			include('koneksi.php');

				//jika kita klik cari, maka yang tampil query cari ini
				if(isset($_GET['kata_cari'])) {
					//menampung variabel kata_cari dari form pencarian
					$kata_cari = $_GET['kata_cari'];

					//jika hanya ingin mencari berdasarkan kode_produk, silahkan hapus dari awal OR
					//jika ingin mencari 1 ketentuan saja query nya ini : SELECT * FROM produk WHERE kode_produk like '%".$kata_cari."%' 
					$query = "SELECT * FROM produk WHERE kode_produk like '%".$kata_cari."%' OR nama_produk like '%".$kata_cari."%' OR keterangan like '%".$kata_cari."%' ORDER BY id ASC";
				} else {
					//jika tidak ada pencarian, default yang dijalankan query ini
					$query = "SELECT * FROM produk ORDER BY id ASC";
				}
				

				$result = mysqli_query($koneksi, $query);

				if(!$result) {
					die("Query Error : ".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
				}
				//kalau ini melakukan foreach atau perulangan
				while ($row = mysqli_fetch_assoc($result)) {
			?>
			<tr>
				<td><?php echo $row['kode_produk']; ?></td>
				<td><?php echo $row['nama_produk']; ?></td>
				<td><?php echo $row['keterangan']; ?></td>
			</tr>
			<?php
			}
			?>

		</tbody>
	</table>
</body>
</html>