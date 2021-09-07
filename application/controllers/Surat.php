<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Surat extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('Surat_selesai_kp_model');
		$this->load->model('Anggota_kp_model');
		$this->load->model('Konfigurasi_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['name_csrf'] = $this->security->get_csrf_token_name();
		$data['hash_csrf'] = $this->security->get_csrf_hash();
		$this->template->load('template', 'surat/tbl_surat_selesai_kp_list', $data);
	}

	function get_data_surat()
	{
		$list = $this->Surat_selesai_kp_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = '<center>' . $no . '</center>';
			$row[] = '<center>' . '<a href="#" class="anggota" id="' . $field->id_surat . '" title="Lihat Anggota" data-toggle="modal" data-target="#myModal">' . $field->no_surat . '</center>';
			$row[] = '<center>' . $field->nama_anggota . '</center>';
			$row[] = '<center>' . $field->kampus . '</center>';
			$row[] = '<center>' . $field->no_kesbangpol . '</center>';
			$row[] = '<center>' . $field->no_surat_kampus . '</center>';
			$row[] = '<center>
                        <a href="' . site_url('surat/read/' . $field->id_surat) . '" title="View Data" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                        <a href="' . site_url('surat/update/' . $field->id_surat) . '" title="Update Data" class="btn btn-success btn-sm"><i class="fa fa-pencil-square-o"></i></a>
                        <a href="' . site_url('surat/delete/' . $field->id_surat) . '" title="Delete Data" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure ?\')"><i class="fa fa-trash-o"></i></a> '
						. getdata($field->tgl_surat_kesbangpol, $field->tgl_surat_kampus, $field->kepada, $field->no_kesbangpol, $field->no_surat_kampus, $field->id_surat) .
                    '</center>';
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Surat_selesai_kp_model->count_all(),
			"recordsFiltered" => $this->Surat_selesai_kp_model->count_filtered(),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}

	public function read($id)
	{
		$row = $this->Surat_selesai_kp_model->get_by_id($id);
		$tanggal = date("d", strtotime($row->tgl_mulai));
		$bulan = date("m", strtotime($row->tgl_mulai));
		$tahun = date("Y", strtotime($row->tgl_mulai));
		$tanggal_mulai = $tanggal . " " . getBulan($bulan) . " " . $tahun;
		$tanggal2 = date("d", strtotime($row->tgl_selesai));
		$bulan2 = date("m", strtotime($row->tgl_selesai));
		$tahun2 = date("Y", strtotime($row->tgl_selesai));
		$tanggal_selesai = $tanggal2 . " " . getBulan($bulan2) . " " . $tahun2;
		$tanggal = date("d", strtotime($row->tgl_surat));
		$bulan = date("m", strtotime($row->tgl_surat));
		$tahun = date("Y", strtotime($row->tgl_surat));
		$tanggal_surat = $tanggal . " " . getBulan($bulan) . " " . $tahun;
		$tanggal2 = date("d", strtotime($row->tgl_surat_kampus));
		$bulan2 = date("m", strtotime($row->tgl_surat_kampus));
		$tahun2 = date("Y", strtotime($row->tgl_surat_kampus));
		$tanggal_surat_kampus = $tanggal2 . " " . getBulan($bulan2) . " " . $tahun2;
		$tanggal2 = date("d", strtotime($row->tgl_surat_kesbangpol));
		$bulan2 = date("m", strtotime($row->tgl_surat_kesbangpol));
		$tahun2 = date("Y", strtotime($row->tgl_surat_kesbangpol));
		$tanggal_surat_kesbangpol = $tanggal2 . " " . getBulan($bulan2) . " " . $tahun2;
		if ($row) {
			$data = array(
				'id_surat' => $row->id_surat,
				'no_surat' => $row->no_surat,
				'nama_pendaftar' => $row->nama_anggota,
				'sifat' => $row->sifat,
				'lampiran' => $row->lampiran,
				'kepada' => $row->kepada,
				'tgl_surat' => $tanggal_surat,
				'tgl_surat_kampus' => $tanggal_surat_kampus,
				'tgl_surat_kesbangpol' => $tanggal_surat_kesbangpol,
				'no_kesbangpol' => $row->no_kesbangpol,
				'no_surat_kampus' => $row->no_surat_kampus,
				'tgl_mulai' => $tanggal_mulai,
				'tgl_selesai' => $tanggal_selesai,
			);
			$this->template->load('template', 'surat/tbl_surat_selesai_kp_read', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('surat'));
		}
	}

	public function cetak_surat($id_surat)
	{
		$konfig = $this->Konfigurasi_model->get_all();
		$surat = $this->Surat_selesai_kp_model->get_by_id($id_surat);
		$anggota = $this->Anggota_kp_model->get_anggota($id_surat);
		$anggota2 = $this->Anggota_kp_model->get_anggota2($id_surat);
		$tanggal = date("d", strtotime($surat->tgl_surat));
		$bulan = date("m", strtotime($surat->tgl_surat));
		$tahun = date("Y", strtotime($surat->tgl_surat));
		$tanggal_surat = $tanggal . " " . getBulan($bulan) . " " . $tahun;
		$tanggal2 = date("d", strtotime($surat->tgl_surat_kampus));
		$bulan2 = date("m", strtotime($surat->tgl_surat_kampus));
		$tahun2 = date("Y", strtotime($surat->tgl_surat_kampus));
		$tanggal_kampus = $tanggal2 . " " . getBulan($bulan2) . " " . $tahun2;
		$tanggal3 = date("d", strtotime($surat->tgl_surat_kesbangpol));
		$bulan3 = date("m", strtotime($surat->tgl_surat_kesbangpol));
		$tahun3 = date("Y", strtotime($surat->tgl_surat_kesbangpol));
		$tanggal_kesba = $tanggal3 . " " . getBulan($bulan3) . " " . $tahun3;
		$tanggal4 = date("d", strtotime($surat->tgl_mulai));
		$bulan4 = date("m", strtotime($surat->tgl_mulai));
		$tahun4 = date("Y", strtotime($surat->tgl_mulai));
		$tanggal_mulai = $tanggal4 . " " . getBulan($bulan4) . " " . $tahun4;
		$tanggal5 = date("d", strtotime($surat->tgl_selesai));
		$bulan5 = date("m", strtotime($surat->tgl_selesai));
		$tahun5 = date("Y", strtotime($surat->tgl_selesai));
		$tanggal_selesai = $tanggal5 . " " . getBulan($bulan5) . " " . $tahun5;
		$data = array(
			"anggota" => $anggota,
			"anggota2" => $anggota2,
			"surat" => $surat,
			"tanggal" => $tanggal_surat,
			"tanggal2" => $tanggal_kampus,
			"tanggal3" => $tanggal_kesba,
			"tanggal4" => $tanggal_mulai,
			"tanggal5" => $tanggal_selesai,
			"konfig" => $konfig,
		);

		$array = array(
			'mode' => 'utf-8',
			'format' => 'LEGAL'
		);
		$mpdf = new \Mpdf\Mpdf($array);
		$mpdf->showImageErrors = true;
		$nama_file = $surat->no_surat . ".pdf";
		$view = $this->load->view('cetak_surat_kp', $data, true);
		$mpdf->WriteHTML($view);
		$mpdf->Output($nama_file, 'I');
	}

	public function update($id)
	{
		$row = $this->Surat_selesai_kp_model->get_by_id($id);
		if ($row->no_kesbangpol == "Belum di assign" && $row->no_surat_kampus == "Belum di assign") {
			$nomor_kesba = "";
			$nomor_kampus = "";
		} else {
			$nomor_kesba = $row->no_kesbangpol;
			$nomor_kampus = $row->no_surat_kampus;
		}
		if ($row) {
			$data = array(
				'button' => 'Update',
				'action' => site_url('surat/update_action'),
				'id_surat' => set_value('id_surat', $row->id_surat),
				'no_surat' => set_value('no_surat', $row->no_surat),
				'sifat' => set_value('sifat', $row->sifat),
				'lampiran' => set_value('lampiran', $row->lampiran),
				'kepada' => set_value('kepada', $row->kepada),
				'kota' => set_value('kepada', $row->kota),
				'tgl_surat' => set_value('tgl_surat', $row->tgl_surat),
				'tgl_surat_kampus' => set_value('tgl_surat_kampus', $row->tgl_surat_kampus),
				'tgl_surat_kesbangpol' => set_value('tgl_surat_kesbangpol', $row->tgl_surat_kesbangpol),
				'no_kesbangpol' => set_value('no_kesbangpol', $nomor_kesba),
				'no_surat_kampus' => set_value('no_surat_kampus', $nomor_kampus),
				'tgl_mulai' => set_value('tgl_mulai', $row->tgl_mulai),
				'tgl_selesai' => set_value('tgl_selesai', $row->tgl_selesai),
			);
			$this->template->load('template', 'surat/tbl_surat_selesai_kp_form', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('surat'));
		}
	}

	public function update_action()
	{
		$this->_rules();
		$no_kesba = htmlspecialchars($this->input->post('no_kesbangpol', TRUE));
		$no_surat_kampus = htmlspecialchars($this->input->post('no_surat_kampus', TRUE));
		if ($this->form_validation->run() == FALSE) {
			$this->update($this->input->post('id_surat', TRUE));
		} else {
			$data = array(
				'kepada' => htmlspecialchars($this->input->post('kepada', TRUE)),
				'tgl_surat' => date("Y-m-d"),
				'tgl_surat_kampus' => htmlspecialchars($this->input->post('tgl_surat_kampus', TRUE)),
				'tgl_surat_kesbangpol' => htmlspecialchars($this->input->post('tgl_surat_kesbangpol', TRUE)),
				'kota' => htmlspecialchars($this->input->post('kota', TRUE)),
				'no_kesbangpol' => $no_kesba,
				'no_surat_kampus' => $no_surat_kampus,
			);
			$this->Surat_selesai_kp_model->update($this->input->post('id_surat', TRUE), $data);
			$this->session->set_flashdata('message', 'Update Record Success');
			redirect(site_url('surat'));
		}
	}

	public function delete($id)
	{
		$row = $this->Surat_selesai_kp_model->delete($id);
		$row1 = $this->Anggota_kp_model->delete_anggota($id);
		if ($row == TRUE && $row1 == TRUE) {
			$this->session->set_flashdata('message', 'Delete Record Success');
			redirect(site_url('surat'));
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('surat'));
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('kepada', 'kepada', 'trim|required');
		$this->form_validation->set_rules('kota', 'kota', 'trim|required');
		$this->form_validation->set_rules('tgl_surat_kampus', 'tgl surat kampus', 'trim|required');
		$this->form_validation->set_rules('tgl_surat_kesbangpol', 'tgl surat kesbangpol', 'trim|required');
		$this->form_validation->set_rules('no_kesbangpol', 'no kesbangpol', 'trim|required');
		$this->form_validation->set_rules('no_surat_kampus', 'no surat kampus', 'trim|required');

		$this->form_validation->set_rules('id_surat', 'id_surat', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}

}

/* End of file Surat.php */
/* Location: ./application/controllers/Surat.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-09-19 17:05:43 */
/* http://harviacode.com */
