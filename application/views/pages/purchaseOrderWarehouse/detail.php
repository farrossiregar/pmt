<div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
         <div class="x_title">
            <h2>Purchasing Order</h2>
            <div class="clearfix"></div>
         </div>
         <div class="x_content">
            <br>
            <form id="demo-po" method="post" class="form-horizontal form-label-left">
              <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="po_number">Company <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="form-control" disabled>
                      <option value="">-- Select Company --</option>
                      <?php foreach(get_company() as $item) { ?>
                     <option value="<?=$item['id']?>" <?=($data['company_id'] == $item['id']) ? 'selected' : ''?> data-po_number="<?=generate_purchase_order_no($item['code'])?>"><?=$item['name']?></option>
                      <?php } ?>
                    </select>
                  </div>
               </div>
              <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="po_number">PO Number <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" id="po_number" required="required" value="<?=$data['po_number']?>" readonly="readonly" class="form-control col-md-7 col-xs-12">
                  </div>
              </div>
               <?php if(!empty($data['rfq_number'])):?>
              <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="rfq_id">RFQ Number <span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" class="form-control" value="<?=$data['rfq_number']?>" disabled>
                  </div>
              </div>
               <?php endif;?>
              <!-- <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pr_id">PR Number <span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" value="<?=$data['pr_number']?>" disabled>
                  </div>
               </div> -->
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="vendor_id">Vendor <span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" class="form-control" value="<?=$data['vname']?>" disabled>
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="doc_date">Doc. Date <span class="required">*</span>
                  </label>
                  <div class="col-md-3 col-sm-3 col-xs-3">
                     <input type="text" class="form-control col-md-7 col-xs-12" disabled value="<?=$data['doc_date']?>">
                  </div>
               </div>               
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Term of Payment<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="number" class="form-control" disabled value="<?=$data['term_day']?>" placeholder="Day" style="width: 150px; float: left; margin-right: 10px;">
                     <label style="margin-top:8px; float: left;">After Invoice Received</label><div style="clear:both;"></div>
                     <input type="text" class="form-control" value="<?=$data['term_day_remark']?>" disabled style="margin-top:5px;float: left;margin-left: 0px; width: 300px;" placeholder="Remark">
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Note
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <textarea class="form-control" style="height: 100px;" disabled><?=$data['note']?></textarea>
                  </div>
               </div>

               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Delivery Address
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <?php $address = ''; ?>
                    
                    <?php if(!empty($data['detail_delivery_address'])):?>
                    <?php $address = $data['detail_delivery_address']; ?>
                    <?php endif; ?>

                    <?php if(!empty($data['address'])):?>
                    <?php $address = $data['address']; ?>
                    <?php endif;?>

                     <textarea class="form-control" style="height: 100px;" disabled><?=$address?></textarea>
                  </div>
               </div>
               <table align="center" class="table" style="margin:auto; width: 50%" >
                  <tbody id="term_body">
                     <?php foreach($term as $item): ?>
                     <tr>
                        <td><input type="text" class="form-control" disabled value="<?=$item->term?>"></td>
                        <td><input type="text" class="form-control" disabled value="<?=$item->cond?>"></td>
                     </tr>
                     <?php endforeach;?>
                  </tbody>
               </table>
               <hr />
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

                              $discount = 0;
                              if(!empty($item->discount))
                              {
                                 $discount = $item->discount * $item->price / 100; 
                              }

                              $price = ($item->price - $discount) * $item->qty;

                              echo '<td class="sub_total">'. format_idr($price) .'</td>';
                              echo '</tr>';

                              echo '<input type="hidden" name="Material['. $key .'][material_id]" value="'. $item->material_id .'" />';
                              echo '<input type="hidden" name="Material['. $key .'][qty]" value="'. $item->qty .'" />';
                              echo '<input type="hidden" name="Material['. $key .'][price]" value="'. $item->price .'" />';
                              echo '<input type="hidden" name="Material['. $key .'][discount]" value="'. $item->discount .'" />';

                              $sub_total += $price;
                           }    

                           $vat = $data['vat'] * $sub_total / 100;
                        }
                     ?>
                  </tbody>
                  <tfoot style="background: #fbfbfb;">
                     <tr>
                        <th colspan="5" style="text-align: right;vertical-align: middle;">Sub Total</th>
                        <td><?=format_idr($sub_total)?></td>
                     </tr>
                     <tr>
                        <th colspan="5" style="text-align: right;vertical-align: middle;">
                           <?=$data['vat_type'] == 1 ? 'PPH' : 'PPN'?>
                        </th>
                        <td>
                           <?php $vat_idr = $sub_total * $data['vat'] / 100; ?>
                           <?=$data['vat']?>% (Rp <?=format_idr($vat_idr)?>)
                        </td>
                     </tr>
                     <tr>
                        <th colspan="5" style="text-align: right;vertical-align: middle;">Shipping Charge</th>
                        <td><?=format_idr($data['shipping_charge'])?></td>
                     </tr>
                     <tr>
                        <td colspan="5" style="text-align: right;vertical-align: middle;">
                           <b>Total</b>
                        </td>
                       <td id="total"><?=format_idr($sub_total + $vat_idr - $discount_rp + $data['shipping_charge'])?></td>
                     </tr>
                 </tfoot>
               </table>
               <br />
               <div class="ln_solid"></div>
               <div class="form-group">
                  <div>
                    <a href="#" onclick="history.back()" class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
                    <?php if($data['status'] == 5):?>
                    <a href="<?=site_url('purchase-order/edit/'. $data['id'])?>?pr_id=<?=$data['pr_id']?>&rfq_id=<?=$data['rfq_id']?>&quotation_vendor_id=<?=$data['quotation_vendor_id']?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> Edit / Revisi</a>
                    <?php endif;?>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>