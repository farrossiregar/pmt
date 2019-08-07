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
              <th class="column-title no-link last" style="width: 30px;"></th>
            </tr>
          </thead>
          <tbody>
          <?php
            foreach ($data as $key => $value):
              $k = $key+1;
              ?>
              <tr>
                  <td><?=$k?></td>
                  <td><?=$value['company']?></td>
                  <td><?=$value['po_number']?></td>
                  <td><?=$value['vendor']?></td>
                  <td><?=$value['doc_date']?></td>
                  <td>
                    <?php 
                      if($value['status'] == 1 || $value['status'] == "")
                      {
                         echo '<label class="btn btn-success btn-sm"><i class="fa fa-history"></i> Proqurement Manager </label>';
                      }
                      elseif($value['status'] == 2 || $value['status'] == 3)
                      {
                         echo '<label class="btn btn-info btn-sm"><i class="fa fa-history"></i> General Manager / Finance </label>';
                      }
                      elseif($value['status'] == 4)
                      {
                         echo '<label class="btn btn-success btn-sm" style="background: #cfa1f1 !important; border:1px solid #cfa1f1;"><i class="fa fa-check"></i> Approved </label>';
                      }
                      elseif($value['status'] == 5)
                      {
                         echo '<label class="btn btn-danger btn-sm"><i class="fa fa-close"></i> Rejected </label>';
                      }
                    ?>
                  </td>
                  <td>
                    <div class="btn-group pull-right">
                      <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-bars"></i>
                      </a>
                      <ul class="dropdown-menu">
                        <?php if($value['status']==1): ?>
                        <li><a href="<?=site_url('PurchaseOrderWarehouse/proccess/'.$value['id'])?>" style="color: #4ec54e;" title="Print"><i class="fa fa-arrow-right"></i> Proccess</a></li>
                        <?php endif; ?>
                        <?php if($value['status']==4): ?>
                        <li><a href="<?=site_url('PurchaseOrderWarehouse/pdf/'.$value['id'])?>" target="_blank" title="Print"><i class="fa fa-print"></i> Print PO</a></li>
                        <?php endif;?>
                        <li><a href="<?=site_url('purchase-order/detail/'.$value['id'])?>?is_rfq=<?=isset($value['rfq_id']) ? $value['rfq_id'] : ''?>" title="Detail"><i class="fa fa-search"></i> Detail</a></li>
                      </ul>
                    </div>
                  </td>
              </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>