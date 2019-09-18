<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor extends CI_Controller {


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

		$this->load->model('VendorOfMaterial_model');
		$this->load->model('GroupOfVendor_model');
		$this->model = $this->VendorOfMaterial_model;
	}

	public function index()
	{
		$params['page'] = 'vendor/index';
		$params['data'] = $this->model->data_();
		$this->load->view('layouts/main', $params);
	}

	/**
	 * Autologin
	 * @return redirect
	 */
	public function autologin()
	{	
		$email = $this->input->get('email');

		$query = $this->db->query("SELECT * FROM user WHERE email='". $email."'");		
		// set setting
		$data = $this->db->get_where('setting', ['id' => 1]);
		$data = $data->row_array();

		$this->session->set_userdata('meta_title', $data['meta_title']);
		$this->session->set_userdata('meta_description', $data['meta_description']);

		if ($row = $query->row()):

			$group = $this->db->get_where('user_group', ['id' => $row->user_group_id])->row();

			$this->session->set_userdata('username', $row->username);
			$this->session->set_userdata('name', $row->name);
			$this->session->set_userdata('divisi', $row->divisi_id);
			$this->session->set_userdata('branch_id', $row->branch_id);
			$this->session->set_userdata('position_id', $row->position_id);
			$this->session->set_userdata('phone', $row->phone);
			$this->session->set_userdata('id_user', $row->id);
			$this->session->set_userdata('user_id', $row->id);
			$this->session->set_userdata('employee_id', $row->id);
			$this->session->set_userdata('access_id', $row->user_group_id);
			$this->session->set_userdata('foto', $row->foto);
			$this->session->set_userdata('group', $group->user_group);
			$this->session->set_userdata('is_login_admin', 1);
			
			if($row->user_group_id == 7)
			{
				$vendor = $this->db->get_where('vendor_of_material', ['email' => $row->username])->row();
				if($vendor)
				{
					$this->session->set_userdata('vendor_id', $vendor->id);
					$this->session->set_userdata('vendor_type', $vendor->vendor_type);
				}
			}

			redirect('home', 'location');

		else:
			$this->session->set_flashdata('messages', 'Session key tidak ditemukan');
			redirect('vendor/index');
		endif;
	}
	
	public function insert()
	{
		if($this->input->post())
		{
			$post  				= $this->input->post('Vendor');

			# Insert user
			$param['password'] 		= md5($this->input->post('password'));
			$param['name'] 			= $post['name'];
			$param['email'] 		= $post['email'];
			$param['username'] 		= $post['email'];
			$param['active'] 		= 1;
			$param['user_group_id'] = 7;
			$this->db->insert('user', $param);
			$user_id = $this->db->insert_id();

            $this->db->flush_cache();

            $post['user_id'] = $user_id;
 			$this->db->insert($this->model->t_table, $post);
			
			$this->session->set_flashdata('messages', 'Data berhasil disimpan');

			redirect('vendor/index','location');
		}
		
		$params['group'] = $this->GroupOfVendor_model->data_();
		$params['page'] = 'vendor/form';

		$this->load->view('layouts/main', $params);
	}

	public function edit($id=0)
	{
		$model = $this->model->get_by_id($id);

		if($this->input->post())
		{
			$post  = $this->input->post('Vendor');

			# Insert user
			if(!empty($this->input->post('password')))
			{
				$param['password'] 		= md5($this->input->post('password'));				
			}
			$param['name'] 			= $post['name'];
			$param['email'] 		= $post['email'];
			$param['username'] 		= $post['email'];
			$param['active'] 		= 1;
			$param['user_group_id'] = 7;
    		
    		$row = $this->db->get_where('user', ['email' => $param['email']])->row_array();
			if(count($row) > 0)
			{
				$this->db->where('email', $param['email']);
            	$this->db->update('user', $param);
            	$user_id = $row['id'];
			}
			else
			{
				$this->db->insert('user', $param);
				$user_id = $this->db->insert_id();
			}
			$this->db->flush_cache();
			
			$post['user_id'] = $user_id;

			$this->db->where('id', $id);
            $this->db->update($this->model->t_table, $post);
            $this->db->flush_cache();

			$this->session->set_flashdata('messages', 'Data berhasil disimpan');

			redirect('vendor/index','location');
		}
		
		$params['page'] = 'vendor/form';
		$params['data'] = $model;
		$params['group'] = $this->GroupOfVendor_model->data_();
		
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

		redirect(site_url('vendor'));
	}
}
