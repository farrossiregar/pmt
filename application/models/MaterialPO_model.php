<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Model Impor
 * @by		: doni(doni.enginer@gmail.com)
 * @date	: Oktober 2012
 **/
 
 class MaterialPO_model extends CI_Model
 {
	var $t_table 	= 'materi_po';

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
		$this->db->select($this->t_table.".*, material.name as mname,  material.description as mdescription");
		$this->db->from($this->t_table);
		if(! empty($search))
		{
			foreach ($search as $key => $value) {
				$this->db->where($key, $value);
			}
		}

		$this->db->join('sales_and_distribution', 'sales_and_distribution.id = materi_po.sales_distribution_id', 'left');
		$this->db->join('material', 'material.id = sales_and_distribution.material_id', 'left');
		$i = $this->db->get();
		
		return $i->result_array();
	}

	public function get_where_one($search = [])
	{
		$this->db->select($this->t_table.".*, material.name as mname,  material.description as mdescription");
		$this->db->from($this->t_table);
		if(! empty($search))
		{
			foreach ($search as $key => $value) {
				$this->db->where($key, $value);
			}
		}

		$this->db->join('sales_and_distribution', 'sales_and_distribution.id = materi_po.sales_distribution_id', 'left');
		$this->db->join('material', 'material.id = sales_and_distribution.material_id', 'left');
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