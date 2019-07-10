<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2>Purchasing Order</h2> &nbsp;
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <div class="table-responsive">
        <table class="table table-striped table-bordered">
          <thead>
            <tr class="headings">
              <th>No</th>
              <th class="column-title">Company </th>
              <th class="column-title">PO Number </th>
              <th class="column-title">Vendor </th>
              <th class="column-title">Doc Date </th>
              <th class="column-title">Status </th>
              <th class="column-title no-link last"></th>
            </tr>
          </thead>
          <tbody>
          <?php
            foreach ($data as $key => $value) {
              $k = $key+1;
              ?>
                <tr>
                    <td><?=$k?></td>
                    <td><?=$value['company']?></td>
                    <td><?=$value['po_number']?></td>
                    <td><?=$value['vendor']?></td>
                    <td><?=$value['doc_date']?></td>
                    <td><?=status_po($value['status'])?></td>
                    <td>
                      <a href="<?=site_url('purchase-order-gm/proccess/'.$value['id'])?>" class="btn btn-default btn-xs">
                      <?php if($value['status'] == 1 || $value['status'] == "") { ?>
                       <i class="fa fa-arrow-right"></i> Proccess 
                      <?php }else {?>
                        <i class="fa fa-search"></i> Detail
                      <?php } ?>
                      </a>
                    </td>
                </tr>
              <?php
            }
          ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>