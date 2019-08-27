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
							rfq.created_at as rfq_date,
							po.po_number as po_no,
							po.vat,
							po.term_day_remark,
							po.term_day,
							po.vat_type,
							po.status,
							v.name as vendor_name,
							m.name as material_name,
							pom.qty,
							pom.price,
							p.project_code,
							p.name as  project_name,
							p.project_type,
							u1.name as requester,
							r.region_code,
							r.region
						');
		$this->db->from('purchase_request pr');
		$this->db->join('request_for_qoutation rfq', 'rfq.purchase_request_id=pr.id', 'left');
		$this->db->join('purchase_order_warehouse po', 'po.rfq_id=rfq.id', 'left');
		$this->db->join('vendor_of_material v', 'po.vendor_id=v.id', 'left');
		$this->db->join('purchase_order_material pom', 'pom.po_id=po.id');
		$this->db->join('material m', 'm.id=pom.material_id', 'left');
		$this->db->join('projects p', 'p.id=pr.project_id', 'left');
		$this->db->join('user u1', 'u1.id=p.project_manager_id', 'left');
		$this->db->join('region r', 'r.id=p.region_id', 'left');

		if(isset($_GET['company_id']) and !empty($_GET['company_id']))
		{
			$this->db->where('pr.company_id', $_GET['company_id']);
		}
		if(isset($_GET['vendor_id']) and !empty($_GET['vendor_id']))
		{
			$this->db->where('po.vendor_id', $_GET['vendor_id']);
		}

		if(isset($_GET['date']) and !empty($_GET['date']))
		{
			$date = explode('to', $_GET['date']);
			$this->db->where('pr.created_at >=', rtrim($date[0]));
			$this->db->where('pr.created_at <=', ltrim($date[1]));
		}

		$i = $this->db->get();
		
		return $i->result_object();
	}
}