<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SalesDistribution extends CI_Controller {

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

			$vendor = $this->db->get_where('vendor_of_material', ['user_id'=> $this->data['user_id']])->row_array();
			
			$this->data['vendor_id'] = $vendor['id'];

		endif;

		$this->load->model('SalesAndDistribution_model');
		$this->load->model('GroupOfMaterial_model');
		$this->load->model('Material_model');
		$this->load->model('GroupOfVendor_model');
		$this->load->model('VendorOfMaterial_model');
		$this->load->model('MasterPeriod_model');
		$this->model = $this->SalesAndDistribution_model;
	}

	function index()
	{
		$params['page'] 		= 'salesDistributionPurcashing/index';
		$params['data'] 		= $this->Material_model->data_();
		$params['vendor_id']	= $this->data['vendor_id'];

		$this->load->view('layouts/main', $params);
	}

	function insert()
	{
		if($this->input->post())
		{
			$post	= $this->input->post('salesDistribution');
			foreach ($post as $key => $value) {

				$this->db->insert($this->model->t_table, $value);		
	            $this->db->flush_cache();
				$this->session->set_flashdata('messages', 'Data berhasil disimpan');
			}
			redirect('salesDistribution/index','location');
		}

		$params['page'] = 'salesDistributionPurcashing/form';
		$params['group'] = $this->GroupOfMaterial_model->data_();
		$params['group_vendor'] = $this->GroupOfVendor_model->data_();
		$params['period'] = $this->MasterPeriod_model->data_();
		$this->load->view('layouts/main', $params);
	}

	/**
	 * Set Price
	 */
	function setprice($id)
	{
		$params['page'] 		= 'salesDistributionPurcashing/set_price';
		$params['material']		= $this->Material_model->get_by_id($id);
		$params['period'] = $this->MasterPeriod_model->data_();

		if($this->input->post())
		{
			$post					= $this->input->post('salesDistribution');
			$post['sales_price'] 	= replace_idr($post['sales_price']);
			$post['material_id']	= $id;
			$post['vendor_id'] 		= $this->data['vendor_id'];

			if(isset($_POST['from']) AND isset($_POST['to']) AND $_POST['from'] !="" AND $_POST['to'] != "")
			{
				$post['supply_abbility_value'] = $_POST['from']." ".$_POST['to'];
			}else{
				$post['supply_abbility_value'] = "";
			}

			if(isset($_POST['disc']) AND count($_POST['disc']) > 0)
			{
				$temp_disc = [];
				foreach ($_POST['disc'] as $key => $value) {
					$temp_disc[] = $value['start_qty'].",".$value['end_qty'].",".$value['discont'];
				}
				$post['discont_val'] = implode(";", $temp_disc);
			}else{
				$post['discont_val'] = "";
			}

			$this->db->insert($this->model->t_table, $post);		
            $this->db->flush_cache();
			$this->session->set_flashdata('messages', 'Data berhasil disimpan');

			redirect('salesDistribution/index','location');
		}

		$this->load->view('layouts/main', $params);
	}

	/**
	 * Edit 
	 * @param  $id
	 */
	function edit($id)
	{
		$model = $this->model->get_by_id($id);
		if($this->input->post())
		{
			$post	= $this->input->post('salesDistribution');
			$post['sales_price'] 	= replace_idr($post['sales_price']);
			
			if(isset($_POST['from']) AND isset($_POST['to']) AND $_POST['from'] !="" AND $_POST['to'] != "")
			{
				$post['supply_abbility_value'] = $_POST['from']." ".$_POST['to'];
			}else{
				$post['supply_abbility_value'] = "";
			}

			if(isset($_POST['disc']) AND count($_POST['disc']) > 0)
			{
				$temp_disc = [];
				foreach ($_POST['disc'] as $key => $value) {
					$temp_disc[] = $value['start_qty'].",".$value['end_qty'].",".$value['discont'];
				}
				$post['discont_val'] = implode(";", $temp_disc);
			}else{
				$post['discont_val'] = "";
			}

			unset($post['material_group']);

			$this->db->where('id', $id);
            $this->db->update($this->model->t_table, $post);
            $this->db->flush_cache();
			redirect('salesDistribution/index','location');
			
		}

		$params['page'] = 'salesDistributionPurcashing/form_edit';
		$params['group'] = $this->GroupOfMaterial_model->data_();
		$params['group_vendor'] = $this->GroupOfVendor_model->data_();
		$params['period'] = $this->MasterPeriod_model->data_();

		$params['material'] = $this->Material_model->get_where_one(['id' => $model['material_id']]);
		$params['vendor'] = $this->VendorOfMaterial_model->get_where_one(['id' => $model['vendor_id']]);
		
		if(empty($params['material']))
			$params['data_material'] = [];
		else
			$params['data_material'] = $this->Material_model->get_where_many(['material_group' => $params['material']['material_group']]);

		if(empty($params['vendor']))
			$params['data_vendor'] = [];
		else
			$params['data_vendor'] = $this->VendorOfMaterial_model->get_where_many(['group_vendor' => $params['vendor']['group_vendor']]);
			
		$params['data'] = $model;
		$this->load->view('layouts/main', $params);
	}

	public function delete($id=0)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->model->t_table);

		$this->session->set_flashdata('messages', 'Data berhasil dihapus');

		redirect(site_url('salesDistribution'));
	}

	function ajax_get_material()
	{
		$group_id = $_GET['id'];
		$this->db->from('material');
        $this->db->where_in('material_group	', $group_id);
        $query = $this->db->get();
        $temp = [];
	 	if($query->num_rows() > 0)
            $temp = $query->result_array();

        echo json_encode($temp);
	}

	function ajax_get_vendor()
	{
		$group_id = $_GET['id'];
		$this->db->from('vendor_of_material');
        $this->db->where_in('group_vendor', $group_id);
        $query = $this->db->get();
        $temp = [];
	 	if($query->num_rows() > 0)
            $temp = $query->result_array();

        echo json_encode($temp);
	}
}
