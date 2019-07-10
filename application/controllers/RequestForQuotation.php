<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RequestForQuotation extends CI_Controller {


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

		$this->load->model('Material_model');
		$this->load->model('RequestForQoutation_model');
		$this->load->model('Division_model');
		$this->load->model('GroupOfMaterial_model');
		$this->load->model('MasterUnit_model');
		$this->load->model('PurchaseRequest_model');
		$this->load->model('MaterialPurchaseRequest_model');
		$this->load->model('RequestForQoutationMaterial_model');
		$this->model = $this->RequestForQoutation_model;
	}

	public function index()
	{
		$params['page'] = 'requestForQuotation/index';
		$params['data'] = $this->model->data_();
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
			$this->db->update('request_for_qoutation_vendor', ['is_nego' => 1]);
			
			$this->session->set_flashdata('messages', 'Nego Submited.');

			redirect('requestForQuotation/bac/'. $id,'location');
		}


		$this->load->view('layouts/main', $params);
	}

	/**
	 * [bac description]
	 * @return [type] [description]
	 */
	public function bac($id)
	{
		$params['page'] 			= 'requestForQuotation/bac';
		$params['data'] 			= $this->model->get_by_id($id);
		$params['vendor'] 			= $this->model->vendor($id);
		$params['material']			= $this->model->material($id);
		
		$this->load->view('layouts/main', $params);
	}

	public function ajax_get_material($divisi)
	{
		$this->db->from('material');
		
		if($divisi != 0)
			$this->db->like("division", $divisi);
		
		$i = $this->db->get();
	
		$material = $i->result_array();
		echo json_encode($material);
	}

	public function ajax_get_purchase_material($purchase_request_id)
	{
		if($purchase_request_id != 0)
			$params['purchase_request_id'] = $purchase_request_id;

		$data = $this->MaterialPurchaseRequest_model->get_where_many($params);

		echo json_encode($data);
	}

	/**
	 * Insert
	 * @return redirect
	 */
	public function insert()
	{
		if(isset($_GET['pr_id']))
		{
			$params['pr'] 			= $this->PurchaseRequest_model->get_by_id($_GET['pr_id']);
			$params['pr_number'] 	= $params['pr']['no'];
			$params['material']		= get_material_pr($_GET['pr_id']);
		}

		if($this->input->post())
		{			
			$post 							= $this->input->post();
			$rfq							= $this->input->post('RFQ');
			$rfq['purchase_request_id'] 	= $_GET['pr_id'];

			$rfq_material	= $this->input->post('RFQMaterial');
			$rfq_id = $this->model->add_data($rfq);

			foreach ($rfq_material as $key => $value)
			{
				$value['request_for_qoutation'] = $rfq_id;
				$this->db->insert($this->RequestForQoutationMaterial_model->t_table, $value);
			}

			if(isset($post['vendor_id']))
			{
				foreach($post['vendor_id'] as $item)
				{
					$param = [];
					$param['vendor_id'] 				= $item;
					$param['request_for_qoutation_id'] = $rfq_id;
					$param['created_at'] 				= date('Y-m-d H:i:s');

					$this->db->insert('request_for_qoutation_vendor', $param);
				}
			}

			if(isset($post['material_id']))
			{
				foreach($post['material_id'] as $key => $item)
				{
					$param = [];
					$param['material_id'] 				= $item;
					$param['qty'] 						= $post['qty'][$key];
					$param['request_for_qoutation'] 	= $rfq_id;
					$param['created_at'] 				= date('Y-m-d H:i:s');

					$this->db->insert('request_for_qoutation_material', $param);
				}
			}

			if(isset($post['term']))
			{
				foreach($post['term'] as $key => $item)
				{
					$param = [];
					$param['term'] 						= $item;
					$param['cond'] 						= $post['cond'][$key];
					$param['request_for_qoutation_id']	= $rfq_id;
					$param['created_at'] 				= date('Y-m-d H:i:s');

					$this->db->insert('request_for_qoutation_term_condition', $param);
				}
			}

			$this->session->set_flashdata('messages', 'Data berhasil disimpan');

			redirect('requestForQuotation/index','location');
		}

		$params['page'] 			= 'requestForQuotation/form';
		$params['request'] 			= $this->PurchaseRequest_model->get_where_many(['purchase_request.status' => 0]);

		$this->load->view('layouts/main', $params);
	}

	public function edit($id)
	{
		if($this->input->post())
		{
			$rfq	= $this->input->post('RFQ');
			$rfq_material	= $this->input->post('RFQMaterial');

			// update content header
			$this->db->where('id', $id);
            $this->db->update($this->model->t_table, $rfq);
	
			// delete child           
            $this->db->delete($this->RequestForQoutationMaterial_model->t_table, array('request_for_qoutation' => $id));

			foreach ($rfq_material as $key => $value) {
				$value['request_for_qoutation'] = $id;
				$this->db->insert($this->RequestForQoutationMaterial_model->t_table, $value);
			}

			$this->session->set_flashdata('messages', 'Data berhasil disimpan');

			redirect('requestForQuotation/index','location');
		}

		$params['data'] = $this->model->get_by_id($id);
		$params['pr'] 			= $this->PurchaseRequest_model->get_by_id($params['data']['purchase_request_id']);
		$params['pr_number'] 	= $params['pr']['no'];

		$params['material']		= $this->model->material($id);
		$params['vendor']		= $this->model->vendor($id);
		$params['term']			= $this->model->term($id);
		$params['page'] 		= 'requestForQuotation/form';
		$params['request']		= $this->PurchaseRequest_model->get_where_many(['purchase_request.status' => 0]);

		$this->load->view('layouts/main', $params);
	}

	public function delete($id)
	{
		$this->db->delete($this->model->t_table, array('id' => $id));
		$this->db->delete($this->RequestForQoutationMaterial_model->t_table, array('request_for_qoutation' => $id));

		$this->session->set_flashdata('messages', 'Data berhasil dihapus');

		redirect(site_url('requestForQuotation'));
	}

	
    public function pdf($id){
        $params['rfq'] = $this->model->getRFQ($id);
        //$params['material'] = $this->MaterialPO_model->get_where_many(['materi_po.po_id    ' => $params['po']['id']]);
        //$params['t'] = $this->TermConditionPo_model->get_where_many(['po_id    ' => $params['po']['id']]);
        $html = $this->load->view('pages/requestForQuotation/rfq_pdf', $params, true);
        //print_r($html);exit();
        //this the the PDF filename that user will get to download
        $pdfFilePath = "RFQ-". date('d M Y') .".pdf";

        //load mPDF library
        $this->load->library('m_pdf');

        $this->m_pdf = new mPDF();
        
        $this->m_pdf->showImageErrors = true;

        $this->m_pdf->SetHTMLHeader('<div style="text-align: center;"><img src="'.base_url().'assets/images/logo.png" /></div>');

        $this->m_pdf->AddPage('P', '', '', '', '',
            15, // margin_left
            10, // margin right
            5, // margin top
            5, // margin bottom
            5, // margin header
            5); // margin footer

           //generate the PDF from the given html
        $this->m_pdf->WriteHTML($html);

        //download it.
        $this->m_pdf->Output($pdfFilePath, "I");        
    }
}
