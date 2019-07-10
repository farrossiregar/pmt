<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Get Regionn
 * @return objects
 */
function get_pr()
{
    $obj = get_instance();

    $obj->db->order_by('id', 'DESC');
    $obj->db->where('status', 4);
    $data = $obj->db->get('purchase_request');

    return $data->result_object();
}

/**
 * Status PO Vendor
 */
function status_invoice_vendor($status)
{
    if($status == 1 || $status == "")
    {
       return '<label class="btn btn-info btn-sm"><i class="fa fa-history"></i> Invoice </label>';
    }
    elseif($status == 2)
    {
       return '<label class="btn btn-info btn-sm"><i class="fa fa-history"></i> Receive </label>';
    }
    elseif($status == 3)
    {
       return '<label class="btn btn-success btn-sm"><i class="fa fa-check"></i> Paid </label>';
    }
}

/**
 * Status Invoice
 */
function status_invoice_finance($status)
{
    if($status == 1 || $status == "")
    {
       return '<label class="btn btn-info btn-sm"><i class="fa fa-history"></i> Invoice </label>';
    }
    elseif($status == 2)
    {
       return '<label class="btn btn-info btn-sm"><i class="fa fa-history"></i> Receive </label>';
    }
    elseif($status == 3)
    {
       return '<label class="btn btn-success btn-sm"><i class="fa fa-check"></i> Paid </label>';
    }
}

/**
 * Status PO
 */
function status_po($status)
{
    if($status == 1 || $status == "")
    {
       return '<label class="btn btn-info btn-sm"><i class="fa fa-history"></i> General Manager </label>';
    }
    elseif($status == 2)
    {
       return '<label class="btn btn-info btn-sm"><i class="fa fa-history"></i> Finance </label>';
    }
    elseif($status == 3)
    {
       return '<label class="btn btn-success btn-sm"><i class="fa fa-check"></i> Approved </label>';
    }
    elseif($status == 4)
    {
       return '<label class="btn btn-danger btn-sm"><i class="fa fa-close"></i> Reject </label>';
    }
}

/**
 * Generate Invoice Number
 * @return string
 */
function generate_invoice_number_vendor($code="VD")
{
    $CI = get_instance();
    $CI->db->from('invoice_vendor');
    $query = $CI->db->get();
    $count =  $query->num_rows() + 1;
    return "INV/". $code. "/".date("dm")."/".$count;
}

/**
 * item_quotation_rfq_vendor description
 */
function item_quotation_rfq_vendor($id, $vendor_id)
{
    $CI = get_instance();
    $CI->db->from('quotation_order_vendor');
    $CI->db->where('rfq_id', $id);
    $CI->db->where('vendor_id', $vendor_id);

    return $CI->db->get()->row_array();
}
/**
 * status_quotation_rfq_vendor description
 */
function status_quotation_rfq_vendor($id, $vendor_id)
{
    $CI = get_instance();
    $CI->db->from('quotation_order_vendor');
    $CI->db->where('rfq_id', $id);
    $CI->db->where('vendor_id', $vendor_id);

    $query = $CI->db->get()->row_array();

    if($query)
    {
        if($query['status'] == 1)
        {
            $msg =  $query['quotation_number'];
        }
        elseif($query['status'] ==2)
        {
            $msg = "<strong class=\"text-success\">Win</strong>";
        }
        else
        {
            $msg = "<strong class=\"text-danger\">Lose</strong>";
        }
    }
    else
    {
        $msg =  "<strong class=\"text-warning\">Open</strong>";
    }

    return ['status' => $query['status'], 'msg' => $msg];
}

/**
 * Generate QO Number Vendor
 * @return string
 */
function generate_qoutation_no_vendor($code = "VD")
{
    $CI = get_instance();
    $CI->db->from('quotation_order_vendor');
    $query = $CI->db->get();
    $count =  $query->num_rows() + 1;
    return "QO/". $code. "/".date("dm")."/".$count;
}

/**
 * Group of material
 * @return array
 */
