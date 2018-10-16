<?php

Class Auth extends CI_Controller
{


    function index()
    {
        $this->load->view('auth/login');
    }

    function forgot_password()
    {
        $this->load->view("auth/forgot_password");
    }

    function forgot()
    {
        $email = $this->input->post('email');
        $pass = $this->input->post('pass', TRUE);
        $hassPass = password_hash($pass, PASSWORD_DEFAULT);

        $data = array(
            'password' => $hassPass
        );
        $this->load->model("User_model");
        $this->User_model->forgot_password($email, $data);
        echo json_encode(array("status" => TRUE));
    }

    function changePassword()
    {
        $email = $this->session->userdata('email');
        $pass = $this->input->post('pass', TRUE);
        $hassPass = password_hash($pass, PASSWORD_DEFAULT);

        $data = array(
            'password' => $hassPass
        );
        $this->load->model("User_model");
        $this->User_model->forgot_password($email, $data);
        echo json_encode(array("status" => TRUE));
    }

    function cheklogin()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password', TRUE);
        // query chek users
        $this->db->where('email', $email);
        $this->db->where('is_aktif', "y");
        $users = $this->db->get('tbl_user');
        $user = $users->row_array();
        if ($user['is_aktif'] == "y") :
            if ($users->num_rows() > 0) :
                if (password_verify($password, $user['password'])) :
					$this->session->set_userdata($user);
                    if ($user['id_user_level'] == 1) :
						redirect('welcome');
					else :
						redirect('surat');
                    endif;
                else :
                    $this->session->set_flashdata('status_login', '<span class="label label-danger" style="font-size: 10px">Password yang anda input salah</span>');
                    redirect('auth');
                endif;
            else :
                redirect('auth');
            endif;
        elseif ($email == "" || $password == "") :
            $this->session->set_flashdata('status_login', '<small class="label label-warning" style="font-size: 10px">Email dan Password tidak boleh kosong</small>');
            redirect('auth');
        else :
            $this->session->set_flashdata('status_login', '<small class="label label-danger">Akun anda dinonaktifkan</small>');
            redirect('auth');
        endif;
    }

    function logout()
    {
        $this->session->sess_destroy();
        $this->session->set_flashdata('status_login', 'Anda sudah berhasil keluar dari aplikasi');
        redirect('auth');
    }
}
