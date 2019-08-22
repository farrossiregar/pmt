<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Controller Login
 * @by		: doni (doni.enginer@gmail.com)
 * @date	: Oktober 2012
 **/

class Approve extends CI_Controller {

	/**
	 * Constructor
	 * @param  -
	 * @return -
	 **/
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		return;
	}

	/**
	 * Approve PR Project Manager
	 */
	public function prpm($token)
	{
		$params = [];
		$token = mysqli_real_escape_string(get_instance()->db->conn_id, $token);

		$this->load->model('PurchaseRequest_model');
		$this->load->model('MaterialPurchaseRequest_model');
		$this->load->model('Project_model');

		$params['data'] = $this->PurchaseRequest_model->get_by_token($token);
		$params['material'] = $this->MaterialPurchaseRequest_model->get_where_many(['material_purchase_request.purchase_request_id' => $params['data']['id']]);

		$expired 	= strtotime($params['data']['token_expired']);
		$today 		= strtotime(date('Y-m-d'));
		
		if($today >= $expired)
		{
			$this->session->set_flashdata('messages', 'Token Expired');

			redirect('approve/success','location');
		}
		if(!$params['data'])
		{
			$this->session->set_flashdata('messages', 'Token Not Found');

			redirect('approve/success','location');	
		}

		if($this->input->post())
		{
			$post = $this->input->post();
			$token_code = md5(uniqid());

			$this->db->flush_cache();
			
			if($post['status'] == 1)
				$set['status']= 4;
			else
				$set['status'] = 3;

			$this->session->set_flashdata('messages', 'Purchase Requisition #'. $params['data']['no']. ( $post['status'] == 1 ? ' Approved' : 'Rejected'));

			$set['note_pm'] = $post['note'];
			$this->db->where('id', $params['data']['id']);
			$this->db->update('purchase_request', $set);

			// Procurement
			$users = $this->db->get_where('user',['user_group_id' => 18])->result_array();

        	foreach($users as $user)
        	{
	    		if(!empty($user) and $post['status'] == 1)
	    		{
					$token_code = md5(uniqid());
	        		$this->db->where('id', $params['data']['id']);
	        		$this->db->update('purchase_request', ['token_code'=>'-']);
					
					$message  = "You have incoming Purchase Requisition ". $params['data']['no'];

	            	$param['message'] 	= $message;
	            	$param['phone'] 	= $user['phone'];
	            	$param['email']		= $user['email'];
	            	$param['subject']	= 'Purchase Requisition #'. $params['data']['no'];

	            	send_notif($param);
	            	$message  = "Your Purchase Requisition ". $params['data']['no'] .' Approved.';
				}
				else $message  = "Your Purchase Requisition ". $params['data']['no'] ." rejected.";
			}
			
            $pm = $this->Project_model->get_manager_by_project($params['data']['project_id']);
            
            if($pm)
            {
	        	$param['message'] 	= $message;
	        	$param['phone'] 	= $pm['phone'];
	        	$param['email']		= $pm['email'];
	        	$param['subject']	= 'Purchase Request #'. $params['data']['no'];
	        	send_notif($param);
	        }

			redirect('approve/success','location');
		}

		$this->load->view('pages/approve/pr', $params);
	}

	public function test()
	{
		$message  = "Testing message.";
            	
    	$param['message'] 	= $message;
    	$param['phone'] 	= '62895355359848';
    	$param['email']		= 'doni.enginer@gmail.com';
    	$param['subject']	= 'Testing message';

    	send_notif($param);
	}

	/**
	 * Success Page
	 * @return view
	 */
	public function success()
	{
		$this->load->view('pages/approve/success');
	}

	/**
	 * Approve PR Project Manager
	 */
	public function poprocurement($token)
	{
		$token = mysqli_real_escape_string(get_instance()->db->conn_id, $token);

		$this->load->model('PurchaseOrderWarehouse_model');
		$this->load->model('QuotationOrderVendor_model');

		$item = $this->db->get_where('purchase_order_warehouse', ['token_code' => $token])->row_array();

		$params['data'] 		= $this->PurchaseOrderWarehouse_model->get_where_one(['purchase_order_warehouse.id' => $item['id']], 'object');
		$params['material']		= $this->PurchaseOrderWarehouse_model->material($item['id']);
		$params['term']			= $this->PurchaseOrderWarehouse_model->term($item['id']);
		$params['is_ho']		= 1;

		if(!$params['data'])
		{
			$this->session->set_flashdata('messages', 'Token Not Found');

			redirect('approve/success','location');	
		}

		if($this->input->post())
		{
			$post = $this->input->post();
			$set = [];
			if($post['status'] == 1)
			{
				$set['status_proqurement_ho'] = 1;
				$set['status']= 2;
			}
			else
			{
				$set['status_proqurement_ho'] = 2;
				$set['status'] = 5;
			}

			$this->db->set('note_procurement', $post['note']);
			$this->db->where('id', $params['data']->id);
			$this->db->update('purchase_order_warehouse', $set);

			$token_code = md5(uniqid());
    		$this->db->set('token_code', $token_code );
    		$this->db->where('id', $params['data']->id);
    		$this->db->update('purchase_order_warehouse');

			if($post['status'] == 1)
			{
	    		// Finance
				$users = $this->db->get_where('user', ['user_group_id' => 16])->result_array();
				foreach($users as $user)
				{
					if($user)
					{
						$message  = "This ". $params['data']->po_number ." need your approval. Please click the link below and select approve or reject with reason.";
						$message .= "\n ". site_url('approve/pofinance/'. $token_code) ."\n ";	
		            	$param['message'] 	= $message;
		            	$param['phone'] 	= $user['phone'];
		            	$param['email']		= $user['email'];
		            	$param['subject']	= 'Purchase Order Need Your Approval #'. $params['data']->po_number;
		            	send_notif($param);
					}
				}

				// General Manager
				if($params['data']->gm_email)
				{
					$message  = "This ". $params['data']->po_number ." need your approval. Please click the link below and select approve or reject with reason.";
					$message .= "\n ". site_url('approve/pogm/'. $token_code) ."\n ";	
	            	$param['message'] 	= $message;
	            	$param['phone'] 	= $params['data']->gm_phone;
	            	$param['email']		= $params['data']->gm_email;
	            	$param['subject']	= 'Purchase Order Need Your Approval #'. $params['data']->po_number;
	            	send_notif($param);
	            }
				
				$message  = "Purchase Order ". $params['data']->po_number ." Approved Proqurement Manager.\n\nNote:\n". $post['note'];	
			}
			else $message  = "Purchase Order ". $params['data']->po_number ." Rejected Proqurement Manager.\n\nNote:\n". $post['note'];
			
			$user = $this->db->get_where('user', ['id' => $params['data']->user_id ])->row_array();
			if($user)
			{
            	$param['message'] 	= $message;
            	$param['phone'] 	= $user['phone'];
            	$param['email']		= $user['email'];
            	$param['subject']	= 'Purchase Order #'. $params['data']->po_number .( $post['status'] == 1 ? ' Approved' : ' Rejected');
            	send_notif($param);
			}

			$this->session->set_flashdata('messages', 'Purchase Order #'. $params['data']->po_number. ( $post['status'] == 1 ? ' Approved' : ' Rejected'));
			
			redirect('approve/success','location');
		}

		$this->load->view('pages/approve/po', $params);
	}

	/**
	 * Approve PR Project Manager
	 */
	public function prho($token)
	{
		$token = mysqli_real_escape_string(get_instance()->db->conn_id, $token);

		$this->load->model('PurchaseRequest_model');
		$this->load->model('MaterialPurchaseRequest_model');

		$params['data'] = $this->PurchaseRequest_model->get_by_token($token);
		$params['material'] = $this->MaterialPurchaseRequest_model->get_where_many(['purchase_request_id' => $params['data']['id']]);

		$expired 	= strtotime($params['data']['token_expired']);
		$today 		= strtotime(date('Y-m-d'));
		
		if($today >= $expired)
		{
			$this->session->set_flashdata('messages', 'Token Expired');

			redirect('approve/success','location');
		}
		if(!$params['data'])
		{
			$this->session->set_flashdata('messages', 'Token Not Found');

			redirect('approve/success','location');	
		}

		if($this->input->post())
		{
			$post = $this->input->post();
			$data = $this->db->get_where('purchase_request', ['token_code' => $token])->row_array();

			$this->db->flush_cache();
			
			if($post['status'] == 1)
				$this->db->set('status', 4);
			else
				$this->db->set('status', 3);

			$this->session->set_flashdata('messages', 'Purchase Request #'. $params['data']['no']. ( $post['status'] == 1 ? ' Approved' : 'Rejected'));
			$this->db->set('note_ho', $post['note']);
			$this->db->set('token_code', '-');
			$this->db->where('id', $params['data']['id']);
			$this->db->update('purchase_request');
			
			redirect('approve/success','location');
		}

		$this->load->view('pages/approve/pr', $params);
	}

	/**
	 * Approve PR Project Manager
	 */
	public function pogm($token)
	{
		$token = mysqli_real_escape_string(get_instance()->db->conn_id, $token);

		$this->load->model('PurchaseOrderWarehouse_model');
		$this->load->model('QuotationOrderVendor_model');

		$item = $this->db->get_where('purchase_order_warehouse', ['token_code' => $token])->row_array();

		$params['data'] 		= $this->PurchaseOrderWarehouse_model->get_where_one(['purchase_order_warehouse.id' => $item['id']]);

		$data = new stdClass();
		foreach ($params['data'] as $key => $value)
		{
		    $data->$key = $value;
		}

		$params['data'] 		= $data;
		$params['material']		= $this->PurchaseOrderWarehouse_model->material($item['id']);
		$params['term']			= $this->PurchaseOrderWarehouse_model->term($item['id']);

		if(!$params['data'])
		{
			$this->session->set_flashdata('messages', 'Token Not Found');

			redirect('approve/success','location');	
		}

		if($this->input->post())
		{
			$var = [];
			$post = $this->input->post();

			if($params['data']->status_finance == 1)
			{
				if($post['status'] == 1)
				{
					$var['status_gm'] 		= 1;
					$var['status'] 			= 4;
					$var['token_code'] 		= '-';
					// send notifkasi to vendor
					if(isset($params['data']->vemail))
					{
						$message  = 'congratulations !!  You become a PO winner with the number '. $params['data']->po_number;
						$message .= "\n <a href=\"". site_url() ."\">Login to System</a> for show detail \n";

						$param['message'] 	= $message;
		            	$param['phone'] 	= $params['data']->vphone_1;
		            	$param['email']		= $params['data']->vemail;
		            	$param['subject']	= 'Congratulations !!  You become a PO winner with the number '. $params['data']->po_number;
		            	send_notif($param);

		            	// update quotation all vendor
		            	$this->db->where('rfq_id', $params['data']->rfq_id);
		            	$this->db->update('quotation_order_vendor', ['status' => 3]);
            			$this->db->flush_cache();

            			// update quotation vendor
		            	$this->db->where('rfq_id', $params['data']->rfq_id);
		            	$this->db->where('vendor_id', $params['data']->vendor_id);
		            	$this->db->update('quotation_order_vendor', ['status' => 2]);
            			$this->db->flush_cache();

            			$vendor = $this->db->get_where('quotation_order_vendor', ['rfq_id' => $params['data']->rfq_id])->result_array();
            			
            			foreach($vendor as $i)
            			{
            				if($i['vendor_id'] == $params['data']->vendor_id) continue; // skip

            				$message  = "sorry, you haven't had the chance to get a PO from the offer you sent with the number ". $params['data']->po_number;
							$message .= "\n <a href=\"". site_url() ."\">Login to System</a> for show detail \n";
							
							$v = $this->db->get_where('vendor_of_material', ['id' => $i['vendor_id']])->row_array();

							if(isset($v['email']))
							{
								$param['message'] 	= $message;
				            	$param['phone'] 	= $v['phone_1'];
				            	$param['email']		= $v['email'];
				            	$param['subject']	= "Lose !!  sorry, you haven't had the chance to get a PO from the offer you sent with the number ". $params['data']->po_number;
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
					$var['status_gm'] 	= 2;
					$var['status']		= 5;
				}
			}

			if($post['status'] == 1)
			{
				$message  = "Purchase Order ". $params['data']->po_number ." Approved General Manager.\n\nNote:\n". $post['note'];	
			}
			else $message  = "Purchase Order ". $params['data']->po_number ." Approved General Manager.\n\nNote:\n". $post['note'];	
			
			$var['note_gm'] = $post['note'];
			$this->db->where('id', $params['data']->id);
	        $this->db->update('purchase_order_warehouse', $var);

			$user = $this->db->get_where('user', ['id' => $params['data']->user_id])->row_array();
			if($user)
			{
            	$param['message'] 	= $message;
            	$param['phone'] 	= $user['phone'];
            	$param['email']		= $user['email'];
            	$param['subject']	= 'Purchase Order #'. $params['data']->po_number .( $post['status'] == 1 ? ' Approved' : ' Rejected');
            	send_notif($param);
			}

			$this->session->set_flashdata('messages', 'Purchase Order #'. $params['data']->po_number. ( $post['status'] == 1 ? ' Approved' : 'Rejected'));
			
			redirect('approve/success','location');
		}

		$this->load->view('pages/approve/po', $params);
	}

	/**
	 * Approve PR Project Manager
	 */
	public function pofinance($token)
	{
		$token = mysqli_real_escape_string(get_instance()->db->conn_id, $token);

		$this->load->model('PurchaseOrderWarehouse_model');
		$this->load->model('QuotationOrderVendor_model');

		$item = $this->db->get_where('purchase_order_warehouse', ['token_code' => $token])->row_array();

		$params['data'] 		= $this->PurchaseOrderWarehouse_model->get_where_one(['purchase_order_warehouse.id' => $item['id']]);

		$data = new stdClass();
		foreach ($params['data'] as $key => $value)
		{
		    $data->$key = $value;
		}

		$params['data'] 		= $data;
		$params['material']		= $this->PurchaseOrderWarehouse_model->material($item['id']);
		$params['term']			= $this->PurchaseOrderWarehouse_model->term($item['id']);

		if(!$params['data'])
		{
			$this->session->set_flashdata('messages', 'Token Not Found');

			redirect('approve/success','location');	
		}

		if($this->input->post())
		{
			$post = $this->input->post();
			$var = [];
			if($params['data']->status_gm == 1)
			{
				if($post['status'] == 1)
				{
					$var['status_finance']  = 1;
					$var['status'] 			= 4;
					$var['token_code'] 		= '-';

					// send notifkasi to vendor
					if($params['data']->vemail)
					{
						$message  = 'congratulations !!  You become a PO winner with the number '. $params['data']->po_number;
						$message .= "\n <a href=\"". site_url() ."\">Login to System</a> for show detail \n";

						$param['message'] 	= $message;
		            	$param['phone'] 	= $params['data']->vphone_1;
		            	$param['email']		= $params['data']->vemail;
		            	$param['subject']	= 'Congratulations !!  You become a PO winner with the number '. $params['data']->po_number;
		            	send_notif($param);

		            	// update quotation all vendor
		            	$this->db->where('rfq_id', $params['data']->rfq_id);
		            	$this->db->update('quotation_order_vendor', ['status' => 3]);
            			$this->db->flush_cache();

            			// update quotation vendor
		            	$this->db->where('rfq_id', $params['data']->rfq_id);
		            	$this->db->where('vendor_id', $params['data']->vendor_id);
		            	$this->db->update('quotation_order_vendor', ['status' => 2]);
            			$this->db->flush_cache();

            			$vendor = $this->db->get_where('quotation_order_vendor', ['rfq_id' => $params['data']->rfq_id])->result_array();
            			foreach($vendor as $i)
            			{
            				if($i['vendor_id'] == $params['data']->vendor_id) continue; // skip

            				$messages  = "sorry, you haven't had the chance to get a PO from the offer you sent with the number ". $params['data']->po_number;
							$messages .= "\n <a href=\"". site_url() ."\">Login to System</a> for show detail \n";
							
							$v = $this->db->get_where('vendor_of_material', ['id' => $i['vendor_id']])->row_array();
							if(isset($v['email']))
							{
								$param['message'] 	= $message;
				            	$param['phone'] 	= $v['phone_1'];
				            	$param['email']		= $v['email'];
				            	$param['subject']	= "Lose !!  sorry, you haven't had the chance to get a PO from the offer you sent with the number ". $params['data']->po_number;
				            	send_notif($param);
				            }
		            	}
            			$this->db->flush_cache();
					}
				}
				else
				{
					$var['status'] 			= 5;
					$var['status_finance'] 	= 1;
				} 
			}
			else
			{
				if($post['status'] == 1)
				{
					$var['status_finance'] 	= 1;
				}
				else 
				{
					$var['status_finance'] 	= 2;
					$var['status'] 			= 5;
				}
			}

			if($post['status'] == 1)
			{
				$message  = "Purchase Order ". $params['data']->po_number ." Approved Finance.\n\nNote:\n". $post['note'];	
			}
			else $message  = "Purchase Order ". $params['data']->po_number ." Approved Finance.\n\nNote:\n". $post['note'];	
			
			$var['note_finance'] = $post['note'];
			
			$this->db->where('id', $params['data']->id);
	        $this->db->update('purchase_order_warehouse', $var);

			$user = $this->db->get_where('user', ['id' => $params['data']->user_id])->row_array();
			if($user)
			{
            	$param['message'] 	= $message;
            	$param['phone'] 	= $user['phone'];
            	$param['email']		= $user['email'];
            	$param['subject']	= 'Purchase Order #'. $params['data']->po_number .( $post['status'] == 1 ? ' Approved' : ' Rejected');
            	send_notif($param);
			}

			$this->session->set_flashdata('messages', 'Purchase Order #'. $params['data']->po_number. ( $post['status'] == 1 ? ' Approved' : 'Rejected'));
			
			redirect('approve/success','location');
		}

		$this->load->view('pages/approve/po', $params);
	}
}
