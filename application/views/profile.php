<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle"
                             src="<?= base_url('assets/foto_profil/' . $images) ?>" alt="User profile picture"
                             style="width: 128px; height: 128px">

                        <h3 class="profile-username text-center"><?= $full_name ?></h3>

                        <p class="text-muted text-center"><?= $level ?></p>
                        <center><b><?= $email ?></b></center>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#activity" data-toggle="tab">Ubah Profil</a></li>
                        <li><a href="#timeline" data-toggle="tab">Ubah Password</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            <form action="<?php echo $action ?>" method="post" class="form-horizontal"
                                  enctype="multipart/form-data">
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                                       value="<?= $this->security->get_csrf_hash(); ?>">
                                <input type="hidden" name="id_users" value="<?php echo $id_users; ?>"/>
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Nama Lengkap</label>

                                    <div class="col-sm-10">
                                        <input type="text" name="full_name" class="form-control" id="inputName"
                                               placeholder="Nama Lengkap" value="<?php echo $full_name; ?>">
                                        <small style="color: #F6BF4E" class="inputName"></small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                                    <div class="col-sm-10">
                                        <input type="email" name="email" class="form-control" id="inputEmail"
                                               placeholder="Email" value="<?php echo $email; ?>">
                                        <small style="color: #F6BF4E" class="email"></small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Level</label>

                                    <div class="col-sm-10">
                                        <?php echo cmb_dinamis('id_user_level', 'tbl_user_level', 'nama_level', 'id_user_level', $level, 'DESC') ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputExperience" class="col-sm-2 control-label">Status Aktif</label>

                                    <div class="col-sm-10">
                                        <?php echo form_dropdown('is_aktif', array('y' => 'AKTIF', 'n' => 'TIDAK AKTIF'), $is_aktif, array('class' => 'form-control')); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="images" class="col-sm-2 control-label">Foto Profile</label>

                                    <div class="col-sm-10">
                                        <input type="file" name="images">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-danger">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="timeline">
                            <form action="" id="change_password" method="post" class="form-horizontal">
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                                       value="<?= $this->security->get_csrf_hash(); ?>">
                                <div class="form-group">
                                    <label for="inputpass" class="col-sm-2 control-label">Password</label>

                                    <div class="col-sm-10">
                                        <input type="password" name="pass" class="form-control" id="inputpass"
                                               placeholder="Password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="konpass" class="col-sm-2 control-label">Konfirmasi Password</label>

                                    <div class="col-sm-10">
                                        <input type="password" name="konpass" class="form-control" id="konpass"
                                               placeholder="Konfirmasi Password">
                                        <span class="result"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="button" id="change" class="btn btn-danger">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery-1.9.1.min.js"></script>
<script src="<?= base_url('assets/js/sweetalert.min.js') ?>"></script>
<script>
    $(document).ready(function () {
        $("#konpass").keyup(function () {
            var pass = $("#inputpass").val();
            var konpass = $("#konpass").val();
            if (pass != konpass) {
                $(".result").html("Password tidak sama");
                $("#change").prop("disabled", true);
            } else {
                $(".result").html("");
                $("#change").prop("disabled", false);
            }
        });

        $("#inputName").keypress(function (event) {
            var inputName = $("#inputName").val().length + 1;
            var charCode = (event.which) ? event.which : event.keyCode;
            if (inputName < 3 && (charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122)) {
                $(".inputName").html("Nama minimal 3 huruf");
                $(".inputName").css("color", "#F0AD4E");
                $("#submit").prop("disabled", true);
            } else if ((charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122) || (charCode == 32) || charCode == 8 || charCode == 9) {
                $(".inputName").html("");
                $("#submit").prop("disabled", false);
                return true;
            } else {
                $(".inputName").html("Nama hanya diperbolehkan huruf");
                $(".inputName").css("color", "#F0AD4E");
                return false;
            }
        });

        $("#change").click(function () {
            var pass = $("#inputpass").val();
            var konpass = $("#konpass").val();
            if (pass == "" || konpass == "") {
                swal({
                    title: "Warning",
                    text: "Semua field harus diisi",
                    icon: "warning",
                    button: "Ok",
                });
            } else {
                $.ajax({
                    url: "<?php echo site_url('auth/changePassword')?>",
                    type: "POST",
                    dataType: "JSON",
                    data: $("#change_password").serialize(),
                    success: function (data) {
                        if (data.status == true) {
                            swal({
                                title: "Success",
                                text: "Data berhasil diubah",
                                icon: "success",
                                buttons: false,
                            });
                            setTimeout(function () {
                                location.reload();
                            }, 2000);
                        } else {
                            swal({
                                title: "Error",
                                text: "Data gagal diubah",
                                icon: "error",
                                buttons: false,
                            });
                            setTimeout(function () {
                                location.reload();
                            }, 2000);
                        }
                    }
                })
            }
        })

        $("#inputEmail").keyup(function (e) {
            e.preventDefault();
            var $result = $(".email");
            var email = $("#inputEmail").val();
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
        })

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
    });
    function validateEmail(email) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }
</script>
