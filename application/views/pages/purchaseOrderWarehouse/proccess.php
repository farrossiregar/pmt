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
            	<div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pr_id">PR Number <span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" value="<?=$data['pr_number']?>" disabled>
                  </div>
               </div>
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
                     <label style="margin-top:8px; float: left;">After Invoice Received</label>
                     <input type="text" class="form-control" value="<?=$data['term_day_remark']?>" disabled style="float: left;margin-left: 10px; width: 300px;" placeholder="Remark">
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
                     <textarea class="form-control" style="height: 100px;" disabled><?=$data['address']?></textarea>
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
               <table align="center" class="table" style="margin:auto; width: 90%" >
	               	<thead>
	               		<tr>
                           <th style="width: 50px;">No</th>
	               			<th>Item</th>
	               			<th>PO QTY</th>
	               			<th>Unit Price</th>
	               			<th style="width: 300px;">Sub Total</th>
	               		</tr>
	               	</thead>
	               	<tbody id="material_body">
                     <?php $total = 0; ?>
                     <?php foreach($material as $key => $item): ?>
                        <tr>
                           <td><?=($key+1)?></td>
                           <td><?=$item->material?></td>
                           <td><?=$item->qty?></td>
                           <td><?=format_idr($item->price)?></td>
                           <td><?=format_idr($item->price * $item->qty)?></td>
                        </tr>
                        <?php $total += $item->price * $item->qty; ?>
                     <?php endforeach; ?>
                     </tbody>
	               	<tfoot style="background: #fbfbfb;">
                        <tr>
                           <th colspan="4" style="text-align: right;vertical-align: middle;">Discount</th>
                           <td><?=$data['discount']?>% (Rp. <?=format_idr($data['discount_rp'])?>)</td>
                        </tr>
                        <tr>
                           <th colspan="4" style="text-align: right;vertical-align: middle;">
                              <?=$data['vat_type'] == 1 ? 'PPH' : 'PPN'?>
                           </th>
                           <td>
                              <?php $vat_idr = $total * $data['vat'] / 100; ?>
                              <?=$data['vat']?>% (Rp <?=format_idr($vat_idr)?>)
                           </td>
                        </tr>
                        <tr>
                           <th colspan="4" style="text-align: right;vertical-align: middle;">Shipping Charge</th>
                           <td><?=format_idr($data['shipping_charge'])?></td>
                        </tr>
		               	<tr>
		               		<td colspan="4" style="text-align: right;vertical-align: middle;">
                              <b>Total</b>
                           </td>
	            			  <td id="total"><?=format_idr($total + $vat_idr - $data['discount_rp'] + $data['shipping_charge'])?></td>
		               	</tr>
	                 </tfoot>
               </table>
               <br />
               <div class="form-group">
                  <div class="col-md-6">
                     <textarea name="note" class="form-control" placeholder="Noted" style="height: 100px;"></textarea>
                  </div>
               </div>
               <div class="ln_solid"></div>
               <div class="form-group">
                  <div>
                     <a href="#" onclick="history.back()" class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i> Cancel</a>
                     <button type="button" onclick="reject()" class="btn btn-danger btn-sm"><i class="fa fa-close"></i> Reject</button>
                     <button type="button" onclick="approve()" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Approve</button>
                  </div>
               </div>
               <input type="hidden" name="status" value="1">
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
            $("#demo-po").trigger('submit');
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
            $("#demo-po").trigger('submit');
         }
       }
     });
   }
</script>