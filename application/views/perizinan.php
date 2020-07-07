<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link href="<?= base_url('assets/css/jquerysctipttop.css') ?>" rel="stylesheet" type="text/css">
	<link rel="stylesheet"
		  href="<?= base_url('assets/adminlte/bower_components/font-awesome/css/font-awesome.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap4.min.css') ?>">
	<link rel="shortcut icon" href="<?= base_url('assets/foto_profil/dtr.png') ?>"/>
	<link href="<?= base_url('assets/css/bootstrap-datepicker.min.css') ?>" rel="stylesheet"/>
	<title><?= $title ?></title>
</head>
<body style="background-image: url('<?= base_url("assets/foto_profil/distaru.png") ?>'); background-size: 100%">
<nav class="navbar navbar-expand-lg navbar-light">
	<img src="<?= base_url('assets/foto_profil/distarcip.png') ?>" width="340px" alt="distaru">

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
		</ul>
		<a href="<?= site_url('auth') ?>">
			<!--            <button class="btn btn-primary btn-sm" type="submit"><b>Login</b></button>-->
		</a>
	</div>
</nav>
<div class="container" style=" width: 500px; border-radius: 10px; background-color: #fff">
	<form action="" id="basicfeedback_validation" method="post"
		  style="padding-top: 10px;" enctype="multipart/form-data">
		<h4 style="text-align: center"><b>Form Permohonan Mahasiswa</b></h4>
		<input type="hidden" id="csrf" name="<?php echo $name_csrf; ?>"
			   value="<?php echo $hash_csrf ?>">
		<div class="row">
			<div class="col">
				<div class="form-group">
					<label>NPM</label>
					<input type="text" name="nrp" id="npm" class="form-control" placeholder="Npm"
						   data-vindicate="required|format:numeric|active" maxlength="20" autofocus autocomplete="off"/>
					<small style="color: #F6BF4E" class="form-control-feedback npm"></small>
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					<label>Nama Lengkap</label>
					<input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Lengkap"
						   data-vindicate="required|format:alpha|active" maxlength="40" autocomplete="off"/>
					<small style="color: #F6BF4E" class="form-control-feedback nama"></small>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<div class="form-group">
					<label>Perguruan Tinggi</label>
					<input type="text" name="kampus" id="kampus" class="form-control"
						   placeholder="Tidak boleh disingkat"
						   data-vindicate="required|format:alpha|active" maxlength="50" autocomplete="off"/>
					<small style="color: #F6BF4E" class="form-control-feedback kampus"></small>
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					<label>Nomor Telepon</label>
					<input type="text" name="no_hp" class="form-control" id="no_hp" placeholder="Nomor Telepon"
						   data-vindicate="required|format:numeric|active" maxlength="12" autocomplete="off"/>
					<small style="color: #F6BF4E" class="form-control-feedback no_hp"></small>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<div class="form-group">
					<label>Email</label>
					<input type="text" name="email" class="form-control" placeholder="Email"
						   data-vindicate="required|format:email|active" maxlength="50" id="email" autocomplete="off"/>
					<small style="color: #F6BF4E" class="form-control-feedback email"></small>
				</div>
			</div>
			<div class="col">
				<div class="form-group" id="jurusan_kampus">
					<label>Jurusan</label>
					<input type="text" name="jurusan" id="jurusan" maxlength="50" class="form-control"
						   placeholder="Jurusan"
						   data-vindicate="required|format:alpha|active"
						   maxlength="20" autofocus autocomplete="off"/>
					<small style="color: #F6BF4E" class="form-control-feedback jurusan"></small>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<div class="form-group" id="remove1">
					<label>Bukti Scan Surat Kesbangpol</label>
					<div class="input-group">
						<label class="input-group-btn">
                            <span class="btn btn-primary"
								  style="border-top-right-radius: 0px; border-bottom-right-radius: 0px">
                                <i class="fa fa-folder-open"></i> <input type="file" name="dokumen" id="customFile"
																		 style="display: none;">
                            </span>
						</label>
						<input type="text" class="form-control" style="background-color: white"
							   placeholder="Pilih berkas" readonly>
					</div>
					<small style="color: #F6BF4E" class="feedback1" style="color: #F0AD4E"></small>
				</div>
			</div>
			<div class="col">
				<div class="form-group" id="remove">
					<label>Keperluan Informasi/Data</label>
					<div>
						<?= cmb_dinamis1('keperluan', 'tbl_keperluan', 'nama_keperluan', 'id_keperluan') ?>
					</div>
					<small style="color: #F6BF4E" class="feedback" style="color: #F0AD4E"></small>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label for="exampleFormControlTextarea1">Rincian Keperluan</label>
			<textarea placeholder="Contoh : Untuk melaksanakan kerja praktek" class="form-control" maxlength="500"
					  name="rincian" id="rincian" rows="3" data-vindicate="required"></textarea>
			<small style="color: #F6BF4E" class="form-control-feedback rincian"></small>
		</div>
		<div class="form-group" id="radio" style="display: none;">
			<label for="exampleFormControlTextarea1">Pilih jumlah anggota</label><br>
			<label for="anggota1"><input type="radio" name="anggota" id="anggota1" value="sendiri"
										 required> Sendiri</label>
			<label for="anggota2"><input type="radio" name="anggota" value="kelompok" id="anggota2"
										 style="margin-left: 10px" required> Kelompok</label>
		</div>
		<div id="awal" class="control-group after-add-more" style="display: none">
			<div class="row">
				<div class="col">
					<div class="form-group">
						<label>NPM</label>
						<div class="input-group">
							<input type="text" name="nrp" class="form-control" data-vindicate="required" id="nrp1"
								   maxlength="30" placeholder="Npm">
						</div>
						<small style="color: #F6BF4E" class="feedback1 nrp1"></small>
					</div>
				</div>
				<div class="col">
					<div class="form-group">
						<label>Nama Lengkap</label>
						<div class="input-group">
							<input type="text" name="nama" class="form-control" id="nama1" maxlength="50"
								   data-vindicate="required" placeholder="Nama Lengkap">
							<div class="input-group-btn">
								<button type="button" class="btn btn-success add-more"
										style="border-top-left-radius: 0px; border-bottom-left-radius: 0px">
									<i class="fa fa-plus"></i>
								</button>
							</div>
						</div>
						<small style="color: #F6BF4E" class="feedback1 nama1"></small>
					</div>
				</div>
			</div>
		</div>
		<div class="copy" id="hide">

		</div>
		<div class="row">
			<div class="col">
				<div class="form-group" id="tanggal_awal" style="display: none">
					<label>Tanggal Masuk</label>
					<div class="input-append date" id="dp3">
						<input class="span2 form-control" readonly id="datepicker"
							   data-vindicate="required|format:date|active" name="tanggal">
						<span class="add-on"><i class="icon-th"></i></span>
						<small style="color: #F6BF4E" class="form-control-feedback"></small>
					</div>
				</div>
			</div>
			<div class="col">
				<div class="form-group" id="tanggal_akhir" style="display: none">
					<label>Tanggal Selesai</label>
					<div class="input-append date" id="dp3">
						<input class="span2 form-control" readonly id="datepicker1"
							   data-vindicate="required|format:date|active" name="tanggal_akhir">
						<span class="add-on"><i class="icon-th"></i></span>
						<small style="color: #F6BF4E" class="form-control-feedback"></small>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group" id="kepada" style="display: none">
			<label>Kepada</label>
			<textarea placeholder="Contoh : Program Studi Teknik Informatika Fakultas Teknik Universitas Pasundan"
					  class="form-control" maxlength="600" name="kepada" id="kepada_pim" rows="3"
					  data-vindicate="required"></textarea>
			<small style="color: #F6BF4E" class="form-control-feedback kepada"></small>
		</div>
		<button id="submit" style="position: relative; top: -10px; margin-top: 10px" class="btn btn-primary btn-block"
				onclick="submitBasicFeedback()"
				type="button">Submit
		</button>
	</form>
	<p>URL Login Admin : http://magang.faisalilhami.site/auth</p>
	<p>Email : faisal.ilhami1997@gmail.com</p>
	<p>Password : admin</p>
