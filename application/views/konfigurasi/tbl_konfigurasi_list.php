<div class="content-wrapper">

    <section class="content">
        <div class="col-md-6">
            <div class="box box-warning box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">DATA KONFIGURASI WEBSITE</h3>
                </div>
                <form action="<?php echo base_url('konfigurasi/update_action') ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                           value="<?= $this->security->get_csrf_hash(); ?>">
                    <table class='table table-bordered>'
                    <tr>
                        <td width='200'>Nama Kepala Dinas <?php echo form_error('nama_kadis') ?></td>
                        <td><input type="text" class="form-control" name="nama_kadis" id="nama_kadis"
                                   placeholder="Nama Kadis" value="<?php echo $nama_kadis; ?>" maxlength="50"/>
                            <small style="color: #F6BF4E" class="nama_kadis"></small>
                        </td>
                    </tr>
                    <tr>
                        <td width='200'>Nip Kepala Dinas <?php echo form_error('nip_kadis') ?></td>
                        <td><input type="text" class="form-control" name="nip_kadis" id="nip_kadis" placeholder="Nip Kadis"
                                   value="<?php echo $nip_kadis; ?>" maxlength="25"/>
                            <small style="color: #F6BF4E" class="nip_kadis"></small>
                        </td>
                    </tr>
                    <tr>
                        <td width='200'>Pangkat Kepala Dinas <?php echo form_error('pangkat_kadis') ?></td>
                        <td><input type="text" class="form-control" name="pangkat_kadis" id="pangkat_kadis"
                                   placeholder="Pangkat Kadis" value="<?php echo $pangkat_kadis; ?>" maxlength="30"/>
                            <small style="color: #F6BF4E" class="pangkat_kadis"></small>
                        </td>
                    </tr>
                    <tr>
                        <td width='200'>Nama Instansi <?php echo form_error('nama_instansi') ?></td>
                        <td><input type="text" class="form-control" name="nama_instansi" id="nama_instansi"
                                   placeholder="Nama Instansi" value="<?php echo $nama_instansi; ?>" maxlength="50"/>
                            <small style="color: #F6BF4E" class="nama_instansi"></small>
                        </td>
                    </tr>

                    <tr>
                        <td width='200'>Alamat Instansi <?php echo form_error('alamat_instansi') ?></td>
                        <td><textarea maxlength="160" class="form-control" rows="3" name="alamat_instansi" id="alamat_instansi"
                                      placeholder="Alamat Instansi"><?php echo $alamat_instansi; ?></textarea></td>
                    </tr>
                    <tr>
                        <td width='200'>Logo Instansi</td>
                        <td><input type="file" name="logo"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="hidden" name="id" value="<?php echo $id; ?>"/>
                            <button type="submit" class="btn btn-danger"><i
                                        class="fa fa-floppy-o"></i> <?php echo $button ?></button>
                        </td>
                    </tr>
                    </table>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-warning box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">REVIEW KONFIGURASI WEBSITE</h3>
                </div>
                <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle"
                             src="<?= base_url('assets/foto_profil/' . $logo) ?>" alt="User profile picture"
                             style="width: 128px; height: 128px">

                        <h3 class="profile-username text-center"><?= $nama_instansi ?></h3>

                        <p class="text-muted text-center"><?= $alamat_instansi ?></p>
                    <table class="table">
                        <tr>
                            <td>Nama Kepala Dinas</td>
                            <td width="1px">:</td>
                            <td><?php echo $nama_kadis; ?></td>
                        </tr>
                        <tr>
                            <td>Pangkat Kepala Dinas</td>
                            <td width="1px">:</td>
                            <td><?php echo $pangkat_kadis; ?></td>
                        </tr>
                        <tr>
                            <td>NIP Kepala Dinas</td>
                            <td width="1px">:</td>
                            <td><?php echo $nip_kadis; ?></td>
                        </tr>
                    </table>
                    </div>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery-1.9.1.min.js"></script>
<script>
    $(document).ready(function () {
        $("#nama_kadis").keydown(function (event) {
            var charCode = (event.which) ? event.which : event.keyCode;
            if ((charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122) || (charCode == 32) || charCode == 8 || charCode == 9) {
                $(".nama_kadis").html("");
                return true;
            } else {
                $(".nama_kadis").html("Nama kepala dinas hanya diperbolehkan huruf");
                $(".nama_kadis").css("color", "#F0AD4E");
                return false;
            }
        });

		$('input[type=file]').change(function () {
			var val = $(this).val().toLowerCase(),
				regex = new RegExp("(.*?)\.(png|jpg|jpeg|pdf)$");

			if (!(regex.test(val))) {
				$(this).val('');
				alert('Format yang diizinkan png atau jpg');
				$("#submit").prop("disabled", true);
			} else {
				$("#submit").prop("disabled", false);
			}
		});

        $("#pangkat_kadis").keydown(function (event) {
            var charCode = (event.which) ? event.which : event.keyCode;
            if ((charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122) || (charCode == 32) || charCode == 8 || charCode == 9) {
                $(".pangkat_kadis").html("");
                return true;
            } else {
                $(".pangkat_kadis").html("Pangkat hanya diperbolehkan huruf");
                $(".pangkat_kadis").css("color", "#F0AD4E");
                return false;
            }
        });

        $("#nama_instansi").keydown(function (event) {
            var charCode = (event.which) ? event.which : event.keyCode;
            if ((charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122) || (charCode == 32) || charCode == 8 || charCode == 9) {
                $(".nama_instansi").html("");
                return true;
            } else {
                $(".nama_instansi").html("Nama Instansi hanya diperbolehkan huruf");
                $(".nama_instansi").css("color", "#F0AD4E");
                return false;
            }
        });

        $("#nip_kadis").keydown(function (event) {
            var charCode = (event.which) ? event.which : event.keyCode;
            if ((charCode >= 48 && charCode <= 57)  || (charCode == 32) || charCode == 8 || charCode == 9) {
                $(".nip_kadis").html("");
                return true;
            } else {
                $(".nip_kadis").html("Nama pendaftar hanya diperbolehkan huruf");
                $(".nip_kadis").css("color", "#F0AD4E");
                return false;
            }
        });
    })
</script>
