<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Form Region</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br>
        <form id="demo-form2" method="post" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Region Code <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" required="required" name="Region[region_code]" value="<?=(isset($data['region_code']) ? $data['region_code'] : '')?>" class="form-control col-md-7 col-xs-12 autocomplete-region-code">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Region<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" required="required" name="Region[region]" value="<?=(isset($data['region']) ? $data['region'] : '')?>" class="form-control col-md-7 col-xs-12">
              </div>
            </div>  
          </div>
          <?php if(isset($data)):?>
          <input type="hidden" name="Region[created_at]" value="<?=date('Y-m-d H:i:s')?>" />
          <?php else: ?>
          <input type="hidden" name="Region[updated_at]" value="<?=date('Y-m-d H:i:s')?>" />
          <?php endif; ?>
          <div class="clearfix"></div>
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <a onclick="history.back();" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back</a>
              <button class="btn btn-primary" type="reset">Reset</button>
              <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$( function() {
  $(".autocomplete-region-code").autocomplete({
    minLength:0,
    limit: 25,
    dataType: "json",
    source: function( request, response ) {
        $.ajax({
          url: "<?=site_url('ajax/getregioncode')?>",
          method : 'POST',
          data: {
            'name': request.term
          },
          success: function( data ) {
            console.log(data);
            response( data );
          }
        });
    },
    select: function( event, ui ) {

    }
  }).on('focus', function () {
        $(this).autocomplete("search", "");
  });
});
</script>