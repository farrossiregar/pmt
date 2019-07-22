<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Vendor / Supplier</h2> &nbsp;
        <div class="btn-group pull-right">
          <a href="<?=site_url('vendor/insert')?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Create </a>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="table-responsive">
          <table class="table table-striped table-bordered">
            <thead>
              <tr class="headings">
                <th>No</th>
                <th class="column-title">ID Vendor </th>
                <th class="column-title">Nama Vendor </th>
                <th class="column-title">Currency </th>
                <th class="column-title">Terms of Payment </th>
                <th class="column-title">Names of PIC </th>
                
                <th class="column-title">Phone 1 </th>
                <!-- <th class="column-title">Phone 2 </th>
                <th class="column-title">Mobile 1 </th>
                <th class="column-title">Mobile 2 </th> -->

                <th class="column-title">Email </th>
                <th class="column-title no-link last"></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($data as $key => $item): ?>
                <tr class="even pointer">
                    <td class="a-center "><?=$key+1?></td>
                    <td><?=$item['vendor_id']?></td>                 
                    <td><?=$item['name']?></td>                    
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
                    
                    <!-- <td><?=$item['phone_2']?></td>
                    <td><?=$item['mobile_1']?></td>
                    <td><?=$item['mobile_2']?></td> -->

                    <td><?=$item['email']?></td>
                    <td>
                        <a href="<?=site_url("vendor/edit/{$item['id']}")?>" title="Edit"><i class="fa fa-edit"></i></a> 
                        <a title="Hapus" onclick="_confirm('Hapus data ini?', '<?=site_url("vendor/delete/{$item['id']}")?>')" ><i class="fa fa-trash"></i></a> 
                    </td>
                </tr>
            <?php endforeach;?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>