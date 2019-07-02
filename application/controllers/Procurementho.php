<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Controller Login
 * @by		: doni (doni.enginer@gmail.com)
 * @date	: Oktober 2012
 **/

class Procurementho extends CI_Controller {

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

		$this->load->model('SalesAndDistribution_model');
		$this->model = $this->SalesAndDistribution_model;
	}

	public function index()
	{
		$params = [];

		$params['page'] = 'employee/index';
		$params['data'] = $this->model->data_user();

		$this->load->view('layouts/main', $params);
	}

	/**
	 * Catalog
	 * @return view
	 */
	public function catalog()
	{
		$params = [];

		$params['page'] = 'proqurementho/catalog';
		$params['data'] = $this->model->data_all($_GET);

		$this->load->view('layouts/main', $params);
	}
}
