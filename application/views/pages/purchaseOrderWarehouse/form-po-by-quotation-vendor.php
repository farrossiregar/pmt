<div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
         <div class="x_title">
            <h2>Purchase Order # <label class="text-danger"><?=$data->vendor_name?> - <?=$data->vendor_pic_name?> / <?=$data->quotation_number?></label></h2>
            <a href="<?=site_url('requestForQuotationVendor/index')?>" class="btn btn-default btn-sm pull-right"><i class="fa fa-arrow-left"></i> Back</a>
            <div class="clearfix"></div>
         </div>
         <div class="x_content">
            <form id="demo-form2" method="post" onsubmit="return confirm('Submit Purchase Order ?')" class="form-horizontal form-label-left" action="<?=site_url('purchase-order/insert')?>">
               <?php if(isset($quotation_vendor_id)): ?>
               <input type="hidden" name="PO[quotation_vendor_id]" value="<?=$quotation_vendor_id?>">
               <?php endif;?>
               <?php if(isset($pr_id)): ?>
               <input type="hidden" name="PO[pr_id]" value="<?=$pr_id?>">
               <?php endif;?>
               <?php if(isset($rfq_id)): ?>
               <input type="hidden" name="PO[rfq_id]" value="<?=$rfq_id?>">
               <?php endif;?>
               
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Company</label>
                  <div class="col-md-6 col-sm-6 col-xs-12"> 
                     <input type="text" readonly class="form-control" value="<?=$data->company_name?>">
                     <input type="hidden" name="PO[company_id]" value="<?=$data->company_id?>">
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">PO Number</label>
                  <div class="col-md-6 col-sm-6 col-xs-12"> 
                     <input type="text" readonly class="form-control" name="PO[po_number]" value="<?=generate_purchase_order_no($data->company_code)?>">
                  </div>
               </div>

               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Quotation Number</label>
                  <div class="col-md-6 col-sm-6 col-xs-12"> 
                     <input type="text" readonly class="form-control" value="<?=$data->quotation_number?>">
                  </div>
               </div>
               <input type="hidden" name="PO[vendor_id]" value="<?=$data->vendor_id?>">
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="doc_date">Doc. Date <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" id="doc_date" required name="PO[doc_date]"  class="form-control col-md-7 col-xs-12 tanggal">
                  </div>
               </div>
               <?php if(isset($data->rfq_number)):?>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">RFQ Number</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" readonly class="form-control" value="<?=$data->rfq_number?>">
                  </div>
               </div>
               <?php endif; ?>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Document Title</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" class="form-control" readonly value="<?=$data->document_title?>">
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Solicitation Type<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
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
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Currency<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
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
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Delivery Date</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" class="form-control tanggal" readonly value="<?=isset($data->delivery_date) ? $data->delivery_date : '';?>">
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Expiration Date and Time</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" class="form-control" id="expired_date" readonly value="<?=isset($data->expired_date) ? $data->expired_date : '';?>">
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Delivery Address</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <textarea class="form-control" readonly><?=isset($data->detail_delivery_address) ? $data->detail_delivery_address : '';?></textarea>
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Term of Payment<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="number" class="form-control" name="PO[term_day]" readonly value="<?=isset($data->term_day) ? $data->term_day : '';?>" style="width: 150px; float: left; margin-right: 10px;">
                     <label style="margin-top:8px;">After Invoice Received</label>
                  </div>
               </div>   
               <table align="center" class="table" style="margin:auto; width: 50%" >
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
                  <tfoot>
                     <tr>
                        <td colspan="3" style="text-align: right;"><a style="cursor: pointer;" class="btn btn-primary btn-xs" id="add_term"><i class="fa fa-plus"></i> Add</a></td>
                     </tr>
                  </tfoot>
               </table>
               <div class="x_panel">
                  <div class="col-md-12">
                     <div class="x_content">
                        <h2>Material</h2>
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
                                       echo '<td>'. $item->price .'</td>';
                                       echo '<td>'. $item->discount .'</td>';
                                       echo '<td class="sub_total">'. format_idr($item->price * $item->qty) .'</td>';
                                       echo '</tr>';

                                       echo '<input type="hidden" name="Material['. $key .'][material_id]" value="'. $item->material_id .'" />';
                                       echo '<input type="hidden" name="Material['. $key .'][qty]" value="'. $item->qty .'" />';
                                       echo '<input type="hidden" name="Material['. $key .'][price]" value="'. $item->price .'" />';
                                       echo '<input type="hidden" name="Material['. $key .'][discount]" value="'. $item->discount .'" />';

                                       $sub_total += $item->price * $item->qty;
                                    }    

                                    $vat = $data->vat * $sub_total / 100;
                                 }
                              ?>
                           </tbody>
                           <tfoot style="background: #fbfbfb;">
                              <tr>
                                 <th colspan="5" style="text-align: right;vertical-align: middle;">
                                    Sub Total
                                 </th>
                                 <td><?=format_idr($sub_total)?></td>
                              </tr>
                              <tr>
                                 <th colspan="5" style="text-align: right;vertical-align: middle;">
                                    Discount
                                 </th>
                                 <td>
                                    <input type="number" class="form-control" name="PO[discount]" placeholder="%" style="width: 80px; float: left; margin-right: 10px;">
                                    <input type="number" class="form-control" name="PO[discount_rp]" placeholder="Rp. " style="width: 170px; float: left; margin-right: 10px;">
                                 </td>
                              </tr>
                              <tr>
                                 <td colspan="5" style="text-align: right;vertical-align: middle;">
                                    <select name="PO[vat_type]" class="form-control" style="width: 100px;float: right;">
                                       <option value="1">PPh</option>
                                       <option value="2">PPN</option>
                                    </select>
                                 </td>
                                 <td>
                                    <input type="number" class="form-control" name="PO[vat]" placeholder="% " style="width: 150px; float: left; margin-right: 10px;">
                                 </td>
                              </tr>
                              <tr>
                                 <th colspan="5" style="text-align: right;vertical-align: middle;">Shipping Charge</th>
                                 <td>
                                    <input type="number" class="form-control" name="PO[shipping_charge]" placeholder="Rp. " style="width: 150px; float: left; margin-right: 10px;">
                                 </td>
                              </tr>
                              <tr>
                                 <td colspan="5" style="text-align: right;vertical-align: middle;">
                                    <b>Total</b>
                                    <input type="hidden" name="PO[total]" value="<?=$sub_total?>" />
                                 </td>
                                <td id="total"><?=format_idr($sub_total)?></td>
                              </tr>
                          </tfoot>           
                          <!--  <tfoot>
                              <tr>
                                 <th colspan="5" style="text-align: right;background: #f5f5f5;">Sub Total</th>
                                 <th style="background: #f5f5f5;"> <?=format_idr($sub_total)?></th>
                              </tr>
                              <tr>
                                 <th colspan="5" style="text-align: right;background: #f5f5f5;">VAT (<?=$data->vat?>%)</th>
                                 <th style="background: #f5f5f5;padding-top:0;">
                                    <a href="#" class="edit_disc" data-type="text"><?=($vat * $sub_total / 100)?></a>
                                    <input type="hidden" name="PO[vat]" value="<?=$data->vat?>">
                                 </th>
                              </tr>
                              <tr>
                                 <th colspan="5" style="text-align: right;background: #f5f5f5;" title="Value After Tax" colspan="3">Total</th>
                                 <th style="background: #f5f5f5;" class="vat"><?=format_idr($sub_total)?></th>
                              </tr>
                           </tfoot> -->
                        </table>
                        <input type="hidden" name="sub_total" value="<?=$sub_total?>">
                        <input type="hidden" name="tax">
                        <input type="hidden" name="total">
                     </div>
                  </div>
               </div>
                <div class="form-group">
                  <div>
                     <a href="#" onclick="history.back()" class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
                     <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-paper-plane"></i> Submit Purchase Order</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">

   var total = <?=$sub_total?>;

   function init_calculate(rp = "")
   {
      if(total == 0 || total == "") return false;

      var disc             = $("input[name='PO[discount]']").val() !="" ? parseInt($("input[name='PO[discount]']").val()) : 0;
      var shipping_charge  = $("input[name='PO[shipping_charge]']").val() !="" ? parseInt($("input[name='PO[shipping_charge]']").val()) : 0;
      var vat              = $("input[name='PO[vat]']").val() !="" ? parseInt($("input[name='PO[vat]']").val()) : 0;
      var discount_rp      = $("input[name='PO[discount_rp]']").val() !="" ? parseInt($("input[name='PO[discount_rp]']").val()) : 0;
      var total_           = total;

      if(disc != 0 && rp == "")
      {
         disc  = disc * total / 100; 
         total_ = parseInt(total_) - disc;
         $("input[name='PO[discount_rp]']").val(disc);
      }
      if(rp != "")
      {
         disc     = discount_rp / total * 100; 
         total_   = parseInt(total_) - discount_rp;
         $("input[name='PO[discount]']").val(disc);
      }
      if(vat != 0)
      {
         vat  = vat * total_ / 100; 
         total_ = parseInt(total_ + vat);
      }

      total_ += parseInt(shipping_charge);
      
      $("#total").html(numberWithDot(total_)); 
   }

   $( document ).ready(function() {      
      $("input[name='PO[discount]'], input[name='PO[vat]'], input[name='PO[shipping_charge]'], input[name='PO[discount_rp]']").on('input', function(){
         
         if($(this).attr('name') == 'PO[discount_rp]')
         {
            init_calculate('rp');         
         } 
         else init_calculate();         

      });
   });

   $("#add_term").click(function(){
      //term_body
      var td = '<tr">' +
                  '<td><input type="text" id="tem_0" name="term[]" class="form-control" placeholder="Term"></td>' +
                  '<td><input type="text" id="cond_0" name="cond[]" class="form-control" placeholder="Cond"></td>' +
                  '<td style="text-align: rightl"><a style="cursor: pointer;" class="btn btn-danger delete-term" onclick="delete_term(this)"><i class="fa fa-trash"></i></a></td>' +
               '</tr>';

      $("#term_body").append(td);
      term ++;
   });

   function delete_term(el)
   {
      $(el).parent().parent().remove();
   }

</script>