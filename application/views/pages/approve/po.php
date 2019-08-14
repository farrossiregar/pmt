
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Purchase Request</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?=base_url('assets/vendors/bootstrap/dist/css/bootstrap.min.css')?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url('assets/vendors/font-awesome/css/font-awesome.min.css')?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?=base_url()?>assets/dist/css/AdminLTE.css?v=<?=date('YmdHis')?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="/"><img src="<?=base_url('assets/pnl-logo.png')?>" style="width: 180px;" /></a>
  </div>
  <div class="register-box-body">
    <p class="login-box-msg">Purchase Order <strong>#<?=$data->po_number?></strong></p>
    <form action="" method="post" id="form_purchase_request">
      <div class="form-group">
        <label class="control-label col-md-12 col-sm-2 col-xs-12">Company</label>
        <div class="col-md-12 col-sm-12 col-xs-12"> 
           <input type="text" readonly class="form-control" value="<?=$data->company?>">
        </div>
     </div>
     <div class="clearfix"></div><br />
     <div class="form-group">
        <label class="control-label col-md-12" for="material_group">Vendor / Supplier</label>
        <div class="col-sm-12"> 
           <input type="text" readonly class="form-control" value="<?=$data->vname?>">
        </div>
     </div>
     <div class="clearfix"></div><br />
     <div class="form-group">
        <label class="control-label col-md-12" for="material_group">PO Number</label>
        <div class="col-sm-12"> 
           <input type="text" readonly class="form-control" value="<?=$data->po_number?>">
        </div>
     </div>
     
     <div class="clearfix"></div><br />
     <div class="form-group">
        <label class="control-label col-md-12" for="material_group">Quotation Number</label>
        <div class="col-md-12"> 
           <input type="text" readonly class="form-control" value="<?=$data->quotation_number?>">
        </div>
     </div>
     <div class="clearfix"></div><br />
     <input type="hidden" name="PO[vendor_id]" value="<?=$data->vendor_id?>">
     <div class="form-group">
        <label class="control-label col-md-12" for="doc_date">Doc. Date <span class="required">*</span>
        </label>
        <div class="col-md-12">
           <input type="text" id="doc_date" readonly value="<?=$data->doc_date?>"  class="form-control col-md-7 col-xs-12 tanggal">
        </div>
     </div>
     <div class="clearfix"></div><br />
     <div class="form-group">
        <label class="control-label col-md-12" for="material_group">RFQ Number</label>
        <div class="col-sm-12">
           <input type="text" readonly class="form-control" value="<?=$data->rfq_number?>">
           <input type="hidden" name="PO[rfq_id]" name="<?=$data->rfq_id?>">
        </div>
     </div>
     <div class="clearfix"></div><br />
     <div class="form-group">
        <label class="control-label col-md-12" for="material_group">Document Title</label>
        <div class="col-md-12">
           <input type="text" class="form-control" readonly value="<?=$data->document_title?>">
        </div>
     </div>
     <div class="clearfix"></div><br />
     <div class="form-group">
        <label class="control-label col-md-12" for="material_group">Solicitation Type<span class="required">*</span>
        </label>
        <div class="col-md-12">
            <select  disabled class="form-control">
              <?php 
                 $solicatation = SOLICITATION___TYPE;                           
                 foreach ($solicatation as $key => $value) {
                    $selected = "";
                    if(isset($data->solicatation_type) AND  $data->solicatation_type == $key)
                       $selected="selected";

                    echo "<option ".$selected." value='".$key."'>".$value."</option>";
                 }
              ?>
           </select>
        </div>
     </div>
     <div class="clearfix"></div><br />
     <div class="form-group">
        <label class="control-label col-md-12" for="material_group">Currency<span class="required">*</span>
        </label>
        <div class="col-md-12">
           <select disabled class="form-control">
              <?php 
                 $currency = CURRENCY;
                 
                 foreach ($currency as $key => $value) {
                    $selected = "";
                    if(isset($data->currency) AND  $data->currency == $key)
                       $selected="selected";

                    echo "<option ".$selected." value='".$key."'>".$value."</option>";
                 }
              ?>
           </select>
        </div>
     </div>
     <div class="clearfix"></div><br />
     <div class="form-group">
        <label class="control-label col-md-12" for="material_group">Delivery Date</label>
        <div class="col-md-12">
           <input type="text" class="form-control tanggal" readonly value="<?=isset($data->delivery_date) ? $data->delivery_date : '';?>">
        </div>
     </div>
     <div class="clearfix"></div><br />
     <div class="form-group">
        <label class="control-label col-md-12" for="material_group">Expiration Date and Time</label>
        <div class="col-md-12">
           <input type="text" class="form-control" id="expired_date" readonly value="<?=isset($data->expired_date) ? $data->expired_date : '';?>">
        </div>
     </div>
     <div class="clearfix"></div><br />
     <div class="form-group">
        <label class="control-label col-md-12" for="material_group">Delivery Address</label>
        <div class="col-md-12">
            <?php if(empty($data->rfq_id)):?>
            <?php if(isset($data->detail_delivery_address)) { $address = $data->detail_delivery_address; }else $address = ''; ?>
            <?php else: ?>
            <?php if(isset($data->address)) { $address = $data->address; }else $address = ''; ?>
            <?php endif;?>
           <textarea class="form-control" readonly><?=$address?></textarea>
        </div>
     </div>
     <div class="clearfix"></div><br />
     <div class="form-group">
        <label class="control-label col-md-12" for="material_group">Term of Payment<span class="required">*</span>
        </label>
        <div class="col-md-12">
           <input type="number" class="form-control" name="PO[term_day]" readonly value="<?=isset($data->term_day) ? $data->term_day : '';?>" style="width: 150px; float: left; margin-right: 10px;">
           <label style="margin-top:8px;">After Invoice Received</label>
        </div>
     </div>   
     <div class="clearfix"></div><br />
     <div class="form-group">
       <div class="col-md-12">
         <table align="center" class="table" style="margin:auto; width: 100%" >
            <tbody id="term_body">
               <?php if(isset($term)): ?>
                  <?php foreach($term as $item): ?>
                     <tr>
                        <td><input type="text" name="term[]" class="form-control" readonly placeholder="Term" value="<?=$item->term?>"></td>
                        <td><input type="text" name="cond[]" class="form-control" readonly placeholder="Condition" value="<?=$item->cond?>"></td>
                        <td style="text-align: right;"></td>
                     </tr>
                  <?php endforeach; ?>
               <?php endif; ?>
            </tbody>
         </table>
        </div>
      </div>
     <hr />
     <div class="x_panel">
        <div class="col-md-12">
           <div class="x_content">
              <h4>Material</h4>
              <table class="table table-bordered">
                 <thead>
                   <tr>
                     <th style="width: 50px;">No</th>
                     <th>Item</th>
                     <th>QTY</th>
                     <th>Price List</th>
                     <th>Discount (%)</th>
                     <th>Price</th>
                   </tr>
                 </thead>
                 <tbody class="add-table-rfq-request">
                    <?php 
                      $vat = 0;
                       if(isset($material) AND count($material) > 0)
                       {
                          $sub_total = 0;
                          foreach ($material as $key => $item)
                          {
                             echo '<tr>';
                             echo '<td>'. ($key+1) .'</td>';
                             echo '<td>'. $item->material .'</td>';
                             echo '<td>'. $item->qty .'</td>';
                             echo '<td>'. format_idr($item->price) .'</td>';
                             echo '<td>'. $item->discount .'</td>';
                             $d = 0;
                             if(!empty($item->discount)) $d = $item->discount * $item->price / 100;

                             echo '<td class="sub_total">'. format_idr(($item->price - $d) * $item->qty) .'</td>';
                             echo '</tr>';

                             echo '<input type="hidden" name="Material['. $key .'][material_id]" value="'. $item->material_id .'" />';
                             echo '<input type="hidden" name="Material['. $key .'][qty]" value="'. $item->qty .'" />';
                             echo '<input type="hidden" name="Material['. $key .'][price]" value="'. $item->price .'" />';
                             echo '<input type="hidden" name="Material['. $key .'][discount]" value="'. $item->discount .'" />';

                             $sub_total += ($item->price - $d) * $item->qty;
                          }    

                          $vat = $data->vat * $sub_total / 100;
                       }
                    ?>
                 </tbody>                
                 <tfoot style="background: #f5f5f5;">
                    <tr>
                       <td colspan="5" style="text-align: right;background: #f5f5f5;">Sub Total</td>
                       <th style="background: #f5f5f5;"> <?=format_idr($sub_total)?></th>
                    </tr>
                    <tr>
                       <td colspan="5" style="text-align: right;vertical-align: middle;">
                          <?php 
                            if($data->vat_type==1)
                            { 
                              echo "PPH"; 
                            }else  echo "PPN";?>
                       </td>
                       <th><?=format_idr($data->vat)?>% (Rp. <?=format_idr($vat)?>)</th>
                    </tr>
                    <tr>
                       <td colspan="5" style="text-align: right;vertical-align: middle;">Shipping Charge</td>
                       <th><?=format_idr($data->shipping_charge)?></th>
                    </tr>
                    <tr>
                       <td colspan="5" style="text-align: right;background: #f5f5f5;" title="Value After Tax" colspan="3">Total</td>
                       <th style="background: #f5f5f5;" class="vat"><?=format_idr( $sub_total + $data->shipping_charge + $vat)?></th>
                    </tr>
                 </tfoot>
              </table>
              <input type="hidden" name="sub_total" value="<?=$sub_total?>">
              <input type="hidden" name="tax">
              <input type="hidden" name="total" value="<?=($sub_total + $data->shipping_charge + $vat - $data->discount_rp)?>">
           </div>
        </div>
     </div>
      <div class="form-group">
        <div class="col-md-12">
          <textarea name="note" class="form-control" placeholder="Note"></textarea>
        </div>
      </div>
      <div class="clearfix"></div><br />
      <div class="form-group">
        <div class="col-xs-8">
          <button type="button" class="btn btn-danger btn-sm" onclick="reject()"><i class="fa fa-close"></i> Reject</button>
        </div>
        <!-- /.col -->
        <div class="col-xs-4" style="text-align: right;">
          <?php if(isset($is_ho)):?>
          <a href="<?=site_url()?>" target="_blank" class="btn btn-info btn-sm"><i class="fa fa-sign-in"></i> Login</a>
          <?php endif; ?>
          <button type="button" class="btn btn-success btn-sm" onclick="approve()"><i class="fa fa-check"></i>Approve</button>
        </div>
        <!-- /.col -->
      </div>
      <div class="clearfix"></div><br >
      <input type="hidden" name="status" value="1">
    </form>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 3 -->
<script src="<?=base_url('assets/vendors/jquery/dist/jquery.min.js')?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url('assets/vendors/bootstrap/dist/js/bootstrap.min.js')?>"></script>
<script type="text/javascript">
  function approve()
  {
    if(confirm('Approve Purchase Order #<?=$data->po_number?> ?'))
    {
      $("#form_purchase_request").trigger('submit');
    }
  }

  function reject()
  {
    if($("textarea[name='note']").val() == "")
    {
      alert("Note required.");
    }
    else if(confirm('Reject Purchase Order #<?=$data->po_number?> ?'))
    {
      $("input[name='status']").val(0);
      $("#form_purchase_request").trigger('submit');
    }
  }
</script>
</body>
</html>
