<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Model Vehicle Vendor
 * @by		: doni(doni.enginer@gmail.com)
 * @date	: September 2019
 **/
 
 class Vehiclevendor_model extends CI_Model
 {
	var $t_table 	= 'vehicle_vendor';

	/**
	 * Constructor
	 * @param	-
	 * @return 	-
	 **/
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * Data Investasi
	 * @param	id, page, limit, search
	 * @return 	array
	 **/
	public function data_()
	{
		$this->db->from($this->t_table .' vv');
		$this->db->select('v.*, vv.sewa, vv.updated_at as  last_updated');
		$this->db->join('vehicle v', 'v.id=vv.vehicle_id', 'left');
		$this->db->join('vendor_of_material vom', 'vom.id=vv.vendor_id');

		if(isset($_GET['brand']) and !empty($_GET['brand']))
		{
			$this->db->where('v.brand', $_GET['brand']);
		}
		if(isset($_GET['merk']) and !empty($_GET['merk']))
		{
			$this->db->where('v.merk', $_GET['merk']);
		}
		if(isset($_GET['type']) and !empty($_GET['type']))
		{
			$this->db->where('v.type', $_GET['type']);
		}
		if(isset($_GET['tahun']) and !empty($_GET['tahun']))
		{
			$this->db->where('v.tahun', $_GET['tahun']);
		}

		$i = $this->db->get();
		
		return $i->result_array();
	}

	/**
	 * Get By ID
	 * @param  $id
	 * @return array
	 */
    public function get_by_id($id)
    {
    	$this->db->from($this->t_table .' vv');
		$this->db->select('v.*, vv.no_polisi, vv.stnk_no, vv.stnk_end_date, vv.kir_no, vv.kir_end_date, vv.sewa, vv.updated_at as  last_updated');
		$this->db->join('vehicle v', 'v.id=vv.vehicle_id', 'left');
		$this->db->join('vendor_of_material vom', 'vom.id=vv.vendor_id', 'left');
		$this->db->where('vv.id', $id);

    	$data = $this->db->get();

    	return $data->row_array();
    }
}