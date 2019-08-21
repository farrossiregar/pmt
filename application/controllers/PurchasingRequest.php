<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PurchasingRequest extends CI_Controller {


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
			$this->data['division'] = $this->session->userdata('divisi');
			$this->data['branch_id'] = $this->session->userdata('branch_id');
			$this->data['position_id'] = $this->session->userdata('position_id');
		endif;

		$this->load->model('PurchaseRequest_model');
		$this->load->model('MaterialPurchaseRequest_model');
		$this->load->model('Material_model');
		$this->load->model('Division_model');
		$this->load->model('GroupOfMaterial_model');
		$this->load->model('MasterUnit_model');
		$this->load->model('Project_model');
		$this->model = $this->PurchaseRequest_model;
	}

	public function index()
	{		
		$params['position'] = $this->data['position_id'];
		$params['user_id']	= $this->data['user_id'];
		$params['access_id']	= $this->session->userdata('access_id');
		$params['page'] = 'purchasing_request/index';
		$params['data'] = $this->model->data_($this->data['user_id']);
		
		$this->load->view('layouts/main', $params);
	}

	/**
	 * PDF
	 * @param  id
	 * @return pdf
	 */
	public function pdf($id)
	{
		$params['data'] = $this->model->get_by_id($id);;
		$params['material'] = $this->MaterialPurchaseRequest_model->get_where_many(['material_purchase_request.purchase_request_id' => $id]);

		$html = $this->load->view('pages/purchasing_request/pdf', $params, true);
		//this the the PDF filename that user will get to download
		$pdfFilePath = "Purchase-Request-". date('d M Y') .".pdf";

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

	public function ajaxGetMaterial($id)
	{
		$data = $this->MaterialPurchaseRequest_model->get_where_many(['purchase_request_id' => $id]);

		echo json_encode($data);
	}

	public function material($id)
	{
		$model = $this->model->get_by_id($id);
		if(! isset($model))
			redirect('PurchasingRequest/index','location');

		$params['page'] = 'purchasing_request/material_index';
		$params['data'] = $this->MaterialPurchaseRequest_model->get_where_many(['purchase_request_id' => $id]);
		$params['header'] = $model;
		$this->load->view('layouts/main', $params);
	}

	/**
	 * Insert
	 * @param  integer $id
	 */
	public function insert($id=0)
	{	
		$params = [];
		if($this->input->post())
		{
			$post = $this->input->post('purchasingRequest');			
			
			$post['created_by'] = $this->data['user_id'];
			
			if($this->input->post('purchase_param') == 'purchase_request'){
				$id = $this->model->submitPurchaseRequest($this->input->post(), $this->data['user_id'], $this->data['branch_id']);
				$this->session->set_flashdata('messages', 'Data berhasil disimpan');
				redirect('PurchasingRequest', 'location');
			}

			$id = $this->model->add_data($post);
			
			$this->session->set_flashdata('messages', 'Data berhasil disimpan');

			redirect('PurchasingRequest/add_material/'.$id,'location');
		}

		if(!empty($id))
		{
			$params['data'] = $this->model->get_by_id($id);
		}

		$params['id'] = $id;
		$params['group_material'] = $this->model->getGroupMaterial();
		$params['project'] = $this->Project_model->data_('pm', $this->data['user_id']);
		$params['page'] = 'purchasing_request/form'; //'purchasing_request/form_purchasing';

		$this->load->view('layouts/main', $params);
	}

	public function getPurchasingRequest(){
		$id = $this->input->get('id');
		$data = $this->model->getPR($id);
		echo json_encode($data);
	}

	/**
	 * Receive Status
	 * @return 
	 */
	public function receive()
	{
		$approval = $this->model->submitReceive($this->input->post(), $this->data['user_id']);

		echo json_encode($approval);
	}

	/**
	 * Approve 
	 * @return json
	 */
	public function approval()
	{	
		$approval = $this->model->submitApproval($this->input->post(), $this->data['user_id']);

		echo json_encode($approval);
	}

	public function edit($id)
	{
		$model = $this->model->get_by_id($id);
		if($this->input->post())
		{
			$post = $this->input->post('purchasingRequest');
			$this->db->where('id', $id);
            $this->db->update($this->model->t_table, $post);
            $this->db->flush_cache();

			$this->session->set_flashdata('messages', 'Data berhasil disimpan');

			redirect('PurchasingRequest/index','location');
		}

		$params['data'] = $model;
		$params['page'] = 'purchasing_request/form_purchasing';
		$this->load->view('layouts/main', $params);
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->model->t_table);

		$this->session->set_flashdata('messages', 'Data berhasil dihapus');

		redirect(site_url('purchasingRequest'));
	}

	public function add_material($id)
	{
		$model = $this->model->get_by_id($id);
		if(! isset($model))
			redirect('PurchasingRequest/index','location');

		if($this->input->post())
		{
			$post	= $this->input->post('purchasingRequest');			
			foreach ($post as $key => $value) {
				$value['purchase_request_id'] = $id;
				if($value['material_id'] == "new")
					$value['material_id'] = "";

				$this->db->insert('material_purchase_request', $value);
			}

			$this->session->set_flashdata('messages', 'Data berhasil disimpan');
			redirect('PurchasingRequest/material/'.$id,'location');
		}

		$this->db->from('material');
		$this->db->like("division", $this->data['division']);
		$i = $this->db->get();
	
		$params['material'] = $i->result_array();
		$params['data'] = $model;
		$params['page'] = 'purchasing_request/form';
		$this->load->view('layouts/main', $params);
	}

	function editMaterial($id_header = 0, $id_content = 0)
	{
		$model = $this->MaterialPurchaseRequest_model->get_by_id($id_content);
		if(! isset($model))
			redirect('PurchasingRequest/index','location');

		if($this->input->post())
		{
			
			$post	= $this->input->post('Material');
			if($post['material_id'] == "new")
				$post['material_id'] = "";
			else
				$post['new_material'] = "";

			$this->db->where('id', $id_content);
            $this->db->update($this->MaterialPurchaseRequest_model->t_table, $post);
            $this->db->flush_cache();

			$this->session->set_flashdata('messages', 'Data berhasil disimpan');

			redirect('PurchasingRequest/material/'.$id_header,'location');
		}

		$this->db->from('material');
		$this->db->like("division",$this->data['division']);
		$i = $this->db->get();
	
		$params['material'] = $i->result_array();
		$params['page'] = 'purchasing_request/form_edit_material';
		$params['data'] = $model;
		$params['header'] = $model = $this->model->get_by_id($model['purchase_request_id']);
		
		$this->load->view('layouts/main', $params);
	}

	function deleteMaterial($id_header, $id_content)
	{
		$this->db->where('id', $id_content);
		$this->db->delete('material_purchase_request');

		$this->session->set_flashdata('messages', 'Data berhasil dihapus');

		redirect(site_url('PurchasingRequest/material/'.$id_header));
	}
}