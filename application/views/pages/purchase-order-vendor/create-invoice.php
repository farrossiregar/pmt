<div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
         <div class="x_title">
            <h2>Create Invoice By Purchasing Order <?=$data['po_number']?></h2>
            <div class="clearfix"></div>
         </div>
         <div class="x_content">
            <br>
            <form id="proccess_po" method="post" enctype="multipart/form-data"  class="form-horizontal form-label-left">
               <input type="hidden" name="Invoice[po_id]" value="<?=$data['id']?>">
               <input type="hidden" name="Invoice[status]" value="1">
               <input type="hidden" name="Invoice[term_day]" value="1">
               <input type="hidden" name="Invoice[created_at]" value="<?=date('Y-m-d H:i:s')?>">
               <div class="form-group">
                  <label class="control-label col-md-2 col-sm-3 col-xs-12" for="po_number">Invoice Number *</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" name="Invoice[invoice_number]" required class="form-control col-md-7 col-xs-12">
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-2 col-sm-3 col-xs-12" for="po_number">To  </label>
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
                  <label class="control-label col-md-2 col-sm-3 col-xs-12" for="po_number">PO Number</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" value="<?=$data['po_number']?>" readonly="readonly" class="form-control col-md-7 col-xs-12">
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-2 col-sm-3 col-xs-12" for="pr_id">Attach File Invoice <span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="file" name="file" required />
                  </div>
               </div>
               <div class="ln_solid"></div>
               <div class="form-group">
                  <div>
                     <a href="#" onclick="history.back()" class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
                     <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Submit Invoice </a>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>