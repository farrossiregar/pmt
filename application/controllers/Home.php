<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Constructor
	 * @param	-
	 * @return 	-
	 **/
	function __construct()
	{
		parent::__construct();	
		if(!$this->session->userdata('username')):
			redirect('login');
		else:
			$this->data['username'] = $this->session->userdata('username');
			$this->data['user_id'] = $this->session->userdata('user_id');
			$this->data['user_level'] = $this->session->userdata('user_level');
			$this->data['menu_name'] = $this->uri->segment('2');
			$this->data['sub_name'] = $this->uri->segment('3');
		endif;
		$this->load->model('Employee_model');
		$this->model = $this->Employee_model;
		$this->load->model('RequestForQoutation_model');
		$this->load->model('Home_model');
	}

	public function index()
	{
		$params = [];
		$params['page'] = 'home-blank';

		if($this->session->userdata('access_id') == 1)
			$params['page'] = 'home';

		if($this->session->userdata('access_id') == 14)
		{
			$params['data'] = $this->Home_model->transaksi();
			$params['page'] = 'home-ho';
		}

		if($this->session->userdata('access_id') == 7){
			$this->load->model('Producthistorystock_model');
    
            $params['data'] = $this->Producthistorystock_model->data_();
			$params['page'] = 'home-produksi';
		}

		if($this->session->userdata('access_id') == 6){
			$params['page'] = 'home-ar';
		}

		if($this->session->userdata('access_id') == 9)
		{
			$this->load->model('Tandaterima_model');
			$this->model = $this->Tandaterima_model;
			
			$params['data'] = $this->model->data_();
			$params['page'] = 'home-kolektor';
		}

		// cek custome old or no
		$this->cek_customer_old();	

		$this->load->view('layouts/main', $params);
	}
		
	/**
	 * Export History PR
	 * @return excel
	 */
	public function exporthistorypr()
	{	
		$params['data'] = $this->Home_model->transaksi();

		$this->load->view('pages/export/export-history-pr',$params);
	}

	/**
	 * BAC
	 * @return void
	 */
	public function bac()
	{
		$this->db->from('request_for_qoutation_material rfqm');
		$this->db->select('sad.sales_price, rfq.id, rfq.*, v.name as vendor_name, c.name as company_name,  m.name as material_name');
		$this->db->join('request_for_qoutation rfq', 'rfq.id=rfqm.request_for_qoutation', 'left');
		$this->db->join('purchase_request pr', 'pr.id=rfq.purchase_request_id', 'left');
		$this->db->join('company c', 'c.id=pr.company_id', 'left');
		$this->db->join('material m', 'm.id=rfqm.material_id', 'left');
		$this->db->join('request_for_qoutation_vendor rfqv', 'rfqv.request_for_qoutation_id=rfq.id');
		$this->db->join('vendor_of_material v', 'v.id=rfqv.vendor_id');
		$this->db->join('sales_and_distribution sad', 'sad.material_id=rfqm.material_id and sad.vendor_id=rfqv.id', 'left');
		$this->db->group_by(['rfqv.vendor_id', 'rfqm.material_id']);

		$data = $this->db->get()->result_array();

		$params['page'] = 'bac-all';
		$params['data'] = $data;

		$this->load->view('layouts/main', $params);
	}

	/**
	 * [cek_customer_old description]
	 * @return [type] [description]
	 */
	public function cek_customer_old()
	{
		$customer = $this->db->get('customer')->result_array();
		
		foreach($customer as $item)
		{
			$start_date  = date('Y-m-d', strtotime($item['create_time'].' +1 years'));
			$end_date  = date('Y-m-d');
			
			if($start_date <= $end_date)
			{
				$this->db->update('customer', ['kategori_customer' => 'Old']);
			}
		}
	}
}
