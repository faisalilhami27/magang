<?php
/**
 * Created by PhpStorm.
 * User: Muhamad Faisal I A
 * Date: 04/10/2018
 * Time: 1:36
 */

class Profile extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('id_users')) {
			redirect('auth');
		}
		$this->load->model('User_model');
		$this->load->library('form_validation');
	}

	function profile($id)
	{
		$row = $this->User_model->get_by_id($id);
		if ($row) :
			$data = array(
				'action' => site_url('profile/update_action1'),
				'id_users' => set_value('id_users', $row->id_users),
				'full_name' => set_value('full_name', $row->full_name),
				'email' => set_value('email', $row->email),
				'password' => set_value('password', $row->password),
				'images' => set_value('images', $row->images),
				'level' => set_value('id_user_level', $row->nama_level),
				'is_aktif' => set_value('is_aktif', $row->is_aktif),
			);
		endif;
		$this->template->load("template", "profile", $data);
	}

	function upload_foto()
	{
		$config['upload_path'] = './assets/foto_profil';
		$config['allowed_types'] = 'gif|jpg|png';
		$this->load->library('upload', $config);
		$this->upload->do_upload('images');
		return $this->upload->data();
	}

	public function update_action1()
	{
		$id = $this->input->post('id_users', TRUE);
		$row = $this->User_model->get_by_id($id);
		$this->_rules();
		$foto = $this->upload_foto();
		if ($this->form_validation->run() == FALSE) {
			$this->update($id);
		} else {
			if ($foto['file_name'] == '') {
				$data = array(
					'full_name' => $this->input->post('full_name', TRUE),
					'email' => $this->input->post('email', TRUE),
					'id_user_level' => $this->input->post('id_user_level', TRUE),
					'is_aktif' => $this->input->post('is_aktif', TRUE));
			} else {
				$path = "assets/foto_profil/" . $row->images;
				unlink($path);
				$data = array(
					'full_name' => $this->input->post('full_name', TRUE),
					'email' => $this->input->post('email', TRUE),
					'images' => $foto['file_name'],
					'id_user_level' => $this->input->post('id_user_level', TRUE),
					'is_aktif' => $this->input->post('is_aktif', TRUE));

				// ubah foto profil yang aktif
				$this->session->set_userdata('images', $foto['file_name']);
			}

			$this->User_model->update($this->input->post('id_users', TRUE), $data);
			redirect(site_url('profile/profile/' . $this->session->userdata("id_users")));
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
