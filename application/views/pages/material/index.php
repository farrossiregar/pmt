<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Material / Services</h2> &nbsp;
        <div class="btn-group pull-right">
          <button type="button" class="btn btn-default btn-sm">Action</button>
          <button type="button" class="btn btn-default dropdown-toggle btn-sm" data-toggle="dropdown" aria-expanded="false">
            <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">
            <li><a href="<?=site_url('material/insert')?>"><i class="fa fa-plus"></i> Create </a></li>
            <li><a href=""><i class="fa fa-upload"></i> Import</a></li>
          </ul>
        </div>
        <div class="clearfix"></div>
      </div>

      <div class="x_content">
        <div class="table-responsive p-t-0">
          <table class="table table-striped table-bordered data_table">
            <thead>
              <tr class="headings">
                <th>No</th>
                <th class="column-title">Material / Services </th>
                <th class="column-title">Group</th>
                <th class="column-title">Deskripsi</th>
                <th class="column-title">Order Unit</th>
                <th class="column-title">Planned Delivery Time</th>
                <!-- <th class="column-title">Region</th> -->
                <th class="column-title">Stock</th>
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
                    <!-- <td><?=get_divisi($item['division'])?></td> -->
                    <td><?=$item['tot_stock']?></td>
                    <td>
                        <a href="<?=site_url("material/edit/{$item['id']}")?>" title="Edit"><i class="fa fa-edit"></i></a> 
                        <a title="Hapus" onclick="_confirm('Hapus data ini?', '<?=site_url("material/delete/{$item['id']}")?>')" ><i class="fa fa-trash"></i></a> 
                    </td>
                </tr>
            <?php  endforeach; ?>
            </tbody>
          </table>
        </div>
        <?php echo $this->pagination->create_links(); ?>
      </div>
    </div>
</div>