<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Projectcode extends CI_Controller {


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
			$this->data['username'] = $this->session->userdata('username');
			$this->data['user_id'] = $this->session->userdata('user_id');
			$this->data['user_level'] = $this->session->userdata('user_level');
			$this->data['menu_name'] = $this->uri->segment('2');
			$this->data['sub_name'] = $this->uri->segment('3');
		endif;
		$this->load->model('Projectcode_model');
		$this->model = $this->Projectcode_model;
	}

	public function index()
	{
		$params = [];

		$params['page'] = 'project-code/index';
		$params['data'] = $this->model->data_();

		$this->load->view('layouts/main', $params);
	}

	public function insert()
	{
		if($this->input->post())
		{
			$post  = $this->input->post('project_code');
			$post['created_at'] = date('Y-m-d H:i:s');
			$post['updated_at'] = date('Y-m-d H:i:s');

			$this->db->insert($this->model->t_table, $post);

			$this->session->set_flashdata('messages', 'Data berhasil disimpan');

			redirect('projectcode/index','location');
		}
		
		$params['page'] = 'project-code/form';

		$this->load->view('layouts/main', $params);
	}

	public function edit($id=0)
	{
		$model = $this->model->get_by_id($id);

		if($this->input->post())
		{
			$post  = $this->input->post('project_code');
			$post['update_time'] = date('Y-m-d H:i:s');

			$this->db->where('id', $id);
            $this->db->update($this->model->t_table, $post);

			$this->session->set_flashdata('messages', 'Data berhasil disimpan');

			redirect('projectcode/index','location');
		}
		
		$params['page'] = 'projectcode/form';
		$params['data'] = $model;
		
		$this->load->view('layouts/main', $params);
	}

	public function delete($id=0)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->model->t_table);

		$this->session->set_flashdata('messages', 'Data berhasil dihapus');
		
		redirect(site_url('projectcode'));
	}
}