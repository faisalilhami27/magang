<div class="content-wrapper">

    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA USER</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                       value="<?= $this->security->get_csrf_hash(); ?>">
                <table class='table table-bordered>'

                <tr>
                    <td width='200'>Nama Lengkap <?php echo form_error('full_name') ?></td>
                    <td><input type="text" class="form-control" name="full_name" id="full_name" placeholder="Full Name"
                               value="<?php echo $full_name; ?>" maxlength="50"/>
                        <small style="color: #F6BF4E" class="full_name"></small>
                    </td>
                </tr>
                <tr>
                    <td width='200'>Email <?php echo form_error('email') ?></td>
                    <td>
                        <input maxlength="60" type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>"/>
                        <small style="color: #F6BF4E" class="email"></small>
                    </td>
                </tr>

                <?php
                if ($this->uri->segment(2) == 'create') {
                    ?>

                    <tr>
                        <td width='200'>Password <?php echo form_error('password') ?></td>
                        <td><input maxlength="12" minlength="8" type="password" class="form-control" name="password" id="password"
                                   placeholder="Password" value="<?php echo $password; ?>"/></td>
                    </tr>
                    <tr>
                        <td width='200'>Foto Profile <?php echo form_error('images') ?></td>
                        <td><input type="file" name="images"></td>
                    </tr>
                    <?php
                }
                ?>
                <tr>
                    <td width='200'>Level User <?php echo form_error('id_user_level') ?></td>
                    <td>
                        <?php echo cmb_dinamis('id_user_level', 'tbl_user_level', 'nama_level', 'id_user_level', $id_user_level, 'DESC') ?>
                        <!--<input type="text" class="form-control" name="id_user_level" id="id_user_level" placeholder="Id User Level" value="<?php echo $id_user_level; ?>" />--></td>
                </tr>
                <tr>
                    <td width='200'>Status Aktif <?php echo form_error('is_aktif') ?></td>
                    <td>
                        <?php echo form_dropdown('is_aktif', array('y' => 'AKTIF', 'n' => 'TIDAK AKTIF'), $is_aktif, array('class' => 'form-control')); ?>
                        <!--<input type="text" class="form-control" name="is_aktif" id="is_aktif" placeholder="Is Aktif" value="<?php echo $is_aktif; ?>" />--></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="hidden" name="id_users" value="<?php echo $id_users; ?>"/>
                        <button type="submit" id="submit" class="btn btn-danger"><i
                                    class="fa fa-floppy-o"></i> <?php echo $button ?></button>
                        <a href="<?php echo site_url('user') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i>
                            Kembali</a></td>
                </tr>
                </table></form>
        </div>
</div>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery-1.9.1.min.js"></script>
<script>
    $(document).ready(function () {
        $("#full_name").keypress(function (event) {
            var full_name = $("#full_name").val().length + 1;
            var charCode = (event.which) ? event.which : event.keyCode;
            if (full_name < 3 && (charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122)) {
                $(".full_name").html("Nama minimal 3 huruf");
                $(".full_name").css("color", "#F0AD4E");
                $("#submit").prop("disabled", true);
            } else if ((charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122) || (charCode == 32) || charCode == 8 || charCode == 9) {
                $(".full_name").html("");
                $("#submit").prop("disabled", false);
                return true;
            } else {
                $(".full_name").html("Nama hanya diperbolehkan huruf");
                $(".full_name").css("color", "#F0AD4E");
                return false;
            }
        });

        $('#email').keyup(function(e) {
            var sEmail = $('#email').val();
            if (validateEmail(sEmail)) {
                $(".email").html("");
                $("#submit").prop("disabled", false);
            }
            else {
                $(".email").html("Masukan email yang valid");
                $("#submit").prop("disabled", true);
                e.preventDefault();
            }
        });
    });

    function validateEmail(sEmail) {
        var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        if (filter.test(sEmail)) {
            return true;
        }
        else {
            return false;
        }
    }
</script>
