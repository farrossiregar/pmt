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
		$params['data'] = $this->model->data_('gm');
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
			$var = [];
			if($params['data']['status_finance'] == 1)
			{
				if($post['status'] == 1)
				{
					$var['status_gm'] 	=  1;
					$var['status'] 		= 4;
					$var['token_code']  = '-';

					// send notifkasi to vendor
					if($params['data']['vemail'])
					{
						$material = '';
						foreach($params['material'] as $k => $i)
						{
							$material .= $k ==0 ? $i->material : ','. $i->material;
						}

						$message  = "Dear ". $params['data']['vname'] ."\n
						Notification of Award of Bidder for (". $material .")\n
						On behalf of ". $params['data']['company'] ." we are pleased to inform you that your quotation has been <b syle=\"color:green;\">successful</b>.\n
						This letter is not and is not intended to have contractual effect and no action should be taken by your company at this time in respect of this award letter. PMT accepts no responsibility or liability for any actions which you may take based on the information detailed in this letter. Any such actions and their financial consequences will be entirely at your own risk.\n
						PMT appreciates your assistance and we look forward to working with you.
						\n\n Yours sincerely";

						$param['message'] 	= $message;
		            	$param['phone'] 	= $params['data']['vphone_1'];
		            	$param['email']		= $params['data']['vemail'];
		            	$param['subject']	= 'Congratulations !!  You become a PO winner with the number '. $params['data']['po_number'];
		            	send_notif($param);

		            	// update quotation all vendor
		            	$this->db->where('rfq_id', $params['data']['rfq_id']);
		            	$this->db->update('quotation_order_vendor', ['status' => 3]);
            			$this->db->flush_cache();

            			// update quotation vendor
		            	$this->db->where('rfq_id', $params['data']['rfq_id']);
		            	$this->db->where('vendor_id', $params['data']['vendor_id']);
		            	$this->db->update('quotation_order_vendor', ['status' => 2]);
            			$this->db->flush_cache();

            			$vendor = $this->db->get_where('quotation_order_vendor', ['rfq_id' => $params['data']['rfq_id']])->result_array();
            			foreach($vendor as $i)
            			{
            				if($i['vendor_id'] == $params['data']['vendor_id']) continue; // skip

            				$message  = "Dear ". $params['data']['vname'] ."\n
								Notification of Award of Bidder for (". $material .")\n
								Thank you for your submission in respect of the Quotation. ". $params['data']['company'] ." has now completed the evaluation of all bidders.\n
								I regret to inform you that on this occasion your bid has been <b syle=\"color:red;\">unsuccessful</b>.\n
								I would like to thank you on behalf of PMT for your interest and time taken in the preparation of your quotation submission.\n
								We hope that your company will consider applying for future contract opportunities that your company may be interested in.
								\n\n Yours sincerely";
							
							$v = $this->db->get_where('vendor_of_material', ['id' => $i['vendor_id']])->row_array();
							if(isset($v['email']))
							{
								$param['message'] 	= $message;
				            	$param['phone'] 	= $v['phone_1'];
				            	$param['email']		= $v['email'];
				            	$param['subject']	= "Lose !!  sorry, you haven't had the chance to get a PO from the offer you sent with the number ". $params['data']['po_number'];
				            	send_notif($param);
				            }
		            	}
            			$this->db->flush_cache();
					}
				}
				else
				{
					$var['status'] 		= 5;
					$var['status_gm'] 	= 1;
				} 
			}
			else
			{
				if($post['status'] == 1)
				{
					$var['status_gm'] = 1;
				}
				else 
				{
					$var['status_gm'] 		= 2;
					$var['status'] 			= 5;
				}
			}

			if($post['status'] == 1)
			{
				$message  = "Purchase Order ". $params['data']['po_number'] ." Approved General Manager.\n\nNote:\n". $post['note'];	
			}
			else $message  = "Purchase Order ". $params['data']['po_number'] ." Approved General Manager.\n\nNote:\n". $post['note'];	
			
			$this->db->where('id', $params['data']['id']);
	        $this->db->update('purchase_order_warehouse',$var);

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
			
			redirect('purchaseOrderGM','location');
		}

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