function get_group_of_material()
{
    $CI = get_instance();
    $CI->db->from('group_of_material');
    $data = $CI->db->get()->result_array();

    return $data;
}

/**
 * Replace first string
 */
function str_replace_first($search, $replace, $subject) {
    $pos = strpos($subject, $search);
    if ($pos !== false) {
        return substr_replace($subject, $replace, $pos, strlen($search));
    }
    return $subject;
}

/**
 * API WHA CURL
 */
function send_notif($param)
{
    $CI = get_instance();
    $CI->load->config('email');
    $CI->load->library('email');

    $message = $param['message'] ."\n\n _Harap tidak membalas pesan ini, karena dikirimkan secara otomatis oleh sistem._";

    $CI->email->set_newline("\r\n");
    $CI->email->from('noreply@empore.co.id');
    $CI->email->to($param['email']);
    $CI->email->subject($param['subject']);
    $CI->email->message($message);
    $CI->email->send();

    $message = $param['message'] ."\n\n _Harap tidak membalas pesan ini, karena dikirimkan secara otomatis oleh sistem._";
    $message = 'text='. urlencode($message);
    $number = str_replace_first('0','62', $param['number']);
    $number = str_replace('-', '', $number);
    
    $url = "https://panel.apiwha.com/send_message.php?apikey=". APIWHA_TOKEN ."&number=". $number ."&".$message;
      
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        echo $response;
    }
}


if (!function_exists('dd')) {
    function dd()
    {
        array_map(function($x) { 
            dump($x); 
        }, func_get_args());
        die;
    }
 }
 
/**
 * Format IDR
 * @param  snumber
 * @return string
 */
function format_idr($number)
{
    return number_format($number,0,0,'.');
}

/**
 * Replace IDR
 * @param  snumber
 * @return string
 */
function replace_idr($nominal)
{
    if($nominal == "") return 0;
    
    $nominal = str_replace('Rp. ','', $nominal);
    $nominal = str_replace('.', '', $nominal);
    $nominal = str_replace(',', '', $nominal);

    return $nominal;
}

/**
 * Get Material
 */
function get_material_vendor_row($id, $vendor_id)
{
    $db = get_instance();

    $db->db->from('sales_and_distribution');
    $db->db->where('material_id', $id);
    $db->db->where('vendor_id', $vendor_id);

    $data = $db->db->get()->row_array();

    return $data;
}

/**
 * Get Company
 * @return array
 */
function get_company()
{
    $db = get_instance();

    $db->db->from('company');

    $data = $db->db->get()->result_array();

    return $data;
}   

/**
 * Get Material PR
 */
function get_material_pr($id)
{
    $db = get_instance();

    $db->db->select('mp.*, m.name as material');
    $db->db->from('material_purchase_request mp');
    $db->db->join('material m', 'm.id=mp.material_id');

    $object = $db->db->where(['purchase_request_id' => $id])->get()->result_array();

    return $object;
}

/**
 * [get_user_name description]
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
function get_project_description($id)
{
    $ini = get_instance();

    $row = $ini->db->get_where('projects', ['id' => $id])->row_array();

    return $row['description'];
}


/**
 * [get_user_name description]
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
function get_branch_name($id)
{
    $ini = get_instance();

    $row = $ini->db->get_where('region', ['id' => $id])->row_array();

    return $row['region'];
}

/**
 * Get Regionn
 * @return objects
 */
function get_region()
{
    $obj = get_instance();

    $obj->db->order_by('id', 'DESC');
    $data = $obj->db->get('region');

    return $data;
}

/**
 * Get Regionn
 * @return objects
 */
function get_project_type($id="")
{
    $obj = get_instance();

    $obj->db->order_by('id', 'DESC');
    $data = $obj->db->get('project_type');

    return $data;
}

