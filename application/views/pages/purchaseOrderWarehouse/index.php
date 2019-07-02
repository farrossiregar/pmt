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
            foreach ($data as $key => $value) {
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
                           echo '<label class="btn btn-info btn-sm"><i class="fa fa-history"></i> General Manager </label>';
                        }
                        elseif($value['status'] == 2)
                        {
                           echo '<label class="btn btn-info btn-sm"><i class="fa fa-history"></i> Finance </label>';
                        }
                        elseif($value['status'] == 3)
                        {
                           echo '<label class="btn btn-success btn-sm"><i class="fa fa-check"></i> Approved </label>';
                        }
                      ?>
                    </td>
                    <td>
                      <div class="btn-group pull-right">
                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                          <i class="fa fa-bars"></i>
                        </a>
                        <ul class="dropdown-menu">
                          <li><a href="<?=site_url('PurchaseOrderWarehouse/pdf/'.$value['id'])?>" target="_blank" title="Print"><i class="fa fa-print"></i> Print PO</a></li>
                          <li><a href="<?=site_url('purchase-order/detail/'.$value['id'])?>" title="Detail"><i class="fa fa-search"></i> Detail</a></li>
                        </ul>
                      </div>
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