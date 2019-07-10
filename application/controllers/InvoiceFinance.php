<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InvoiceFinance extends CI_Controller {


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

		$this->load->model('InvoiceVendor_model');
		$this->model = $this->InvoiceVendor_model;
	}

	public function index()
	{
		$params['page'] = 'invoice-finance/index';
		$params['data'] = $this->model->data_();
		$this->load->view('layouts/main', $params);
	}

	/**
	 * Receive
	 */
	public function receive($id)
	{
		if(empty($id)) return false;

		$this->db->set('status', 2);
		$this->db->set('receive_date', date('Y-m-d'));
		$this->db->where('id', $id);
		$this->db->update('invoice_vendor');

		$this->session->set_flashdata('messages', 'Invoice Received.');

		$vendor = $this->db->get_where('invoice_vendor', ['id' => $id])->row_array();
		$user = $this->db->get_where('user', ['id' => $vendor['id']])->row_array();
		if($user)
		{
			// send notifikasi whatsapp
			$message  = "This Invoice ". $vendor['invoice_number'] ." received.";
			$message .= "\n ";//. site_url('approve/pr/'. $token_code) ."\n ";

			ApiWhaCurl($user['phone'], $message);
		}


		redirect('InvoiceFinance','location');
	}

	/**
	 * Paid
	 */
	public function paid($id)
	{
		if(empty($id)) return false;

		$this->db->set('status', 3);
		$this->db->set('paid_date', date('Y-m-d'));
		$this->db->where('id', $id);
		$this->db->update('invoice_vendor');

		$this->session->set_flashdata('messages', 'Invoice Paid.');

		$vendor = $this->db->get_where('invoice_vendor', ['id' => $id])->row_array();
		$user = $this->db->get_where('user', ['id' => $vendor['id']])->row_array();
		if($user)
		{
			// send notifikasi whatsapp
			$message  = "This Invoice ". $vendor['invoice_number'] ." paid.";
			$message .= "\n ";//. site_url('approve/pr/'. $token_code) ."\n ";

			ApiWhaCurl($user['phone'], $message);
		}

		redirect('InvoiceFinance','location');
	}
}
