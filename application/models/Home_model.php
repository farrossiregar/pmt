<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Model Impor
 * @by		: doni(doni.enginer@gmail.com)
 * @date	: Oktober 2012
 **/
 
 class Home_model extends CI_Model
 {
	var $t_table 	= 'area';

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
	public function transaksi($id=0, $page=0, $limit=0, $search=0)
	{
		$this->db->select(' pr.no as purchase_request_no, 
							pr.created_at as pr_date, 
							rfq.case_id as rfq_no,
							rfq.created_at as rfq_date
						');
		$this->db->from('purchase_request pr');
		$this->db->join('request_for_qoutation rfq', 'rfq.purchase_request_id=pr.id', 'left');

		$i = $this->db->get();
		
		return $i->result_object();
	}
}