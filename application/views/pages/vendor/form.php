<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Form Vendor / Supplier</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br>
        <form id="demo-form2" method="post" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="vendor_id">ID Vendor <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input readonly="readonly" type="text" id="vendor_id" required="required" name="Vendor[vendor_id]"  value="<?=(isset($data['vendor_id']) ? $data['vendor_id'] : generate_vendor_id())?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nama Vendor <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="name" required="required" name="Vendor[name]"  value="<?=(isset($data['name']) ? $data['name'] : '')?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="group_vendor">Description <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12"> 
              <textarea name="Vendor[description]" class="form-control"></textarea>
            </div>
          </div>          
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="currency">Currency  <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select required class="form-control select_tipe_division" name="Vendor[currency]">
                <?php
                  $currency = ['- Currency -', 'IDR', 'USD', 'EUR'];                   
                  foreach($currency as $key => $i) {

                    $selected = "";

                    if(isset($data['currency']))
                    {
                      if($data['currency'] == $key){
                        $selected = " selected";
                      }
                    }
                ?>
                    <option value="<?=$key?>" <?=$selected?>><?=$i?></option>
                <?php } ?>
                </select>
            </div>  
          </div> 
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="term_of_payment">Terms Of Payment <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" class="form-control" name="Vendor[term_of_payment]" value="<?=isset($data['term_of_payment']) ? $data['term_of_payment'] : '' ?>" />
            </div>  
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pic_name">Names Of PIC <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="pic_name" required="required" name="Vendor[pic_name]"  value="<?=(isset($data['pic_name']) ? $data['pic_name'] : '')?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone_1">Phone <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="phone_1" required="required" name="Vendor[phone_1]"  value="<?=(isset($data['phone_1']) ? $data['phone_1'] : '')?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div>
         <!--  <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone_2">Phone 2 <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="phone_2" required="required" name="Vendor[phone_2]"  value="<?=(isset($data['phone_2']) ? $data['phone_1'] : '')?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div> -->
          <!-- <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mobile_1">Mobile 1 <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="mobile_1" required="required" name="Vendor[mobile_1]"  value="<?=(isset($data['mobile_1']) ? $data['mobile_1'] : '')?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mobile_2">Mobile 2 <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="mobile_2" required="required" name="Vendor[mobile_2]"  value="<?=(isset($data['mobile_2']) ? $data['mobile_2'] : '')?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div> -->
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="email" required="required" name="Vendor[email]"  value="<?=(isset($data['email']) ? $data['email'] : '')?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Password <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="password" required="required" name="password"  class="form-control col-md-7 col-xs-12">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="group_vendor">Address <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12"> 
              <textarea name="Vendor[address]" class="form-control"></textarea>
            </div>
          </div>
          <div class="ln_solid"></div>
          <div class="form-group">
            <div>
              <a href="#" onclick="history.back()" class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i> Cancel</a>
              <button class="btn btn-primary btn-sm" type="reset"><i class="fa fa-refresh"></i> Reset</button>
              <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Save</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
