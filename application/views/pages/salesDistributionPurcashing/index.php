<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Catalog</h2> &nbsp;
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="table-responsive">
          <table class="table table-striped table-bordered">
            <thead>
              <tr class="headings">
                <th>No</th>
                <th class="column-title">Group </th>
                <th class="column-title">Material </th>
                <th class="column-title">Valid Until</th>
                <th class="column-title">Sales Price</th>
                <th class="column-title">Min Order</th>
                <th style="width: 100px;"></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($data as $key => $item): ?>
                <tr class="even pointer">
                  <td class="a-center "><?=$key+1?></td>    
                <?php if(get_material_vendor_row($item['id'], $vendor_id)) { 
                    $row = get_material_vendor_row($item['id'], $vendor_id);
                  ?>                
                  <td><?=$item['name_group']?></td>
                  <td><?=$item['name']?></td>
                  <td><?=$row['valid_until']?></td>
                  <td><?=format_idr($row['sales_price'])?></td>
                  <td><?=$row['min_order']?></td>
                  <td><a href="<?=site_url("salesDistribution/edit/{$row['id']}")?>" class="btn btn-success btn-xs" title="Edit"><i class="fa fa-edit"></i> Update</a> 
                  </td>
                <?php } else { ?>
                  <td><?=$item['name_group']?></td>
                  <td><?=$item['name']?></td>
                  <td> - </td>
                  <td>0</td>
                  <td>0</td>
                  <td>
                      <a href="<?=site_url("salesDistribution/setprice/{$item['id']}")?>" class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-edit"></i> Set Price</a> 
                  </td>
                <?php } ?>
                </tr>
            <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>