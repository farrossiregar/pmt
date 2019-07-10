<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PurchaseOrderGM extends CI_Controller {


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
		$params['page'] = 'purchase-order-gm/index';
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

			if($post['status'] == 1)
				$this->db->set('status', 2);
			else
				$this->db->set('status', 4);

			$this->db->set('note_gm', $post['note']);
			$this->db->where('id', $id);
			$this->db->update('purchase_order_warehouse');

			$this->session->set_flashdata('messages', 'Purchase Order Submited.');

			$user = $this->db->get_where('user', ['user_group_id' => 16])->row_array();
			if($user)
			{
				$token_code = md5(uniqid());
        		$this->db->set('token_code', $token_code );
        		$this->db->where('id', $id);
        		$this->db->update('purchase_order_warehouse');

				// send notifikasi whatsapp
				$message  = "This ". $params['data']['po_number'] ." need your approval. Please click the link below and select approve or reject with reason.";
				$message .= "\n ". site_url('approve/pofinance/'. $token_code) ."\n ";
            	
            	$param['message'] 	= $message;
            	$param['phone'] 	= $user['phone'];
            	$param['email']		= $user['email'];
            	$param['subject']	= 'Purchase Order Need Your Approval #'. $params['data']['po_number'];

            	send_notif($param);
			}

			redirect('purchaseOrderGM','location');
		}

		$params['data'] 			= $this->model->get_by_id($id);
		$params['pr_data'] 			= $this->PurchaseRequest_model->get_by_id($id);
		$params['pr_number'] 		= $params['pr']['no'];
		$params['material']			= $this->model->material($id);
		$params['term']				= $this->model->term($id);

		$params['page'] 	= 'purchase-order-gm/proccess';
		$params['vendor'] 	= $this->VendorOfMaterial_model->data_();
		$params['pr'] 		= $this->PurchaseRequest_model->get_where_many(['purchase_request.status' => 4]);
		$params['rfq'] 		= $this->RequestForQoutation_model->data_();

		$this->load->view('layouts/main', $params);
	}
}
