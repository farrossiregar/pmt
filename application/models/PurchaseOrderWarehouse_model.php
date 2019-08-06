<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Model Impor
 * @by		: doni(doni.enginer@gmail.com)
 * @date	: Oktober 2012
 **/
 
 class PurchaseOrderWarehouse_model extends CI_Model
 {
	var $t_table 	= 'purchase_order_warehouse';

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
		$this->db->select($this->t_table .'.*, c.name as company, v.name as vendor');
		$this->db->join('company c', 'c.id='. $this->t_table .'.company_id');
		$this->db->join('vendor_of_material v', 'v.id='. $this->t_table .'.vendor_id');
		$this->db->order_by('id', 'desc');

		$i = $this->db->get();
		
		return $i->result_array();
	}

	/**
	 * Data by Vendor
	 **/
	public function data_vendor($vendor_id)
	{
		$this->db->from($this->t_table);
		$this->db->select($this->t_table .'.*, c.name as company, v.name as vendor');
		$this->db->join('company c', 'c.id='. $this->t_table .'.company_id');
		$this->db->join('vendor_of_material v', 'v.id='. $this->t_table .'.vendor_id');
		$this->db->where($this->t_table.'.vendor_id', $vendor_id);
		$this->db->order_by('id', 'desc');

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

	public function get_where_one($search = [], $type = '')
	{
		$this->db->select($this->t_table.".*, 
							vendor_of_material.name as vname, 
							vendor_of_material.pic_name as vpic_name, 
							vendor_of_material.phone_1 as vphone_1, 
							user.name as uname, 
							c.name as company, 
							c.telepon as company_telepon, 
							c.address as company_address, 
							c.logo as company_logo,
							qo.quotation_number as quotation_number,
							rfq.case_id as rfq_number,
							rfq.document_title,
							rfq.solicatation_type,
							rfq.currency,
							rfq.delivery_date,
							rfq.expired_date,
							rfq.detail_delivery_address,
							pr.no as pr_number
						");
		$this->db->from($this->t_table);
		if(! empty($search))
		{
			foreach ($search as $key => $value) {
				$this->db->where($key, $value);
			}
		}	

		$this->db->join('vendor_of_material', 'vendor_of_material.id = purchase_order_warehouse.vendor_id', 'left');
		$this->db->join('user', 'user.id = purchase_order_warehouse.requester', 'left');
		$this->db->join('company c', 'c.id='. $this->t_table .'.company_id');
		$this->db->join('quotation_order_vendor qo', 'qo.id=purchase_order_warehouse.quotation_vendor_id', 'left');
		$this->db->join('request_for_qoutation rfq', 'rfq.id=purchase_order_warehouse.rfq_id', 'left');
		$this->db->join('purchase_request pr', 'pr.id='. $this->t_table .'.pr_id', 'left');
		$i = $this->db->get();

		if($type == 'object') 
			return $i->row_object();
		else 
			return $i->row_array();
	}

	function add_data($post_data) 
	{
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
		return $this->get_where_one([$this->t_table .'.id' => $id]);
	}

	/**
	 * Get Material
	 * @return void
	 */
	public function material($id)
	{
		$this->db->from('purchase_order_material p');
		$this->db->select('p.*, m.name as material');
		$this->db->join('material m', 'm.id=p.material_id');
		$this->db->where('p.po_id', $id);

		$data = $this->db->get();

		return $data->result_object();
	}

	/**
     * Get Term
     * @return objects
     */
    public function term($id)
    {
    	$this->db->from('term_condition_po t');
    	$this->db->select('t.*');
    	$this->db->where('t.po_id', $id);

    	return $this->db->get()->result_object();
    }
}