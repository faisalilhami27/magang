<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="content-wrapper">

    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">UPDATE DATA PERMOHONAN</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
                <input type="hidden" id="csrf" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
				<input type="hidden" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>"/>
                <table class='table table-bordered>'
				<tr>
					<td width='200'>Keperluan <?php echo form_error('keperluan') ?></td>
					<td><?= cmb_dinamis3('keperluan', 'tbl_keperluan', 'nama_keperluan', 'id_keperluan', $keperluan) ?></td>
				</tr>
                <tr>
                    <td width='200'>Status <?php echo form_error('status') ?></td>
                    <td><?= cmb_dinamis2('status', 'tbl_status', 'nama_status', 'id_status', $status) ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <button type="submit" class="btn btn-danger"><i
                                    class="fa fa-floppy-o"></i> <?php echo $button ?></button>
                        <a href="<?php echo site_url('Permohonan') ?>" class="btn btn-info"><i
                                    class="fa fa-sign-out"></i> Kembali</a></td>
                </tr>
                </table>
            </form>
        </div>
    </div>
