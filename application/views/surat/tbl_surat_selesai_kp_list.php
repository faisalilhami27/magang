<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">
                    <div class="box-header">
                        <h3 class="box-title">KELOLA DATA SURAT SELESAI KERJA PRAKTEK</h3>
                    </div>

                    <div class="box-body table-responsive">
                        <div style="margin-bottom: 10px">
							<?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                        </div>
						<table class="table table-bordered table-striped table-responsive" id="mytable1">
							<thead>
							<tr>
								<th style="text-align: center" width="30px">No</th>
								<th style="text-align: center" width="100px">No Surat</th>
								<th style="text-align: center">Nama Mahasiswa</th>
								<th style="text-align: center">Perguruan Tinggi</th>
								<th style="text-align: center">Nomor Kesbangpol</th>
								<th style="text-align: center">Nomor Surat Kampus</th>
								<th style="text-align: center" width="150px">Action</th>
							</tr>
							</thead>
						</table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Daftar Mahasiswa</h4>
            </div>
            <div class="modal-body table-responsive">
                <table class="table table-responsive table-bordered table-striped" id="mytable" width="100%">
                    <thead>
                    <tr>
                        <th style="text-align: center" width="30px">No</th>
                        <th style="text-align: center">NPM</th>
                        <th style="text-align: center">Nama Mahasiswa</th>
                        <th style="text-align: center">Jurusan</th>
                        <th style="text-align: center">Perguruan Tinggi</th>
                    </tr>
                    </thead>

                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('assets/js/jquery-3.1.1.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">
    $(document).ready(function () {
		table = $('#mytable1').DataTable({
			"processing": true, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"paging": true,
			"searching": true,
			"bDestroy": true,
			"order": [], //Initial no order.
			"aLengthMenu": [[5, 10, 25, 100], [5, 10, 25, 100]],

			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": "<?php echo site_url('surat/get_data_surat/')?>",
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

        table.on('click', '.anggota', function (e) {
			e.preventDefault();
			var id = $(this).attr("id");
			$('#mytable').DataTable({
				"processing": true, //Feature control the processing indicator.
				"serverSide": true, //Feature control DataTables' server-side processing mode.
				"paging": true,
				"searching": false,
				"bDestroy": true,
				"order": [], //Initial no order.
				"aLengthMenu": [[5, 10, 25, 100], [5, 10, 25, 100]],

				// Load data for the table's content from an Ajax source
				"ajax": {
					"url": "<?php echo site_url('anggota/get_data_anggota/')?>" + id,
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
		})
    });
</script>
