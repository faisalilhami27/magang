<div class="content-wrapper">

    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA MAHASISWA</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                       value="<?= $this->security->get_csrf_hash(); ?>">
                <table class='table table-bordered>'
                <tr>
                    <td width='200'>Npm <?php echo form_error('npm') ?></td>
                    <td><input type="text" class="form-control" name="npm" id="npm" placeholder="Npm"
                               value="<?php echo $npm; ?>"/>
                        <small style="color: #F6BF4E" class="npm"></small>
                    </td>
                </tr>
                <tr>
                    <td width='200'>Nama Anggota <?php echo form_error('nama_anggota') ?></td>
                    <td><input type="text" class="form-control" name="nama_anggota" id="nama_anggota"
                               placeholder="Nama Anggota" value="<?php echo $nama_anggota; ?>"/>
                        <small style="color: #F6BF4E" class="nama_anggota"></small>
                    </td>
                </tr>
                <tr>
                    <td width='200'>Jurusan <?php echo form_error('jurusan') ?></td>
                    <td><input type="text" class="form-control" name="jurusan" id="jurusan" placeholder="Jurusan"
                               value="<?php echo $jurusan; ?>"/>
                        <small style="color: #F6BF4E" class="jurusan"></small>
                    </td>
                </tr>
                <tr>
                    <td width='200'>Kampus <?php echo form_error('kampus') ?></td>
                    <td><input type="text" class="form-control" name="kampus" id="kampus" placeholder="Kampus"
                               value="<?php echo $kampus; ?>"/>
                        <small style="color: #F6BF4E" class="kampus"></small>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="hidden" name="id_anggota" value="<?php echo $id_anggota; ?>"/>
						<input type="hidden" name="id_surat" value="<?php echo $id_surat; ?>"/>
                        <button type="submit" class="btn btn-danger"><i
                                    class="fa fa-floppy-o"></i> <?php echo $button ?></button>
                        <a href="<?php echo site_url('anggota') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i>
                            Kembali</a></td>
                </tr>
                </table>
            </form>
        </div>
    </section>
</div>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery-1.9.1.min.js"></script>
<script>
    $(document).ready(function () {
        $("#nama_anggota").keypress(function (event) {
            var nama_anggota = $("#nama_anggota").val().length + 1;
            var charCode = (event.which) ? event.which : event.keyCode;
            if (nama_anggota < 3 && (charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122)) {
                $(".nama_anggota").html("Nama minimal 3 huruf");
                $(".nama_anggota").css("color", "#F0AD4E");
                $("#submit").prop("disabled", true);
            } else if ((charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122) || (charCode == 32) || charCode == 8 || charCode == 9) {
                $(".nama_anggota").html("");
                $("#submit").prop("disabled", false);
                return true;
            } else {
                $(".nama_anggota").html("Nama hanya diperbolehkan huruf");
                $(".nama_anggota").css("color", "#F0AD4E");
                return false;
            }
        });

        $("#jurusan").keypress(function (event) {
            var charCode = (event.which) ? event.which : event.keyCode;
            if ((charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122) || (charCode == 32) || charCode == 8 || charCode == 9) {
                $(".jurusan").html("");
                $("#submit").prop("disabled", false);
                return true;
            } else {
                $(".jurusan").html("Jurusan hanya diperbolehkan huruf");
                $(".jurusan").css("color", "#F0AD4E");
                return false;
            }
        });

        $("#kampus").keypress(function (event) {
            var kampus = $("#kampus").val().length + 1;
            var charCode = (event.which) ? event.which : event.keyCode;
            if (kampus < 3 && (charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122)) {
                $(".kampus").html("Nama Kampus minimal 3 huruf");
                $(".kampus").css("color", "#F0AD4E");
                $("#submit").prop("disabled", true);
            } else if ((charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122) || (charCode == 32) || charCode == 8 || charCode == 9) {
                $(".kampus").html("");
                $("#submit").prop("disabled", false);
                return true;
            } else {
                $(".kampus").html("Nama Kampus hanya diperbolehkan huruf");
                $(".kampus").css("color", "#F0AD4E");
                return false;
            }
        });

        $("#npm").keydown(function (data) {
            var no = $("#npm").val().length + 1;
            if (data.which != 8 && data.which != 0 && (data.which < 48 || data.which > 57)) {
                $(".npm").html("Npm hanya diperbolehkan angka");
                $(".npm").css("color", "#F0AD4E");
                return false;
            } else {
                $("#submit").prop("disabled", false);
                $(".npm").html("");
            }
        });
    })
</script>
