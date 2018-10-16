<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Anggota_kp_model extends CI_Model
{

    private $table = 'tbl_mahasiswa';
    private $id = 'id_anggota';
    private $column_order = array(null, 'id_anggota', 'id_surat', 'npm', 'nama_anggota', 'jurusan', 'kampus'); //field yang ada di table user
    private $column_search = array('id_anggota', 'id_surat', 'tbl_mahasiswa.id_surat', 'npm', 'nama_anggota', 'jurusan', 'kampus'); //field yang diizin untuk pencarian
    private $order = array('id_anggota' => 'desc'); // default order

    function __construct()
    {
        parent::__construct();
    }
    private function _get_datatables_query($where)
    {

        $this->db->from($this->table);
        $this->db->join("tbl_surat_selesai_kp", "tbl_mahasiswa.id_surat = tbl_surat_selesai_kp.id_surat");
        $this->db->where("tbl_surat_selesai_kp.id_surat", $where);
        $i = 0;

        foreach ($this->column_search as $item) // looping awal
        {
            if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {

                if ($i === 0) // looping awal
                {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables($where)
    {
        $this->_get_datatables_query($where);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered($where)
    {
        $this->_get_datatables_query($where);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

	function get_anggota($where)
	{
		$this->db->where("id_surat", $where);
		return $this->db->get($this->table)->result();
	}

	function get_anggota2($where)
	{
		$this->db->where("id_surat", $where);
		return $this->db->get($this->table)->row();
	}

    private function _get_datatables_query1()
    {

        $this->db->from($this->table);
        $i = 0;

        foreach ($this->column_search as $item) // looping awal
        {
            if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {

                if ($i === 0) // looping awal
                {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables1()
    {
        $this->_get_datatables_query1();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered1()
    {
        $this->_get_datatables_query1();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all1()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get all
    function get_all($id)
    {
        $this->db->where("id_surat", $id);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

	// get data by id
	function get_first_name($id)
	{
		$this->db->select("id_anggota");
		$this->db->where("id_surat", $id);
		$this->db->order_by("id_anggota", "ASC");
		$this->db->limit(1);
		return $this->db->get($this->table)->row();
	}

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

	// update data
	function update1($id, $data)
	{
		$this->db->where("id_surat", $id);
		$this->db->update($this->table, $data);
	}

	function delete($id)
	{
		$this->db->where("id_anggota", $id);
		$this->db->delete($this->table);
	}

	function delete_anggota($id)
	{
		$this->db->where("id_surat", $id);
		$this->db->delete($this->table);
	}
}

/* End of file Anggota_kp_model.php/* Location: ./application/models/Anggota_kp_model */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-09-26 13:36:41 */
/* http://harviacode.com */
