<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Model Impor
 * @by		: doni(doni.enginer@gmail.com)
 * @date	: Oktober 2012
 **/
 
 class PurchaseRequest_model extends CI_Model
 {
	var $t_table 	= 'purchase_request';

	/**
	 * Constructor
	 * @param	-
	 * @return 	-
	 **/
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}
	
	/**
	 * Data Investasi
	 * @param	id, page, limit, search
	 * @return 	array
	 **/
	public function data_($user_id)
	{
		$this->db->select('pr.*,p.osm_id, u_osm.name as osm, p.name as project, u_p.name as project_manager, p.project_manager_id, c.name as company');
		$this->db->order_by('id','desc');
		
		$this->db->from($this->t_table.' pr');
		$this->db->join('projects p ', 'p.id=pr.project_id');
		$this->db->join('user u_p ', 'u_p.id=p.project_manager_id');
		$this->db->join('user u_osm ', 'u_osm.id=p.osm_id');
		$this->db->join('company c ', 'c.id=pr.company_id');

		if($this->session->userdata('access_id') != 14 and $this->session->userdata('access_id') != 18)
		{
			$this->db->where(['pr.user_id' => $user_id]);
			$this->db->or_where(['p.osm_id' => $user_id]);
		}

		if($position > 2){
			$this->db->where('pr.status', 2);
			$this->db->or_where('pr.status', 3);
			$this->db->or_where('pr.status', 4);
			$this->db->or_where('pr.status', 5);
		}
		$i = $this->db->get();
		
		return $i->result_array();
	}

	public function get_where_many($search = [])
	{
		$this->db->select($this->t_table.".*, user.name as name_user, user.divisi_id, division.name as name_division");
		$this->db->from($this->t_table);
		if(! empty($search))
		{
			foreach ($search as $key => $value) {
				$this->db->where($key, $value);
			}
		}
		
		$this->db->join('user', 'user.id = purchase_request.created_by', 'left');
		$this->db->join('division', 'division.id = user.divisi_id', 'left');
		$i = $this->db->get();
		
		return $i->result_array();
	}

	public function get_where_one($search = [])
	{
		$this->db->select($this->t_table.".*, user.name as name_user, user.divisi_id, division.name as name_division");
		$this->db->from($this->t_table);
		if(! empty($search))
		{
			foreach ($search as $key => $value) {
				$this->db->where($key, $value);
			}
		}
		
		$this->db->join('user', 'user.id = purchase_request.created_by', 'left');
		$this->db->join('division', 'division.id = user.divisi_id', 'left');
		$i = $this->db->get();
		
		return $i->row_array();
	}

	function add_data($post_data) 
	{
    	$this->db->insert($this->t_table ,$post_data);
    	return $this->db->insert_id();
	}

	/* Purchase Request */
	public function submitPurchaseRequest($data, $user_id, $branch_id){
		$result = false;
        $error = 'error';
        $insid = 0;
        $token_code = md5(uniqid());

        try{
            $this->db->trans_begin();
            /* insert head = Purchase Request */
            $konten = array(
                'no' => $data['purchase_number'],
                'require_date' => $data['purchase_require_date'],
                'project_id' => $data['purchase_project'],
                'branch_id' => $this->session->userdata('branch_id'),
                'user_id' => $this->session->userdata('user_id'),
                'token_code' => $token_code,
                'token_expired' => date('Y-m-d', strtotime( date('Y-m-d') .' + 3 day')),
                'company_id' => $data['company_id']
            );
            $project_id = $data['purchase_project'];
            if(@$data['purchase_idx']){
            	$konten['updated_at'] = date('Y-m-d H:i:s');

                $this->db->where('id', @$data['purchase_idx']);
                $this->db->update($this->t_table, $konten);
                $insid = @$data['purchase_idx'];
            }else{
            	$konten['created_by'] = $user_id;
            	$konten['created_at'] = date('Y-m-d H:i:s');
            	$konten['status'] = 1;

                $this->db->insert($this->t_table, $konten);
                $insid = $this->db->insert_id();
            }
            

            /* insert detail = Material Purchase Request */
            $detail = array_values($data['purchasingRequest']);

            if(count($detail)){
            	for($i=0; $i<count($detail); $i++){
            		$konten_detail = array(
            			'purchase_request_id' => $insid,
            			'material_group_id' => $detail[$i]['material_group_id'],
            			'material_id' => $detail[$i]['material_id'],
            			'qty' => $detail[$i]['qty'],
            			'urgency' => $detail[$i]['urgency'],
            		);
		            if(@$detail[$i]['id']){
		            	$konten_detail['updated_at'] = date('Y-m-d H:i:s');

		                $this->db->where('id', @$detail[$i]['id']);
		                $this->db->update('material_purchase_request', $konten_detail);
		            }else{
		            	$konten_detail['created_by'] = $user_id;
		            	$konten_detail['created_at'] = date('Y-m-d H:i:s');
		                $this->db->insert('material_purchase_request', $konten_detail);
		            }
            	}
            }

            if ($this->db->trans_status() == false) {
                $this->db->trans_rollback();
                $error = $this->db->_error_messages();
            } else {
                $this->db->trans_commit();
                $result = true;
            }

            if($result)
            {
            	$this->load->model('Project_model');
            	
            	$project = $this->Project_model->get_osm_by_project($project_id);
            	
            	// send notifikasi whatsapp
            	$message  = "This ". $data['purchase_number'] ." need your approval. Please click the link below and select approve or reject with reason.";
            	$message .= "\n ". site_url('approve/prpm/'. $token_code) ."\n ";
            	
            	$param['message'] 	= $message;
            	$param['phone'] 	= $project['phone'];
            	$param['email']		= $project['email'];
            	$param['subject']	= 'Purchase Request Need Your Approval #'. $data['purchase_number'];

            	send_notif($param);
            }

        } catch (Exception $exc) {
            $this->db->trans_rollback();
            $result = false;
        }

        $this->db->trans_complete();

        if($result) {
            return $insid;
        }else{
            return false;
        }
	}

	/**
	 * Submit Receive
	 * @param  [type] $data    [description]
	 * @param  [type] $user_id [description]
	 * @return [type]          [description]
	 */
	public function submitReceive($data, $user_id)
	{
		$result = false;
        $error = 'error';
        try{
            $this->db->trans_begin();

            if(@$data['id']){
                $this->db->where('id', @$data['id']);
                $this->db->update($this->t_table, ['status' => 5, 'receive_date' => $data['date']]);
            }

            if ($this->db->trans_status() == false) {
                $this->db->trans_rollback();
                $error = $this->db->_error_messages();
            } else {
                $this->db->trans_commit();
                $result = true;
            }

        } catch (Exception $exc) {
            $this->db->trans_rollback();
            $result = false;
        }

        $this->db->trans_complete();

        if($result) {
            return array('success' => true, 'message' => 'Approval Success !');
        }else{
            return array('success' => false, 'message' => 'Approval failed !');
        }
	}

	public function submitApproval($data, $user_id){
		$result = false;
        $error = 'error';
        try{
            $this->db->trans_begin();
            if(@$data['id']){
        		
        		$token_code 		= md5(uniqid());
                $token_expired 		= date('Y-m-d', strtotime( date('Y-m-d') .' + 1 day'));

                $this->db->where('id', @$data['id']);
                $this->db->update($this->t_table, ['status' => $data['value'], 'token_code' => $token_code, 'token_expired' => $token_expired ]);

	            $cek = $this->db->get_where('approval', array('PurchaseRequestID' => $data['id'], 'UserID' => $user_id));
	            $konten['PurchaseRequestID'] = $user_id;
            	$konten['UserID'] = $user_id;
            	$konten['approval'] = $data['value'];
            	$konten['date'] = $data['date'].' '.date('H:i:s');
            	$konten['description'] = $data['description'];

	            if($cek->num_rows()){
	            	$this->db->where(array('PurchaseRequestID' => $data['id'], 'UserID' => $user_id));
	            	$this->db->update('approval', $konten);
	            }else{
                	$this->db->insert('approval', $konten);
	            }

            	$pr = $this->db->get_where('purchase_request',['id' => $data['id']])->row_array();
				$pm = $this->Project_model->get_manager_by_project($pr['project_id']);
	            $this->db->set('token_code', '-' );
        		$this->db->where('id', $pr['id']);
        		$this->db->update('purchase_request');

	            if($data['value'] == 4)
            	{
            		$user = $this->db->get_where('user',['user_group_id' => 14])->row_array();
            		if(!empty($user))
            		{
						// send notifikasi whatsapp
						$message  = "You have incoming Purchase Requisition ". $pr['no'];	
		            	$param['message'] 	= $message;
		            	$param['phone'] 	= $user['phone'];
		            	$param['email']		= $user['email'];
		            	$param['subject']	= 'Purchase Requisition #'. $pr['no'];
		            	send_notif($param); $params = "";
					}
            	}
            	else $message  = "Your Purchase Requisition ". $pr['no'] ." rejected.";
            	
            	$param['message'] 	= $message;
	        	$param['phone'] 	= $pm['phone'];
	        	$param['email']		= $pm['email'];
	        	$param['subject']	= 'Purchase Requisition  #'. $pr['no'];
	        	send_notif($param);
            }

            if ($this->db->trans_status() == false) {
                $this->db->trans_rollback();
                $error = $this->db->_error_messages();
            } else {
                $this->db->trans_commit();
                $result = true;
            }

        } catch (Exception $exc) {
            $this->db->trans_rollback();
            $result = false;
        }

        $this->db->trans_complete();

        if($result) {
            return array('success' => true, 'message' => 'Approval Success !');
        }else{
            return array('success' => false, 'message' => 'Approval failed !');
        }
	}

	public function getPR($id=0){
		$pr = $this->db->get_where($this->t_table, ['id'=>$id])->row();
		$pr_material = $this->db->select('a.*,b.name as group_material, c.name as material',false)
								->from('material_purchase_request a')
								->join('group_of_material b', 'a.material_group_id=b.id','left')
								->join('material c', 'a.material_id=c.id','left')
								->where('a.purchase_request_id', $id)
								->get()
								->result();
		$urgency = URGENCY___LEVEL;

		return array('success' => true, 'pr'=>$pr, 'pr_material'=>$pr_material, 'urgency' => $urgency);
	}



	/**
	 * [get_by_id description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function get_by_id($id)
	{
		$this->db->select('pr.*,p.osm_id,u_osm.name as osm, p.name as project, r.region_code, p.project_type, p.project_code, u_p.name as project_manager, p.project_manager_id');
		$this->db->order_by('id','desc');
		
		$this->db->from($this->t_table.' pr');
		$this->db->join('projects p ', 'p.id=pr.project_id');
		$this->db->join('user u_p ', 'u_p.id=p.project_manager_id');
		$this->db->join('user u_osm ', 'u_osm.id=p.osm_id');
		$this->db->join('region r', 'r.id=p.region_id');
		$this->db->where(['pr.id' => $id]);

		$i = $this->db->get();
		
		return $i->row_array();
	}

	/* Group Material */
	public function getGroupMaterial(){
		$data = $this->db->select('*')
						 ->from('group_of_material')
						 ->get();

		if($data->num_rows()){
			return $data->result();
		}

		return array();
	}

	/* Project */
	public function getProject(){
		$data = $this->db->select('*')
						 ->from('projects')
						 ->get();

		if($data->num_rows()){
			return $data->result();
		}

		return array();
	}	

	/**
	 * Get By Token
	 * @return void
	 */
	public function get_by_token($token)
	{
		$this->db->from($this->t_table);
		$this->db->where('token_code', $token);

		$data  = $this->db->get()->row_array();

		return $this->get_by_id($data['id']);;
	}
}