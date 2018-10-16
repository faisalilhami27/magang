<div class="content-wrapper">

    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">DETAIL DATA PERMOHONAN</h3>
            </div>
            <table class="table table-bordered">
                <tr>
                    <td>Npm</td>
                    <td><?php echo $npm; ?></td>
                </tr>
                <tr>
                    <td>Nama Mahasiswa</td>
                    <td><?php echo $nama_mahasiswa; ?></td>
                </tr>
                <tr>
                    <td>Perguruan Tinggi</td>
                    <td><?php echo $perguruan_tinggi; ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?php echo $email; ?></td>
                </tr>
                <tr>
                    <td>Keperluan</td>
                    <td><?php echo $keperluan; ?></td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td><?php echo $status; ?></td>
                </tr>
                <tr>
                    <td>Rincian Keperluan</td>
                    <td><?php echo $rincian; ?></td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td><?php echo $tanggal; ?></td>
                </tr>
                <tr>
                    <td>Tanggal Akhir</td>
                    <td><?php echo $tanggal_akhir; ?></td>
                </tr>
                <tr>
                    <td>No Hp</td>
                    <td><?php echo $no_hp; ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td><a href="<?php echo site_url('Permohonan') ?>" class="btn btn-default">Cancel</a></td>
                </tr>
            </table>
        </div>
    </section>
</div>