/**
 * [catatan_so_by_so_id description]
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
function catatan_ar_by_so_id($id)
{

    $ini = get_instance();

    $catatan_ar = $ini->db->get_where('sales_order_catatan_ar', ['sales_order_id' => $id])->result_array();
    
    $html = '';

    foreach($catatan_ar as $cat)
    {
      $html .= $cat['catatan']. '<br />';
    }

    return $html;
}


/**
 * [total_invoice_perso description]
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
function total_invoice_perso($id)
{
    $ini = get_instance();

    $query = $ini->db->query("SELECT * FROM invoice i WHERE i.sales_order_id={$id}")->result_array();
    $total = 0;
    foreach($query as $i)
    {
        $total += $i['nominal'];
    }   

    return $total;
}

/**
 * [total_nominal_perso description]
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
function total_kiriman_perso($id)
{
    $ini = get_instance();

    $query = $ini->db->query("SELECT sj.no_surat_jalan, spmp.volume, spmp.harga_satuan FROM surat_jalan sj 
                                            INNER JOIN surat_perintah_muat spm on spm.id=sj.surat_perintah_muat_id
                                            INNER JOIN surat_perintah_muat_product spmp on spmp.surat_perintah_muat_id=spm.id
                                            INNER JOIN surat_izin_kirim sik on sik.id=spm.surat_izin_kirim_id
                                            WHERE sik.sales_order_id={$id}
                                ")->result_array();
    $total = 0;
    foreach($query as $i)
    {
        $total += $i['volume'] * $i['harga_satuan'];
    }   

    return $total;
}

/**
 * [name_manager description]
 * @return [type] [description]
 */
function name_manager()
{
    $ini = get_instance();

    $row = $ini->db->get_where('user', ['user_group_id' => 5])->row_array();

    return $row['name']; 
}

/**
 * [ar_manager description]
 * @return [type] [description]
 */
function name_ar_manager()
{
    $ini = get_instance();

    $row = $ini->db->get_where('user', ['user_group_id' => 10])->row_array();

    return $row['name'];
}

/**
 * [get_user_name description]
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
function get_user_name($id)
{
    $ini = get_instance();

    $row = $ini->db->get_where('user', ['id' => $id])->row_array();

    return $row['name'];
}

/**
 * [label_customer_pt description]
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
function label_customer_pt($id)
{
    $CI = get_instance();
    
    $customer = $CI->db->get_where('customer', ['id' => $id])->row_array();
    if($customer)
    {
        if($customer['tipe_customer'] == 'Perorangan')
            return $customer['name'];
        else
            return $customer['company'];    
    }
}   

/**
 * [total_nominal_quotation description]
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
function total_nominal_quotation($id)
{
    $ini = get_instance();

    $total = $ini->db->query("SELECT * FROM quotation_order_products where quotation_order_id={$id}")->result_array();

    $total_harga = 0;
    foreach($total as $i)
    {
        $total_harga += $i['vol'] * $i['harga_satuan'];
    }

    return $total_harga;
}

/**
 * [status_sik description]
 * @param  [type] $row [description]
 * @return [type]      [description]
 */
function status_sik($item)
{
    $CI = get_instance();

    if($item['is_lock'] == 0){

        // cek tanggal proses sik
        $cek_tanggal_sik = $CI->db->query("SELECT * FROM surat_izin_kirim where date_proses <= '".date('Y-m-d')."' and id={$item['id']}")->row_array();
 
        $row_sik = $CI->db->query("SELECT * FROM surat_izin_kirim where id={$item['id']}")->row_array();

         if(!$cek_tanggal_sik): 
            $html ='<strong>SIK Active Tanggal : <label class="btn btn-warning btn-sm"> <i class="fa fa-info-circle"></i> '. date('d F Y', strtotime($row_sik['date_proses'])) .'</label></strong>';

            return $html;
         endif; 

        $html = position_sik($item['position']). '<br />';

        $html .= '<a href="'. site_url('deliversik/spm/'. $item['id']) .'" class="btn btn-default btn-xs" title="Buat Surat Izin Kirim"><i class="fa fa-cab"></i> SPM <br />(Surat Perintah Muat)</a>';
      return $html;
    }else{
        $row = $CI->db->query("SELECT * FROM surat_izin_kirim_lock_history where surat_izin_kirim_id={$item['id']} ORDER BY id DESC")->row_array();
      return "<label class=\"btn btn-xs btn-danger\" onclick=\"_alert('{$row['catatan']}')\"><i class=\"fa fa-lock\"></i> Lock Manager</label>";
    }
}

