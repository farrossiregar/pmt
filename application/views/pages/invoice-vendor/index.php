<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2>Invoice</h2> &nbsp;
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <div class="table-responsive">
        <table class="table table-striped table-bordered">
          <thead>
            <tr class="headings">
              <th>No</th>
              <th class="column-title">Invoice Number </th>
              <th class="column-title">PO Number </th>
              <th class="column-title">Term of Payment </th>
              <th class="column-title">Date </th>
              <th class="column-title">Receive Date</th>
              <th class="column-title">Paid Date </th>
              <th class="column-title">File </th>
              <th class="column-title">Status </th>
            </tr>
          </thead>
          <tbody>
           <?php foreach ($data as $key => $value) {
              $k = $key+1;
              
              $due_date       = strtotime($value['due_date']);
              $now_date = time();
              $day        = $now_date - $due_date;
              $day        = abs(round($day / (60 * 60 * 24)));

              if($day <= 3 and $value['status'] != 3)
              {
                echo '<tr class="warning" title="Term Of Payment '. $day .' Day">';
              }
              else
              {
                echo '<tr>';
              }

              ?>
                    <td><?=$k?></td>
                    <td><?=$value['invoice_number']?></td>
                    <td><?=$value['po_number']?></td>
                    <?php 
                      if($day <= 3 and $value['status'] != 3)
                      {
                        echo '<td class="text-danger" style="font-weight: bold;"><i style="font-size: 18px;" class="fa fa-warning"></i> ';
                      }
                      else
                      {
                        echo '<td>';
                      }

                      if($value['status'] != 3){
                        echo $day?> Day ( <?=date('d F Y', strtotime($value['due_date']))?> )
                    <?php } else { echo $value['term_day'] .' Day'; } ?>
                  </td>
                    <td><?=date('d F Y', strtotime($value['created_at']))?></td>
                    <td>
                      <?php 
                        if($value['receive_date']) echo date('d F Y', strtotime($value['receive_date']))
                      ?>
                    </td>
                    <td>
                      <?php 
                        if($value['paid_date']) echo date('d F Y', strtotime($value['paid_date']))
                      ?>
                    </td>
                    <td><a href="<?=base_url('upload/'.$value['file'])?>" target="_blank"><i class="fa fa-download"></i> Download </td>
                    <td><?=status_invoice_finance($value['status'])?></td>
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