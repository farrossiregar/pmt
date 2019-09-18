<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Vendor / Supplier</h2> &nbsp;
        <div class="btn-group pull-right">
          <a href="<?=site_url('vendor/insert')?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Create </a>
        </div>
        <div class="col-md-8 pull-right">
            <form method="GET" action="">
                <button type="submit" class="btn btn-info btn-sm pull-right"><i class="fa fa-search-plus"></i></button>
                <div class="col-md-2 pull-right">
                  <select name="currency" class="form-control">
                    <option value=""> - Currency - </option>
                    <?php 
                    $currency = [1=>'IDR', 2=>'USD', 3=>'EUR'];                   
                      foreach($currency as $key => $i) {

                        $selected = "";

                        if(isset($_GET['currency']))
                        {
                          if($_GET['currency'] == $key){
                            $selected = " selected";
                          }
                        }
                    ?>
                        <option value="<?=$key?>" <?=$selected?>><?=$i?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="col-md-5 pull-right">
                    <input type="text" class="form-control" name="name" value="<?=@$_GET['name']?>" placeholder="ID Vendor / Nama Vendor / PIC / Phone / Email / Terms of Payment">
                </div>
                <div class="col-md-3 pull-right">
                  <select name="vendor_type" class="form-control">
                    <option value=""> - Vendor Type - </option>
                    <?php 
                      $vendor_type = [1=>'Material / Services', 2=>'Vehicle'];                   
                      foreach($vendor_type as $key => $i) {

                        $selected = "";

                        if(isset($_GET['vendor_type']))
                        {
                          if($_GET['vendor_type'] == $key){
                            $selected = " selected";
                          }
                        }
                    ?>
                        <option value="<?=$key?>" <?=$selected?>><?=$i?></option>
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
                <th class="column-title">Vendor Type </th>
                <th class="column-title">ID Vendor </th>
                <th class="column-title">Nama Vendor </th>
                <th class="column-title">Currency </th>
                <th class="column-title">Terms of Payment </th>
                <th class="column-title">Names of PIC </th>
                <th class="column-title">Phone 1 </th>
                <th class="column-title">Email </th>
                <th class="column-title no-link last"></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($data as $key => $item): ?>
                <tr class="even pointer">
                    <td class="a-center "><?=$key+1?></td>
                    <td>
                      <?php 
                        if($item['vendor_type'] == 1)
                        {
                          echo 'Material / Services';
                        }
                        elseif($item['vendor_type'] == 2)
                        {
                          echo 'Vehicle';
                        }
                        else
                        {
                          echo '<i><small>Not Set</small></i>';
                        }
                      ?>
                    </td>                 
                    <td><a href="<?=site_url("vendor/edit/{$item['id']}")?>" class="link" title="Edit"><?=$item['vendor_id']?></a></td>                 
                    <td>
                      <?=$item['name']?>
                      <a href="javascript:void(0)" title="Autologin" style="float: right;" onclick="_confirm('Login sebagai <?=$item['name']?>?', '<?=site_url("vendor/autologin")?>?email=<?=$item['email']?>')" ><i class="fa fa-user-secret"></i></a>
                    </td>                    
                    <td><?php
                          switch ($item['currency']) {
                            case 1:
                              echo  "IDR";
                              break;
                            case 2:
                              echo "USD";
                              break;
                            case 3:
                              echo "EUR";
                              break;
                            default:
                              # code...
                              break;
                          }
                        ?>  </td>
                    <td><?=$item['term_of_payment']?></td>
                    <td><?=$item['pic_name']?></td>
                    <td><?=$item['phone_1']?></td>
                    <td><?=$item['email']?></td>
                    <td>
                      <div class="btn-group pull-right">
                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                          <i class="fa fa-bars"></i>
                        </a>
                        <ul class="dropdown-menu">
                          <li><a href="<?=site_url("vendor/edit/{$item['id']}")?>" title="Edit"><i class="fa fa-edit"></i> Edit</a></li>
                          <li><a title="Hapus" onclick="_confirm('Hapus data ini?', '<?=site_url("vendor/delete/{$item['id']}")?>')" ><i class="fa fa-trash"></i> Delete</a></li>
                          <li><a title="Autologin" onclick="_confirm('Login sebagai <?=$item['name']?>?', '<?=site_url("vendor/autologin")?>?email=<?=$item['email']?>')" ><i class="fa fa-user-secret"></i> Autologin</a></li>
                        </ul>
                      </div>
                    </td>
                </tr>
            <?php endforeach;?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>