<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Model Impor
 * @by		: doni(doni.enginer@gmail.com)
 * @date	: Oktober 2012
 **/
 
 class SalesAndDistribution_model extends CI_Model
 {
	var $t_table 	= 'sales_and_distribution';

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
		$this->db->select($this->t_table.".*, material.name as name_material, vendor_of_material.name as name_vendor");
		$this->db->from($this->t_table);
		$this->db->join('material', 'material.id = sales_and_distribution.material_id', 'left');
		$this->db->join('vendor_of_material', 'vendor_of_material.id = sales_and_distribution.vendor_id', 'left');

		$i = $this->db->get();
		
		return $i->result_array();
	}

	public function get_where_many($search = [])
	{
		$this->db->select($this->t_table.".*, material.name as name_material, material.description");
		$this->db->from($this->t_table);
		if(! empty($search))
		{
			foreach ($search as $key => $value) {
				$this->db->where($key, $value);
			}
		}

		$this->db->join('material', 'material.id = sales_and_distribution.material_id', 'left');
		
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

	/**
	 * Data Investasi
	 * @param	id, page, limit, search
	 * @return 	array
	 **/
	public function data_all($id=0, $page=0, $limit=0, $search=0)
	{
		$this->db->select($this->t_table.".*, material.name as name_material, vendor_of_material.name as name_vendor, g.name as group");
		$this->db->from($this->t_table);
		$this->db->join('material', 'material.id = sales_and_distribution.material_id', 'left');
		$this->db->join('vendor_of_material', 'vendor_of_material.id = sales_and_distribution.vendor_id', 'left');
		$this->db->join('group_of_material g', 'g.id=material.material_group', 'left');

		if(isset($_GET['material']) and !empty($_GET['material']))
		{	
			$this->db->like('material.name', $_GET['material'], 'both');
		}

		if(isset($_GET['vendor_id']) and !empty($_GET['vendor_id']))
		{	
			$this->db->where('sales_and_distribution.vendor_id', $_GET['vendor_id']);
		}

		if(isset($_GET['group_id']) and !empty($_GET['group_id']))
		{	
			$this->db->where('material.material_group', $_GET['group_id']);
		}	

		$i = $this->db->get();
		
		return $i->result_array();
	}
}