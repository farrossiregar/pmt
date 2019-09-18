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
          <div class="col-md-6" style="background: #fbfbfb;padding: 10px;border: 1px solid #eee;">
            <h4 style="padding:0  !important;margin:0 !important;">Cluster</h4>
            <hr style="margin-top:4px;" />
            <div class="table-responsive">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr class="headings">
                    <th class="column-title">Cluster </th>
                    <th class="column-title no-link last" style="width: 30px;"></th>
                  </tr>
                </thead>
                <tbody class="table-cluster">
                  <?php if(isset($cluster)):?>
                    <?php foreach($cluster as $item):?>
                      <input type="hidden" name="edit_id[]" value="<?=$item['id']?>" >
                      <tr>
                        <td><input type="text" class="form-control" name="edit_name[]" value="<?=$item['name']?>"></td>
                        <td><a href="<?=site_url('region/deletecluster/'. $item['id'])?>?region_id=<?=$data['id']?>" onclick="return confirm('Delete this data ?')" class="text-danger"><i class="fa fa-trash"></i></a></td>
                      </tr>
                    <?php endforeach;?>
                  <?php else:?>
                  <tr class="empty-tr">
                    <td colspan="3" style="text-align: center;"><small><i>Empty</i></small></td>
                  </tr>
                  <?php endif;?>
                </tbody>
              </table>
              <a href="javascript:void(0)" onclick="add_cluster()" class="btn btn-warning btn-xs"><i class="fa fa-plus"></i> Add Cluster</a>
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
            <div class="col-md-6 col-sm-6 col-xs-12" style="text-align: left;">
              <a onclick="history.back();" class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
              <button class="btn btn-primary btn-sm" type="reset">Reset</button>
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
function add_cluster()
{
  $('.empty-tr').remove();
  var el = '<tr><td><input type="text" class="form-control" name="cluster[]" /></td><td><a href="javascript:void(0)" class="text-danger" onclick="delete_this(this)"><i class="fa fa-trash"></i></a></td></tr>';
  $('.table-cluster').append(el);
}

function delete_this(el)
{
  $(el).parent().parent().remove();
}

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