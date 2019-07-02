<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class importMaterial extends CI_Controller {

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

		$this->load->model('GroupOfMaterial_model');
	}
	
	public function index()
	{
		$params['page'] = 'importMaterial/form';

		if($this->input->post())
		{

			$post = $this->input->post();
			# upload file
			$config = Array();
			$config['upload_path'] 		= './upload/';
			$config['allowed_types'] 	= '*';
			$config['max_size']			= '2000';
			$config['max_width'] 		= '2000';
			$config['max_height']		= '2000';

			$this->load->library('upload', $config);
			if (!$this->upload->do_upload("file")):
				$error = array('error' => $this->upload->display_errors());
				print_r($error);
			else:

				$upload_data = $this->upload->data();
				
				// Load the spreadsheet reader library
				$this->load->library('Excel_reader');

				$this->excel_reader->setOutputEncoding('230787');
				$file = $upload_data['full_path'];
				$this->excel_reader->read($file);
				error_reporting(E_ALL ^ E_NOTICE);

				$data = $this->excel_reader->sheets[0];
			    for ($i = 1; $i <= $data['numRows']; $i++) {
			        
			        if ($data['cells'][$i][1] == '') continue;

			        if($i==1) continue;
			        
			        $g = $this->GroupOfMaterial_model->get_where_one(['name' => $data['cells'][$i][2]]);

			        if(isset($g)){
			        	$id = (int) $g['id'];
			        }
			        else{
			        	$group['name'] = $data['cells'][$i][2];
			        	$id = (int) $this->GroupOfMaterial_model->add_data($group);			        	
			        }
			        
			        $dataexcel['name'] = $data['cells'][$i][3];
			        $dataexcel['material_group'] = $id;

			        $this->db->insert('material', $dataexcel);
			    }
				
				echo $i." => ";
				//delete file
	            $file = $config['upload_path'] . $upload_data['file_name'];
				unlink($upload_data['full_path']);

				redirect(site_url('importMaterial'));
			endif;

		}

		$this->load->view('layouts/main', $params);
	}
}
