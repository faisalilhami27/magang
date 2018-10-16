<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kelolamenu extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Menu_model');
        $this->load->model('User_level_model');
        $this->load->library('form_validation');
        $this->load->helper('racode_helper');
        $this->load->library('datatables');
    }

    public function index()
    {
        $data['name_csrf'] = $this->security->get_csrf_token_name();
        $data['hash_csrf'] = $this->security->get_csrf_hash();
        $data['setting'] = $this->db->get_where('tbl_setting', array('id_setting' => 1))->row_array();
        $this->template->load('template', 'kelolamenu/tbl_menu_list', $data);
    }

    function get_data_menu()
    {
        $list = $this->Menu_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->title;
            $row[] = $field->url;
            $row[] = $field->icon;
            $row[] = $field->is_main_menu;
            $row[] = getString($field->is_aktif);
            $row[] = '<center>
                        <a href="'. site_url('kelolamenu/update/'. $field->id_menu) .'" title="Update Data" class="btn btn-success btn-sm"><i class="fa fa-pencil-square-o"></i></a>
                        <a href="'. site_url('kelolamenu/delete/'. $field->id_menu) .'"  title="Delete Data" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure ?\')"><i class="fa fa-trash-o"></i></a>
                     </center>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Menu_model->count_all(),
            "recordsFiltered" => $this->Menu_model->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    function simpan_setting()
    {
        if (!$this->input->is_ajax_request()) :
            die("Anda tidak menggunakan metode yang benar.");
        endif;

        $value = $this->input->post('tampil_menu');
        $update = $this->Menu_model->setting($value);
        echo json_encode(array("status" => TRUE, "value" => $update));
    }

    public function read($id)
    {
        $row = $this->Menu_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id_menu' => $row->id_menu,
                'title' => $row->title,
                'url' => $row->url,
                'icon' => $row->icon,
                'is_main_menu' => $row->is_main_menu,
                'is_aktif' => $row->is_aktif,
            );
            $this->template->load('template', 'kelolamenu/tbl_menu_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kelolamenu'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('kelolamenu/create_action'),
            'id_menu' => set_value('id_menu'),
            'title' => set_value('title'),
            'url' => set_value('url'),
            'icon' => set_value('icon'),
            'is_main_menu' => set_value('is_main_menu'),
            'is_aktif' => set_value('is_aktif'),
        );
        $this->template->load('template', 'kelolamenu/tbl_menu_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'title' => htmlspecialchars($this->input->post('title', TRUE)),
                'url' => htmlspecialchars($this->input->post('url', TRUE)),
                'icon' => htmlspecialchars($this->input->post('icon', TRUE)),
                'is_main_menu' => $this->input->post('is_main_menu', TRUE),
                'is_aktif' => $this->input->post('is_aktif', TRUE),
            );

            $this->Menu_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('kelolamenu'));
        }
    }

    public function update($id)
    {
        $row = $this->Menu_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('kelolamenu/update_action'),
                'id_menu' => set_value('id_menu', $row->id_menu),
                'title' => set_value('title', $row->title),
                'url' => set_value('url', $row->url),
                'icon' => set_value('icon', $row->icon),
                'is_main_menu' => set_value('is_main_menu', $row->is_main_menu),
                'is_aktif' => set_value('is_aktif', $row->is_aktif),
            );
            $this->template->load('template', 'kelolamenu/tbl_menu_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kelolamenu'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_menu', TRUE));
        } else {
            $data = array(
                'title' => htmlspecialchars($this->input->post('title', TRUE)),
                'url' => htmlspecialchars($this->input->post('url', TRUE)),
                'icon' => htmlspecialchars($this->input->post('icon', TRUE)),
                'is_main_menu' => $this->input->post('is_main_menu', TRUE),
                'is_aktif' => $this->input->post('is_aktif', TRUE),
            );

            $this->Menu_model->update($this->input->post('id_menu', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('kelolamenu'));
        }
    }

    public function delete($id)
    {
        $row = $this->Menu_model->get_by_id($id);

        if ($row) {
            $this->Menu_model->delete($id);
            $this->User_level_model->deleteForMenu($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('kelolamenu'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kelolamenu'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('title', 'title', 'trim|required');
        $this->form_validation->set_rules('url', 'url', 'trim|required');
        $this->form_validation->set_rules('icon', 'icon', 'trim|required');
        $this->form_validation->set_rules('is_main_menu', 'is main menu', 'trim|required');
        $this->form_validation->set_rules('is_aktif', 'is aktif', 'trim|required');

        $this->form_validation->set_rules('id_menu', 'id_menu', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Kelolamenu.php */
/* Location: ./application/controllers/Kelolamenu.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-10-04 10:50:27 */
/* http://harviacode.com */