function label_customer_kebalik($id)
{
    $CI = get_instance();
    
    $customer = $CI->db->get_where('customer', ['id' => $id])->row_array();
    if($customer)
    {
        if($customer['tipe_customer'] == 'Perorangan')
            return $customer['name'];
        else
            return '<b>'. $customer['name'] .'</b><br />'. $customer['company'];    
    }
}

/**
 * [label_customer description]
 * @return [type] [description]
 */
function label_customer($id)
{
    $CI = get_instance();
    
    $customer = $CI->db->get_where('customer', ['id' => $id])->row_array();
    if($customer)
    {
        if($customer['tipe_customer'] == 'Perorangan')
            return $customer['name'];
        else
            return $customer['company'] .'<br />'. $customer['name'];    
    }
}

/**
 * [nama_customer description]
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
function nama_customer($id)
{
    $CI = get_instance();
    
    $customer = $CI->db->get_where('customer', ['id' => $id])->row_array();
    if($customer)
    {
        if($customer['tipe_customer'] == 'Perorangan')
            return $customer['name'];
        else
            return $customer['company'];    
    }
}

function status_invoice($id)
{
    $status = "";
    switch ($id) {
        case 0:
            $status = "<button class=\"btn btn-danger btn-xs\">Belum Lunas</button>";
            break;
        case 1:
            $status = "<button class=\"btn btn-success btn-xs\"><i class=\"fa fa-check-square\"></i> Lunas</button>";
            break;
    }
    
    return $status;
}

/**
 * [status_dispensasi description]
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
function status_dispensasi($id)
{
    $status = "";
    switch ($id) {
        case 0:
            $status = "On Progress";
            break;
        case 1:
            $status = "<i class=\"fa fa-check-square\"></i> Disetujui";
            break;
        case 2:
            $status = "Ditolak";
            break;
        default:
            $status = "On Progress";
            break;
    }
    
    return "<button class=\"btn btn-success btn-xs\">". $status ."</button>";
}

/**
 * [sisa_uang_so description]
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
function sisa_uang_so($id)
{
    $CI = get_instance();

    $sik  = $CI->db->query("SELECT sum(sh.harga_yang_dikirim) as nominal FROM surat_izin_kirim s inner join surat_izin_kirim_history sh on sh.surat_izin_kirim_id=s.id WHERE s.position <= 3 and s.sales_order_id={$id}")->row_array();

    $so = $CI->db->query("SELECT sum(deposit) as total FROM sales_order WHERE id={$id}")->row_array();

    return $so['total'] - $sik['nominal'];
}

/**
 * [total_nominal_sik description]
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
function total_nominal_sik($id)
{
    $CI = get_instance();

    $sik = $CI->db->query("SELECT sum(sik.harga_yang_dikirim) as total FROM surat_izin_kirim_history sik where surat_izin_kirim_id={$id}")->row_array();

    return $sik['total'];
}

 
/**
 * Debug function
 * d($var);
 */
function d($var,$caller=null)
{
    echo '<code>File: '.$caller['file'].' / Line: '.$caller['line'].'</code>';
    echo '<pre>';
    var_dump($var, 10, true);
    echo '</pre>';
}
 
/**
 * Debug function with die() after
 * dd($var);
 */
function dd($var)
{
    d($var);
    die();
}


/**
 * [kekata description]
 * @param  [type] $x [description]
 * @return [type]    [description]
 */
