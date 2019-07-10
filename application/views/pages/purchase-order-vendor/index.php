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
              <th class="column-title">Doc Date </th>
              <th class="column-title">Status </th>
              <th class="column-title no-link last" style="width: 25px;"></th>
            </tr>
          </thead>
          <tbody>
          <?php
            foreach ($data as $key => $value) {
              $k = $key+1;
              if($value['status'] != 3) continue;
              ?>
                <tr>
                    <td><?=$k?></td>
                    <td><?=$value['company']?></td>
                    <td><?=$value['po_number']?></td>
                    <td><?=$value['doc_date']?></td>
                    <td>
                    <?php 
                      if($value['status'] == "" || $value['status'] == 1)
                      {
                          echo '<label class="btn btn-warning btn-sm"> Open</label>';
                      }
                      elseif($value['status'] == 3)
                      {
                          if(!empty($value['invoice_id']))
                          {
                            echo '<a href="'. site_url('invoice-vendor/'. $value['id']) .'" class="btn btn-info btn-sm"><i class="fa fa-calendar"></i> Invoice</a>';
                          }else
                            echo '<label class="btn btn-success btn-sm"><i class="fa fa-star"></i> Win</label>';
                      }
                    ?>
                    </td>
                    <td>
                        <div class="btn-group pull-right">
                          <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-bars"></i>
                          </a>
                          <ul class="dropdown-menu">
                            <li><a href="<?=site_url('PurchaseOrderVendor/detail/'.$value['id'])?>"><i class="fa fa-search-plus"></i> Detail</a></li>
                            <li><a href="<?=site_url('PurchaseOrderVendor/createinvoice/'.$value['id'])?>"><i class="fa fa-plus"></i> Create Invoice</a></li>
                            <li><a href="<?=site_url('PurchaseOrderWarehouse/pdf/'.$value['id'])?>" target="_blank"  title="Print"><i class="fa fa-print"></i> Print PO</a></li>
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