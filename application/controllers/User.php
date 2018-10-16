<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('User_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        $data['csrf_name'] = $this->security->get_csrf_token_name();
        $data['csrf_hash'] = $this->security->get_csrf_hash();
        $this->template->load('template', 'user/tbl_user_list', $data);
    }

    function get_data_user()
    {
        $list = $this->User_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->full_name;
            $row[] = $field->email;
            $row[] = $field->nama_level;
            $row[] = getString($field->is_aktif);
            $row[] = '<center>
                        <a href="' . site_url('user/update/' . $field->id_users) . '" title="Update Data" class="btn btn-success btn-sm"><i class="fa fa-pencil-square-o"></i></a>
                        <a href="' . site_url('user/delete/' . $field->id_users) . '" title="Delete Data" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure ?\')"><i class="fa fa-trash-o"></i></a>
                     </center>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->User_model->count_all(),
            "recordsFiltered" => $this->User_model->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function read($id)
    {
        $row = $this->User_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id_users' => $row->id_users,
                'full_name' => $row->full_name,
                'email' => $row->email,
                'password' => $row->password,
                'images' => $row->images,
                'id_user_level' => $row->id_user_level,
                'is_aktif' => $row->is_aktif,
            );
            $this->template->load('template', 'user/tbl_user_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('user/create_action'),
            'id_users' => set_value('id_users'),
            'full_name' => set_value('full_name'),
            'email' => set_value('email'),
            'password' => set_value('password'),
            'images' => set_value('images'),
            'id_user_level' => set_value('id_user_level'),
            'is_aktif' => set_value('is_aktif'),
        );
        $this->template->load('template', 'user/tbl_user_form', $data);
    }


    public function create_action()
    {
        $this->_rules();
        $foto = $this->upload_foto();
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $password = $this->input->post('password', TRUE);
            $options = array("cost" => 4);
            $hashPassword = password_hash($password, PASSWORD_BCRYPT, $options);

            $data = array(
                'full_name' => htmlspecialchars($this->input->post('full_name', TRUE)),
                'email' => htmlspecialchars($this->input->post('email', TRUE)),
                'images' => $foto['file_name'],
                'id_user_level' => htmlspecialchars($this->input->post('id_user_level', TRUE)),
                'is_aktif' => htmlspecialchars($this->input->post('is_aktif', TRUE)),
                'password' => $hashPassword
            );

            $this->User_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('user'));
        }
    }

    public function update($id)
    {
        $row = $this->User_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('user/update_action'),
                'id_users' => set_value('id_users', $row->id_users),
                'full_name' => set_value('full_name', $row->full_name),
                'email' => set_value('email', $row->email),
                'password' => set_value('password', $row->password),
                'images' => set_value('images', $row->images),
                'id_user_level' => set_value('id_user_level', $row->id_user_level),
                'is_aktif' => set_value('is_aktif', $row->is_aktif),
            );
            $this->template->load('template', 'user/tbl_user_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user'));
        }
    }

    public function update_action()
    {
        $this->_rules();
        $foto = $this->upload_foto();
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_users', TRUE));
        } else {
            if ($foto['file_name'] == '') {
                $data = array(
                    'full_name' => htmlspecialchars($this->input->post('full_name', TRUE)),
                    'email' => htmlspecialchars($this->input->post('email', TRUE)),
                    'id_user_level' => htmlspecialchars($this->input->post('id_user_level', TRUE)),
                    'is_aktif' => htmlspecialchars($this->input->post('is_aktif', TRUE))
                );
            } else {
                $data = array(
                    'full_name' => htmlspecialchars($this->input->post('full_name', TRUE)),
                    'email' => htmlspecialchars($this->input->post('email', TRUE)),
                    'images' => $foto['file_name'],
                    'id_user_level' => htmlspecialchars($this->input->post('id_user_level', TRUE)),
                    'is_aktif' => htmlspecialchars($this->input->post('is_aktif', TRUE))
                );

                // ubah foto profil yang aktif
                $this->session->set_userdata('images', $foto['file_name']);
            }
            $this->User_model->update($this->input->post('id_users', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('user'));
        }
    }

    function upload_foto()
    {
        $config['upload_path'] = './assets/foto_profil';
        $config['allowed_types'] = 'gif|jpg|png';
        $this->load->library('upload', $config);
        $this->upload->do_upload('images');
        return $this->upload->data();
    }

    public function delete($id)
    {
        $row = $this->User_model->get_by_id($id);
        if ($row) {
            $path = "assets/foto_profil/" . $row->images;
            unlink($path);
            $this->User_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('user'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('full_name', 'full name', 'trim|required');
        $this->form_validation->set_rules('email', 'email', 'trim|required');
        //$this->form_validation->set_rules('password', 'password', 'trim|required');
        //$this->form_validation->set_rules('images', 'images', 'trim|required');
        $this->form_validation->set_rules('id_user_level', 'id user level', 'trim|required');
        $this->form_validation->set_rules('is_aktif', 'is aktif', 'trim|required');

        $this->form_validation->set_rules('id_users', 'id_users', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file User.php */
/* Location: ./application/controllers/User.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-10-04 06:32:22 */
/* http://harviacode.com */
