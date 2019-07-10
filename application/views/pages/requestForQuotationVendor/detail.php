<div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
         <div class="x_title">
            <h2>Create Quotation From <label class="text-danger"><?=$data['case_id']?></label></h2>
            <a href="<?=site_url('requestForQuotationVendor/index')?>" class="btn btn-default btn-sm pull-right"><i class="fa fa-arrow-left"></i> Back</a>
            <div class="clearfix"></div>
         </div>
         <div class="x_content">
            <form id="demo-form2" method="post" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
              <input type="hidden" name="RFQ[rfq_id]" value="<?=$data['id']?>" />
              <input type="hidden" name="RFQ[vendor_id]" value="<?=$vendor_id?>" />

               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Quotation Number<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" readonly class="form-control" name="RFQ[quotation_number]" value="<?=generate_qoutation_no_vendor()?>">
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">RFQ Number<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" readonly class="form-control" value="<?=isset($data['case_id']) ? $data['case_id'] : generate_request_for_qoutation_no()?>">
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Document Title<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" class="form-control" readonly value="<?=isset($data['document_title']) ? $data['document_title'] : '';?>">
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Solicitation Type<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                      <select  readonly class="form-control">
                        <?php 
                           $solicatation = SOLICITATION___TYPE;                           
                           foreach ($solicatation as $key => $value) {
                              $selected = "";
                              if(isset($data['solicatation_type']) AND  $data['solicatation_type'] == $key)
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
                     <select readonly class="form-control">
                        <?php 
                           $currency = CURRENCY;
                           
                           foreach ($currency as $key => $value) {
                              $selected = "";
                              if(isset($data['currency']) AND  $data['currency'] == $key)
                                 $selected="selected";

                              echo "<option ".$selected." value='".$key."'>".$value."</option>";
                           }
                        ?>
                     </select>
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Delivery Date<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" class="form-control tanggal" readonly value="<?=isset($data['delivery_date']) ? $data['delivery_date'] : '';?>">
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Expiration Date and Time<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" class="form-control" id="expired_date" readonly value="<?=isset($data['expired_date']) ? $data['expired_date'] : '';?>">
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Delivery Address<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <textarea class="form-control" readonly><?=isset($data['detail_delivery_address']) ? $data['detail_delivery_address'] : '';?></textarea>
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Term of Payment<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="number" class="form-control" readonly value="<?=isset($data['term_day']) ? $data['term_day'] : '';?>" style="width: 150px; float: left; margin-right: 10px;">
                     <label style="margin-top:8px;">After Invoice Received</label>
                  </div>
               </div>
               <table align="center" class="table" style="margin:auto; width: 50%" >
                  <tbody id="term_body">
                     <?php if(isset($term)){ ?>
                     <?php foreach($term as $item){ ?>
                        <tr>
                          <td><input type="text" readonly name="term[<?=$item['id']?>]" class="form-control" value="<?=$item['term']?>" placeholder="Term"></td>
                          <td><input type="text" readonly name="cond[<?=$item['id']?>]" class="form-control" value="<?=$item['cond']?>" placeholder="Cond"></td>
                          <!-- <td><label><input type="checkbox" name="approve[<?=$item['id']?>]" value="1" /> Agree</label></td> -->
                       </tr>
                     <?php }
                      } 
                     ?>
                  </tbody>
                 <!--  <tfoot>
                     <tr>
                        <td colspan="3" style="text-align: right;"><a style="cursor: pointer;" class="btn btn-primary btn-xs" id="add_term"><i class="fa fa-plus"></i> Add Term & Condition</a></td>
                     </tr>
                  </tfoot> -->
               </table>
               <br/><br/>
               <br/>
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
                                 if(isset($material) AND count($material) > 0)
                                 {
                                    $sub_total = 0;
                                    foreach ($material as $key => $item)
                                    {
                                       $row = get_material_vendor_row($item['material_id'], $vendor_id);

                                       echo '<tr>';
                                       echo '<td>'. ($key+1) .'</td>';
                                       echo '<td>'. $item['material'] .'</td>';
                                       echo '<td>'. $item['qty'];
                                       echo '<input type="hidden" name="material_id[]" value="'. $item['material_id'] .'" />';
                                       echo '<input type="hidden" name="qty[]" value="'. $item['qty'] .'" />';
                                       echo '<input type="hidden" name="discount[]" value="'. $item['qty'] .'" />';
                                       echo '</td>';
                                       
                                       if($row)
                                       {
                                          echo '<td>'. format_idr($row['sales_price']);
                                          echo '<input type="hidden" name="price[]" value="'. $row['sales_price'] .'" />';
                                          echo '</td>';
                                       }
                                       else
                                       {
                                          echo '<td><input type="hidden" name="price[]" value="0" /></td>';
                                       }

                                       echo '<td>
                                             <a href="#" class="edit_disc" data-type="text" data-qty="'. $item['qty'] .'" data-price="'. $row['sales_price'] .'" data-pk="'. $row['id'] .'" >0</a>
                                       </td>';

                                       echo '<td class="sub_total">'. format_idr($row['sales_price'] * $item['qty']) .'</td>';
                                       echo '</tr>';

                                       $sub_total += $row['sales_price'] * $item['qty'];
                                    }                                 
                                 }
                              ?>
                           </tbody>                
                           <tfoot>
                              <tr>
                                 <th colspan="5" style="text-align: right;background: #f5f5f5;">Sub Total</th>
                                 <th style="background: #f5f5f5;"> <?=format_idr($sub_total)?></th>
                              </tr>
                              <tr>
                                 <th colspan="5" style="text-align: right;background: #f5f5f5;">VAT (%)</th>
                                 <td style="background: #f5f5f5;padding-top:0;">
                                    <!-- <input type="number" class="form-control calculate_tax" placeholder="%" style="width: 100px;" /> -->
                                    <a href="#" class="edit_disc" data-type="text">0</a>
                                 </td>
                              </tr>
                              <tr>
                                 <th colspan="5" style="text-align: right;background: #f5f5f5;" title="Value After Tax" colspan="3">Total</th>
                                 <th style="background: #f5f5f5;" class="vat"><?=format_idr($sub_total)?></th>
                              </tr>
                           </tfoot>
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
                     <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-paper-plane"></i> Submit</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
  function delete_term(el)
  {
    $(el).parent().parent().remove();
  }

  $("#add_term").click(function(){
    var el  = '<tr>';
        el += '<td><input type="text" class="form-control" name="term_2[]" placeholder="Term" /></td>';
        el += '<td><input type="text" class="form-control" name="cond_2[]" placeholder="Condition" /></td>';
        el += '<td style="text-align: left;"><a style="cursor: pointer;" class="btn btn-danger delete-term btn-sm" onclick="delete_term(this)"><i class="fa fa-trash"></i></a></td>';
        el += '</tr>';

    $('#term_body').append(el);
  });

   $('.edit_disc').editable(
    {
        success: function(response, val) {
         var price      =  $(this).data('price');
         var qty        =  $(this).data('qty');
         var sub_total  =  (price - (val * price / 100)) * qty;

         $(this).parent().parent().find('.sub_total').html(numberWithDot(sub_total)); 
         $(this).parent().parent().find("input[name='discount[]']").val(val); 
         
        }
      }
    );

   $(function(){
      $('.calculate_tax').on('input', function(){

         var tax        = $(this).val();
         var sub_total  = parseInt($("input[name='sub_total']").val());

         if(tax == "") tax = 0;

         var vat        = parseInt(tax * sub_total / 100) + parseInt(sub_total); 

         $(".vat").html(numberWithDot(vat));
         $("input[name='total']").val(vat);
         $("input[name='tax']").val(tax);
      });
   });
</script>