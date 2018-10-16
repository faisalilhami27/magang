<?php
function cmb_dinamis($name, $table, $field, $pk, $selected = null, $order = null)
{
    $ci = get_instance();
    $cmb = "<select name='$name'class='form-control'>";
    $data = $ci->db->get($table)->result();
    foreach ($data as $d) {
        $cmb .= "<option value='" . $d->$pk . "'";
        $cmb .= $selected == $d->$pk ? " selected='selected'" : '';
        $cmb .= ">" . $d->$field . "</option>";
    }
    $cmb .= "</select>";
    return $cmb;
}

function getBulan($bln)
{
    switch ($bln) :
        case '01':
            $bulan = "Januari";
            break;
        case '02':
            $bulan = "Februari";
            break;
        case '03':
            $bulan = "Maret";
            break;
        case '04':
            $bulan = "April";
            break;
        case '05':
            $bulan = "Mei";
            break;
        case '06':
            $bulan = "Juni";
            break;
        case '07':
            $bulan = "Juli";
            break;
        case '08':
            $bulan = "Agustus";
            break;
        case '09':
            $bulan = "September";
            break;
        case '10':
            $bulan = "Oktober";
            break;
        case '11':
            $bulan = "November";
            break;
        case '12':
            $bulan = "Desember";
            break;
    endswitch;
    return $bulan;
}

function getStyling($status)
{
	switch ($status) :
		case 'menunggu konfirmasi':
			$nama_status = '<span class="label label-warning">' . $status . '</span>';
			break;
		case 'diterima':
			$nama_status = '<span class="label label-primary">' . $status . '</span>';
			break;
		case 'ditolak':
			$nama_status = '<span class="label label-danger">' . $status . '</span>';
			break;
	endswitch;
	return $nama_status;
}

function getdata($tgl_kampus, $tgl_kesba, $kepada, $no_kesba, $no_kampus, $id_surat)
{
	if ($tgl_kampus == "0000-00-00" && $tgl_kesba == "0000-00-00" && $kepada == "" && $no_kesba == "Belum di assign"
	&& $no_kampus == "Belum di assign") :
		$button = '<button type="button" disabled="" title="Print" class="btn btn-warning btn-sm"><i class="fa fa-print"></i></a>';
	else:
		$button = '<a href="' . site_url('surat/cetak_surat/' . $id_surat) . '" title="Print" target="_blank" class="btn btn-warning btn-sm"><i class="fa fa-print"></i></a>';
	endif;
	return $button;
}

function cetak($str){
    echo htmlentities($str, ENT_QUOTES, 'UTF-8');
}

function getString($str)
{
    switch ($str) :
        case 'y':
            $string = "Aktif";
            break;
        case 'n':
            $string = "Tidak Aktif";
            break;
    endswitch;
    return $string;
}

function cmb_dinamis1($name, $table, $field, $pk, $selected = null, $order = null)
{
    $ci = get_instance();
    $cmb = "<select name='$name'class='form-control' id='keperluan'>";
    if ($order) {
        $ci->db->order_by($field, $order);
    }
    $ci->db->select('*');
    $ci->db->where('id_keperluan between 1 and 5');
    $data = $ci->db->get($table)->result();
    $cmb .= "<option value='0' readonly='' selected>Pilih Keperluan</option>";
    foreach ($data as $d) {
        $cmb .= "<option value='" . $d->$pk . "'";
        $cmb .= $selected == $d->$pk ? " selected='selected'" : '';
        $cmb .= ">" . $d->$field . "</option>";
    }
    $cmb .= "</select>";
    return $cmb;
}

function cmb_dinamis2($name, $table, $field, $pk, $selected = null, $order = null)
{
    $ci = get_instance();
    $cmb = "<select name='$name' class='form-control'>";
    $data = $ci->db->get($table)->result();
    foreach ($data as $d) {
        $cmb .= "<option value='" . $d->$pk . "'";
        $cmb .= $selected == $d->$pk ? " selected='selected'" : '';
        $cmb .= ">" . strtoupper($d->$field) . "</option>";
    }
    $cmb .= "</select>";
    return $cmb;
}

function cmb_dinamis3($name, $table, $field, $pk, $selected = null, $order = null)
{
    $ci = get_instance();
    $cmb = "<select name='$name' class='form-control' id='example' style='background: #eee; pointer-events: none; touch-action: none;'>";
    $data = $ci->db->get($table)->result();
    foreach ($data as $d) {
        $cmb .= "<option value='" . $d->$pk . "'";
        $cmb .= $selected == $d->$pk ? " selected='selected'" : '';
        $cmb .= ">" . strtoupper($d->$field) . "</option>";
    }
    $cmb .= "</select>";
    return $cmb;
}

function select2_dinamis($name, $table, $field, $placeholder)
{
    $ci = get_instance();
    $select2 = '<select name="' . $name . '" class="form-control select2 select2-hidden-accessible" multiple="" 
               data-placeholder="' . $placeholder . '" style="width: 100%;" tabindex="-1" aria-hidden="true">';
    $data = $ci->db->get($table)->result();
    foreach ($data as $row) {
        $select2 .= ' <option>' . $row->$field . '</option>';
    }
    $select2 .= '</select>';
    return $select2;
}

function datalist_dinamis($name, $table, $field, $value = null)
{
    $ci = get_instance();
    $string = '<input value="' . $value . '" name="' . $name . '" list="' . $name . '" class="form-control">
    <datalist id="' . $name . '">';
    $data = $ci->db->get($table)->result();
    foreach ($data as $row) {
        $string .= '<option value="' . $row->$field . '">';
    }
    $string .= '</datalist>';
    return $string;
}

function rename_string_is_aktif($string)
{
    return $string == 'y' ? 'Aktif' : 'Tidak Aktif';
}


function is_login()
{
    $ci = get_instance();
    if (!$ci->session->userdata('id_users')) {
        redirect('auth');
    } else {
        $modul = $ci->uri->segment(1);

        $id_user_level = $ci->session->userdata('id_user_level');
        // dapatkan id menu berdasarkan nama controller
        $menu = $ci->db->get_where('tbl_menu', array('url' => $modul))->row_array();
        $id_menu = $menu['id_menu'];
        // chek apakah user ini boleh mengakses modul ini
        $hak_akses = $ci->db->get_where('tbl_hak_akses', array('id_menu' => $id_menu, 'id_user_level' => $id_user_level));
        if ($hak_akses->num_rows() < 1) {
            redirect('blokir');
            exit;
        }
    }
}

function alert($class, $title, $description)
{
    return '<div class="alert ' . $class . ' alert-dismissible">
                <h4><i class="icon fa fa-ban"></i> ' . $title . '</h4>
                ' . $description . '
              </div>';
}

function alert1($class, $title, $description)
{
    return '<div class="alert ' . $class . ' alert-dismissible">
                <h4><i class="icon fa fa-ban"></i> ' . $title . '</h4>
                ' . $description . '
              </div>';
}

// untuk chek akses level pada modul peberian akses
function checked_akses($id_user_level, $id_menu)
{
    $ci = get_instance();
    $ci->db->where('id_user_level', $id_user_level);
    $ci->db->where('id_menu', $id_menu);
    $data = $ci->db->get('tbl_hak_akses');
    if ($data->num_rows() > 0) {
        return "checked='checked'";
    }
}


function autocomplate_json($table, $field)
{
    $ci = get_instance();
    $ci->db->like($field, $_GET['term']);
    $ci->db->select($field);
    $collections = $ci->db->get($table)->result();
    foreach ($collections as $collection) {
        $return_arr[] = $collection->$field;
    }
    echo json_encode($return_arr);
}
