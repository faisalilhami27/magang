<div class="content-wrapper">

    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA LEVEL USER</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                       value="<?= $this->security->get_csrf_hash(); ?>">
                <table class='table table-bordered>'

                <tr>
                    <td width='200'>Nama Level <?php echo form_error('nama_level') ?></td>
                    <td>
                        <input type="text" class="form-control" maxlength="30" name="nama_level" id="level" placeholder="Nama Level" value="<?php echo $nama_level; ?>"/>
                        <small style="color: #F6BF4E" class="level"></small>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="hidden" name="id_user_level" value="<?php echo $id_user_level; ?>"/>
                        <button type="submit" id="submit" class="btn btn-danger"><i
                                    class="fa fa-floppy-o"></i> <?php echo $button ?></button>
                        <a href="<?php echo site_url('userlevel') ?>" class="btn btn-info"><i
                                    class="fa fa-sign-out"></i> Kembali</a></td>
                </tr>
                </table>
            </form>
        </div>
</div>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery-1.9.1.min.js"></script>
<script>
    $("#level").keypress(function (event) {
        var level = $("#level").val().length + 1;
        var charCode = (event.which) ? event.which : event.keyCode;
        if (level < 5 && (charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122)) {
            $(".level").html("Nama level minimal 5 huruf");
            $(".level").css("color", "#F0AD4E");
            $("#submit").prop("disabled", true);
        } else if ((charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122) || (charCode == 32) || charCode == 8 || charCode == 9) {
            $(".level").html("");
            $("#submit").prop("disabled", false);
            return true;
        } else {
            $(".level").html("Nama level hanya diperbolehkan huruf");
            $(".level").css("color", "#F0AD4E");
            return false;
        }
    });
</script>
