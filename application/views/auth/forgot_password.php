<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="<?= base_url('assets/css/jquerysctipttop.css') ?>" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/bower_components/font-awesome/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap4.min.css') ?>">
    <link rel="shortcut icon" href="<?= base_url('assets/foto_profil/dtr.png') ?>"/>
    <link href="<?= base_url('assets/css/bootstrap-datepicker.min.css') ?>" rel="stylesheet"/>
    <link rel="shortcut icon" href="<?= base_url('assets/foto_profil/dtr.png') ?>"/>
    <title>Halaman Forgot Password</title>
    <style>
        input {
            background: transparent;
        }
    </style>
</head>
<body style="background-image: url('<?= base_url("assets/foto_profil/distaru.png") ?>'); background-size: 100%">
<nav class="navbar navbar-expand-lg navbar-light">
    <img src="<?= base_url('assets/foto_profil/distarcip.png') ?>" width="340px" alt="distaru">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        </ul>
        <a href="<?= site_url('auth') ?>">
            <button class="btn btn-primary btn-sm" type="submit"><b>Login</b></button>
        </a>
    </div>
</nav>
<div class="container" style="width: 500px; border-radius: 10px; background-color: #fff">
    <form action="" id="basicfeedback_validation" method="post" style="padding-top: 10px;">
        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
               value="<?= $this->security->get_csrf_hash(); ?>">
        <h4 style="text-align: center"><b>Form Forgot Password</b></h4>
        <?php echo $this->session->userdata("pesan") ?>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" id="email" autofocus autocomplete="on"
                           placeholder="Email"
                           data-vindicate="required|format:email|active"/>
                    <small class="form-control-feedback1" style="color: red"></small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="pass" class="form-control" id="pass"
                           placeholder="Masukan Password Baru"
                           data-vindicate="required|format:alphanumeric|active"/>
                    <small class="form-control-feedback"></small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <input type="password" name="konpass" class="form-control" id="konpass"
                           placeholder="Konfirmasi Password"
                           data-vindicate="required|format:alphanumeric|active"/>
                    <small class="form-control-feedback"></small>
                </div>
            </div>
        </div>
        <br>
        <button id="submit" style="position: relative; top: -10px;" class="btn btn-primary btn-block"
                type="button" onclick="save()">Submit
        </button>
    </form>
</div>
<script src="<?= base_url('assets/js/jquery-3.1.1.min.js') ?>"></script>
<script src="<?= base_url('assets/js/popper.min.js') ?>"></script>
<script src="<?= base_url('assets/js/tether.min.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap-datepicker.min.js') ?>"></script>
<script src="<?= base_url('assets/js/sweetalert.min.js') ?>"></script>
<script src="<?= base_url('assets/js/vindicate.js') ?>"></script>z
<script>
    function validateEmail(email) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }

    function validate() {
        var $result = $(".form-control-feedback1");
        var email = $("#email").val();
        $result.text("");

        if (validateEmail(email)) {
            $result.text("");
            $result.css("color", "green");
            $("#submit").prop("disabled", false);
        } else {
            $result.text("Masukan format email yang benar");
            $result.css("color", "red");
            $("#submit").prop("disabled", true);
        }
        return false;
    }

    $("#email").bind("keyup", validate);

    function save() {
        var email = $("#email").val();
        var pass = $("#pass").val();
        var konpass = $("#konpass").val();
        if (email == "" || pass == "" || konpass == "") {
            swal({
                title: "Warning",
                text: "Semua field harus diisi",
                icon: "warning",
                button: "Ok",
            });
        } else if (pass != konpass) {
            swal({
                title: "Warning",
                text: "Password tidak sama",
                icon: "warning",
                button: "Ok",
            });
        } else {
            $.ajax({
                url: "<?php echo site_url('auth/forgot')?>",
                type: "POST",
                dataType: "JSON",
                data: $("#basicfeedback_validation").serialize(),
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
    }
</script>
</body>
</html>
