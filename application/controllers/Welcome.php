<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model("Permohonan_model");
    }

    public function index() {
        $data["menunggu"] = $this->Permohonan_model->getMenunggu();
        $data["terima"] = $this->Permohonan_model->getTerima();
        $data["tolak"] = $this->Permohonan_model->getTolak();
        $data["total"] = $this->Permohonan_model->getMahasiswa();
        $this->template->load('template', 'welcome', $data);
    }

    public function form() {
        //$this->load->view('table');
        $this->template->load('template', 'form');
    }
    
    function autocomplate(){
        autocomplate_json('tbl_user', 'full_name');
    }

    function __autocomplate() {
        $this->db->like('nama_lengkap', $_GET['term']);
        $this->db->select('nama_lengkap');
        $products = $this->db->get('pegawai')->result();
        foreach ($products as $product) {
            $return_arr[] = $product->nama_lengkap;
        }

        echo json_encode($return_arr);
    }

}
