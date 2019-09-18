<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
         <div class="x_title">
            <h2>Set Vehicle</h2>
            <div class="clearfix"></div>
         </div>
         <div class="x_content">
            <br>
            <form id="demo-form2" method="post" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Brand</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" class="form-control" readonly="true" value="<?=isset($vehicle['brand']) ? $vehicle['brand'] : '' ?>">
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Merk</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" class="form-control" readonly="true" value="<?=isset($vehicle['merk']) ? $vehicle['merk'] : '' ?>">
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Type</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" class="form-control" readonly="true" value="<?=isset($vehicle['type']) ? $vehicle['type'] : '' ?>">
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Tahun</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" class="form-control" readonly="true" value="<?=isset($vehicle['tahun']) ? $vehicle['tahun'] : '' ?>">
                  </div>
               </div>
               <hr/>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sales_price">No Polisi <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="Vehicle[no_polisi]" class="form-control" value="<?=isset($data['no_polisi']) ? $data['no_polisi'] : '' ?>" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sales_price">Sewa / Bulan <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                  	<input type="text" name="Vehicle[sewa]" class="form-control idr" value="<?=isset($data['sewa']) ? $data['sewa'] : '' ?>" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sales_price">No STNK <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="Vehicle[stnk_no]" class="form-control" value="<?=isset($data['stnk_no']) ? $data['stnk_no'] : '' ?>" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sales_price">End Date STNK <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="Vehicle[stnk_end_date]" class="form-control tanggal" value="<?=isset($data['stnk_end_date']) ? $data['stnk_end_date'] : '' ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sales_price">No KIR <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="Vehicle[kir_no]" class="form-control" value="<?=isset($data['kir_no']) ? $data['kir_no'] : '' ?>" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sales_price">End Date KIR <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="Vehicle[kir_end_date]" class="form-control tanggal" value="<?=isset($data['kir_end_date']) ? $data['kir_end_date'] : '' ?>" />
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