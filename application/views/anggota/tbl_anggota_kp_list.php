<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">

                    <div class="box-header">
                        <h3 class="box-title">KELOLA DATA MAHASISWA</h3>
                    </div>

                    <div class="box-body table-responsive">
						<div style="padding-bottom: 10px;"></div>
                    <table class="table table-bordered table-striped table-responsive" id="mytable">
                        <thead>
                        <tr>
                            <th style="text-align: center" width="30px">No</th>
                            <th style="text-align: center">NPM</th>
                            <th style="text-align: center">Nama Mahasiswa</th>
                            <th style="text-align: center">Jurusan</th>
                            <th style="text-align: center">Perguruan Tinggi</th>
                            <th style="text-align: center" width="20px">Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
</div>
</section>
</div>
<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings) {
            return {
                "iStart": oSettings._iDisplayStart,
                "iEnd": oSettings.fnDisplayEnd(),
                "iLength": oSettings._iDisplayLength,
                "iTotal": oSettings.fnRecordsTotal(),
                "iFilteredTotal": oSettings.fnRecordsDisplay(),
                "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
            };
        };

        //datatables
        $('#mytable').DataTable({

            "processing": true,
            "serverSide": true,
            "order": [],
			"aLengthMenu": [[5, 10, 25, 100], [5, 10, 25, 100]],

            "ajax": {
                "url": "<?php echo site_url('anggota/get_data_anggota1')?>",
                "type": "POST",
                "data": {"<?php echo $csrf_name?>": "<?php echo $csrf_hash ?>"}
            },


            "columnDefs": [
                {
                    "targets": [ 0 ],
                    "orderable": false,
                },
            ],

        });
    });
</script>
