<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Konfigurasi_model extends CI_Model
{

    private $table = 'tbl_konfigurasi';
    private $id = 'id';
    private $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }
}

/* End of file Konfigurasi_model.php/* Location: ./application/models/Konfigurasi_model */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-09-21 16:44:04 */
/* http://harviacode.com */