function kekata($x) {
    $x = abs($x);
    $angka = array("", "satu", "dua", "tiga", "empat", "lima",
    "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($x <12) {
        $temp = " ". $angka[$x];
    } else if ($x <20) {
        $temp = kekata($x - 10). " belas";
    } else if ($x <100) {
        $temp = kekata($x/10)." puluh". kekata($x % 10);
    } else if ($x <200) {
        $temp = " seratus" . kekata($x - 100);
    } else if ($x <1000) {
        $temp = kekata($x/100) . " ratus" . kekata($x % 100);
    } else if ($x <2000) {
        $temp = " seribu" . kekata($x - 1000);
    } else if ($x <1000000) {
        $temp = kekata($x/1000) . " ribu" . kekata($x % 1000);
    } else if ($x <1000000000) {
        $temp = kekata($x/1000000) . " juta" . kekata($x % 1000000);
    } else if ($x <1000000000000) {
        $temp = kekata($x/1000000000) . " milyar" . kekata(fmod($x,1000000000));
    } else if ($x <1000000000000000) {
        $temp = kekata($x/1000000000000) . " trilyun" . kekata(fmod($x,1000000000000));
    }     
        return $temp;
}
 
/**
 * [terbilang description]
 * @param  [type]  $x     [description]
 * @param  integer $style [description]
 * @return [type]         [description]
 */
function terbilang($x, $style=4) {
    if($x<0) {
        $hasil = "minus ". trim(kekata($x));
    } else {
        $hasil = trim(kekata($x));
    }     
    switch ($style) {
        case 1:
            $hasil = strtoupper($hasil);
            break;
        case 2:
            $hasil = strtolower($hasil);
            break;
        case 3:
            $hasil = ucwords($hasil);
            break;
        default:
            $hasil = ucfirst($hasil);
            break;
    }     
    return $hasil;
}


/**
 * [status_spm description]
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
function status_spm($id)
{
    $status = "";
    switch ($id) {
        case 1:
            $status = "On Progress";
            break;
        case 2:
            $status = "<i class=\"fa fa-check-square\"></i> Selesai";
            break;
        case 3:
            $status = "Dibatalkan";
            break;
        case 4:
            $status = "Terkirim";
            break;
            
        default:
            $status = "On Progress";
            break;
    }
    
    if($status == "Dibatalkan")
        return "<button class=\"btn btn-danger btn-xs\"><i class=\"fa fa-close\"></i>  ". $status ."</button>";
    else
        return "<button class=\"btn btn-success btn-xs\">". $status ."</button>";
}

/**
 * [get_stock_product description]
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
function get_stock_product($id)
{
    $CI = get_instance();
    
    // stock_temporary
    // stock
    $product = $CI->db->query("SELECT * FROM products WHERE id={$id}")->row_array();


    if(!$product) return 0;

    return ($product['stock'] - $product['stock_temporary']);
}


/**
 * [total_shift_lembar_kerja description]
 * @param  [type] $product_schedule_id [description]
 * @param  [type] $day                 [description]
 * @param  [type] $shift               [description]
 * @param  [type] $product_id          [description]
 * @return [type]                      [description]
 */
function total_shift_lembar_kerja($product_schedule_id, $day, $shift, $product_id)
{
    // Get a reference to the controller object
    $CI = get_instance();   

    $result = $CI->db->query("SELECT * FROM product_schedule_plan_lembar_kerja where product_schedule_id={$product_schedule_id} AND day={$day} AND shift={$shift} AND product_id={$product_id}")->row_array();

    return $result;
}


/**
 * [total_shift_lembar_kerja_tulangan description]
 * @param  [type] $tulangan_schedule_id [description]
 * @param  [type] $day                  [description]
 * @param  [type] $shift                [description]
 * @param  [type] $tulangan_id          [description]
 * @return [type]                       [description]
 */
function total_shift_lembar_kerja_tulangan($tulangan_schedule_id, $day, $shift, $tulangan_id)
{
    // Get a reference to the controller object
    $CI = get_instance();   

    $result = $CI->db->query("SELECT * FROM tulangan_schedule_plan_lembar_kerja where tulangan_schedule_id={$tulangan_schedule_id} AND day={$day} AND shift={$shift} AND tulangan_id={$tulangan_id}")->row_array();

    return $result;
}



