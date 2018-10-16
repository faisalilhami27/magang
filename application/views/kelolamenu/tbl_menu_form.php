<div class="content-wrapper">
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA MENU</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                       value="<?= $this->security->get_csrf_hash(); ?>">
                <table class='table table-bordered>'
                <tr>
                    <td width='200'>Title <?php echo form_error('title') ?></td>
                    <td><input type="text" class="form-control" name="title" id="title" placeholder="Title"
                               value="<?php echo $title; ?>" maxlength="30"/>
                        <small style="color: #F6BF4E" class="title"></small>
                    </td>
                </tr>
                <tr>
                    <td width='200'>Url <?php echo form_error('url') ?></td>
                    <td><input type="text" class="form-control" name="url" id="url" placeholder="Url"
                               value="<?php echo $url; ?>" maxlength="20"/>
                        <small style="color: #F6BF4E" class="url"></small>
                    </td>
                </tr>
                <tr>
                    <td width='200'>Icon <?php echo form_error('icon') ?></td>
                    <td><input type="text" class="form-control" name="icon" id="icon" placeholder="contoh : fa fa-user"
                               value="<?php echo $icon; ?>" maxlength="55"/>
                        <small style="color: #F6BF4E" class="icon"></small>
                    </td>
                </tr>
                <tr>
                    <td width='200'>Is Main Menu <?php echo form_error('is_main_menu') ?></td>
                    <td><select name="is_main_menu" class="form-control">
                            <option value="0">MAIN MENU</option>
                            <?php
                            $menu = $this->db->get('tbl_menu')->result();
                            foreach ($menu as $m) {
                                echo "<option value='$m->id_menu' ";
                                echo $m->id_menu == $is_main_menu ? 'selected' : '';
                                echo ">" . strtoupper($m->title) . "</option>";
                            }
                            ?>
                        </select></td>
                </tr>
                <tr>
                    <td width='200'>Is Aktif <?php echo form_error('is_aktif') ?></td>
                    <td><?php echo form_dropdown('is_aktif', array('y' => 'AKTIF', 'n' => 'TIDAK'), $is_aktif, array('class' => 'form-control')) ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="hidden" name="id_menu" value="<?php echo $id_menu; ?>"/>
                        <button type="submit" id="submit" class="btn btn-danger"><i
                                    class="fa fa-floppy-o"></i> <?php echo $button ?></button>
                        <a href="<?php echo site_url('kelolamenu') ?>" class="btn btn-info"><i
                                    class="fa fa-sign-out"></i> Kembali</a></td>
                </tr>
                </table>
            </form>
        </div>
    </div>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery-1.9.1.min.js"></script>
<script>
    $(document).ready(function () {
        $("#title").keypress(function (event) {
            var title = $("#title").val().length + 1;
            var charCode = (event.which) ? event.which : event.keyCode;
            if (title < 5 && (charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122)) {
                $(".title").html("Judul minimal 5 huruf");
                $(".title").css("color", "#F0AD4E");
                $("#submit").prop("disabled", true);
            } else if ((charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122) || (charCode == 32) || charCode == 8 || charCode == 9) {
                $(".title").html("");
                $("#submit").prop("disabled", false);
                return true;
            } else {
                $(".title").html("Judul hanya diperbolehkan huruf");
                $(".title").css("color", "#F0AD4E");
                return false;
            }
        });

        $("#url").keypress(function (event) {
            var url = $("#url").val().length + 1;
            var charCode = (event.which) ? event.which : event.keyCode;
            if (url < 3 && (charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122)) {
                $(".url").html("Url minimal 3 huruf");
                $(".url").css("color", "#F0AD4E");
                $("#submit").prop("disabled", true);
            } else if ((charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122) || (charCode == 32) || charCode == 35 || charCode == 8 || charCode == 9 || charCode == 95 || charCode == 47) {
                $(".url").html("");
                $("#submit").prop("disabled", false);
                return true;
            } else {
                $(".url").html("Url hanya diperbolehkan huruf");
                $(".url").css("color", "#F0AD4E");
                return false;
            }
        });

        $("#icon").keypress(function (event) {
            var charCode = (event.which) ? event.which : event.keyCode;
            if ((charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122) || (charCode == 32) || charCode == 8 || charCode == 9 || charCode == 45) {
                $(".icon").html("");
                return true;
            } else {
                $(".icon").html("Nama hanya diperbolehkan huruf dan/atau menggunakan strip");
                $(".icon").css("color", "#F0AD4E");
                return false;
            }
        });
    });
</script>
