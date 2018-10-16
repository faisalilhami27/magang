<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Panduan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_login();
    }

    public function index()
    {
        $data['title'] = "User Guide";
        $this->template->load('template', 'panduan', $data);
    }
}
