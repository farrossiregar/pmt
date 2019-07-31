<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {


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
		$this->load->model('User_model');
		$this->model = $this->User_model;
	}

	public function index()
	{
		$params = [];

		$params['page'] = 'user/index';
		$params['data'] = $this->model->data_user();

		$this->load->view('layouts/main', $params);
	}

	/**
	 * Autologin
	 * @return redirect
	 */
	public function autologin($id)
	{	
		$key = $this->input->get('key');

		$query = $this->db->query("SELECT * FROM user WHERE id='". $id."' AND password='".$key."'");		
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
				}
			}

			redirect('home', 'location');

		else:
			$this->session->set_flashdata('messages', 'Session key tidak ditemukan');
			redirect('user/index');
		endif;
	}

	/**
	 * Back to Admin
	 * @return redirect
	 */
	public function backtoadmin()
	{
    	if($this->session->userdata('is_login_admin') == 1):
    		$query = $this->db->query("SELECT * FROM user WHERE user_group_id=1");		
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
				$this->session->set_userdata('is_login_admin', "");
				
				if($row->user_group_id == 7)
				{
					$vendor = $this->db->get_where('vendor_of_material', ['email' => $row->username])->row();
					if($vendor)
					{
						$this->session->set_userdata('vendor_id', $vendor->id);
					}
				}

				redirect('home', 'location');
			endif;
    	else:

    	endif;
	}

	public function profile()
	{
		$params = [];

		$params['page'] = 'user/index';
		$params['data'] = $this->model->data_user();

		$this->load->view('layouts/main', $params);
	}

	public function insert()
	{
		if($this->input->post())
		{
			$post  = $this->input->post('User');
			$post['password'] = md5($post['password']);
			$post['create_time'] = date('Y-m-d H:i:s');
			
			$this->db->insert('user', $post);

			$this->session->set_flashdata('messages', 'User Saved.');

			redirect('user/index','location');
		}
		
		$params['page'] = 'user/form';

		$this->load->view('layouts/main', $params);
	}

	public function edit($id=0)
	{
		$model = $this->model->get_by_id($id);

		if($this->input->post())
		{
			$post  = $this->input->post('User');

			if(!empty($post['password'])){
				$post['password'] = md5($post['password']);				
			}else{
				unset($post['password']);
			}
			
			$post['update_time'] = date('Y-m-d H:i:s');

			$this->db->where('id', $id);
            $this->db->update($this->model->t_table, $post);

			$this->session->set_flashdata('messages', 'User Saved.');

			redirect('user/index','location');
		}
		
		$params['page'] = 'user/form';
		$params['data'] = $model;
		
		$this->load->view('layouts/main', $params);
	}

	/**
	 * [unlock description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function unlock($id)
	{
		$this->db->where(['id' => $id]);
		$this->db->update('user', ['is_lock' => 0]);

		$this->session->set_flashdata('messages', 'User Sales berhasil di unlock');

		redirect('user/index','location');
	}
	
	/**
	 * [lock description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function lock($id)
	{
		$this->db->where(['id' => $id]);
		$this->db->update('user', ['is_lock' => 1]);

		$this->session->set_flashdata('messages', 'User Sales berhasil di lock');

		redirect('user/index','location');
	}

	/**
	 * [delete description]
	 * @param  integer $id [description]
	 * @return [type]      [description]
	 */
	public function delete($id=0)
	{
		$this->db->where(['id' => $id]);
		$this->db->update('user', ['disabled' => 1]);
		
		$this->session->set_flashdata('messages', 'User Deleted.');

		redirect(site_url('user'));
	}

	/**
	 * Logout
	 * @param  -
	 * @return -
	 **/
	public function signout()
	{
		$this->session->sess_destroy();
		redirect('login', 'location');
	}
}
