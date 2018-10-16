<div class="content-wrapper">

    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">UPDATE DATA SURAT SELESAI KERJA PRAKTEK</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                       value="<?= $this->security->get_csrf_hash(); ?>">
                <table class='table table-bordered>'

<!--                <tr>
<!--                    <td width='200'>Nomor Surat --><?php //echo form_error('no_surat') ?><!--</td>-->
<!--                    <td><input type="text" readonly class="form-control" name="no_surat" maxlength="50" id="no_surat" placeholder="Nomor Surat"-->
<!--                               value="--><?php //echo $no_surat; ?><!--"/></td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td width='200'>Sifat --><?php //echo form_error('sifat') ?><!--</td>-->
<!--                    <td><input type="text" class="form-control" name="sifat" id="sifat" placeholder="Sifat"-->
<!--                               value="--><?php //echo $sifat; ?><!--" maxlength="30"/>-->
<!--                        <small style="color: #F6BF4E" class="sifat"></small>-->
<!--                    </td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td width='200'>Lampiran --><?php //echo form_error('lampiran') ?><!--</td>-->
<!--                    <td><input type="number" class="form-control" name="lampiran" id="lampiran" placeholder="Lampiran"-->
<!--                               value="--><?php //echo $lampiran; ?><!--" maxlength="30"/>-->
<!--                        <small style="color: #F6BF4E" class="lampiran"></small>-->
<!--                    </td>-->
<!--                </tr>-->

                <tr>
                    <td width='200'>Kepada <?php echo form_error('kepada') ?></td>
                    <td><textarea maxlength="300" class="form-control" rows="3" name="kepada" id="kepada"
                                  placeholder="Ditujukan kepada instansi yang bersangkutan"><?php echo $kepada; ?></textarea></td>
				<tr>
					<td width='200'>Kota Asal Kampus <?php echo form_error('kota') ?></td>
					<td><input type="text" class="form-control" name="kota" id="kota"
							   placeholder="Contoh : Bandung" maxlength="30" value="<?php echo $kota; ?>"/></td>
				</tr>
				<tr>
					<td width='200'>Nomor Kesbangpol <?php echo form_error('no_kesbangpol') ?></td>
					<td><input type="text" class="form-control" name="no_kesbangpol" id="no_kesbangpol"
							   placeholder="Silahkan Isi Nomor Kesbangpol" maxlength="30" value="<?php echo $no_kesbangpol; ?>"/></td>
				</tr>
				<tr>
					<td width='200'>Nomor Surat Kampus <?php echo form_error('no_surat_kampus') ?></td>
					<td><input type="text" class="form-control" name="no_surat_kampus" id="no_surat_kampus"
							   placeholder="Silahkan Isi Nomor Surat Kampus" maxlength="60" value="<?php echo $no_surat_kampus; ?>"/></td>
				</tr>
                <tr>
                    <td width='200'>Tanggal Surat Kampus <?php echo form_error('tgl_surat_kampus') ?></td>
                    <td><input type="date" class="form-control" name="tgl_surat_kampus" id="tgl_surat_kampus"
                               placeholder="Tanggal Surat Kampus" value="<?php echo $tgl_surat_kampus; ?>"/></td>
                </tr>
                <tr>
                    <td width='200'>Tanggal Surat Kesbangpol <?php echo form_error('tgl_surat_kesbangpol') ?></td>
                    <td><input type="date" class="form-control" name="tgl_surat_kesbangpol" id="tgl_surat_kesbangpol"
                               placeholder="Tanggal Surat Kesbangpol" value="<?php echo $tgl_surat_kesbangpol; ?>"/></td>
                </tr>
				<!--<tr>-->
				<!--	<td width='200'>Tanggal Pembuatan Surat <?php echo form_error('tgl_surat') ?></td>-->
				<!--	<td><input type="date" class="form-control" name="tgl_surat" id="tgl_surat" placeholder="Tanggal Surat"-->
				<!--			   value="<?php echo $tgl_surat; ?>"/></td>-->
				<!--</tr>-->
<!--                <tr>-->
<!--                    <td width='200'>Tanggal Mulai --><?php //echo form_error('tgl_mulai') ?><!--</td>-->
<!--                    <td><input type="date" class="form-control" name="tgl_mulai" id="tgl_mulai" placeholder="Tanggal Mulai"-->
<!--                               value="--><?php //echo $tgl_mulai; ?><!--"/></td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td width='200'>Tanggal Selesai --><?php //echo form_error('tgl_selesai') ?><!--</td>-->
<!--                    <td><input type="date" class="form-control" name="tgl_selesai" id="tgl_selesai"-->
<!--                               placeholder="Tanggal Selesai" value="--><?php //echo $tgl_selesai; ?><!--"/></td>-->
<!--                </tr>-->
                    <td></td>
                    <td><input type="hidden" name="id_surat" value="<?php echo $id_surat; ?>"/>
                        <button type="submit" id="submit" class="btn btn-danger"><i
                                    class="fa fa-floppy-o"></i> <?php echo $button ?></button>
                        <a href="<?php echo site_url('surat') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i>
                            Kembali</a></td>
                </tr>
                </table></form>
        </div>
    </section>
</div>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery-1.9.1.min.js"></script>
<script>
    $(document).ready(function () {
        $("#nama_pendaftar").keypress(function (event) {
            var nama_pendaftar = $("#nama_pendaftar").val().length + 1;
            var charCode = (event.which) ? event.which : event.keyCode;
            if (nama_pendaftar < 3 && (charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122)) {
                $(".nama_pendaftar").html("Nama minimal 3 huruf");
                $(".nama_pendaftar").css("color", "#F0AD4E");
                $("#submit").prop("disabled", true);
            } else if ((charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122) || (charCode == 32) || charCode == 8 || charCode == 9) {
                $(".nama_pendaftar").html("");
                $("#submit").prop("disabled", false);
                return true;
            } else {
                $(".nama_pendaftar").html("Nama hanya diperbolehkan huruf");
                $(".nama_pendaftar").css("color", "#F0AD4E");
                return false;
            }
        });

        $("#sifat").keypress(function (event) {
            var charCode = (event.which) ? event.which : event.keyCode;
            if ((charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122) || (charCode == 32) || charCode == 8 || charCode == 9) {
                $(".sifat").html("");
                return true;
            } else {
                $(".sifat").html("Sifat hanya diperbolehkan huruf");
                $(".sifat").css("color", "#F0AD4E");
                return false;
            }
        });

		$("#lampiran").keydown(function (data) {
			if (data.which != 8 && data.which != 0 && (data.which < 48 || data.which > 57)) {
				$(".lampiran").html("lampiran hanya diperbolehkan angka");
				$(".lampiran").css("color", "#F0AD4E");
				return false;
			} else {
				$(".lampiran").html("");
			}
		});

    })
</script>
