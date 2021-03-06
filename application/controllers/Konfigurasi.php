<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Konfigurasi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Konfigurasi_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $row = $this->Konfigurasi_model->get_all();
        $data = array(
            'id' => $row[0]->id,
            'nama_kadis' => $row[0]->nama_kadis,
            'nip_kadis' => $row[0]->nip_kadis,
            'pangkat_kadis' => $row[0]->pangkat_kadis,
            'nama_instansi' => $row[0]->nama_instansi,
            'alamat_instansi' => $row[0]->alamat_instansi,
            'logo' => $row[0]->logo_instansi,
            'button' => 'Update',
        );
        $this->template->load('template', 'konfigurasi/tbl_konfigurasi_list', $data);
    }

    public function update_action()
    {
        $id = $this->input->post('id', TRUE);
        $row = $this->Konfigurasi_model->get_by_id($id);
        $this->_rules();
        $foto = $this->upload_foto();
        if ($foto['file_name'] == '') {
            $data = array(
                'nama_kadis' => htmlspecialchars($this->input->post('nama_kadis', TRUE)),
                'nip_kadis' => htmlspecialchars($this->input->post('nip_kadis', TRUE)),
                'pangkat_kadis' => htmlspecialchars($this->input->post('pangkat_kadis', TRUE)),
                'nama_instansi' => htmlspecialchars($this->input->post('nama_instansi', TRUE)),
                'alamat_instansi' => htmlspecialchars($this->input->post('alamat_instansi', TRUE)),
            );
        } else {
            $path = "assets/foto_profil/" . $row->logo_instansi;
            unlink($path);
            $data = array(
                'nama_kadis' => htmlspecialchars($this->input->post('nama_kadis', TRUE)),
                'nip_kadis' => htmlspecialchars($this->input->post('nip_kadis', TRUE)),
                'pangkat_kadis' => htmlspecialchars($this->input->post('pangkat_kadis', TRUE)),
                'nama_instansi' => htmlspecialchars($this->input->post('nama_instansi', TRUE)),
                'alamat_instansi' => htmlspecialchars($this->input->post('alamat_instansi', TRUE)),
                'logo_instansi' => $foto['file_name']
            );
        }

        $this->Konfigurasi_model->update($id, $data);
        redirect(site_url('konfigurasi'));
    }

    function upload_foto()
    {
        $config['upload_path'] = './assets/foto_profil';
        $config['allowed_types'] = 'gif|jpg|png';
        $this->load->library('upload', $config);
        $this->upload->do_upload('logo');
        return $this->upload->data();
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nama_kadis', 'nama kadis', 'trim|required');
        $this->form_validation->set_rules('nip_kadis', 'nip kadis', 'trim|required');
        $this->form_validation->set_rules('pangkat_kadis', 'pangkat kadis', 'trim|required');
        $this->form_validation->set_rules('nama_instansi', 'nama instansi', 'trim|required');
        $this->form_validation->set_rules('alamat_instansi', 'alamat instansi', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Konfigurasi.php */
/* Location: ./application/controllers/Konfigurasi.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-09-21 16:44:04 */
/* http://harviacode.com */
