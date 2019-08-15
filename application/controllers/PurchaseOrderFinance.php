<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PurchaseOrderFinance extends CI_Controller {

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
			// cek akses
			$access = $this->session->userdata('access_id');

			$this->data['username'] = $this->session->userdata('username');
			$this->data['user_id'] = $this->session->userdata('user_id');
			$this->data['user_level'] = $this->session->userdata('user_level');
			$this->data['menu_name'] = $this->uri->segment('2');
			$this->data['sub_name'] = $this->uri->segment('3');
		endif;

		$this->load->model('PurchaseOrderWarehouse_model');
		$this->load->model('PurchaseRequest_model');
		$this->load->model('VendorOfMaterial_model');
		$this->load->model('RequestForQoutation_model');
		$this->model = $this->PurchaseOrderWarehouse_model;
	}

	public function index()
	{
		$params['page'] = 'purchase-order-finance/index';
		$params['data'] = $this->model->data_();
		$this->load->view('layouts/main', $params);
	}

	/**
	 * Proccess
	 * @return void
	 */
	public function proccess($id)
	{
		$params['data'] 			= $this->model->get_by_id($id);

		if($this->input->post())
		{	
			$post = $this->input->post();

			if($params['data']['status_gm'] == 1)
			{
				if($post['status'] == 1)
				{
					$this->db->set('status_finance', 1);
					$this->db->set('status', 4);
					$this->db->set('token_code', '-');
				}
				else
				{
					$this->db->set('status', 5);
					$this->db->set('status_finance', 1);
				} 
			}
			else
			{
				if($post['status'] == 1)
				{
					$this->db->set('status_finance', 1);
				}
				else 
				{
					$this->db->set('status_finance', 2);
					$this->db->set('status', 5);
				}
			}

			if($post['status'] == 1)
			{
				$message  = "Purchase Order ". $params['data']['po_number'] ." Approved Finance.\n\nNote:\n". $post['note'];	
			}
			else $message  = "Purchase Order ". $params['data']['po_number'] ." Approved Finance.\n\nNote:\n". $post['note'];	
			
			$this->db->where('id', $params['data']['id']);
	        $this->db->update('purchase_order_warehouse');
            $this->db->flush_cache();
			$user = $this->db->get_where('user', ['id' => $params['data']['user_id']])->row_array();
			
			if($user)
			{
            	$param['message'] 	= $message;
            	$param['phone'] 	= $user['phone'];
            	$param['email']		= $user['email'];
            	$param['subject']	= 'Purchase Order #'. $params['data']['po_number'] .( $post['status'] == 1 ? ' Approved' : ' Rejected');
            	send_notif($param);
			}

			$this->session->set_flashdata('messages', 'Purchase Order #'. $params['data']['po_number']. ( $post['status'] == 1 ? ' Approved' : 'Rejected'));
			
			redirect('purchaseOrderFinance','location');
		}

		$params['pr_data'] 			= $this->PurchaseRequest_model->get_by_id($id);
		$params['pr_number'] 		= $params['pr']['no'];
		$params['material']			= $this->model->material($id);
		$params['term']				= $this->model->term($id);

		$params['page'] 	= 'purchase-order-finance/proccess';
		$params['vendor'] 	= $this->VendorOfMaterial_model->data_();
		$params['pr'] 		= $this->PurchaseRequest_model->get_where_many(['purchase_request.status' => 4]);
		$params['rfq'] 		= $this->RequestForQoutation_model->data_();

		$this->load->view('layouts/main', $params);
	}
}
