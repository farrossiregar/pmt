<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Region extends CI_Controller {

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

		$this->load->model('Region_model');
		$this->model = $this->Region_model;
	}

	public function index()
	{
		$params['page'] = 'region/index';
		$params['data'] = $this->model->data_();
		$this->load->view('layouts/main', $params);
	}

	public function insert()
	{
		if($this->input->post())
		{
			$post  			= $this->input->post('Region');

			$this->db->insert($this->model->t_table, $post);
			
			$this->session->set_flashdata('messages', 'Data berhasil disimpan');

			redirect('region/index','location');
		}
		
		$params['group'] = $this->Region_model->data_();
		$params['page'] = 'region/form';

		$this->load->view('layouts/main', $params);
	}

	/**
	 * Edit
	 * @param  integer $id
	 * @return void
	 */
	public function edit($id=0)
	{
		$model = $this->model->get_by_id($id);

		if($this->input->post())
		{
			$post  = $this->input->post('Region');

			$this->db->where('id', $id);
            $this->db->update($this->model->t_table, $post);
            $this->db->flush_cache();

			$this->session->set_flashdata('messages', 'Data berhasil disimpan');

			redirect('region/index','location');
		}
		
		$params['page'] = 'region/form';
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

		$this->session->set_flashdata('messages', 'Data deleted');

		redirect(site_url('region'));
	}
}
