<div class="content-wrapper">

    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA KEPERLUAN</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                       value="<?= $this->security->get_csrf_hash(); ?>">
                <table class='table table-bordered>'

                <tr>
                    <td width='200'>Nama Keperluan <?php echo form_error('nama_keperluan') ?></td>
                    <td><input type="text" class="form-control" name="nama_keperluan" id="nama_keperluan"
                               placeholder="Nama Keperluan" value="<?php echo $nama_keperluan; ?>" maxlength="30"/>
                        <small style="color: #F6BF4E" class="nama_keperluan"></small>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="hidden" name="id_keperluan" value="<?php echo $id_keperluan; ?>"/>
                        <button type="submit" id="submit" class="btn btn-danger"><i
                                    class="fa fa-floppy-o"></i> <?php echo $button ?></button>
                        <a href="<?php echo site_url('keperluan') ?>" class="btn btn-info"><i
                                    class="fa fa-sign-out"></i> Kembali</a></td>
                </tr>
                </table></form>
        </div>
</div>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery-1.9.1.min.js"></script>
<script>
    $(document).ready(function () {
        $("#nama_keperluan").keypress(function (event) {
            var keperluan = $("#nama_keperluan").val().length + 1;
            var charCode = (event.which) ? event.which : event.keyCode;
            if (keperluan < 3 && (charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122)) {
                $(".nama_keperluan").html("Nama keperluan minimal 3 huruf");
                $(".nama_keperluan").css("color", "#F0AD4E");
                $("#submit").prop("disabled", true);
            } else if ((charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122) || (charCode == 32) || charCode == 8 || charCode == 9) {
                $(".nama_keperluan").html("");
                $("#submit").prop("disabled", false);
                return true;
            } else {
                $(".nama_keperluan").html("Nama keperluan hanya diperbolehkan huruf");
                $(".nama_keperluan").css("color", "#F0AD4E");
                return false;
            }
        });
    });
</script>
