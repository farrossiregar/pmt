<div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
         <div class="x_title">
            <h2>Quotation From <label class="text-danger"><?=$data['case_id']?></label></h2>
            <a href="<?=site_url('requestForQuotation/bac')?>/<?=$data['id']?>" class="btn btn-default btn-sm pull-right"><i class="fa fa-arrow-left"></i> Back</a>
            <div class="clearfix"></div>
         </div>
         <div class="x_content">
            <form id="demo-form2" method="post" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
              <input type="hidden" name="RFQ[rfq_id]" value="<?=$data['id']?>" />
              <input type="hidden" name="RFQ[vendor_id]" value="<?=$vendor_id?>" />
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Quotation Number</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" readonly class="form-control" value="<?=$quotation['quotation_number']?>">
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Vendor</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" readonly class="form-control" value="<?=@$_GET['vendor_name']?>">
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">RFQ Number</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" readonly class="form-control" value="<?=isset($data['case_id']) ? $data['case_id'] : generate_request_for_qoutation_no()?>">
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Document Title</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" class="form-control" readonly value="<?=isset($data['document_title']) ? $data['document_title'] : '';?>">
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Solicitation Type</label>
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
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Currency</label>
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
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Delivery Date</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" class="form-control tanggal" readonly value="<?=isset($data['delivery_date']) ? $data['delivery_date'] : '';?>">
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Expiration Date and Time</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" class="form-control" id="expired_date" readonly value="<?=isset($data['expired_date']) ? $data['expired_date'] : '';?>">
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Delivery Address</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <textarea class="form-control" readonly><?=isset($data['detail_delivery_address']) ? $data['detail_delivery_address'] : '';?></textarea>
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Term of Payment</label>
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
                       </tr>
                     <?php }
                      } 
                     ?>
                  </tbody>
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
                               <th>Sub Total</th>
                             </tr>
                           </thead>
                           <tbody class="add-table-rfq-request">
                              <?php 
                                 if(isset($material) AND count($material) > 0)
                                 {
                                    $sub_total = 0;
                                    foreach ($material as $key => $item)
                                    {
                                        echo '<tr>';
                                        echo '<td>'. ($key+1) .'</td>';
                                        echo '<td>'. $item['material'] .'</td>';
                                        echo '<td>'. $item['qty'] .'</td>';
                                        echo '<td>'. format_idr($item['price']) .'</td>';
                                        echo '<td>'. $item['discount'] .'</td>';

                                        $discount = 0;
                                        if(!empty($item['discount']))
                                        {
                                          $discount = $item['discount'] * $item['price'] / 100; 
                                        }

                                       echo '<td class="sub_total">'. format_idr(($item['price'] - $discount) * $item['qty']) .'</td>';
                                       echo '</tr>';
                                      
                                      

                                      $sub_total += ($item['price'] - $discount) * $item['qty'];
                                    }                                 
                                 }
                              ?>
                           </tbody>      
                           <tfoot style="background: #f5f5f5;">
                              <tr>
                                 <th colspan="5" style="text-align: right;">Sub Total</th>
                                 <td class="foot_sub_total"> <?=format_idr($sub_total)?></td>
                              </tr>
                              <tr>
                                <th colspan="5" style="text-align: right;vertical-align: middle;">
                                  <?php if(isset($quotation_id)):?>
                                    <?=($quotation['vat_type'] == 1 ? 'PPH' : 'PPN')?>
                                  <?php else:?>
                                    PPH / PPN
                                  <?php endif;?>
                                 </th>
                                 <td>
                                    <?php if(isset($quotation_id)):?>
                                      <a href="javascript:void(0)"><?=$quotation['vat']?>%</a>
                                    <?php else: ?>
                                      0%
                                    <?php endif; ?>
                                 </td>
                              </tr>
                              <tr>
                                 <th colspan="5" style="text-align: right;vertical-align: middle;">Shipping Charge</th>
                                 <td>
                                    <?php if(isset($quotation_id)):?>
                                      <?=format_idr($quotation['shipping_charge'])?>
                                    <?php else: ?>
                                      0
                                    <?php endif; ?>
                                 </td>
                              </tr>
                              <tr>
                                 <th colspan="5" style="text-align: right;" title="Value After Tax" colspan="3">Total</th>
                                 <td class="total">
                                  <?php 
                                    if(isset($quotation_id)):
                                      $sub_total = $sub_total + $quotation['shipping_charge'] + ($quotation['vat'] * $sub_total / 100);
                                    endif;
                                  ?>
                                  <?=format_idr($sub_total)?></td>
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
                     <a href="<?=site_url('requestForQuotationVendor')?>" class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
                     <?php if(!isset($quotation_id)):?>
                     <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-paper-plane"></i> Submit</button>
                   <?php endif?>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>