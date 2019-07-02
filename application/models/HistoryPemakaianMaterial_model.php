<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Model Impor
 * @by		: doni(doni.enginer@gmail.com)
 * @date	: Oktober 2012
 **/
 
 class HistoryPemakaianMaterial_model extends CI_Model
 {
	var $t_table 	= 'history_pemakaian_material';

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
	public function data_($id=0, $page=0, $limit=0, $search=0)
	{
		$this->db->select($this->t_table.".*, material.name as mname, branch.name as bname, branch.name as bname, user.name as uname");
		$this->db->from($this->t_table);
		$this->db->join('material', 'material.id = history_pemakaian_material.material_id', 'left');
		$this->db->join('branch', 'branch.id = history_pemakaian_material.branch_id', 'left');
		$this->db->join('user', 'user.id = history_pemakaian_material.created_by', 'left');

		$i = $this->db->get();
		
		return $i->result_array();
	}

	public function get_where_many($search = [])
	{
		$this->db->from($this->t_table);
		if(! empty($search))
		{
			foreach ($search as $key => $value) {
				$this->db->where($key, $value);
			}
		}
		
		$i = $this->db->get();
		
		return $i->result_array();
	}

	public function get_where_one($search = [])
	{
		$this->db->from($this->t_table);
		if(! empty($search))
		{
			foreach ($search as $key => $value) {
				$this->db->where($key, $value);
			}
		}
		
		$i = $this->db->get();
		
		return $i->row_array();
	}

	/**
	 * [get_by_id description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function get_by_id($id)
	{
		return $this->db->get_where($this->t_table, ['id' => $id])->row_array();
	}
}