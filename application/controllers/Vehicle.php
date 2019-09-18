<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vehicle extends CI_Controller {


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
			$this->data['division'] = $this->session->userdata('divisi');
			$this->data['menu_name'] = $this->uri->segment('2');
			$this->data['sub_name'] = $this->uri->segment('3');
			$this->data['sub_name'] = $this->uri->segment('3');
		endif;

		$this->load->model('Vehicle_model');
		$this->model = $this->Vehicle_model;
	}

	public function index()
	{
		$params['page'] = 'vehicle/index';
		$params['data'] = $this->model->data_();

		$this->load->view('layouts/main', $params);
	}

	/**
	 * Vehicle
	 * @return void
	 */
	public function insert()
	{
		if($this->input->post())
		{ 
			$post	= $this->input->post('Vehicle');
			$post['created_at'] = date('Y-m-d H:i:s');

			$this->db->insert($this->model->t_table, $post);
			$this->session->set_flashdata('messages', 'Data berhasil disimpan');

			redirect('vehicle/index','location');
		}
		
		$params['page'] = 'vehicle/form';
		$this->load->view('layouts/main', $params);
	}

	public function edit($id=0)
	{
		$model = $this->model->get_by_id($id);

		if($this->input->post())
		{
			$post	= $this->input->post('Vehicle');
			$post['updated_at']	= date('Y-m-d H:i:s');

			$this->db->where('id', $id);
            $this->db->update($this->model->t_table, $post);
            $this->db->flush_cache();

			$this->session->set_flashdata('messages', 'Data berhasil disimpan');

			redirect('vehicle/index','location');
		}
		
		$params['page'] = 'vehicle/form';
		$params['data'] = $model;
		
		$this->load->view('layouts/main', $params);
	}


	/**
	 * [delete description]
	 * @param  integer $id [description]
	 * @return [type]      [description]
	 */
	public function delete($id=0)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->model->t_table);

		$this->session->set_flashdata('messages', 'Data berhasil dihapus');

		redirect(site_url('vehicle'));
	}
}
