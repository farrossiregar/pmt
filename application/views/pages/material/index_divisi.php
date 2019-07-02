<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Material</h2> &nbsp;
        
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
        </ul>
        <div class="clearfix"></div>
      </div>

      <div class="x_content">
        <div class="table-responsive">
          <table id="datatable-buttons" class="table table-striped table-bordered">
            <thead>
              <tr class="headings">
                <th>No</th>
                <th class="column-title">Name </th>
                <th class="column-title">Group</th>
                <th class="column-title">Deskripsi</th>
                <th class="column-title">Order Unit</th>
                <th class="column-title">Planned Delivery Time</th>
                <th class="column-title">Stock Actual</th>
                <th class="column-title">Safety Stock</th>
                <th class="column-title"></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($data as $key => $item): ?>
                <tr class="even pointer">
                    <td class="a-center "><?=$key+1?></td>
                    <td><?=$item['name']?></td>
                    <td><?=$item['name_group']?></td>
                    <td><?=$item['description']?></td>
                    <td><?=$item['name_unit']?></td>                    
                    <td><?php 
                          $variable = PLANNED__DELIVERY__TIME;
                          $planned = "";
                          if(isset($item['planned_delivery_time'])){
                            $planned = isset($variable[$item['planned_delivery_time']]) ? $variable[$item['planned_delivery_time']] : "";
                          }

                          echo $planned;
                        ?>   
                    </td>
                    <td><?=$item['tot_stock']?></td>
                    <td>
                      <?php 
                        if($item['tot_stock'] > $item['safety_stock'])
                        {
                          echo "<a class='btn btn-primary'>Aman</a>";
                        }else
                        {
                          echo "<a class='btn btn-danger'>Peringatan</a>";
                        }
                      ?>

                    </td>
                    <td>
                        <a href="<?=site_url("material/edit/{$item['id']}")?>" title="Edit"><i class="fa fa-edit"></i></a> 
                        <a title="Hapus" onclick="_confirm('Hapus data ini?', '<?=site_url("material/delete/{$item['id']}")?>')" ><i class="fa fa-trash"></i></a> 
                    </td>
                </tr>
            <?php 
                endforeach;
            ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>