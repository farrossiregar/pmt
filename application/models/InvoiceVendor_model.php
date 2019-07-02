<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Model Impor
 * @by		: doni(doni.enginer@gmail.com)
 * @date	: Oktober 2012
 **/
 
 class InvoiceVendor_model extends CI_Model
 {
	var $t_table 	= 'invoice_vendor';

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
		$this->db->select('invoice_vendor.*, po.po_number');
		$this->db->join('purchase_order_warehouse po','po.id=invoice_vendor.po_id','left');
		$this->db->order_by('id', 'DESC');
		$i = $this->db->get();
		
		return $i->result_array();
	}

	/**
	 * Data
	 **/
	public function data_vendor($vendor_id=0)
	{
		$this->db->from($this->t_table);
		$this->db->select('invoice_vendor.*, po.po_number');
		$this->db->join('purchase_order_warehouse po','po.id=invoice_vendor.po_id','left');
		$this->db->where('invoice_vendor.vendor_id', $vendor_id);

		$i = $this->db->get();
		
		return $i->result_array();
	}
}