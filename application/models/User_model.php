<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Model Impor
 * @by		: doni(doni.enginer@gmail.com)
 * @date	: Oktober 2012
 **/
 
 class User_model extends CI_Model
 {
	var $t_table 	= 'user';

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
	public function data_user($id=0, $page=0, $limit=0, $search=0)
	{
		$this->db->from($this->t_table);
		$this->db->select('user.*, user_group.user_group as user_group, user_group.user_group as access');
		$this->db->join('user_group', 'user_group.id=user.user_group_id', 'left');

		if(isset($_GET['user_group_id']) and !empty($_GET['user_group_id']))
		{
			$this->db->where('user_group_id', $_GET['user_group_id']);
		}

		if(isset($_GET['name']) and !empty($_GET['name']))
		{
			$this->db->group_start()
					->like('name', $_GET['name'])
					->or_like('username', $_GET['name'])
					->or_like('email', $_GET['name'])
					->or_like('phone', $_GET['name'])
					->group_end();
		}


		$this->db->order_by('id', 'desc');

		$i = $this->db->get();
		
		return $i->result_array();
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
		$this->db->select('user.*, user_group.user_group as user_group, user_group.user_group as access');
		$this->db->join('user_group', 'user_group.id=user.user_group_id');
		$this->db->where(['user.id' => $id]);

    	$data = $this->db->get();

    	return $data->row_array();
    }
}