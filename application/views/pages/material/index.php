<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Material / Services</h2> &nbsp;
        <div class="col-md-8 pull-right">
            <form method="GET" action="">
                <a href="<?=site_url('material/insert')?>" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus"></i> Create </a>
                <button type="submit" class="btn btn-info btn-sm pull-right"><i class="fa fa-search-plus"></i></button>
                <div class="col-md-3 pull-right">
                    <select name="material_group" class="form-control">
                        <option value=""> - Material Group - </option>
                        <?php 
                            $i = $this->db->get('group_of_material');
                
                            foreach($i->result_array() as $i) {

                              $selected = '';
                              if(isset($_GET['material_group']))
                              {
                                if($_GET['material_group'] == $i['id'])
                                {
                                  $selected = ' selected';
                                }
                              }
                            ?>
                              <option value="<?=$i['id']?>" <?=$selected?>><?=$i['name']?></option>
                              <?php } ?>
                    </select>
                </div>
                <div class="col-md-3 pull-right">
                    <select name="order_unit" class="form-control">
                        <option value=""> - Order Unit - </option>
                        <?php 
                            $i = $this->db->get('master_unit');
                
                            foreach($i->result_array() as $i) {

                              $selected = '';
                              if(isset($_GET['order_unit']))
                              {
                                if($_GET['order_unit'] == $i['id'])
                                {
                                  $selected = ' selected';
                                }
                              }
                            ?>
                              <option value="<?=$i['id']?>" <?=$selected?>><?=$i['name']?></option>

                              <?php } ?>
                    </select>
                </div>
                <div class="col-md-3 pull-right">
                    <input type="text" class="form-control" name="name" value="<?=@$_GET['name']?>" placeholder="Material / Services">
                </div>
            </form>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="table-responsive p-t-0">
          <table class="table table-striped table-bordered">
            <thead>
              <tr class="headings">
                <th>No</th>
                <th class="column-title">Material / Services </th>
                <th class="column-title">Group</th>
                <th class="column-title">Deskripsi</th>
                <th class="column-title">Order Unit</th>
                <th class="column-title">Planned Delivery Time</th>
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