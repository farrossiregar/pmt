<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Form Project</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br>
        <form id="demo-form2" method="post" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Project Code <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" class="form-control" name="project_code[code]" required>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Description <span class="required">*</span>
              </label>
              <div class="col-md-7 col-sm-7 col-xs-12"> 
                <textarea class="form-control" name="project_code[description]" style="height: 150px;" required></textarea>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6">
              <a onclick="history.back();" class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
              <button class="btn btn-primary  btn-sm" type="reset"><i class="fa fa-back"></i> Reset</button>
              <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Save</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>