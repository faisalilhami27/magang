<div class="content-wrapper">

	<section class="content">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">DETAIL DATA SURAT SELESAI KERJA PRAKTEK</h3>
			</div>
			<table class="table">
				<tr>
					<td>No Surat</td>
					<td><?php echo $no_surat; ?></td>
				</tr>
				<tr>
					<td>Nama Pendaftar</td>
					<td><?php echo $nama_pendaftar; ?></td>
				</tr>
				<tr>
					<td>Sifat</td>
					<td><?php echo $sifat; ?></td>
				</tr>
				<tr>
					<td>Lampiran</td>
					<td><?php  if ($lampiran == 0) : ?>
							<?php echo "-" ?>
						<?php else: ?>
							<?php echo $lampiran . "Lembar"; ?>
						<?php endif; ?>
					</td>
				</tr>
				<tr>
					<td>Kepada</td>
					<td><?php echo $kepada; ?></td>
				</tr>
				<tr>
					<td>Tanggal Surat</td>
					<td><?php echo $tgl_surat; ?></td>
				</tr>
				<tr>
					<td>Tanggal Surat Kampus</td>
					<td><?php echo $tgl_surat_kampus; ?></td>
				</tr>
				<tr>
					<td>Tanggal Surat Kesbangpol</td>
					<td><?php echo $tgl_surat_kesbangpol; ?></td>
				</tr>
				<tr>
					<td>No Kesbangpol</td>
					<td><?php echo $no_kesbangpol; ?></td>
				</tr>
				<tr>
					<td>No Surat Kampus</td>
					<td><?php echo $no_surat_kampus; ?></td>
				</tr>
				<tr>
					<td>Tanggal Mulai</td>
					<td><?php echo $tgl_mulai; ?></td>
				</tr>
				<tr>
					<td>Tanggal Selesai</td>
					<td><?php echo $tgl_selesai; ?></td>
				</tr>
				<tr>
					<td></td>
					<td><a href="<?php echo site_url('surat') ?>" class="btn btn-default">Cancel</a></td>
				</tr>
			</table>
		</div>
	</section>
</div>
