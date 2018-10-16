<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-warning box-solid">
					<div class="box-header">
						<h3 class="box-title">KELOLA DATA PERMOHONAN</h3>
					</div>
				<div class="box-body table-responsive">
					<div style="padding-bottom: 10px;">
						<?php echo anchor(site_url('permohonan/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export Ms Excel', 'class="btn btn-success btn-sm"'); ?>
					</div>
					<table class="table table-bordered table-striped table-responsive" id="mytable">
						<thead>
						<tr>
							<th style="text-align: center">No</th>
							<th style="text-align: center" width="110px">Surat Kesbangpol</th>
							<th style="text-align: center">Npm</th>
							<th style="text-align: center" width="120px">Nama Mahasiswa</th>
							<th style="text-align: center" width="120px">Perguruan Tinggi</th>
							<th style="text-align: center">Keperluan</th>
							<th style="text-align: center">Status</th>
							<th style="text-align: center" width="120px">Action</th>
						</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
		</div>
	</section>
</div>
<script src="<?= base_url('assets/js/jquery-3.1.1.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">
	$(document).ready(function () {
		$('#mytable').DataTable({
			"processing": true, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"paging": true,
			"searching": true,
			"bDestroy": true,
			"order": [], //Initial no order.
			"aLengthMenu": [[5, 10, 25, 100], [5, 10, 25, 100]],

			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": "<?php echo site_url('permohonan/get_data_permohonan/')?>",
				"type": "POST",
				"data": {"<?php echo $name_csrf ?>": "<?php echo $hash_csrf ?>"}
			},

			//Set column definition initialisation properties.
			"columnDefs": [
				{
					"targets": [-1], //first column / numbering column
					"orderable": false, //set not orderable
				},
			],
		});
	});
</script>
