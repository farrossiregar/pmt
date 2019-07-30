<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RequestForQuotationVendor extends CI_Controller {


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

			$this->data['username'] 	= $this->session->userdata('username');
			$this->data['user_id'] 		= $this->session->userdata('user_id');
			$this->data['user_level'] 	= $this->session->userdata('user_level');
			$this->data['vendor_id'] 	= $this->session->userdata('vendor_id');
			$this->data['menu_name'] 	= $this->uri->segment('2');
			$this->data['sub_name'] 	= $this->uri->segment('3');
		endif;

		$this->load->model('Material_model');
		$this->load->model('RequestForQoutation_model');
		$this->load->model('Division_model');
		$this->load->model('GroupOfMaterial_model');
		$this->load->model('MasterUnit_model');
		$this->load->model('PurchaseRequest_model');
		$this->load->model('MaterialPurchaseRequest_model');
		$this->load->model('RequestForQoutationMaterial_model');
		$this->load->model('QuotationOrderVendor_model');
		$this->model = $this->RequestForQoutation_model;
	}

	public function index()
	{
		$params['page'] = 'requestForQuotationVendor/index';
		$params['data'] = $this->model->data_rfq_vendor($this->data['vendor_id']);
		$params['vendor_id'] = $this->data['vendor_id'];

		$this->load->view('layouts/main', $params);
	}

	/**
	 * Nego
	 */
	public function nego($id)
	{
		$params['page'] 			= 'requestForQuotation/nego';
		$params['data'] 			= $this->model->get_by_id($id);
		$params['material']			= $this->model->material($id);
		$params['vendor_id']		= $_GET['vendor_id'];
		$params['quotation_order_vendor_id']		= $id;

		if($this->input->post())
		{			
			$post 							= $this->input->post();

			foreach($post['persen_nego'] as $k => $i)
			{
				if($i== "") continue;

				$val['request_for_qoutation_material_id'] 	= $id;
				$val['persen_nego'] 						= $i;
				$val['price_nego'] 							= $post['price_nego'][$k];
				$val['price'] 								= $post['price'][$k];
				$val['material_id'] 						= $post['material_id'][$k];
				$this->db->insert('request_for_qoutation_material_nego', $val);	
			
				$this->db->flush_cache();
				$val = [];
				$val['persen_nego'] = $i;
				$val['price_nego']	= $post['price_nego'][$k];
				$this->db->where('quotation_order_vendor_id', $id);
				$this->db->where('material_id', $post['material_id'][$k]);
				$this->db->update('quotation_order_vendor_material', $val);
			}

			// change status is nego
			$this->db->where('request_for_qoutation_id', $id);	
			$this->db->where('vendor_id', $_GET['vendor_id']);
			$this->db->update('request_for_qoutation_vendor', ['is_nego' => 2]);
			
			$this->session->set_flashdata('messages', 'Nego Submited.');

			redirect('requestForQuotationVendor');
		}


		$this->load->view('layouts/main', $params);
	}

	/**
	 * Detail
	 */
	public function detail($id)
	{
		if($this->input->post())
		{			
			$post 							= $this->input->post();
			$rfq							= $this->input->post('RFQ');
			$rfq['created_at'] 				= date('Y-m-d H:is');
			$rfq['status'] 					= 1;

			$this->db->insert('quotation_order_vendor', $rfq);
			$id = $this->db->insert_id();
			$this->db->flush_cache();

			foreach($post['material_id'] as $key => $item)
			{
				$param = [];
				$param['quotation_order_vendor_id'] 	= $id;
				$param['material_id'] 					= $item;
				$param['qty'] 							= $post['qty'][$key];
				$param['price'] 							= $post['price'][$key];
				$param['discount'] 							= $post['discount'][$key];
				$param['created_at'] 					= date('Y-m-d H:i:s');

				$this->db->insert('quotation_order_vendor_material', $param);
				$this->db->flush_cache();

				// check vendor material price list
            	$vendor_material = $this->db->get_where('sales_and_distribution', ['material_id' => $item, 'vendor_id' => $rfq['vendor_id']])->row_array();
				if($vendor_material)
				{
					$this->db->where('id', $vendor_material['id']);
					$this->db->update('sales_and_distribution', ['price_submited' => $post['price'][$key], 'price_submited_date'=> date('Y-m-d')]);
            		$this->db->flush_cache();
				}
				else
				{
					$this->db->insert('sales_and_distribution', 
								[
									'vendor_id'=>$rfq['vendor_id'], 
									'material_id' => $item,
									'sales_price'=> $post['price'][$key],
									'price_submited' => $post['price'][$key], 
									'price_submited_date'=> date('Y-m-d')
								]);
				} 	
			}

			if(isset($post['term']))
			{
				foreach($post['term'] as $key => $item)
				{
					$param = [];
					$param['quotation_order_vendor_id'] = $id;
					$param['vendor_id'] 				= $rfq['vendor_id'];
					$param['term'] 						= $post['term'][$key];
					$param['cond'] 						= $post['cond'][$key];
					$param['created_at'] 				= date('Y-m-d H:i:s');

					$this->db->insert('quotation_order_vendor_term_cond', $param);
					$this->db->flush_cache();
				}
			}

			if(isset($post['term_2']))
			{
				foreach($post['term_2'] as $key => $item)
				{
					$param['quotation_order_vendor_id'] = $id;
					$param['vendor_id'] 				= $rfq['vendor_id'];
					$param['term'] 						= $post['term_2'][$key];
					$param['cond'] 						= $post['cond_2'][$key];
					$param['created_at'] 				= date('Y-m-d H:i:s');

					$this->db->insert('quotation_order_vendor_term_cond', $param);
					$this->db->flush_cache();
				}
			}

			$this->session->set_flashdata('messages', 'Quotation Submited.');
			redirect(site_url('requestForQuotationVendor'));
		}

		$params['data'] = $this->model->get_by_id($id);
		$params['pr'] 			= $this->PurchaseRequest_model->get_by_id($params['data']['purchase_request_id']);
		$params['pr_number'] 	= $params['pr']['no'];

		if(isset($_GET['quotation_id']))
		{
			$params['material']		= $this->QuotationOrderVendor_model->material($_GET['quotation_id'], 'array');
			$params['term']			= $this->QuotationOrderVendor_model->term($_GET['quotation_id'], 'array');
			$params['new'] 			= 0;
		}
		else
		{
			$params['material']		= $this->model->material($id);
			$params['term']			= $this->model->term($id);
			$params['new'] 			= 1;
		}
		$params['vendor']		= $this->model->vendor($id);
		$params['vendor_id'] 	= $this->session->userdata('vendor_id');
		$params['page'] 		= 'requestForQuotationVendor/detail';
		$params['request']		= $this->PurchaseRequest_model->get_where_many(['purchase_request.status' => 0]);

		if(isset($_GET['quotation_id']))
		{
			$params['quotation_id'] 	= $_GET['quotation_id'];
			$params['quotation'] 		= $this->db->get_where('quotation_order_vendor', ['id'=>$_GET['quotation_id']] )->row_array();
		}

		$this->load->view('layouts/main', $params);
	}

	public function delete($id)
	{
		$this->db->delete($this->model->t_table, array('id' => $id));
		$this->db->delete($this->RequestForQoutationMaterial_model->t_table, array('request_for_qoutation' => $id));

		$this->session->set_flashdata('messages', 'Data berhasil dihapus');

		redirect(site_url('requestForQuotation'));
	}
}
