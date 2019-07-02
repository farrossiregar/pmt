<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2>Catalog</h2> &nbsp;
      <a href="<?=site_url('salesDistribution/insert')?>" class="btn btn-success btn-sm"> <i class="fa fa-plus"></i> Tambah</a>
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
              <th class="column-title">Material </th>
              <th class="column-title">Vendor</th>
              <th class="column-title">Valid Until</th>
              <th class="column-title">Sales Price</th>
              <th class="column-title">Min Order</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($data as $key => $item): ?>
              <tr class="even pointer">
                  <td class="a-center "><?=$key+1?></td>                    
                  <td><?=$item['name_material']?></td>
                  <td><?=$item['name_vendor']?></td>
                  <td><?=$item['valid_until']?></td>
                  <td><?=$item['sales_price']?></td>
                  <td><?=$item['min_order']?></td>
                  <td>
                      <a href="<?=site_url("salesDistribution/edit/{$item['id']}")?>" title="Edit"><i class="fa fa-edit"></i></a> 
                      <a title="Hapus" onclick="_confirm('Hapus data ini?', '<?=site_url("salesDistribution/delete/{$item['id']}")?>')" ><i class="fa fa-trash"></i></a> 
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