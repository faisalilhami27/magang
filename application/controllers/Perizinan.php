<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Perizinan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Permohonan_model');
        $this->load->model('Anggota_kp_model');
        $this->load->model('Keperluan_model');
        $this->load->model('Surat_selesai_kp_model');
    }

    public function index()
    {
        $data['title'] = "Halaman Permohonan Permohonan";
        $data['name_csrf'] = $this->security->get_csrf_token_name();
        $data['hash_csrf'] = $this->security->get_csrf_hash();
        date_default_timezone_set('Asia/Jakarta');
        $data['tanggal'] = date('Y-m-d');
        $this->load->view('perizinan', $data);
    }

    public function create_action()
    {
        $foto = $this->upload_foto();
        $pilihan_lain = htmlspecialchars($this->input->post('keperluan', TRUE));
        $getNomorOtomatis = $this->Surat_selesai_kp_model->nomorOtomatis();
        $nomor = "800" . " / " . $getNomorOtomatis . " -Distaru";
        $npm = json_decode($this->input->post('npm'));
        $nama = json_decode($this->input->post('nama'));
        $j_npm = count($npm);
        $j_nama = count($nama);
        $total = ($j_npm + $j_nama) / 2;
        if ($pilihan_lain == 4) {
				$tanggal_awal = htmlspecialchars($this->input->post('tanggal', TRUE));
				$tanggal_akhir = htmlspecialchars($this->input->post('tanggal_akhir', TRUE));
				$data = array(
                'no_surat' => $nomor,
                'sifat' => "Biasa",
                'lampiran' => 0,
                'tgl_surat' => date("Y-m-d"),
                'no_kesbangpol' => "Belum di assign",
                'no_surat_kampus' => "Belum di assign",
                'tgl_mulai' => $tanggal_awal,
                'tgl_selesai' => $tanggal_akhir
            );
            $insert_surat = $this->Surat_selesai_kp_model->insert($data);
              if ($total >= 1) {
                  for ($i = 0; $i < $total; $i++) {
                      $data = array(
                          'id_surat' => $insert_surat,
                          'npm' => $npm[$i],
                          'nama_anggota' => $nama[$i],
                          'jurusan' => htmlspecialchars($this->input->post('jurusan', TRUE)),
                          'kampus' => htmlspecialchars($this->input->post('kampus', TRUE))
                      );
                      $this->Surat_selesai_kp_model->insert_anggota($data);
                  }
				  $get_id = $this->Anggota_kp_model->get_first_name($insert_surat);
                  $data1 = array(
					  'nama_pendaftar' => $get_id->id_anggota,
				  );
				  $this->Surat_selesai_kp_model->update($insert_surat, $data1);
				  $data = array(
					  'id_anggota' => $get_id->id_anggota,
					  'email' => htmlspecialchars($this->input->post('email', TRUE)),
					  'keperluan' => htmlspecialchars($this->input->post('keperluan', TRUE)),
					  'status' => htmlspecialchars(2),
					  'rincian_keperluan' => htmlspecialchars($this->input->post('rincian', TRUE)),
					  'gambar' => $foto['file_name'],
					  'tanggal' => $tanggal_awal,
					  'tanggal_akhir' => $tanggal_akhir,
					  'no_hp' => htmlspecialchars($this->input->post('no_hp', TRUE)),
				  );
				  $this->Permohonan_model->insert($data);
				  echo json_encode(array("status" => TRUE));
              }
        } else {
			$data1 = array(
				'id_surat' => 0,
				'npm' => $npm[0],
				'nama_anggota' => $nama[0],
				'jurusan' => htmlspecialchars($this->input->post('jurusan', TRUE)),
				'kampus' => htmlspecialchars($this->input->post('kampus', TRUE))
			);
			$insert_anggota = $this->Surat_selesai_kp_model->insert_anggota($data1);
			$tanggal_awal = date("Y-m-d");
			$tanggal_akhir = date("Y-m-d");
			$data = array(
				'id_anggota' => $insert_anggota,
				'email' => htmlspecialchars($this->input->post('email', TRUE)),
				'keperluan' => htmlspecialchars($this->input->post('keperluan', TRUE)),
				'status' => 1,
				'rincian_keperluan' => htmlspecialchars($this->input->post('rincian', TRUE)),
				'gambar' => $foto['file_name'],
				'tanggal' => $tanggal_awal,
				'tanggal_akhir' => $tanggal_akhir,
				'no_hp' => htmlspecialchars($this->input->post('no_hp', TRUE)),
			);
			$this->Permohonan_model->insert($data);
			echo json_encode(array("status" => TRUE));
        }
    }

    function upload_foto()
    {
        $config['upload_path'] = './assets/dokumen';
        $config['allowed_types'] = 'jpg|png|jpeg|pdf';
        $this->load->library('upload', $config);
        $this->upload->do_upload('dokumen');
        return $this->upload->data();
    }
}
