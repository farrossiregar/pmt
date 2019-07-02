<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PurchaseOrderWarehouse extends CI_Controller {

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
		$this->load->model('VendorOfMaterial_model');
		$this->load->model('RequestForQoutation_model');
		$this->load->model('PurchaseRequest_model');
		$this->load->model('Branch_model');
		$this->load->model('Departement_model');
		$this->load->model('Division_model');
		$this->load->model('Section_model');
		$this->load->model('MaterialPurchaseRequest_model');
		$this->load->model('RequestForQoutationMaterial_model');
		$this->load->model('SalesAndDistribution_model');
		$this->load->model('TermConditionPo_model');
		$this->load->model('MaterialPO_model');
		$this->load->model('InvoiceVendor_model');
		$this->model = $this->PurchaseOrderWarehouse_model;
		$this->load->model('QuotationOrderVendor_model');
	}

	public function index()
	{
		$params['page'] = 'purchaseOrderWarehouse/index';
		$params['data'] = $this->model->data_();
		$this->load->view('layouts/main', $params);
	}

	/**
	 * Finance
	 * @return void
	 */
	public function invoice()
	{
		$params['page'] = 'purchaseOrderWarehouse/invoice';
		$params['data'] = $this->InvoiceVendor_model->data_();
		$this->load->view('layouts/main', $params);
	}

	/**
	 * detail
	 * @return view
	 */
	public function detail($id)
	{
		$params['page'] 		= 'purchaseOrderWarehouse/form-po-by-quotation-vendor';
		$params['data'] 		= $this->QuotationOrderVendor_model->get_by_id($id);
		$params['material']		= $this->QuotationOrderVendor_model->material($id);
		$params['term']			= $this->QuotationOrderVendor_model->term($id);

		$this->load->view('layouts/main', $params);
	}

	/**
	 * Create Po by Quotation Vendor
	 */
	public function createpobyqo($id)
	{	
		$params['page'] 		= 'purchaseOrderWarehouse/form-po-by-quotation-vendor';
		$params['data'] 		= $this->QuotationOrderVendor_model->get_by_id($id);
		$params['material']		= $this->QuotationOrderVendor_model->material($id);
		$params['term']			= $this->QuotationOrderVendor_model->term($id);
		$params['quotation_vendor_id'] = $id;
		$params['rfq_id'] 		= $params['data']->rfq_id;

		$this->load->view('layouts/main', $params);
	}

	/**
	 * Insert
	 * @return view
	 */
	public function insert()
	{
		if(isset($_GET['pr_id']))
		{
			$params['pr_data'] 			= $this->PurchaseRequest_model->get_by_id($_GET['pr_id']);
			$params['pr_number'] 		= $params['pr']['no'];
			$params['material']			= get_material_pr($_GET['pr_id']);
		}

		if($this->input->post())
		{
        	$token_code = md5(uniqid());
			$post = $this->input->post('PO');
			$post['token_code'] 	= $token_code;
			$post['created_at'] 	= date('Y-m-d H:i:s');
			$post['status'] 		= 1;

			$this->db->insert('purchase_order_warehouse', $post);
    		$id = $this->db->insert_id();
            $this->db->flush_cache();
			
			$term = $this->input->post('term');
			$cond = $this->input->post('cond');
			foreach ($term as $key => $item)
			{
				$value['po_id'] 	= $id;
				$value['term'] 		= $item;
				$value['cond'] 		= $cond[$key];
				$this->db->insert('term_condition_po', $value);
            	$this->db->flush_cache();
			}

			$material = $this->input->post('Material');
			foreach ($material as $key => $value)
			{
				$var = $value;
				$var['po_id'] 			= $id;

				$this->db->insert('purchase_order_material', $var);
            	$this->db->flush_cache();
			}

			$gm = $this->db->get_where('user', ['user_group_id' => 15])->row_array();
			if($gm)
			{
				// send notifikasi whatsapp
				$message  = "This ". $post['po_number'] ." need your approval. Please click the link below and select approve or reject with reason.";
				$message .= site_url('approve/pogm/'. $token_code) ."\n ";

				$param['message'] 	= $message;
            	$param['phone'] 	= $gm['phone'];
            	$param['email']		= $gm['email'];
            	$param['subject']	= 'Purchase Order Need Your Approval #'. $post['po_number'];

            	send_notif($param);
			}
			
			$this->session->set_flashdata('messages', 'Purchase Order Submited.');

			redirect('purchaseOrderWarehouse','location');
		}			

		$params['page'] 	= 'purchaseOrderWarehouse/form';
		$params['vendor'] 	= $this->VendorOfMaterial_model->data_();
		$params['pr'] 		= $this->PurchaseRequest_model->get_where_many(['purchase_request.status' => 4]);
		$params['rfq'] 		= $this->RequestForQoutation_model->data_();
		$params['branch'] 	= $this->Branch_model->data_();

		$this->db->from('user');	
		$this->db->like("user_group_id", 12);
		$i = $this->db->get();	
		$params['requester'] = $i->result_array();

		$this->load->view('layouts/main', $params);
	}

	public function pdf($id)
	{
		$params['po'] = $this->model->get_where_one(['purchase_order_warehouse.id' => $id]);
		$params['material'] = $this->model->material($params['po']['id']);
		$params['t'] = $this->TermConditionPo_model->get_where_many(['po_id	' => $params['po']['id']]);

		$html = $this->load->view('pages/purchaseOrderWarehouse/po_pdf', $params, true);
		//print_r($html);exit();
		//this the the PDF filename that user will get to download
		$pdfFilePath = "Invoice-". date('d M Y') .".pdf";

        //load mPDF library
		$this->load->library('m_pdf');

		$this->m_pdf = new mPDF();
		
		$this->m_pdf->showImageErrors = true;

		$this->m_pdf->AddPage('P', // L - landscape, P - portrait
            '', '', '', '',
            5, // margin_left
            5, // margin right
            5, // margin top
            5, // margin bottom
            5, // margin header
            5); // margin footer

       //generate the PDF from the given html
		$this->m_pdf->WriteHTML($html);

        //download it.
		$this->m_pdf->Output($pdfFilePath, "I");		
	}

	public function pdf2($id)
	{
		$params['po'] = $this->model->get_where_one(['purchase_order_warehouse.id' => $id]);
		$params['material'] = $this->MaterialPO_model->get_where_one(['materi_po.po_id	' => $params['po']['id']]);
		$params['t'] = $this->TermConditionPo_model->get_where_one(['po_id	' => $params['po']['id']]);

		print_r($params['po']);
	}

	public function ajax_get_departement($id)
	{
		$data = $this->Departement_model->get_where_many(['branch_id' => $id]);
		echo json_encode($data);
	}

	public function ajax_get_divisi($id)
	{
		$data = $this->Division_model->get_where_many(['departement_id' => $id]);
		echo json_encode($data);
	}

	public function ajax_get_section($id)
	{
		$data = $this->Section_model->get_where_many(['division_id' => $id]);
		echo json_encode($data);
	}

	public function ajax_get_material_pr($id)
	{		
		$data = $this->MaterialPurchaseRequest_model->get_where_many(['purchase_request_id' => $id]);
		echo json_encode($data);
	}

	public function ajax_get_material_rfq($id)
	{		
		$data = $this->RequestForQoutationMaterial_model->get_where_many(['request_for_qoutation' => $id]);
		echo json_encode($data);
	}

	public function ajax_get_sales_distribution($id)
	{
		$data = $this->SalesAndDistribution_model->get_where_many(['vendor_id' => $id]);
		echo json_encode($data);
	}

	/**
	 * Get PR Material by Vendor
	 */
	public function ajax_get_pr_material_by_vendor($id)
	{
		$material = get_material_pr($_GET['pr_id']);
		$data = [];
		foreach($material as $key => $item)
		{
			$data[$key] = $item;
			$row = get_material_vendor_row($item['material_id'], $id);
            if($row) 
            {
            	$data[$key]['sales_price'] = $row['sales_price'];
            } 
            else
            {
            	$data[$key]['sales_price'] = '';
            }
		}
		echo json_encode($data);
	}
}
