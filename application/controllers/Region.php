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
			$id = $this->db->insert_id();
			// add cluster
            $post = $this->input->post();
            if(isset($post['cluster']))
            {
            	foreach($post['cluster'] as $item)
            	{
            		$this->db->trans_start();
	            	$var['name'] 		= $item;
	            	$var['region_id']	= $id;

	            	$this->db->insert('region_cluster', $var);
	            	$this->db->trans_complete();
	            }
            }
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

            // add cluster
            $post = $this->input->post();
            if(isset($post['cluster']))
            {
            	foreach($post['cluster'] as $item)
            	{
            		$this->db->trans_start();
	            	$var['name'] 		= $item;
	            	$var['region_id']	= $id;
	            	$this->db->insert('region_cluster', $var);
	            	$this->db->trans_complete();
	            }
            }

            if(isset($post['edit_id']))
            {
            	foreach($post['edit_id'] as $k => $item)
            	{
            		$this->db->trans_start();
	            	$var['name'] 		= $post['edit_name'][$k];
	            	$this->db->where('id', $item);
	            	$this->db->update('region_cluster', $var);
	            	$this->db->trans_complete();
	            }
            }

			$this->session->set_flashdata('messages', 'Data berhasil disimpan');

			redirect('region/index','location');
		}
		
		$params['page'] = 'region/form';
		$params['data'] = $model;
		$params['cluster'] = $this->db->get_where('region_cluster', ['region_id'=>$id])->result_array();
		
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

	/**
	 * Delete
	 * @param  integer $id [description]
	 * @return [type]      [description]
	 */
	public function deletecluster($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('region_cluster');

		$this->session->set_flashdata('messages', 'Data deleted');

		redirect(site_url('region/edit/'.$_GET['region_id']));
	}
}