if(!function_exists('total_plan_pcs'))
{
    function total_plan($id, $type)
    {
        // Get a reference to the controller object
        $CI = get_instance();

        $total_tonase   = 0;
        $total_pcs = $CI->db->query("SELECT sum(p.day1_shift1 + p.day1_shift2 + p.day2_shift1 + p.day2_shift2 + p.day3_shift1 + p.day3_shift2 + p.day4_shift1 + p.day4_shift2 + p.day5_shift1 + p.day5_shift2 + p.day6_shift1 + p.day6_shift2) as total FROM product_schedule_plan p 
            WHERE product_schedule_id={$id}")->row_array()['total'];

        $sql = $CI->db->query("SELECT sum(p.day1_shift1 + p.day1_shift2 + p.day2_shift1 + p.day2_shift2 + p.day3_shift1 + p.day3_shift2 + p.day4_shift1 + p.day4_shift2 + p.day5_shift1 + p.day5_shift2 + p.day6_shift1 + p.day6_shift2) as total, pr.weight FROM product_schedule_plan p 
            INNER JOIN products pr on pr.id=p.product_id
            WHERE product_schedule_id={$id} GROUP BY p.product_id")->result_array();

        foreach($sql as $item)
        {
            $total_tonase += $item['total']*$item['weight'];
        }

        return ($type == 'tonase' ? $total_tonase : $total_pcs);
    }
}

if(!function_exists('total_plan_pcs'))
{
    function total_cetakan_plan($id)
    {
        // Get a reference to the controller object
        $CI = get_instance();

        $total = $CI->db->query("SELECT SUM(cetakan) as total FROM product_schedule_plan p WHERE product_schedule_id={$id}")->row_array()['total'];

        echo $total;
    }
}

if ( ! function_exists('position_qo'))
{
    function position_qo($position_id = '', $quotation_id=null)
    {
        $message = '';
        switch ($position_id):
            case 0:
                $message = "Draft";
                break;
            case 1:
                $message = "Sales Admin";
                break;
            case 2:
                $message = "Sales";
                break;
            case 3:
                $message = "AR";
                break;
            case 4:
                $message = "Manager";
                break;
            case 5:
                $message = "Disetujui"; 
                break;
            default:
                $message = "Draft";
                break;
        endswitch;

        return "<button class=\"btn btn-success btn-xs\">{$message}</button>";
    }   
}

if ( ! function_exists('position_sik'))
{
    /**
     * [position_sik description]
     * @param  string $position_id [description]
     * @return [type]              [description]
     */
    function position_sik($position_id = '')
    {
        $message = '';
        switch ($position_id):
            case 1:
                $message = "Manager AR";
                break;
            case 2:
                $message = "Manager";
                break;
            case 3:
                $message = "Disetujui";
                break;

            case 4:
                $message = "Ditolak";
                break;
                
            default:
                $message = "Draft";
            break;
        endswitch;

        if($message == "Dibatalkan")
            return "<button class=\"btn btn-danger btn-xs\">{$message}</button>";
        else
            return "<button class=\"btn btn-success btn-xs\">{$message}</button>";
    }   
}



/**
 * Generate an array of string dates between 2 dates
 *
 * @param string $start Start date
 * @param string $end End date
 * @param string $format Output format (Default: Y-m-d)
 *
 * @return array
 */
function getDatesFromRange($start, $end, $format = 'Y-m-d') {
    $array = array();
    $interval = new DateInterval('P1D');

    $realEnd = new DateTime($end);
    $realEnd->add($interval);

    $period = new DatePeriod(new DateTime($start), $interval, $realEnd);

    foreach($period as $date) { 
        $array[] = $date->format($format); 
    }

    return $array;
}

/**
 * 
 */
if ( ! function_exists('position_so'))
{
    function position_so($position_id = '')
    {
        $message = "";
        switch ($position_id):
            case 0:
                $message = "Draft";
                break;
            case 1:
                $message =  "Sales Admin";
                break;
            case 2:
                $message =  "Sales";
                break;
            case 3:
                $message =  "AR";
                break;
            case 4:
                $message =  "Manager";
                break;
            case 5:
                $message =  "Disetujui";
                break;
            case 6:
                $message =  "Closed";
                break;
            default:
                $message =  "Draft";
                break;
        endswitch;
        
        return "<button class=\"btn btn-success btn-xs\">{$message}</button>";

    }   
}

    
/**
 * [KonDecRomawi description]
 * @param [type] $angka [description]
 */
if ( ! function_exists('toRomawi'))
{
    function toRomawi($angka){
        $hsl = "";
        if($angka<1||$angka>3999){
            $hsl = "Batas Angka 1 s/d 3999";
        }else{
             while($angka>=1000){
                 $hsl .= "M";
                 $angka -= 1000;
             }
             if($angka>=500){
                 if($angka>500){
                     if($angka>=900){
                         $hsl .= "M";
                         $angka-=900;
                     }else{
                         $hsl .= "D";
                         $angka-=500;
                     }
                 }
             }
             while($angka>=100){
                 if($angka>=400){
                     $hsl .= "CD";
                     $angka-=400;
                 }else{
                     $angka-=100;
                 }
             }
             if($angka>=50){
                 if($angka>=90){
                     $hsl .= "XC";
                      $angka-=90;
                 }else{
                    $hsl .= "L";
                    $angka-=50;
                 }
             }
             while($angka>=10){
                 if($angka>=40){
                    $hsl .= "XL";
                    $angka-=40;
                 }else{
                    $hsl .= "X";
                    $angka-=10;
                 }
             }
             if($angka>=5){
                 if($angka==9){
                     $hsl .= "IX";
                     $angka-=9;
                 }else{
                    $hsl .= "V";
                    $angka-=5;
                 }
             }
             while($angka>=1){
                 if($angka==4){
                    $hsl .= "IV";
                    $angka-=4;
                 }else{
                    $hsl .= "I";
                    $angka-=1;
                 }
             }
        }
        return ($hsl);
    }

    /**
     * 
     */
    if ( ! function_exists('get_vendor'))
    {
        function get_vendor($array = [])
        {
            $CI = get_instance();

            $CI->db->select('*');
            $CI->db->from('vendor_of_material');
            $query = $CI->db->get();

            return $query->result_array();
        }
    }

    if ( ! function_exists('generate_vendor_id'))
    {
        function generate_vendor_id()
        {            
            $CI = get_instance();
            $CI->db->from('vendor_of_material');
            $query = $CI->db->get();
            $count =  $query->num_rows() + 1;
            return "V/".date("ymdhis")."/".$count;
        }
    }   

    if ( ! function_exists('get_divisi'))
    {
        function get_divisi($items = null)
        {
            if(! isset($items))
                return "";

            $division = explode(",", $items);
            if(count($division) < 1)
                return "";

            $CI = get_instance();

            $CI->db->select('*');
            $CI->db->from('division');
            $CI->db->where_in('id', $division);

            $query = $CI->db->get();
            $result = "";
            if($query->num_rows() > 0){               
                $temp = [];
                foreach ($query->result_array() as $key => $value) {
                    $temp[] = $value['name'];
                } 

                $result = implode(", ", $temp) ;
            }

            return $result;
        }
    }

    if ( ! function_exists('generate_purchase_request_no'))
    {
        function generate_purchase_request_no($project_code = null)
        {
            $CI = get_instance();
            $CI->db->from('purchase_request');
            $query = $CI->db->get();
            $count =  $query->num_rows() + 1;
            
            return $project_code . "/".date("dm")."/".$count;
        }
    }

    if ( ! function_exists('generate_request_for_qoutation_no'))
    {
        function generate_request_for_qoutation_no()
        {
             $CI = get_instance();
            $CI->db->from('request_for_qoutation');
            $query = $CI->db->get();
            $count =  $query->num_rows() + 1;
            return "RFQ/".date("ymdhis")."/".$count;
        }
    }

    if ( ! function_exists('generate_purchase_order_no'))
    {
        function generate_purchase_order_no($code)
        {
            $CI = get_instance();
            $CI->db->from('purchase_order_warehouse');
            $query = $CI->db->get();
            $count =  $query->num_rows() + 1;
            return "PO/". $code. "/".date("dm")."/".$count;
        }
    }
}