<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Model Impor
 * @by		: doni(doni.enginer@gmail.com)
 * @date	: Oktober 2012
 **/
 
 class MaterialPurchaseRequest_model extends CI_Model
 {
	var $t_table 	= 'material_purchase_request';

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
		$this->db->from($this->t_table);

		$i = $this->db->get();
		
		return $i->result_array();
	}

	public function get_where_many($search = [])
	{
		$this->db->select($this->t_table.".*, material.name as name_material, material.description, b.name as group_material");
		$this->db->from($this->t_table);
		$this->db->join('material', 'material.id = material_purchase_request.material_id', 'left');
		$this->db->join('group_of_material b', 'material_purchase_request.material_group_id=b.id','left');
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

	function add_data($post_data) {
    	$this->db->insert($this->t_table ,$post_data);
    	return $this->db->insert_id();
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