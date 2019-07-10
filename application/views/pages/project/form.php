<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Form Project</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br>
        <form id="demo-form2" method="post" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="" autocomplete="off">
          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="product_specification_id">Project Code <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="project[project_code]" class="form-control autocomplete-project-code" value="<?=isset($data['project_code']) ? $data['project_code'] : ''?>" />
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="product_specification_id">Project Name <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" class="form-control" name="project[name]" value="<?=isset($data['name']) ? $data['name'] : ''?>" />
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="code">Region <span class="required">*</span></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control col-md-7 col-xs-12" name="project[region_id]">
                  <option value=""> - Region - </option>
                  <?php foreach(get_region()->result_object() as $item){ ?>
                    <option value="<?=$item->id?>"><?=$item->region_code?> - <?=$item->region?></option>
                <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="product_specification_id">Project Type <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" class="form-control" name="project[project_type]" value="<?=isset($data['project_type']) ? $data['project_type'] : ''?>" required />
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Project Manager <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" class="form-control autocomplete-project-manager" value="<?=isset($data['project_manager']) ? $data['project_manager'] : ''?>" required />
                <input type="hidden" name="project[project_manager_id]" value="<?=isset($data['project_manager_id']) ? $data['project_manager_id'] : ''?>" />
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Operation Service Manager <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" class="form-control autocomplete-osm" value="<?=isset($data['osm']) ? $data['osm'] : ''?>" required />
                <input type="hidden" name="project[osm_id]" value="<?=isset($data['osm_id']) ? $data['osm_id'] : ''?>" />
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
          
          <?php if(isset($data['created_ay'])){ ?>
          <input type="hidden" name="project[updated_at]" value="<?=date('Y-m-d H:i:s')?>" />
          <?php }else { ?>
          <input type="hidden" name="project[created_at]" value="<?=date('Y-m-d H:i:s')?>" />
          <input type="hidden" name="project[updated_at]" value="<?=date('Y-m-d H:i:s')?>" />
          <?php } ?>

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

<link href="<?=base_url()?>assets/js/ui/jquery-ui.min.css" rel="stylesheet">
<script src="<?=base_url()?>assets/js/ui/jquery-ui.min.js"></script>
<script type="text/javascript">
  $.fn.datepicker.noConflict = function(){
     $.fn.datepicker = old;
     return this;
  };

 $( function() {
  $(".autocomplete-project-code").autocomplete({
    minLength:0,
    limit: 25,
    dataType: "json",
    source: function( request, response ) {
        $.ajax({
          url: "<?=site_url('ajax/getprojectcode')?>",
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
      $(".project_code_description").val(ui.item.description);
    }
  }).on('focus', function () {
        $(this).autocomplete("search", "");
  });

  $(".autocomplete-project-manager").autocomplete({
    minLength:0,
    limit: 25,
    dataType: "json",
    source: function( request, response ) {
        $.ajax({
          url: "<?=site_url('ajax/getpm')?>",
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
      $("input[name='project[project_manager_id]']").val(ui.item.id);
    }
  }).on('focus', function () {
        $(this).autocomplete("search", "");
  });

  $(".autocomplete-osm").autocomplete({
    minLength:0,
    limit: 25,
    dataType: "json",
    source: function( request, response ) {
        $.ajax({
          url: "<?=site_url('ajax/getosm')?>",
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
      $("input[name='project[osm_id]']").val(ui.item.id);
    }
  }).on('focus', function () {
        $(this).autocomplete("search", "");
  });
});
</script>