</div>
<script src="<?= base_url('assets/js/jquery-3.1.1.min.js') ?>"></script>
<script src="<?= base_url('assets/js/popper.min.js') ?>"></script>
<script src="<?= base_url('assets/js/tether.min.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap-datepicker.min.js') ?>"></script>
<script src="<?= base_url('assets/js/sweetalert.min.js') ?>"></script>
<script src="<?= base_url('assets/js/vindicate.js') ?>"></script>
<script>
	$(document).ready(function () {
		var next = 2;
		$(".add-more").click(function () {
			$(".copy").append('<div class="test">\n' +
				'                <div class="row">\n' +
				'                    <div class="col">\n' +
				'                        <div class="form-group">\n' +
				'                            <div class="input-group">\n' +
				'                                <input type="text" name="nrp" class="form-control" data-vindicate="required" id="nrp' + next + '" maxlength="30" placeholder="Npm">\n' +
				'                            </div>\n' +
				'                            <small style="color: #F6BF4E" class="feedback1 nrp' + next + '"></small>\n' +
				'                        </div>\n' +
				'                    </div>\n' +
				'                    <div class="col">\n' +
				'                        <div class="form-group">\n' +
				'                            <div class="input-group">\n' +
				'                                <input type="text" name="nama" class="form-control" id="nama' + next + '" maxlength="50" data-vindicate="required" placeholder="Nama Lengkap">\n' +
				'                                <div class="input-group-btn">\n' +
				'                                    <button type="button" class="btn btn-danger remove" style="border-top-left-radius: 0px; border-bottom-left-radius: 0px">\n' +
				'                                        <i class="fa fa-trash"></i>\n' +
				'                                    </button>\n' +
				'                                </div>\n' +
				'                            </div>\n' +
				'                            <small style="color: #F6BF4E" class="feedback1 nama' + next + '"></small>\n' +
				'                        </div>\n' +
				'                    </div>\n' +
				'                </div>\n' +
				'            </div>');
			var kelas = ".nrp" + next;
			var id = "#nrp" + next;
			var kelas1 = ".nama" + next;
			var id1 = "#nama" + next;
			next++;
			$(id).keydown(function (data) {
				if (data.which != 8 && data.which != 0 && (data.which < 48 || data.which > 57)) {
					$(kelas).html("Npm hanya diperbolehkan angka");
					$(kelas).css("color", "#F0AD4E");
					return false;
				} else {
					$(kelas).html("");
				}
			});
			$(id1).keypress(function (event) {
				var nama2 = $(id1).val().length + 1;
				var charCode = (event.which) ? event.which : event.keyCode;
				if (nama2 < 3 && (charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122)) {
					$(kelas1).html("Nama minimal 3 huruf");
					$(kelas1).css("color", "#F0AD4E");
					$("#submit").prop("disabled", true);
				} else if ((charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122) || (charCode == 32) || charCode == 8 || charCode == 9) {
					$(kelas1).html("");
					$("#submit").prop("disabled", false);
					return true;
				} else {
					$(kelas1).html("Nama hanya diperbolehkan huruf");
					$(kelas1).css("color", "#F0AD4E");
					return false;
				}
			});
		});
		$("body").on("click", ".remove", function () {
			$(this).parents(".test").remove();
		});

		$("#keperluan").on('change', function () {
			var pilih = $('#keperluan').val();
			$(".feedback").html("");
			if (pilih == 4) {
				$("#submit").prop("disabled", true);
				$('input[name="anggota"]').change(function () {
					if ($('input[name="anggota"]').is(":checked")) {
						$("#submit").prop("disabled", false);
					}
				});
				$("#tanggal_awal").slideDown(1000);
				$("#tanggal_akhir").slideDown(1000);
				$("#radio").slideDown(1000);
			} else if (pilih != 4) {
				$("#submit").prop("disabled", false);
				$("#tanggal_awal").slideUp(1000);
				$("#tanggal_akhir").slideUp(1000);
				$("#awal").slideUp(1000);
				$("#radio").slideUp(1000);
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

		$("#email").bind("keyup", validate);

		$("#npm").keydown(function (data) {
			if (data.which != 8 && data.which != 0 && (data.which < 48 || data.which > 57)) {
				$(".npm").html("Npm hanya diperbolehkan angka");
				$(".npm").css("color", "#F0AD4E");
				return false;
			} else {
				$(".npm").html("");
			}
		});

		$("#nrp1").keydown(function (data) {
			if (data.which != 8 && data.which != 0 && (data.which < 48 || data.which > 57)) {
				$(".nrp1").html("Npm hanya diperbolehkan angka");
				$(".nrp1").css("color", "#F0AD4E");
				return false;
			} else {
				$(".nrp1").html("");
			}
		});

		$("#no_hp").keydown(function (data) {
			var no = $("#no_hp").val().length + 1;
			if (data.which != 8 && data.which != 0 && (data.which < 48 || data.which > 57)) {
				$(".no_hp").html("Nomor Hp hanya diperbolehkan angka");
				$(".no_hp").css("color", "#F0AD4E");
				return false;
			} else if (no < 10) {
				$(".no_hp").html("Nomor Hp minimal 10 digit");
				$(".no_hp").css("color", "#F0AD4E");
				$("#submit").prop("disabled", true);
			} else {
				$("#submit").prop("disabled", false);
				$(".no_hp").html("");
			}
		});

		$("#nama").keypress(function (event) {
			var nama = $("#nama").val().length + 1;
			var charCode = (event.which) ? event.which : event.keyCode;
			if (nama < 3 && (charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122)) {
				$(".nama").html("Nama minimal 3 huruf");
				$(".nama").css("color", "#F0AD4E");
				$("#submit").prop("disabled", true);
			} else if ((charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122) || (charCode == 32) || charCode == 8 || charCode == 9) {
				$(".nama").html("");
				$("#submit").prop("disabled", false);
				return true;
			} else {
				$(".nama").html("Nama hanya diperbolehkan huruf");
				$(".nama").css("color", "#F0AD4E");
				return false;
			}
		});

		$("#nama1").keypress(function (event) {
			var nama1 = $("#nama1").val().length + 1;
			var charCode = (event.which) ? event.which : event.keyCode;
			if (nama1 < 3 && (charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122)) {
				$(".nama1").html("Nama minimal 3 huruf");
				$(".nama1").css("color", "#F0AD4E");
				$("#submit").prop("disabled", true);
			} else if ((charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122) || (charCode == 32) || charCode == 8 || charCode == 9) {
				$(".nama1").html("");
				$("#submit").prop("disabled", false);
				return true;
			} else {
				$(".nama1").html("Nama hanya diperbolehkan huruf");
				$(".nama1").css("color", "#F0AD4E");
				return false;
			}
		});

		$("#jurusan").keypress(function (event) {
			var charCode = (event.which) ? event.which : event.keyCode;
			if ((charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122) || (charCode == 32) || charCode == 8 || charCode == 9) {
				$(".jurusan").html("");
				return true;
			} else {
				$(".jurusan").html("Jurusan hanya diperbolehkan huruf");
				$(".jurusan").css("color", "#F0AD4E");
				return false;
			}
		});

		$("#kampus").keypress(function (event) {
			var charCode = (event.which) ? event.which : event.keyCode;
			if ((charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122) || (charCode == 32) || charCode == 8 || charCode == 9) {
				$(".kampus").html("");
				return true;
			} else {
				$(".kampus").html("Nama kampus hanya diperbolehkan huruf");
				$(".kampus").css("color", "#F0AD4E");
				return false;
			}
		});

		$("input:radio[name=anggota]").change(function (e) {
			e.preventDefault;
			var anggota = $("input:radio[name=anggota]:checked").val();
			if (anggota == "kelompok") {
				$("#awal").slideDown(1000);
			} else {
				$("#awal").slideUp(1000);
				// $("#awal").hide();
			}
		})
	});

	function validateEmail(email) {
		var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		return re.test(email);
	}

	function validate() {
		var $result = $(".email");
		var email = $("#email").val();
		$result.text("");

		if (validateEmail(email)) {
			$result.text("");
			$("#submit").prop("disabled", false);
		} else {
			$result.text("Masukan format email yang benar");
			$result.css("color", "#F0AD4E");
			$("#submit").prop("disabled", true);
		}
		return false;
	}

	$("#basic_validation").vindicate("init");
	$("#basicfeedback_validation").vindicate("init");
	var submitBasicFeedback = function () {
		$("#basicfeedback_validation").vindicate("validate");
		var npm = $("#nrp1").val();
		var name = $("#nama1").val();
		var jurusan = $("#jurusan").val();
		var masuk = $("#datepicker").val();
		var selesai = $("#datepicker1").val();
		var pilih = $("#keperluan").val();
		var file = $('#customFile').val();
		var anggota = $("input:radio[name=anggota]:checked").val();
		if (pilih == 0 || file == "") {
			$("#remove").addClass("has-warning");
			$(".feedback").html("This is a field required");
			$("#remove1").addClass("has-warning");
			$(".feedback1").html("This is a field required");
			$("#submit").prop("disabled", true);
		} else {
			$("#submit").prop("disabled", false);
			if (pilih == 4) {
				if (anggota == "sendiri") {
					if (jurusan != "" && masuk != "" && selesai != "") {
						save();
					}
				} else {
					if (npm != "" && name != "" && jurusan != "" && masuk != "" && selesai != "") {
						save();
					}
				}
			} else {
				save();
			}
		}
	}

	$(function () {

		// We can attach the `fileselect` event to all file inputs on the page
		$(document).on('change', ':file', function () {
			var input = $(this),
				numFiles = input.get(0).files ? input.get(0).files.length : 1,
				label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
			input.trigger('fileselect', [numFiles, label]);
		});

		// We can watch for our custom `fileselect` event like this
		$(document).ready(function () {
			$(':file').on('fileselect', function (event, numFiles, label) {

				var input = $(this).parents('.input-group').find(':text'),
					log = numFiles > 1 ? numFiles + ' files selected' : label;

				if (input.length) {
					input.val(log);
				} else {
					if (log) alert(log);
				}

			});
		});

		$('#datepicker').datepicker({
			weekStart: 1,
			daysOfWeekHighlighted: "6,0",
			autoclose: true,
			todayHighlight: true,
			format: 'yyyy-mm-dd',
		});

		$('#datepicker1').datepicker({
			weekStart: 1,
			daysOfWeekHighlighted: "6,0",
			autoclose: true,
			todayHighlight: true,
			format: 'yyyy-mm-dd',
		});
	});

	function save() {
		var pilih = $("#keperluan").val();
		var email = $("#email").val();
		var kampus = $("#kampus").val();
		var noHp = $("#no_hp").val();
		var keperluan = $("#keperluan").val();
		var rincian = $("#rincian").val();
		var jurusan = $("#jurusan").val();
		var masuk = $("#datepicker").val();
		var selesai = $("#datepicker1").val();
		var file_data = $('#customFile').prop('files')[0];
		var anggota = $("input:radio[name=anggota]:checked").val();
		var form_data = new FormData();
		var nrp = [];
		var nama = [];
		$('input[name="nrp"]').each(function () {
			nrp.push($(this).val());
		});
		$('input[name="nama"]').each(function () {
			nama.push($(this).val());
		});

		if (pilih != 4) {
			nrp.splice(1, 2);
			nama.splice(1, 2);
		} else {
			if (anggota == "sendiri") {
				nrp.splice(1, 2);
				nama.splice(1, 2);
			}
		}
		form_data.append('npm', JSON.stringify(nrp));
		form_data.append('nama', JSON.stringify(nama));
		form_data.append('email', email);
		form_data.append('kampus', kampus);
		form_data.append('no_hp', noHp);
		form_data.append('keperluan', keperluan);
		form_data.append('rincian', rincian);
		form_data.append('jurusan', jurusan);
		form_data.append('tanggal', masuk);
		form_data.append('tanggal_akhir', selesai);
		form_data.append('dokumen', file_data);
		form_data.append("<?= $this->security->get_csrf_token_name();?>", "<?= $this->security->get_csrf_hash(); ?>");
		swal({
			title: "Apakah data yang dimasukan sudah benar ?",
			text: "Jika belum silahkan periksa kembali sebelum menginsert data",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
			.then((willDelete) => {
				if (willDelete) {
					$.ajax({
					    url: "<?php echo site_url('Perizinan/create_action')?>",
					    dataType: "JSON",
					    cache: false,
					    contentType: false,
					    processData: false,
					    data: form_data,
					    type: "POST",
					    success: function (data) {
					        if (data.status == true) {
					            swal({
					                title: "Success",
					                text: "Data berhasil disimpan",
					                icon: "success",
					                buttons: false,
					            });
					            setTimeout(function () {
					                location.reload();
					            }, 2000);
					        }
					    },
					    error: function (xhr, status, error) {
					        alert(status + " : " + error);
					    }
					})
				} else {
					swal("Permintaan telah dibatalkan");
				}
			});
	}
</script>
</body>
</html>
