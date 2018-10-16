<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Keperluan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Keperluan_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        $data['csrf_name'] = $this->security->get_csrf_token_name();
        $data['csrf_hash'] = $this->security->get_csrf_hash();
        $this->template->load('template', 'keperluan/tbl_keperluan_list', $data);
    }

    function get_data_keperluan()
    {
        $list = $this->Keperluan_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->nama_keperluan;
            $row[] = '<center>
                        <a href="'. site_url('keperluan/update/'. $field->id_keperluan) .'" title="Update Data" class="btn btn-success btn-sm"><i class="fa fa-pencil-square-o"></i></a>
                        <a href="'. site_url('keperluan/delete/'. $field->id_keperluan) .'" title="Delete Data" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure ?\')"><i class="fa fa-trash-o"></i></a>
                     </center>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Keperluan_model->count_all(),
            "recordsFiltered" => $this->Keperluan_model->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function read($id)
    {
        $row = $this->Keperluan_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id_keperluan' => $row->id_keperluan,
                'nama_keperluan' => $row->nama_keperluan,
            );
            $this->template->load('template', 'keperluan/tbl_keperluan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('keperluan'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('keperluan/create_action'),
            'id_keperluan' => set_value('id_keperluan'),
            'nama_keperluan' => set_value('nama_keperluan'),
        );
        $this->template->load('template', 'keperluan/tbl_keperluan_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'nama_keperluan' => htmlspecialchars($this->input->post('nama_keperluan', TRUE)),
            );

            $this->Keperluan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('keperluan'));
        }
    }

    public function update($id)
    {
        $row = $this->Keperluan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('keperluan/update_action'),
                'id_keperluan' => set_value('id_keperluan', $row->id_keperluan),
                'nama_keperluan' => set_value('nama_keperluan', $row->nama_keperluan),
            );
            $this->template->load('template', 'keperluan/tbl_keperluan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('keperluan'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_keperluan', TRUE));
        } else {
            $data = array(
                'nama_keperluan' => htmlspecialchars($this->input->post('nama_keperluan', TRUE)),
            );

            $this->Keperluan_model->update($this->input->post('id_keperluan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('keperluan'));
        }
    }

    public function delete($id)
    {
        $row = $this->Keperluan_model->get_by_id($id);

        if ($row) {
            $this->Keperluan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('keperluan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('keperluan'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nama_keperluan', 'nama keperluan', 'trim|required');

        $this->form_validation->set_rules('id_keperluan', 'id_keperluan', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Keperluan.php */
/* Location: ./application/controllers/Keperluan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-08-06 02:39:38 */
/* http://harviacode.com */
