<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <div class="col-md-2">
          <h2>Catalog Material</h2>
        </div>
        <div class="col-md-10">
          <form action="" method="get">
             <div class="col-md-3">
              <div class="form-group">
                <input type="text" class="form-control" name="material" placeholder="Material" value="<?=(@$_GET['material'] ? $_GET['material'] : '')?>" />
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <select name="vendor_id" class="form-control">
                  <option value="">- Select Vendor -</option>
                  <?php 
                    foreach(get_vendor() as $item)
                    {
                      echo '<option value="'. $item['id'] .'" '.( @$_GET['vendor_id'] == $item['id'] ? 'selected' : '' ).'>'. $item['name'] .'</option>';
                    }
                  ?>
                </select>
              </div>
            </div>
             <div class="col-md-4">
              <div class="form-group">
                <select name="group_id" class="form-control">
                  <option value="">- Select Group -</option>
                  <?php 
                    foreach(get_group_of_material() as $item)
                    {
                      echo '<option value="'. $item['id'] .'" '.( @$_GET['group_id'] == $item['id'] ? 'selected' : '' ).'>'. $item['name'] .'</option>';
                    }
                  ?>
                </select>
              </div>
            </div>
            <div class="col-md-1">
              <div class="form-group">
                <button type="submit" class="btn btn-info btn-sm"><i class="fa fa-search-plus"></i></button>
              </div>
            </div>
          </form>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="table-responsive">
          <table class="table table-striped table-bordered">
            <thead>
              <tr class="headings">
                <th>No</th>
                <th class="column-title">Vendor </th>
                <th class="column-title">Group </th>
                <th class="column-title">Material </th>
                <th class="column-title">Valid Until</th>
                <th class="column-title">Sales Price</th>
                <th class="column-title">Min Order</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($data as $key => $item): ?>
                <tr class="even pointer">
                  <td class="a-center "><?=$key+1?></td>    
                  <?php  $vendor = get_material_vendor_row($item['material_id'], $item['vendor_id']); ?>                
                  <td><?=$item['name_vendor']?></td>
                  <td><?=$item['group']?></td>
                  <td><?=$item['name_material']?></td>
                  
                  <?php if($vendor) { ?>
                  <td><?=$vendor['valid_until']?></td>
                  <td><?=format_idr($vendor['sales_price'])?></td>
                  <td><?=$vendor['min_order']?></td>
                  <?php } else { ?>
                    <td></td>
                    <td></td>
                    <td></td>
                  <?php } ?>

                </tr>
            <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>