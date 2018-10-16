<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">

                    <div class="box-header">
                        <h3 class="box-title">SETTING TAMPILAN MENU</h3>
                    </div>

                    <div class="box-body">
                        <form action="" id="simpan_setting" method="post">
                            <table class="table table-bordered">
                                <tr>
                                    <td width="250">Tampilkan Menu Berdasarkan Level</td>
                                    <td>
                                        <?php
                                        echo form_dropdown('tampil_menu', array('ya' => 'YA', 'tidak' => 'TIDAK'), $setting['value'], array('class' => 'form-control setting'));
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <button type="button" id="change" class="btn btn-danger btn-sm">Simpan
                                            Perubahan
                                        </button>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">

                    <div class="box-header">
                        <h3 class="box-title">KELOLA DATA MENU</h3>
                    </div>

                    <div class="box-body table-responsive">
                        <div style="padding-bottom: 10px;"
                        '>
                        <?php echo anchor(site_url('kelolamenu/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-primary btn-sm"'); ?>
                    </div>
                    <table class="table table-bordered table-striped table-responsive" id="mytable">
                        <thead>
                        <tr>
                            <th width="30px">No</th>
                            <th>Title</th>
                            <th>Url</th>
                            <th>Icon</th>
                            <th>Is Main Menu</th>
                            <th>Is Aktif</th>
                            <th>Action</th>
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
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">

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
        //datatables
        table = $('#mytable').DataTable({
            "autowidth": true,
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "stateSave": true,
            "aLengthMenu": [[5, 10, 25, 100], [5, 10, 25, 100]],

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('kelolamenu/get_data_menu/')?>",
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

        $("#change").click(function () {
            var setting = $(".setting").val();
            $.ajax({
                url: "<?php echo site_url('kelolamenu/simpan_setting/')?>",
                type: "POST",
                data: "tampil_menu=" + setting  +"&<?php echo $name_csrf ?>=<?php echo $hash_csrf ?>",
                success: function () {
                    location.reload();
                },
                error: function(xhr, status, error){
                    alert(status + " : " + error);
                }
            });
        });
    })
</script>
