<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Model Impor
 * @by		: doni(doni.enginer@gmail.com)
 * @date	: Oktober 2012
 **/
 
 class RequestForQoutation_model extends CI_Model
 {
	var $t_table 	= 'request_for_qoutation';

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
		$this->db->from($this->t_table.' rfq');
		$this->db->select('rfq.*, c.name as company_name');
		$this->db->join('purchase_request pr', 'pr.id=rfq.purchase_request_id', 'left');
		$this->db->join('company c', 'c.id=pr.company_id', 'left');
		$this->db->order_by('id', 'DESC');

		$i = $this->db->get();

		return $i->result_array();
	}

	/**
	 * Data RFQ Vendor
	 * @return [type] [description]
	 */
	public function data_rfq_vendor($vendor_id)
	{
		$this->db->select($this->t_table .'.*');
		$this->db->from($this->t_table);
		$this->db->join('request_for_qoutation_vendor rv', $this->t_table .'.id=rv.request_for_qoutation_id');
		$this->db->where('rv.vendor_id', $vendor_id);
		$this->db->order_by('id', 'DESC');

		$i = $this->db->get();

		return $i->result_array();
	}

	public function get_where_many($search = [])
	{
		$this->db->from($this->t_table);
		if(! empty($search))
		{
			foreach ($search as $key => $value) {
				$this->db->where($key, $value);
			}
		}
		
		$i = $this->db->get();
		
		return $i->result_array();
	}

	public function get_where_one($search = [])
	{
		$this->db->from($this->t_table);
		if(! empty($search))
		{
			foreach ($search as $key => $value) {
				$this->db->where($key, $value);
			}
		}
		
		$i = $this->db->get();
		
		return $i->row_array();
	}

	function add_data($post_data) {
    	$this->db->insert($this->t_table ,$post_data);
    	return $this->db->insert_id();
	}

	/**
	 * [get_by_id description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function get_by_id($id)
	{
		return $this->db->get_where($this->t_table, ['id' => $id])->row_array();
	}

	/**
	 * Get Vendor
	 * @return array
	 */
	public function vendor($id)
	{
		$this->db->from('request_for_qoutation_vendor r');
		$this->db->select('r.*, v.name as vendor, v.phone_1 as phone, v.email');
		$this->db->join('vendor_of_material v','v.id=r.vendor_id');
		$this->db->where('r.request_for_qoutation_id', $id);

		$data = $this->db->get()->result_array();

		return $data;
	}

	/**
	 * Get Term
	 * @return array
	 */
	public function term($id)
	{
		$this->db->from('request_for_qoutation_term_condition r');
		$this->db->select('r.*');
		$this->db->where('r.request_for_qoutation_id', $id);

		$data = $this->db->get()->result_array();

		return $data;
	}

	/**
	 * Get Term
	 * @return array
	 */
	public function material($id)
	{
		$this->db->from('request_for_qoutation_material r');
		$this->db->select('r.*, v.name as material');
		$this->db->join('material v','v.id=r.material_id');
		$this->db->where('r.request_for_qoutation', $id);

		$data = $this->db->get()->result_array();

		return $data;
	}


	    public function get_material_by_id($id, $requester)
    {
        $sql = "SELECT
                    IFNULL(b.id, 0) as id,
                    a.purchase_request_id as requester,
                    d.name as group_material,
                    c.name,
                    a.material_id,
                    a.qty,
                    IFNULL(b.price, 0) as price,
                    IFNULL(b.discount, 0) as discount,
                    IFNULL(b.total,0) as total,
                    IFNULL(b.penawaran,0) as penawaran,
                    ".$this->session->userdata('user_id')." as vendor_id
                FROM
                    material_purchase_request a
                    LEFT JOIN request_for_qoutation_material b on a.purchase_request_id = b.purchase_id and a.material_id = b.material_id
                    LEFT JOIN material c ON a.material_id = c.id
                    LEFT JOIN group_of_material d ON d.id=c.material_group
                WHERE a.purchase_request_id = $requester";

        $query = $this->db->query($sql);

        if($query->num_rows()){
            return $query->result_array();
        }
        return array();
    }

    public function get_vendor_by_id($id)
    {
        $sql = "SELECT
                    a.id,
                    a.vendor_id,
                    b.name as vendor_name
                FROM
                    request_for_quotation_vendor a
                    LEFT JOIN vendor_of_material b on a.vendor_id = b.id
                WHERE a.rfq_id = $id";

        $query = $this->db->query($sql);

        if($query->num_rows()){
            return $query->result_array();
        }
        return array();
    }

    public function getRequestVendor($id = 0){
        $this->db->select('b.*', false);
        $this->db->from('request_for_quotation_vendor a');
        $this->db->join('vendor_of_material b', 'a.vendor_id=b.id', 'left'); 
        $this->db->where('a.status', 1);
        $this->db->where('a.rfq_id', $id);

        $data = $this->db->get()->result();

        return $data;
    }

    public function getRequestTerm($id = 0){
        $this->db->select('a.*', false);
        $this->db->from('term_condition_rfq a');
        $this->db->where('a.rfq_id', $id);

        $data = $this->db->get()->result();

        return $data;
    }

    public function getRequestTermVendor($id=0, $userid=0){
        $vendor_id = $this->db->get_where('vendor_of_material', ['userID' => $userid])->row()->id;
        if((int)$this->session->userdata('access_id') != 14){
            $vendor_id = $userid;
        }
        $this->db->select('a.*, id as term_vendor_id', false);
        $this->db->from('term_condition_vendor a');
        $this->db->where('a.rfq_id', $id);
        $this->db->where('a.vendor_id', $vendor_id);

        $data = $this->db->get()->result();

        if(count($data) == 0){
            $this->db->select('a.*, "" as checking, "" as term_vendor_id', false);
            $this->db->from('term_condition_rfq a');
            $this->db->where('a.rfq_id', $id);

            $data = $this->db->get()->result();
        }

        return $data;
    }

    public function SubmitRPO($data, $user_id){
        $result = false;
        $error = 'error';
        $insid = 0;
        try{
            $this->db->trans_begin();

            /* insert head = RFQ */
            $konten = array(
                'requester' => $data['requester'],
                'case_id' => $data['case_id'],
                'purchase_type' => $data['purchase_type'],
                'document_title' => $data['document_title'],
                'solicatation_type' => $data['solicatation_type'],
                'currency' => $data['currency'],
                'delivery_date' => $data['delivery_date'],
                'expired_date' => $data['expired_date'],
                'delivery_address' => $data['delivery_address'],
                'detail_delivery_address' => $data['detail_delivery_address'],
                'efective_date' => $data['efective_date'],
                'expiration_date' => $data['expiration_date'],
                'rfq_type' => $data['rfq_type']
            );

            if(@$data['id']){
                $konten['updated_at'] = date('Y-m-d H:i:s');

                $this->db->where('id', @$data['id']);
                $this->db->update($this->t_table, $konten);
                $insid = @$data['id'];
            }else{
                $konten['created_by'] = $user_id;
                $konten['created_at'] = date('Y-m-d H:i:s');
                $konten['status'] = 1;

                $this->db->insert($this->t_table, $konten);
                $insid = $this->db->insert_id();
            }
            

            /* insert detail = Vendor Purchase Request */
            $detail = array_values($data['vendorRequest']);

            if(count($detail)){
                for($i=0; $i<count($detail); $i++){
                    $konten_detail = array(
                        'rfq_id' => $insid,
                        'vendor_id' => $detail[$i]['vendor_id'],
                        'status' => 1
                    );
                    if($detail[$i]['vendor_id']){
                        $cek = $this->db->get_where('request_for_quotation_vendor', array('rfq_id' => $insid, 'vendor_id' => $detail[$i]['vendor_id']));
                        if($cek->num_rows()){
                            $konten_detail['updated_at'] = date('Y-m-d H:i:s');

                            $this->db->where('id', $cek->row()->id);
                            $this->db->update('request_for_quotation_vendor', $konten_detail);
                        }else{
                            $konten_detail['created_by'] = $user_id;
                            $konten_detail['created_at'] = date('Y-m-d H:i:s');
                            $this->db->insert('request_for_quotation_vendor', $konten_detail);
                        }
                    }
                }
            }

            /* insert detail = Term And Condition */
            $detailT = array_values($data['T']);

            if(count($detailT)){
                for($i=0; $i<count($detailT); $i++){
                    $konten_detail = array(
                        'rfq_id' => $insid,
                        'term' => $detailT[$i]['term'],
                        'cond' => $detailT[$i]['cond']
                    );
                    if($detailT[$i]['term']){
                        $cek = $this->db->get_where('term_condition_rfq', array('rfq_id' => $insid, 'term' => $detailT[$i]['term']));
                        if($cek->num_rows()){
                            $konten_detail['updated_at'] = date('Y-m-d H:i:s');

                            $this->db->where('id', $cek->row()->id);
                            $this->db->update('term_condition_rfq', $konten_detail);
                        }else{
                            $konten_detail['created_by'] = $user_id;
                            $konten_detail['created_at'] = date('Y-m-d H:i:s');
                            $this->db->insert('term_condition_rfq', $konten_detail);
                        }
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

    public function SubmitVendorQuotation($id, $requester, $data, $user_id){
        $result = false;
        $error = 'error';
        $insid = 0;
        try{
            $this->db->trans_begin();
            $vendor_id = $this->db->get_where('vendor_of_material', ['userID' => $this->session->userdata('user_id')])->row()->id;
            /* insert detail = Vendor Quotation */
            $detail = array_values($data['material_vendor']);

            if(count($detail)){
                for($i=0; $i<count($detail); $i++){
                    $konten_detail = array(
                        'rfq_id' => $id,
                        'purchase_id' => $requester,
                        'material_id' => $detail[$i]['material_id'],
                        'vendor_id' => $vendor_id,
                        'qty' => $detail[$i]['qty'],
                        'price' => $detail[$i]['price'],
                        'discount' => $detail[$i]['discount'],
                        'total' => $detail[$i]['total']
                    );
                    if($detail[$i]['id']){
                        $konten_detail['updated_at'] = date('Y-m-d H:i:s');
                        $this->db->where('id', $detail[$i]['id']);
                        $this->db->update('request_for_qoutation_material', $konten_detail);
                    }else{
                        $konten_detail['created_by'] = $user_id;
                        $konten_detail['created_at'] = date('Y-m-d H:i:s');
                        $this->db->insert('request_for_qoutation_material', $konten_detail);
                    }
                }
                $this->db->where('rfq_id', $id);
                $this->db->where('vendor_id', $vendor_id);
                $this->db->update('request_for_quotation_vendor', ['status_quotation'=>1]);
            }

            /* insert detail = Term And Condition */
            $detailT = array_values($data['T']);

            if(count($detailT)){
                for($i=0; $i<count($detailT); $i++){
                    $konten_detail = array(
                        'rfq_id' => $id,
                        'vendor_id' => $vendor_id,
                        'term' => $detailT[$i]['term'],
                        'cond' => $detailT[$i]['cond'],
                        'checking' => @$detailT[$i]['check'] != '' ? 1 : 0 
                    );
                    if($detailT[$i]['term']){
                        if($detailT[$i]['idx']){
                            $konten_detail['updated_at'] = date('Y-m-d H:i:s');
                            $this->db->where('id', $detailT[$i]['idx']);
                            $this->db->update('term_condition_vendor', $konten_detail);
                        }else{
                            $konten_detail['created_by'] = $user_id;
                            $konten_detail['created_at'] = date('Y-m-d H:i:s');
                            $this->db->insert('term_condition_vendor', $konten_detail);
                        }
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

        } catch (Exception $exc) {
            $this->db->trans_rollback();
            $result = false;
        }
        
        $this->db->trans_complete();
        
        if($result) {
            return $id;
        }else{
            return false;
        }
    }

    public function SubmitAdmVendorQuotation($id, $requester, $data, $user_id){
        $result = false;
        $error = 'error';
        $insid = 0;

        try{
            $this->db->trans_begin();
            /* Update Penawaran */
            $detail = array_values($data['materialPenawaran']);

            if(count($detail)){
                for($i=0; $i<count($detail); $i++){
                    $konten_detail = ['penawaran' => str_replace(".","",$detail[$i]['penawaran']) ];
                    if($detail[$i]['material_id']){
                        $konten_detail['updated_at'] = date('Y-m-d H:i:s');
                        $this->db->where('rfq_id', $id);
                        $this->db->where('material_id', $detail[$i]['material_id']);
                        $this->db->update('request_for_qoutation_material', $konten_detail);
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

        } catch (Exception $exc) {
            $this->db->trans_rollback();
            $result = false;
        }

        if($result) {
            return $id;
        }else{
            return false;
        }
    }

    public function getRFQ($id=0){
        $rfq = $this->db->select($this->t_table.'.*, DATE_FORMAT(delivery_date, "%Y-%m-%d") as delivery_date', false)
                ->from($this->t_table)
                ->where('id', $id)
                ->get()
                ->row();

        return array('success' => true, 'rfq'=>$rfq);
    }

    public function getPR($id=0){
        $this->db->select('  a.*,
                             c.id as user_id, c.name as name_user, 
                             d.id as divisi_id, d.name as name_division,
                             e.project_name as project_name', false);
        $this->db->from('purchase_request a');
        $this->db->join('project_code e', 'a.project_id=e.id', 'left'); 
        $this->db->join('request_for_qoutation b', 'a.id=b.requester', 'left'); 
        $this->db->join('user c', 'c.id = a.created_by', 'left');
        $this->db->join('division d', 'd.id = c.divisi_id', 'left');
        $this->db->where('a.status <', 4);
        $this->db->where('b.requester', NULL);
        $this->db->where('a.id', $id);
        $this->db->group_by('a.id');
                        
        $data = $this->db->get()->row();

        return $data;
    }
}