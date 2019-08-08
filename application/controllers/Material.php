<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Material extends CI_Controller {


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

		$this->load->model('Material_model');
		$this->load->model('Division_model');
		$this->load->model('GroupOfMaterial_model');
		$this->load->model('MasterUnit_model');
		$this->model = $this->Material_model;
	}

	public function index()
	{
		$params['page'] = 'material/index';

		$this->db->select("material.*, group_of_material.name as name_group, master_unit.name as name_unit, IFNULL(SUM(stock_material.stock), 0) as tot_stock");
		$this->db->from('material');
		$this->db->join('group_of_material', 'group_of_material.id = material.material_group', 'left');
		$this->db->join('master_unit', 'master_unit.id = material.order_unit', 'left');
		$this->db->join('stock_material', 'material.id = stock_material.material_id', 'left');

		if(isset($_GET['material_group']) and !empty($_GET['material_group']))
		{
			$this->db->where('material.material_group', $_GET['material_group']);
		}
		if(isset($_GET['order_unit']) and !empty($_GET['order_unit']))
		{
			$this->db->where('material.order_unit', $_GET['order_unit']);
		}
		if(isset($_GET['name']) and !empty($_GET['name']))
		{
			$this->db->like('material.name', $_GET['name']);
		}

		$this->db->group_by('material.id');
		$i = $this->db->get();
		$params['data'] = $i->result_array();
		$this->load->view('layouts/main', $params);
	}

	public function divisi()
	{
		$this->db->from('user');
		$this->db->where('id', $this->data['user_id'] );
		$i = $this->db->get();	
		$data =  $i->row_array();
		$branch = $data['branch_id'];


		$params['page'] = 'material/index_divisi';
		$this->db->select("material.*, group_of_material.name as name_group, master_unit.name as name_unit, SUM(stock_material.stock) as tot_stock");
		$this->db->from('material');
		$this->db->like("division", $this->data['division']);
		$this->db->join('group_of_material', 'group_of_material.id = material.material_group', 'left');
		$this->db->join('master_unit', 'master_unit.id = material.order_unit', 'left');
		$this->db->join('stock_material', 'material.id = stock_material.material_id', 'left');
		$this->db->where('stock_material.branch_id', $branch);
		$i = $this->db->get();
		$params['data'] = $i->result_array();

		$this->load->view('layouts/main', $params);
	}

	public function insert()
	{
		if($this->input->post())
		{ 
			$post	= $this->input->post('Material');

			if($post['material_group'] == "")
			{
				if($this->input->post('material_group_name') != "")
				{
					$this->db->insert('group_of_material', ['name' => $this->input->post('material_group_name'), 'created_at' => date('Y-m-d H:i:s') ]);
					$post['material_group'] =  $this->db->insert_id();
				}else $post['material_group'] = 0;
			}

			// new insert order unit
			if($post['order_unit'] == "")
			{
				if($this->input->post('order_unit_name') != "")
				{
					$this->db->insert('master_unit', ['name' => $this->input->post('order_unit_name'), 'created_at' => date('Y-m-d H:i:s') ]);
					$post['order_unit'] =  $this->db->insert_id();
				} else $post['order_unit'] = 0;

			}
			
			if($post['shipping_instruction_val'] != 1)
			{
				$post['overdelive_tol'] = "";
				$post['underdelive_tol'] = "";
				$post['stock_type'] = "";
			}

			$post['shipping_instruction'] = $post['shipping_instruction_val'];
			unset($post['shipping_instruction_val']);


			if($post['forecasting'] != 1)
			{
				$post['1_st_rem'] = "" ;
				$post['2_st_rem'] = "" ;
				$post['3_st_rem'] = "" ;
			}

			$post['reminder'] = $post['forecasting'];
			unset($post['forecasting']);			
			
			$this->db->insert($this->model->t_table, $post);
			$this->session->set_flashdata('messages', 'Data berhasil disimpan');
			redirect('material/index','location');
		}
		
		$params['page'] = 'material/form';
		$params['division'] = $this->Division_model->data_();
		$params['group'] = $this->GroupOfMaterial_model->data_();
		$params['unit'] = $this->MasterUnit_model->data_();
		$this->load->view('layouts/main', $params);
	}

	public function edit($id=0)
	{
		$model = $this->model->get_by_id($id);

		if($this->input->post())
		{
			$post	= $this->input->post('Material');

			if($post['material_group'] == "")
			{
				if($this->input->post('material_group_name') != "")
				{
					$this->db->insert('group_of_material', ['name' => $this->input->post('material_group_name'), 'created_at' => date('Y-m-d H:i:s') ]);
					$post['material_group'] =  $this->db->insert_id();
				}else $post['material_group'] = 0;
			}

			// new insert order unit
			if($post['order_unit'] == "")
			{
				if($this->input->post('order_unit_name') != "")
				{
					$this->db->insert('master_unit', ['name' => $this->input->post('order_unit_name'), 'created_at' => date('Y-m-d H:i:s') ]);
					$post['order_unit'] =  $this->db->insert_id();
				} else $post['order_unit'] = 0;

			}
			
			if($post['shipping_instruction_val'] != 1)
			{
				$post['overdelive_tol'] = "";
				$post['underdelive_tol'] = "";
				$post['stock_type'] = "";
			}

			$post['shipping_instruction'] = $post['shipping_instruction_val'];
			unset($post['shipping_instruction_val']);


			if($post['forecasting'] != 1)
			{
				$post['1_st_rem'] = "" ; 
				$post['2_st_rem'] = "" ; 
				$post['3_st_rem'] = "" ;
			}

			$post['reminder'] = $post['forecasting'];
			unset($post['forecasting']);	
			$this->db->where('id', $id);
            $this->db->update($this->model->t_table, $post);
            $this->db->flush_cache();

			$this->session->set_flashdata('messages', 'Data berhasil disimpan');

			redirect('material/index','location');
		}
		
		$params['page'] = 'material/form';
		$params['data'] = $model;
		$params['division'] = $this->Division_model->data_();
		$params['group'] = $this->GroupOfMaterial_model->data_();
		$params['unit'] = $this->MasterUnit_model->data_();
		
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

		redirect(site_url('material'));
	}
}
