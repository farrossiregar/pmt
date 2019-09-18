<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Catalog</h2> &nbsp;
        <div class="col-md-10 pull-right">
          <form method="GET" action="">
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
        <div class="table-responsive">
          <table class="table table-striped table-bordered">
            <thead>
              <tr class="headings">
                <th>No</th>
                <th class="column-title">Brand </th>
                <th class="column-title">Merk </th>
                <th class="column-title">Type</th>
                <th class="column-title">Tahun</th>
                <th class="column-title">No Polisi</th>
                <th class="column-title">Sewa / Bulan</th>
                <th class="column-title">No STNK</th>
                <th class="column-title">End Date STNK</th>
                <th class="column-title">No KIR</th>
                <th class="column-title">End Date KIR</th>
                <th class="column-title">Last Submited</th>
                <th style="width: 100px;"></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($data as $key => $item): ?>
                <tr>
                  <td class="a-center "><?=$key+1?></td>    
                  <td><?=$item['brand']?></td>
                  <td><?=$item['merk']?></td>
                  <td><?=$item['type']?></td>
                  <td><?=$item['tahun']?></td>
                  <?php
                    $vendor = $this->db->get_where('vehicle_vendor', ['vehicle_id' => $item['id'],'vendor_id'=> $this->session->userdata('vendor_id')])->row_array();
                    if($vendor)
                    {
                      $item['sewa']             = $vendor['sewa'];
                      $item['no_polisi']        = $vendor['no_polisi'];
                      $item['stnk_no']          = $vendor['stnk_no'];
                      $item['stnk_end_date']    = $vendor['stnk_end_date'];
                      $item['kir_no']           = $vendor['kir_no'];
                      $item['kir_end_date']     = $vendor['kir_end_date'];
                      $item['last_updated']     = $vendor['updated_at'];
                    }
                  ?>
                  <td><?=$item['no_polisi']?></td>
                  <td><?=($item['sewa'] != "" ? format_idr($item['sewa']) : '')?></td>
                  <td><?=$item['stnk_no']?></td>
                  <td><?=$item['stnk_end_date']?></td>
                  <td><?=$item['kir_no']?></td>
                  <td><?=$item['kir_end_date']?></td>
                  <td>
                    <?php if($item['last_updated'] != ""):?>
                      <?=date('d F Y', strtotime($item['last_updated']));?>
                    <?php endif; ?>
                  </td>
                  <td>
                    <?php if($item['sewa'] != ""):?>
                      <a href="<?=site_url("vehiclevendor/edit/{$vendor['id']}?vehicle_id=". $item['id'])?>" class="btn btn-success btn-xs" title="Edit"><i class="fa fa-edit"></i> Update</a> 
                    <?php else: ?>
                      <a href="<?=site_url("vehiclevendor/setvehicle/{$item['id']}")?>" class="btn btn-warning btn-xs" title="Set Price"><i class="fa fa-arrow-right"></i> Set Vehicle</a> 
                    <?php endif;?>
                  </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>