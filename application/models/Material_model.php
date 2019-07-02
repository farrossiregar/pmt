<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Model Impor
 * @by		: doni(doni.enginer@gmail.com)
 * @date	: Oktober 2012
 **/
 
 class Material_model extends CI_Model
 {
	var $t_table 	= 'material';

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
		$this->db->select($this->t_table.".*, group_of_material.name as name_group, master_unit.name as name_unit");
		$this->db->from($this->t_table);
		$this->db->join('group_of_material', 'group_of_material.id = material.material_group', 'left');
		$this->db->join('master_unit', 'master_unit.id = material.order_unit', 'left');

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
		$this->db->select($this->t_table.".*, group_of_material.name as name_group, master_unit.name as name_unit");
		$this->db->from($this->t_table);
		$this->db->join('group_of_material', 'group_of_material.id = material.material_group', 'left');
		$this->db->join('master_unit', 'master_unit.id = material.order_unit', 'left');
		$this->db->where($this->t_table .'.id', $id);

		$data = $this->db->get()->row_array();

		return $data;
	}
}