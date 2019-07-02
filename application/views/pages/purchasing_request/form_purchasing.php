<div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
         <div class="x_title">
            <h2>Form PURCHASING REQUEST</h2>
            <div class="clearfix"></div>
         </div>
         <div class="x_content">
            <br>

            <form id="demo-form2" method="post" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">                   

            	<div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="no">No Purchase Request<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text"  name="purchasingRequest[no]" value="<?=(isset($data['no']) ? $data['no'] : generate_purchase_request_no())?>" readonly="readonly" class="form-control" id="no" >
                  </div>
               </div>
               
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="posting_date">Posting Date <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text"  name="purchasingRequest[posting_date]" value="<?=(isset($data['posting_date']) ? $data['posting_date'] : "")?>" class="form-control tanggal"  id="posting_date">
                  </div>
               </div>

               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="valid_until">Valid Until <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" value="<?=(isset($data['valid_until']) ? $data['valid_until'] : "")?>"  name="purchasingRequest[valid_until]" class="form-control tanggal" id="valid_until">
                  </div>
               </div>

               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="document_date">Document Date <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" value="<?=(isset($data['document_date']) ? $data['document_date'] : "")?>"  name="purchasingRequest[document_date]" class="form-control tanggal" id="document_date">
                  </div>
               </div>

               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="require_date">REQUIRED DATE <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" value="<?=(isset($data['require_date']) ? $data['require_date'] : "")?>"  name="purchasingRequest[require_date]" class="form-control tanggal" id="require_date">
                  </div>
               </div>

               <div class="ln_solid"></div>
               <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                     <a onclick="history.back();" class="btn btn-default">Cancel</a>
                     <button class="btn btn-primary" id="reset" type="reset">Reset</button>
                     <button type="submit" class="btn btn-success">Save</button>
                  </div>
               </div>

            </form>

         </div>
      </div>
   </div>
</div>