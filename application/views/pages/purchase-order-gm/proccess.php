<div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
         <div class="x_title">
            <h2>Purchasing Order</h2>
            <div class="clearfix"></div>
         </div>
         <div class="x_content">
            <br>
            <form id="proccess_po" method="post" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="po_number">Company <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <select class="form-control" readonly>
                        <option value="">-- Select Company --</option>
                        <?php foreach(get_company() as $item) { ?>
                           <option value="<?=$item['id']?>" <?=(isset($data['company_id']) and $data['company_id'] == $item['id']) ? 'selected' : ''?>><?=$item['name']?></option>
                        <?php } ?>
                     </select>
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="po_number">PO Number <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" value="<?=$data['po_number']?>" readonly="readonly" class="form-control col-md-7 col-xs-12">
                  </div>
               </div>
               <?php if(!empty($data['rfq_id'])) { ?>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="rfq_id">RFQ Number <span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <select class="form-control col-md-7 col-xs-12" readonly>
                        <option value="0">-- Select FRQ --</option>
                       <?php foreach ($rfq as $key => $value) { ?>
                           <option value="<?=$value['id']?>" <?=$data['rfq_id']==$value['id'] ? 'selected' : ''?>><?=$value['case_id']?></option>
                        <?php } ?>
                     </select>
                  </div>
               </div>   
               <?php } ?>
               <?php if(!empty($data['pr_id'])) { ?>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pr_id">PR Number <span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                      <select class="form-control col-md-7 col-xs-12" readonly>
                        <option value="0">-- Select PR --</option>
                       <?php foreach ($pr as $key => $value) { ?>
                           <option value="<?=$value['id']?>" <?=$data['pr_id'] == $value['id'] ? 'selected' : ''?>><?=$value['no']?></option>
                        <?php } ?>
                     </select>
                  </div>
               </div>
               <?php } ?>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="vendor_id">Vendor <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <select class="form-control col-md-7 col-xs-12" readonly>
                        <option value="0">-- Select Vendor --</option>
                        <?php foreach ($vendor as $key => $value) { ?>
                           <option value="<?=$value['id']?>" <?=$data['vendor_id']==$value['id'] ? 'selected' : ''?>><?=$value['name']?> / <?=$value['pic_name']?></option>
                        <?php } ?>
                     </select>
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="doc_date">Doc. Date <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" value="<?=$data['doc_date']?>" readonly class="form-control col-md-7 col-xs-12">
                  </div>
               </div>               
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Term of Payment<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="number" class="form-control" readonly value="<?=$data['term_day']?>" placeholder="Day" style="width: 150px; float: left; margin-right: 10px;">
                     <label style="margin-top:8px;">After Invoice Received</label>
                     <input type="text" class="form-control" readonly value="<?=$data['term_day_remark']?>" style="margin-top: 10px; width: 300px;" placeholder="Remark">
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Discount
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="number" class="form-control" readonly value="<?=$data['discount']?>" placeholder="%" style="width: 150px; float: left; margin-right: 10px;">
                     <input type="number" class="form-control" readonly name="<?=$data['discount_rp']?>" placeholder="Rp. " style="width: 250px; float: left; margin-right: 10px;">
                  </div>
               </div>

               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Note
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <textarea class="form-control" readonly style="height: 100px;"><?=$data['note']?></textarea>
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
                      <th>Sub Total</th>
                    </tr>
                  </thead>
                  <tbody class="add-table-rfq-request">
                     <?php 
                       $vat = 0;
                       $total = 0;
                        if(isset($material) AND count($material) > 0)
                        {
                           $total = 0;
                           foreach ($material as $key => $item)
                           {
                              echo '<tr>';
                              echo '<td>'. ($key+1) .'</td>';
                              echo '<td>'. $item->material .'</td>';
                              echo '<td>'. $item->qty .'</td>';
                              echo '<td>'. format_idr($item->price) .'</td>';
                              echo '<td>'. $item->discount .'</td>';
                              echo '<td class="sub_total">'. format_idr($item->price * $item->qty) .'</td>';
                              echo '</tr>';
                              echo '<input type="hidden" name="Material['. $key .'][material_id]" value="'. $item->material_id .'" />';
                              echo '<input type="hidden" name="Material['. $key .'][qty]" value="'. $item->qty .'" />';
                              echo '<input type="hidden" name="Material['. $key .'][price]" value="'. $item->sales_price .'" />';
                              $total += $item->price * $item->qty;
                           }    

                           $vat = $data->vat * $total / 100;
                        }
                     ?>
                  </tbody>                
                  <tfoot style="background: #fbfbfb;">
                     <tr>
                        <th colspan="5" style="text-align: right;vertical-align: middle;">Discount</th>
                        <td><?=$data['discount']?>% (Rp. <?=format_idr($data['discount_rp'])?>)</td>
                     </tr>
                     <tr>
                        <th colspan="5" style="text-align: right;vertical-align: middle;">
                           <?=$data['vat_type'] == 1 ? 'PPH' : 'PPN'?>
                        </th>
                        <td>
                           <?php $vat_idr = $total * $data['vat'] / 100; ?>
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
                       <td id="total"><?=format_idr($total + $vat_idr - $data['discount_rp'] + $data['shipping_charge'])?></td>
                     </tr>
                 </tfoot>
               </table>
               <div class="form-group">
                  <textarea name="note" class="form-control" placeholder="Note General Manager" style="height: 100px;width: 600px;"></textarea>
               </div>
               <div class="ln_solid"></div>
               <div class="form-group">
                  <div>
                     <a href="#" onclick="history.back()" class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
                    <?php if(!empty($data['status_gm'])):?>
                     <button type="button" class="btn btn-danger btn-sm" onclick="reject()"><i class="fa fa-close"></i> Reject </button>
                     <button type="button" class="btn btn-success btn-sm" onclick="approve()"><i class="fa fa-check"></i> Approve </button>
                    <?php endif; ?>
                  </div>
               </div>
               <input type="hidden" name="status" value="1" />
            </form>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   function approve()
   {
      bootbox.confirm({
      title : "<i class=\"fa fa-warning\"></i> EMPORE SYSTEM",
      message: 'Approve Purchasing Order #<?=$data['po_number']?> ?',
      closeButton: false,
      buttons: {
           confirm: {
               label: '<i class="fa fa-check"></i> Yes',
               className: 'btn btn-sm btn-success'
           },
           cancel: {
               label: '<i class="fa fa-close"></i> No',
               className: 'btn btn-sm btn-default btn-outline'
           }
      },
      callback: function (result) {
         if(result)
         { 
            $("input[name='status']").val(1);
            $("#proccess_po").trigger('submit');
         }
       }
     });
   }

   function reject()
   {
      bootbox.confirm({
      title : "<i class=\"fa fa-warning\"></i> EMPORE SYSTEM",
      message: 'Reject Purchasing Order #<?=$data['po_number']?> ?',
      closeButton: false,
      buttons: {
           confirm: {
               label: '<i class="fa fa-check"></i> Yes',
               className: 'btn btn-sm btn-success'
           },
           cancel: {
               label: '<i class="fa fa-close"></i> No',
               className: 'btn btn-sm btn-default btn-outline'
           }
      },
      callback: function (result) {
         if(result)
         { 
            $("input[name='status']").val(2);
            $("#proccess_po").trigger('submit');
         }
       }
     });
   }
</script>