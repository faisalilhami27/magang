<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Anggota extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Anggota_kp_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['csrf_name'] = $this->security->get_csrf_token_name();
        $data['csrf_hash'] = $this->security->get_csrf_hash();
        $this->template->load('template', 'anggota/tbl_anggota_kp_list', $data);
    }

    function get_data_anggota($id)
    {
        $list = $this->Anggota_kp_model->get_datatables($id);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = '<center>' . $no . '</center>';
            $row[] = '<center>' . $field->npm . '</center>';
            $row[] = '<center>' . $field->nama_anggota . '</center>';
            $row[] = '<center>' . $field->jurusan . '</center>';
            $row[] = '<center>' . $field->kampus . '</center>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Anggota_kp_model->count_all(),
            "recordsFiltered" => $this->Anggota_kp_model->count_filtered($id),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    function get_data_anggota1()
    {
        $list = $this->Anggota_kp_model->get_datatables1();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = '<center>' . $no . '</center>';
            $row[] = '<center>' . $field->npm . '</center>';
            $row[] = '<center>' . $field->nama_anggota . '</center>';
            $row[] = '<center>' . $field->jurusan . '</center>';
            $row[] = '<center>' . $field->kampus . '</center>';
            $row[] = '<center>
                        <a href="' . site_url('anggota/update/' . $field->id_anggota . '/' . $field->id_surat) . '" title="Update Data" class="btn btn-success btn-sm"><i class="fa fa-pencil-square-o"></i></a>
                     </center>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Anggota_kp_model->count_all1(),
            "recordsFiltered" => $this->Anggota_kp_model->count_filtered1(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function update($id)
    {
        $row = $this->Anggota_kp_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('anggota/update_action'),
                'id_anggota' => set_value('id_anggota', $row->id_anggota),
                'id_surat' => set_value('id_surat', $row->id_surat),
                'npm' => set_value('npm', $row->npm),
                'nama_anggota' => set_value('nama_anggota', $row->nama_anggota),
                'jurusan' => set_value('jurusan', $row->jurusan),
                'kampus' => set_value('kampus', $row->kampus),
            );
            $this->template->load('template', 'anggota/tbl_anggota_kp_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('anggota'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_anggota', TRUE));
        } else {
            $data = array(
                'npm' => $this->input->post('npm', TRUE),
                'nama_anggota' => $this->input->post('nama_anggota', TRUE),
            );

            $this->Anggota_kp_model->update($this->input->post('id_anggota', TRUE), $data);

			$data1 = array(
				'jurusan' => $this->input->post('jurusan', TRUE),
				'kampus' => $this->input->post('kampus', TRUE),
			);

			$this->Anggota_kp_model->update1($this->input->post('id_surat', TRUE), $data1);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('anggota'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('npm', 'npm', 'trim|required');
        $this->form_validation->set_rules('nama_anggota', 'nama anggota', 'trim|required');
        $this->form_validation->set_rules('jurusan', 'jurusan', 'trim|required');
        $this->form_validation->set_rules('kampus', 'kampus', 'trim|required');

        $this->form_validation->set_rules('id_anggota', 'id_anggota', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Anggota.php */
/* Location: ./application/controllers/Anggota.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-09-26 13:36:41 */
/* http://harviacode.com */
