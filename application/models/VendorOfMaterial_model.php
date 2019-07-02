<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Model Impor
 * @by		: doni(doni.enginer@gmail.com)
 * @date	: Oktober 2012
 **/
 
 class VendorOfMaterial_model extends CI_Model
 {
	var $t_table 	= 'vendor_of_material';

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
		$this->db->select($this->t_table.".*, group_of_vendor.name as name_group");
		$this->db->from($this->t_table);
		$this->db->join('group_of_vendor', 'group_of_vendor.id = vendor_of_material.group_vendor', 'left');		
		$this->db->order_by('id', 'DESC');
		
		$i = $this->db->get();
		
		return $i->result_array();
	}

	
	public function get_where_one($search = [])
	{
		return $this->db->get_where($this->t_table, $search)->row_array();
	}

	public function get_where_many($search = [])
	{
		return $this->db->get_where($this->t_table, $search)->result_array();
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