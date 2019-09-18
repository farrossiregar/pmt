<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Vehicle</h2> &nbsp;
        <div class="col-md-10 pull-right">
            <form method="GET" action="">
                <a href="<?=site_url('vehicle/insert')?>" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus"></i> Create </a>
                <button type="submit" class="btn btn-info btn-sm pull-right"><i class="fa fa-search-plus"></i></button>
                <div class="col-md-2 pull-right">
                  <select name="tahun" class="form-control">
                      <option value=""> - Tahun - </option>
                      <?php 
                          $this->db->flush_cache();
                          $this->db->group_by('tahun');
                          $i = $this->db->get('vehicle');
              
                          foreach($i->result_array() as $i) {

                            $selected = '';
                            if(isset($_GET['tahun']))
                            {
                              if($_GET['tahun'] == $i['tahun'])
                              {
                                $selected = ' selected';
                              }
                            }
                          ?>
                            <option <?=$selected?>><?=$i['tahun']?></option>
                            <?php } ?>
                  </select>
                </div>
                <div class="col-md-2 pull-right">
                  <select name="type" class="form-control">
                      <option value=""> - Type - </option>
                      <?php 
                          $this->db->flush_cache();
                          $this->db->group_by('type');
                          $i = $this->db->get('vehicle');
              
                          foreach($i->result_array() as $i) {

                            $selected = '';
                            if(isset($_GET['type']))
                            {
                              if($_GET['type'] == $i['type'])
                              {
                                $selected = ' selected';
                              }
                            }
                          ?>
                            <option <?=$selected?>><?=$i['type']?></option>
                            <?php } ?>
                  </select>
                </div>
                <div class="col-md-3 pull-right">
                  <select name="merk" class="form-control">
                      <option value=""> - Merk - </option>
                      <?php 
                          $this->db->flush_cache();
                          $this->db->group_by('merk');
                          $i = $this->db->get('vehicle');
              
                          foreach($i->result_array() as $i) {

                            $selected = '';
                            if(isset($_GET['merk']))
                            {
                              if($_GET['merk'] == $i['merk'])
                              {
                                $selected = ' selected';
                              }
                            }
                          ?>
                            <option <?=$selected?>><?=$i['merk']?></option>
                            <?php } ?>
                  </select>
                </div>
                <div class="col-md-3 pull-right">
                    <select name="brand" class="form-control">
                        <option value=""> - Brand - </option>
                        <?php 
                            $this->db->group_by('brand');
                            $i = $this->db->get('vehicle');
                
                            foreach($i->result_array() as $i) {

                              $selected = '';
                              if(isset($_GET['brand']))
                              {
                                if($_GET['brand'] == $i['id'])
                                {
                                  $selected = ' selected';
                                }
                              }
                            ?>
                              <option <?=$selected?>><?=$i['brand']?></option>
                              <?php } ?>
                    </select>
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
                <th class="column-title">Brand </th>
                <th class="column-title">Merk</th>
                <th class="column-title">Type</th>
                <th class="column-title">Tahun Pembuatan</th>
                <th class="column-title">Create</th>
                <th class="column-title">Update</th>
                <th class="column-title"></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($data as $key => $item): ?>
                <tr class="even pointer">
                    <td class="a-center "><?=$key+1?></td>
                    <td><?=$item['brand']?></td>
                    <td><?=$item['merk']?></td>
                    <td><?=$item['type']?></td>
                    <td><?=$item['tahun']?></td>
                    <td><?=date('d F Y', strtotime($item['created_at']))?></td>
                    <td><?=date('d F Y', strtotime($item['updated_at']))?></td>
                    <td>
                        <a href="<?=site_url("vehicle/edit/{$item['id']}")?>" title="Edit"><i class="fa fa-edit"></i></a> 
                        <a title="Hapus" onclick="_confirm('Hapus data ini?', '<?=site_url("vehicle/delete/{$item['id']}")?>')" ><i class="fa fa-trash"></i></a> 
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