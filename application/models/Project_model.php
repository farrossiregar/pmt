<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Model Project
 * @by		: doni(doni.enginer@gmail.com)
 * @date	: Mei 2019
 **/
 
 class Project_model extends CI_Model
 {
	var $t_table 	= 'projects';

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
	public function data_($id=0, $page=0, $limit=0, $search=0)
	{
		$this->db->from($this->t_table);
		$this->db->select($this->t_table .'.*, region.region_code, user.name as project_manager');
		$this->db->join('region', 'region.id='. $this->t_table .'.region_id', 'left');
		$this->db->join('user', 'user.id='. $this->t_table .'.project_manager_id', 'left');

		$i = $this->db->get();
		
		return $i->result_array();
	}

	/**
	 * Get Manager Project
	 */
	public function get_manager_by_project($project_id)
	{
		$this->db->from($this->t_table);
		$this->db->select($this->t_table .'.*, region.region_code, user.name as project_manager, user.phone, user.email');
		$this->db->join('region', 'region.id='. $this->t_table .'.region_id', 'left');
		$this->db->join('user', 'user.id='. $this->t_table .'.project_manager_id', 'left');

		$i = $this->db->get();
		
		return $i->row_array();
	}

	/**
	 * Total
	 * @param 	search 
	 * @return 	count table
	 **/
	public function total($search = 0)
    {
    	if(!empty($search)):
			$this->db->like('uraian', $search);
		endif;
        $i = $this->db->get($this->t_table);
        return $i->num_rows();
    }

    /**
	 * insert
	 * @param 	data array , table
	 * @return 	
	 **/
    public function insert($table, $data = array())
    {
    	$i = $this->db->insert($table, $data);
    	$no = 0;
    	if($i):
    		echo $no++;
    	endif;
    }

    public function get_by_id($id)
    {
    	$this->db->from($this->t_table);
		$this->db->select($this->t_table .'.*, region.region_code, user.name as project_manager');
		$this->db->join('region', 'region.id='. $this->t_table .'.region_id', 'left');
		$this->db->join('user', 'user.id='. $this->t_table .'.project_manager_id', 'left');
		$this->db->where([$this->t_table .'.id' => $id]);

		$data = $this->db->get();
    	
    	return $data->row_array();
    }
}