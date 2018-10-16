<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?= $surat->no_surat ?></title>
</head>
<style type="text/css">
	* {
		padding: 0;
		font-family: "Times New Roman";
	}

	body {
		padding: 0px;
		margin: 0px;
		font-family: Times New Roman;
		font-size: 13px;

	}

	.kop {
		margin-left: auto;
		margin-right: auto;
		text-align: center;
		margin-bottom: -30px;
	}

	hr {
		background-color: black;
		/*border: 5px double black; */
	}

	.garis {
		border-top: 5px double black;
		margin-right: 0;
		margin-left: 0;
	}

	.garis1 {
		border-top: 2px solid black;
		width: 192px;
		margin-right: auto;
		margin-left: auto;
	}

	.tgl_surat {
		/*border: 1px solid black;*/
		text-align: right;
		padding-top: -10px;
		font-size: 15px;
		padding-bottom: -14px;
	}

	.kode_surat tr td {
		/*border: 1px solid black;*/
		/*padding-bottom: 100px;*/
		margin-bottom: 30px;
		font-size: 15px;
	}

	td {
		padding-bottom: 10px;
		/*border: 1px solid black; */
	}

	.kepada {
		/*border: 1px solid black;*/
		width: 200px;
		margin-bottom: 30px;
		padding-top: -15px;
		float: right;
		font-size: 15px;
		margin-top: -165px;

	}

	.area_surat {
		margin-left: 20px;
	}

	.pembukaan {
		/*border: 1px solid black; */
		margin-top: 20px;
		padding-top: -15px;
		padding-bottom: 10px;
		text-align: justify;
	}

	.teks_pembukaan {
		/*border: 1px solid black;*/
		margin-bottom: -2px;

	}

	.teks_pembukaan2 {
		/*border: 1px solid black;*/
		margin-top: 5px;
		margin-left: 84px;
		font-size: 15px;
		text-indent: 20px;
		line-height: 30px;
		width: 650px;
	}

	.isi_surat {
		/*border: 1px solid black;*/
		margin-top: -10px;

	}

	.ttd {
		/*border: 1px solid black;*/
		margin-top: 25px;
		width: 250px;
		height: 200px;
		text-align: center;
		float: right;
	}

	.nomor {
		text-align: center;
		letter-spacing: 1px;
		margin-top: -18px;
		font-weight: bold;
	}


</style>
<body>
<div style="position: absolute;left: 60px;right: 0;top: 65px;bottom: 0;">
	<img src="./assets/foto_profil/dapodik.png" alt="" style="width: 28mm; height: 25mm;">
</div>
<div class="kop">
	<table align="center">
		<tr>
			<td rowspan="3" align="center"></td>
			<td align="center"><b style="font-size: 17px; letter-spacing: 2px">PEMERINTAH KOTA BANDUNG</b></td>
		</tr>
		<tr>
			<!-- <td>a</td> -->
			<td align="center"><b
					style="font-size: 25px; letter-spacing: 2px"><?= substr($konfig[0]->nama_instansi, 0, 20) ?></b>
			</td>
		</tr>
		<tr>
			<!-- <td>a</td> -->
			<td align="center"><p><b style="font-size: 12px;"><?= $konfig[0]->alamat_instansi ?></b></p></td>
		</tr>
	</table>
</div>
<div style="position: absolute;left: 640px;right: 0;top: 35px;bottom: 0;">
    <img src="./assets/foto_profil/<?= $konfig[0]->logo_instansi ?>" alt="" style="width: 33mm; height: 35mm;">
</div>
<br>
<br>
<div class="garis"></div>

<div class="area_surat">
	<div class="tgl_surat">
		<p>Bandung, <?php echo $tanggal ?></p>
	</div>

	<div class="kode_surat">
		<br>
		<table>
			<tr>
				<td>Nomor</td>
				<td>:</td>
				<td><?= $surat->no_surat ?></td>
			</tr>
			<tr>
				<td>Sifat</td>
				<td>:</td>
				<td>Biasa</td>
			</tr>
			<tr>
				<td>Lampiran</td>
				<td>:</td>
				<td><?php if ($surat->lampiran == 0) : ?>
						<span>-</span>
					<?php else : ?>
						<?= $surat->lampiran . " Lembar" ?>
					<?php endif; ?>
				</td>
			</tr>
			<tr>
				<td height="10">Perihal</td>
				<td>:</td>
				<td>Keterangan telah selesai</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>melaksanakan praktek kerja</td>
			</tr>
		</table>
		<div class="kepada">
			<p>Kepada :</p>
			<p>Yth. <?= $surat->kepada ?></p>
			<p>di <span style="letter-spacing: 5px"><?= strtoupper($surat->kota	) ?></span></p>
		</div>
		<div style="clear: both"></div>
	</div>

	<div class="pembukaan">
		<p class="teks_pembukaan2">Menindaklanjuti surat dari <?= $anggota2->kampus ?> Nomor
			: <?= $surat->no_surat_kampus ?> tanggal <?= $tanggal2 ?>
			dan surat dari Kepala Badan Kesatuan Bangsa dan Politik Kota Bandung Nomor : <?= $surat->no_kesbangpol ?>
			tanggal <?= $tanggal3 ?>
			perihal permohonan untuk melaksanakan Praktek Kerja bahwa nama-nama yang tercantum dibawah ini : </p>
	</div>

	<div align="center">
		<table border="1" cellspacing="0" style="margin-left: 12.5%">
			<tr>
				<th width="40px" style="height: 30px;">No</th>
				<th width="150px" style="height: 30px">Nama</th>
				<th width="150px" style="height: 30px">NIS</th>
				<th width="155px" style="height: 30px">Jurusan</th>
			</tr>
			<?php $no = 1 ?>
			<?php foreach ($anggota as $a) : ?>
				<tr>
					<td style="text-align: center;"><?= $no++ ?></td>
					<td style="text-align: justify; padding-left: 10px; width: 250px"><?= strtoupper($a->nama_anggota) ?></td>
					<td style="text-align: center; font-size: 15px;"><?= $a->npm ?></td>
					<td style="text-align: center; font-size: 15px;"><?= $a->jurusan ?></td>
				</tr>
			<?php endforeach; ?>
		</table>
	</div>

	<div class="isi_surat"><br>
		<p style="line-height: 30px; text-align: justify; font-size: 15px; margin-left: 84px; width: 650px">Telah selesai melaksanakan praktek kerja di Dinas Penataan Ruang
			Kota Bandung pada
			tanggal <?= $tanggal4 ?> sampai dengan <?= $tanggal5 ?>.</p>
	</div>

	<div class="penutup">
		<p style="text-indent: 30px; font-size: 15px; margin-left: 90px">Demikian, kiranya maklum.</p>
	</div>

	<div class="ttd">
		<p><b>KEPALA DINAS PENATAAN RUANG,</b></p>
		<br><br><br><br>
		<span style="text-decoration: underline"><b><?= strtoupper($konfig[0]->nama_kadis) ?></b></span><br>
		<span><b><?= $konfig[0]->pangkat_kadis ?></b></span><br>
		<span><b>NIP. <?= $konfig[0]->nip_kadis ?></b></span>
	</div>

</div>
</body>
</html>
