<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dinas Penataan Ruang Kota Bandung</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/jquery-ui/themes/base/minified/jquery-ui.min.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/bower_components/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="shortcut icon" href="<?= base_url('assets/foto_profil/dtr.png') ?>"/>
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/dist/css/skins/_all-skins.min.css">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition lockscreen">
<div class="lockscreen-wrapper">
    <div class="lockscreen-logo">
        <span><b>Distaru</b></span><br>
        <?= $this->session->userdata('status_login') ?>
    </div>
    <div class="lockscreen-name"><?= $this->session->userdata('full_name') ?></div>

    <div class="lockscreen-item">
        <div class="lockscreen-image">
            <img src="<?= base_url('assets/foto_profil/'.$this->session->userdata('images')) ?>" alt="User Image">
        </div>
        <form action="<?= site_url('lockscreen/reLogin') ?>" method="post" class="lockscreen-credentials">
            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                   value="<?= $this->security->get_csrf_hash(); ?>">
            <div class="input-group">
                <input type="password" name="password" class="form-control" placeholder="password">
                <div class="input-group-btn">
                    <button type="submit" class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
                </div>
            </div>
        </form>
    </div>
    <div class="help-block text-center">
        Masukan kembali password untuk login
    </div>
    <div class="lockscreen-footer text-center">
        Copyright &copy; <?= date("Y") ?> <b class="text-black"><br>Dinas Penataan Ruang Kota Bandung</b><br>
        All rights reserved
    </div>
</div>
<!-- /.center -->

<script src="<?= base_url('assets/js/jquery-3.1.1.min.js') ?>"></script>
<script src="<?php echo base_url() ?>assets/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<script src="<?= base_url('assets/js/jquery.idle.min.js') ?>"></script>
<script>
    $(document).idle({
        onIdle: function(){
            window.location="<?= site_url('auth/logout') ?>";
        },
        idle: 1800000
    });
</script>
<script>
    $(document).ready(function() {
        window.history.pushState(null, "", window.location.href);
        window.onpopstate = function() {
            window.history.pushState(null, "", window.location.href);
        };
    });
</script>
</body>
</html>
