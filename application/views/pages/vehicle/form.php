<div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
          <div class="x_title">
            <h2>Form Vehicle</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br>
            <form id="demo-form2" method="post" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="material_group">Brand<span class="required">*</span>
                </label>
                <div class="col-md-3 col-sm-3 col-xs-12">
                  <input type="text"  class="form-control" name="Vehicle[brand]" value="<?=(isset($data['brand']) ? $data['brand'] : '')?>" />
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="material_group">Merk<span class="required">*</span>
                </label>
                <div class="col-md-3 col-sm-3 col-xs-12">
                  <input type="text"  class="form-control" name="Vehicle[merk]" value="<?=(isset($data['merk']) ? $data['merk'] : '')?>" />
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="material_group">Type<span class="required">*</span>
                </label>
                <div class="col-md-3 col-sm-3 col-xs-12">
                  <input type="text"  class="form-control" name="Vehicle[type]" value="<?=(isset($data['type']) ? $data['type'] : '')?>" />
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="material_group">Tahun Pembuatan<span class="required">*</span>
                </label>
                <div class="col-md-2 col-sm-2 col-xs-12">
                  <input type="number"  class="form-control" name="Vehicle[tahun]" value="<?=(isset($data['tahun']) ? $data['tahun'] : '')?>" />
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div>
                  <a href="#" onclick="history.back()" class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
                  <button class="btn btn-primary btn-sm" type="reset"><i class="fa fa-refresh"></i> Reset</button>
                  <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Save</button>
                </div>
              </div>
            </form>
         </div>
      </div>
   </div>
</div>
<link href="<?=base_url()?>assets/js/ui/jquery-ui.min.css" rel="stylesheet">
<script src="<?=base_url()?>assets/js/ui/jquery-ui.min.js"></script>
<script type="text/javascript">
   $( document ).ready(function() {

      $("input[name='Vehicle[brand]']").autocomplete({
        minLength:0,
        limit: 25,
        dataType: "json",
        source: function( request, response ) {
            $.ajax({
              url: "<?=site_url('ajax/getvehiclebrand')?>",
              method : 'POST',
              data: {
                'name': request.term
              },
              success: function( data ) {
                response( data );
              }
            });
        },
        select: function( event, ui ) {
          $("input[name='Vehicle[brand]']").val(ui.item.name);
        }
      }).on('focus', function () {
            $(this).autocomplete("search", "");
      });

      $("input[name='Vehicle[merk]']").autocomplete({
        minLength:0,
        limit: 25,
        dataType: "json",
        source: function( request, response ) {
            $.ajax({
              url: "<?=site_url('ajax/getvehiclemerk')?>",
              method : 'POST',
              data: {
                'name': request.term
              },
              success: function( data ) {
                response( data );
              }
            });
        },
        select: function( event, ui ) {
          $("input[name='Vehicle[merk]']").val(ui.item.name);
        }
      }).on('focus', function () {
            $(this).autocomplete("search", "");
      });    

      $("input[name='Vehicle[type]']").autocomplete({
        minLength:0,
        limit: 25,
        dataType: "json",
        source: function( request, response ) {
            $.ajax({
              url: "<?=site_url('ajax/getvehicletype')?>",
              method : 'POST',
              data: {
                'name': request.term
              },
              success: function( data ) {
                response( data );
              }
            });
        },
        select: function( event, ui ) {
          $("input[name='Vehicle[type]']").val(ui.item.name);
        }
      }).on('focus', function () {
            $(this).autocomplete("search", "");
      });
   });
</script>