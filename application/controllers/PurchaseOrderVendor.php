<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PurchaseOrderVendor extends CI_Controller {


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
			$this->data['vendor_id'] = $this->session->userdata('vendor_id');
			$this->data['menu_name'] = $this->uri->segment('2');
			$this->data['sub_name'] = $this->uri->segment('3');
		endif;

		$this->load->model('PurchaseOrderWarehouse_model');
		$this->load->model('PurchaseRequest_model');
		$this->load->model('RequestForQoutation_model');
		$this->load->model('VendorOfMaterial_model');
		$this->model = $this->PurchaseOrderWarehouse_model;
	}

	public function index()
	{
		$params['page'] = 'purchase-order-vendor/index';
		$params['data'] = $this->model->data_vendor($this->data['vendor_id']);
		$this->load->view('layouts/main', $params);
	}

	/**
	 * Proccess
	 * @return void
	 */
	public function detail($id)
	{
		$params['data'] 			= $this->model->get_by_id($id);
		$params['data'] 			= $this->model->get_by_id($id);
		$params['pr_data'] 			= $this->PurchaseRequest_model->get_by_id($id);
		$params['pr_number'] 		= $params['pr']['no'];
		$params['material']			= $this->model->material($id);
		$params['term']				= $this->model->term($id);
		$params['page'] 	= 'purchase-order-vendor/detail';
		$params['vendor'] 	= $this->VendorOfMaterial_model->data_();
		$params['pr'] 		= $this->PurchaseRequest_model->get_where_many(['purchase_request.status' => 4]);
		$params['rfq'] 		= $this->RequestForQoutation_model->data_();

		$this->load->view('layouts/main', $params);
	}

	/**
	 * Proccess
	 * @return void
	 */
	public function createinvoice($id)
	{
		$params['data'] 			= $this->model->get_by_id($id);

		if($this->input->post())
		{	
			$post = $this->input->post('Invoice');
			$post['due_date'] = date('Y-m-d', strtotime( date('Y-m-d') .' + '. $post['term_day'] ." days"));
			$post['vendor_id'] =$this->data['vendor_id'];

			# upload file
			$config = Array();
			$config['upload_path'] 		= './upload/';
			$config['allowed_types'] 	= '*';
			$config['max_size']			= '2000';
			$config['max_width'] 		= '2000';
			$config['max_height']		= '2000';

			$this->load->library('upload', $config);
			if (!$this->upload->do_upload("file")):
				$error = array('error' => $this->upload->display_errors());
				print_r($error);
			else:
				$upload_data = $this->upload->data();
				
				$file = $upload_data['full_path'];
				
				//delete file
	            $file = $config['upload_path'] . $upload_data['file_name'];
			
				$post['file'] = $upload_data['file_name'];
			endif;

			$this->db->insert('invoice_vendor', $post);
			$invoice_id = $this->db->insert_id();

			// update invoice_id
			$this->db->where('id', $id);
			$this->db->update('purchase_order_warehouse', ['invoice_id' => $invoice_id]);

			$this->session->set_flashdata('messages', 'Invoice Submited.');

			$finance = $this->db->get_where('user', ['user_group_id' => 16])->row_array();
			if($finance)
			{
				// send notifikasi whatsapp
				$message  = "This ". $post['invoice_number'] ." need your approval. Please click the link below and select approve or reject with reason.";
				$message .= "\n ";//. site_url('approve/pr/'. $token_code) ."\n ";

				ApiWhaCurl($finance['phone'], $message);
			}

			redirect('InvoiceVendor','location');
		}

		$params['pr_data'] 			= $this->PurchaseRequest_model->get_by_id($id);
		$params['pr_number'] 		= $params['pr']['no'];
		$params['material']			= get_material_pr($id);

		$params['page'] 	= 'purchase-order-vendor/create-invoice';
		$params['vendor'] 	= $this->VendorOfMaterial_model->data_();
		$params['pr'] 		= $this->PurchaseRequest_model->get_where_many(['purchase_request.status' => 4]);
		$params['rfq'] 		= $this->RequestForQoutation_model->data_();

		$this->load->view('layouts/main', $params);
	}
}
