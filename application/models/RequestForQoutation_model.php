<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Model Impor
 * @by		: doni(doni.enginer@gmail.com)
 * @date	: Oktober 2012
 **/
 
 class RequestForQoutation_model extends CI_Model
 {
	var $t_table 	= 'request_for_qoutation';

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
		$this->db->from($this->t_table.' rfq');
		$this->db->select('rfq.*, c.name as company_name');
		$this->db->join('purchase_request pr', 'pr.id=rfq.purchase_request_id', 'left');
		$this->db->join('company c', 'c.id=pr.company_id', 'left');
		$this->db->order_by('id', 'DESC');

		$i = $this->db->get();

		return $i->result_array();
	}

	/**
	 * Data RFQ Vendor
	 * @return [type] [description]
	 */
	public function data_rfq_vendor($vendor_id)
	{
		$this->db->select($this->t_table .'.*');
		$this->db->from($this->t_table);
		$this->db->join('request_for_qoutation_vendor rv', $this->t_table .'.id=rv.request_for_qoutation_id');
		$this->db->where('rv.vendor_id', $vendor_id);
		$this->db->order_by('id', 'DESC');

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

	/**
	 * Get Vendor
	 * @return array
	 */
	public function vendor($id)
	{
		$this->db->from('request_for_qoutation_vendor r');
		$this->db->select('r.*, v.name as vendor, v.phone_1 as phone, v.email');
		$this->db->join('vendor_of_material v','v.id=r.vendor_id');
		$this->db->where('r.request_for_qoutation_id', $id);

		$data = $this->db->get()->result_array();

		return $data;
	}

	/**
	 * Get Term
	 * @return array
	 */
	public function term($id)
	{
		$this->db->from('request_for_qoutation_term_condition r');
		$this->db->select('r.*');
		$this->db->where('r.request_for_qoutation_id', $id);

		$data = $this->db->get()->result_array();

		return $data;
	}

	/**
	 * Get Term
	 * @return array
	 */
	public function material($id)
	{
		$this->db->from('request_for_qoutation_material r');
		$this->db->select('r.*, v.name as material');
		$this->db->join('material v','v.id=r.material_id');
		$this->db->where('r.request_for_qoutation', $id);

		$data = $this->db->get()->result_array();

		return $data;
	}
}