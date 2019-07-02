<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CI_Controller {


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
		$this->load->model('Company_model');
		$this->model = $this->Company_model;
	}

	public function index()
	{
		$params = [];

		$params['page'] = 'company/index';
		$params['data'] = $this->model->data_();

		$this->load->view('layouts/main', $params);
	}

	public function insert()
	{
		if($this->input->post())
		{
			$post  = $this->input->post('Company');
			$post['created_at'] = date('Y-m-d H:i:s');

			# upload file
			$config = Array();
			$config['upload_path'] 		= './upload/';
			$config['allowed_types'] 	= '*';
			$config['max_size']			= '2000';
			#$config['max_width'] 		= '2000';
			#$config['max_height']		= '2000';

			$this->load->library('upload', $config);
			
			if (!$this->upload->do_upload("logo"))
			{

				$error = array('error' => $this->upload->display_errors());
				print_r($error);
			}
			else
			{
				$upload_data = $this->upload->data();
				
				$file = $upload_data['file_name'];
				$post['logo'] = $file;
			}

			$this->db->insert($this->model->t_table, $post);

			$this->session->set_flashdata('messages', 'Data berhasil disimpan');

			redirect('company/index','location');
		}
		
		$params['page'] = 'company/form';

		$this->load->view('layouts/main', $params);
	}

	public function edit($id=0)
	{
		$model = $this->model->get_by_id($id);

		if($this->input->post())
		{
			$post  = $this->input->post('Company');
			$post['updated_at'] = date('Y-m-d H:i:s');
			
			$this->db->where('id', $id);
            $this->db->update($this->model->t_table, $post);

			$this->session->set_flashdata('messages', 'Data berhasil disimpan');

			redirect('company/index','location');
		}
		
		$params['page'] = 'company/form';
		$params['data'] = $model;
		
		$this->load->view('layouts/main', $params);
	}

	public function delete($id=0)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->model->t_table);
			
		$this->session->set_flashdata('messages', 'Data berhasil dihapus');

		redirect(site_url('company'));
	}
}
