<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Model Impor
 * @by		: doni(doni.enginer@gmail.com)
 * @date	: Oktober 2012
 **/
 
 class Vehicle_model extends CI_Model
 {
	var $t_table 	= 'vehicle';

	/**
	 * Constructor
	 * @param	-
	 * @return 	-
	 **/
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * Data Investasi
	 * @param	id, page, limit, search
	 * @return 	array
	 **/
	public function data_()
	{
		$this->db->from($this->t_table);

		if(isset($_GET['brand']) and !empty($_GET['brand']))
		{
			$this->db->where('brand', $_GET['brand']);
		}
		if(isset($_GET['merk']) and !empty($_GET['merk']))
		{
			$this->db->where('merk', $_GET['merk']);
		}
		if(isset($_GET['type']) and !empty($_GET['type']))
		{
			$this->db->where('type', $_GET['type']);
		}
		if(isset($_GET['tahun']) and !empty($_GET['tahun']))
		{
			$this->db->where('tahun', $_GET['tahun']);
		}

		$i = $this->db->get();
		
		return $i->result_array();
	}

	/**
	 * Total
	 * @param 	search 
	 * @return 	count table
	 **/
	public function total($search = 0)
    {
    	if(!empty($search)):
			$this->db->like('uraian', $search);
		endif;
        $i = $this->db->get($this->t_table);
        return $i->num_rows();
    }

    /**
	 * insert
	 * @param 	data array , table
	 * @return 	
	 **/
    public function insert($table, $data = array())
    {
    	$i = $this->db->insert($table, $data);
    	$no = 0;
    	if($i):
    		echo $no++;
    	endif;
    }

    public function get_by_id($id)
    {
    	$data = $this->db->get_where($this->t_table, ['id' => $id]);

    	return $data->row_array();
    }
}