<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
 class QuotationOrderVendor_model extends CI_Model
 {
	var $t_table 	= 'quotation_order_vendor';

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

	/**
	 * get by id
	 */
    public function get_by_id($id)
    {	
    	$this->db->from($this->t_table .' qo');
    	$this->db->select(
           'qo.*, 
            rfq.id as rfq_id,
    		rfq.case_id as rfq_number, 
    		rfq.solicatation_type, 
    		rfq.document_title, 
    		rfq.currency, 
    		rfq.delivery_date, 
    		rfq.expired_date,
			rfq.detail_delivery_address,
			rfq.term_day,
			v.name as vendor_name,
			v.pic_name as vendor_pic_name,
			v.phone_1 as vendor_phone,
			v.email as  vendor_email,
            c.name as company_name,
            c.code as company_code,
            c.id as company_id,
            v.id as  vendor_id
    		');
    	$this->db->join('request_for_qoutation rfq', 'rfq.id=qo.rfq_id');
        $this->db->join('purchase_request pr', 'pr.id=rfq.purchase_request_id');
        $this->db->join('vendor_of_material v', 'v.id=qo.vendor_id');
    	$this->db->join('company c', 'c.id=pr.company_id', 'left');
    	$this->db->where('qo.id', $id);

    	return $this->db->get()->row_object();
    }

    /**
     * Get Material
     * @return objects
     */
    public function material($id)
    {
    	$this->db->from('quotation_order_vendor_material q');
    	$this->db->select('q.*, m.name as material');
    	$this->db->join('material m', 'm.id=q.material_id', 'left');
    	$this->db->where('q.quotation_order_vendor_id', $id);

    	return $this->db->get()->result_object();
    }

    /**
     * Get Term
     * @return objects
     */
    public function term($id)
    {
    	$this->db->from('quotation_order_vendor_term_cond t');
    	$this->db->select('t.*');
    	$this->db->where('t.quotation_order_vendor_id', $id);

    	return $this->db->get()->result_object();
    }
}