<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vehiclevendor extends CI_Controller {

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

		$this->load->model('Vehiclevendor_model');
		$this->load->model('Vehicle_model');
		$this->model = $this->Vehiclevendor_model;
	}

	function index()
	{
		$params['page'] 		= 'vehicle-vendor/index';
		$params['data'] 		= $this->Vehicle_model->data_();
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
	function setvehicle($id)
	{
		$params['page'] 		= 'vehicle-vendor/set_vehicle';
		$params['vehicle']		= $this->Vehicle_model->get_by_id($id);

		if($this->input->post())
		{
			$post					= $this->input->post('Vehicle');
			$post['vehicle_id'] 	= $id;
			$post['vendor_id'] 		= $this->session->userdata('vendor_id');
			$post['sewa'] 			= replace_idr($post['sewa']);
			$post['created_at'] 	= date('Y-m-d H:i:s');
			$post['updated_at'] 	= date('Y-m-d H:i:s');
			
			$this->db->insert('vehicle_vendor', $post);		
            $this->db->flush_cache();
			$this->session->set_flashdata('messages', 'Data berhasil disimpan');

			redirect('vehiclevendor/index','location');
		}

		$this->load->view('layouts/main', $params);
	}

	/**
	 * Edit 
	 * @param  $id
	 */
	function edit($id)
	{
		$params['page'] 		= 'vehicle-vendor/set_vehicle';
		$params['vehicle']		= $this->Vehicle_model->get_by_id($_GET['vehicle_id']);
		$params['data']			= $this->model->get_by_id($id);
		
		if($this->input->post())
		{
			$post					= $this->input->post('Vehicle');
			$post['sewa'] 			= replace_idr($post['sewa']);
			$post['updated_at'] 	= date('Y-m-d H:i:s');
			
			$this->db->where('id', $id);
			$this->db->update('vehicle_vendor', $post);		
            $this->db->flush_cache();
			$this->session->set_flashdata('messages', 'Data berhasil disimpan');

			redirect('vehiclevendor/index','location');
		}

		$this->load->view('layouts/main', $params);
	}

	public function delete($id=0)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->model->t_table);

		$this->session->set_flashdata('messages', 'Data berhasil dihapus');

		redirect(site_url('salesDistribution'));
	}
}
