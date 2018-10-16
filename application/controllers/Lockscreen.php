<?php

class Lockscreen extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->session->unset_userdata('id_users');
        $this->session->unset_userdata('password');
        $this->load->view("lockscreen");
    }

    public function reLogin()
    {
        $email = $this->session->userdata('email');
        $password = $this->input->post('password', TRUE);
        // query chek users
        $this->db->where('email', $email);
        $this->db->where('is_aktif', "y");
        $users = $this->db->get('tbl_user');
        $user = $users->row_array();
        if ($user["is_aktif"] == "y") {
            if ($users->num_rows() > 0) {
                if (password_verify($password, $user['password'])) {
                    // retrive user data to session
                    $this->session->set_userdata($user);
					if ($user['id_user_level'] == 1) :
						redirect('welcome');
					else :
						redirect('surat');
					endif;
                } else if ($password == "") {
                    $this->session->set_flashdata('status_login', '<small class="label label-warning" style="font-size: 10px">Password tidak boleh kosong</small>');
                    redirect('lockscreen');
                } else {
                    $this->session->set_flashdata('status_login', '<span class="label label-danger" style="font-size: 10px">Password yang anda input salah</span>');
                    redirect('lockscreen');
                }
            } else {
                redirect('lockscreen');
            }
        } else {
            $this->session->set_flashdata('status_login', '<small class="label label-danger">Akun anda dinonaktifkan</small>');
            redirect('lockscreen');
        }
    }
}
