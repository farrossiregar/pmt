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

			$user = $this->db->get_where('user',['user_group_id' => 14])->row_array();
        		
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

            $pm = $this->Project_model->get_manager_by_project($data['data']->project_id);

            if($pm)
            {
	        	$param['message'] 	= $message;
	        	$param['phone'] 	= $pm['phone'];
	        	$param['email']		= $pm['email'];
	        	$param['subject']	= 'Purchase Request  #'. $params['data']['no'];
	        	send_notif($param);
	        }

			redirect('approve/success','location');
		}

		$this->load->view('pages/approve/pr', $params);
	}

	public function test()
	{
		$message  = "Your Purchase Requisition  Rejected.";
            	
    	$param['message'] 	= $message;
    	$param['phone'] 	= '087775365856';
    	$param['email']		= 'doni.enginer@gmail.com';
    	$param['subject']	= 'Purchase Request  #';

    	send_notif($param);
	}

	/**
	 * Success Page
	 * @return view
	 */
	public function success()
	{
		$this->load->view('pages/approve/success', $params);
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

			$this->db->set('note_gm', $post['note']);
			$this->db->where('id', $params['data']->id);
			$this->db->update('purchase_order_warehouse');

			$token_code = md5(uniqid());
    		$this->db->set('token_code', $token_code );
    		$this->db->where('id', $params['data']->id);
    		$this->db->update('purchase_order_warehouse');

			if($post['status'] == 1)
			{
	    		// Finance
				$user = $this->db->get_where('user', ['user_group_id' => 16])->row_array();
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
				// General Manager
				$user = $this->db->get_where('user', ['user_group_id' => 15])->row_array();
				if($user)
				{
					$message  = "This ". $params['data']->po_number ." need your approval. Please click the link below and select approve or reject with reason.";
					$message .= "\n ". site_url('approve/pogm/'. $token_code) ."\n ";	
	            	$param['message'] 	= $message;
	            	$param['phone'] 	= $user['phone'];
	            	$param['email']		= $user['email'];
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
			$post = $this->input->post();

			if($params['data']->status_finance == 1)
			{
				if($post['status'] == 1)
				{
					$this->db->set('status_gm', 1);
					$this->db->set('status', 4);
					$this->db->set('token_code', '-');
				}
				else
				{
					$this->db->set('status', 5);
					$this->db->set('status_gm', 1);
				} 
			}
			else
			{
				if($post['status'] == 1)
				{
					$this->db->set('status_gm', 1);
				}
				else 
				{
					$this->db->set('status_gm', 2);
					$this->db->set('status', 5);
				}
			}

			if($post['status'] == 1)
			{
				$message  = "Purchase Order ". $params['data']->po_number ." Approved General Manager.\n\nNote:\n". $post['note'];	
			}
			else $message  = "Purchase Order ". $params['data']->po_number ." Approved General Manager.\n\nNote:\n". $post['note'];	
			

			$this->db->where('id', $params['data']->id);
	        $this->db->update('purchase_order_warehouse');

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

			if($params['data']->status_gm == 1)
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
				$message  = "Purchase Order ". $params['data']->po_number ." Approved General Manager.\n\nNote:\n". $post['note'];	
			}
			else $message  = "Purchase Order ". $params['data']->po_number ." Approved General Manager.\n\nNote:\n". $post['note'];	
			
			$this->db->where('id', $params['data']->id);
	        $this->db->update('purchase_order_warehouse');

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
