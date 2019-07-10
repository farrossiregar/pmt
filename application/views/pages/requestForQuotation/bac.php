<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="col-md-12 col-sm-12 col-xs-12">
   <div class="x_panel">
      <div class="x_title">
         <h2>Bid Analysis Comparison #<?=$data['case_id']?></h2>
         <div class="clearfix"></div>
      </div>
      <div class="x_content">
         <div class="table-responsive">
            <table class="table table-striped table-bordered">
               <thead>
                  <tr class="headings">
                     <th style="width: 50px;">No</th>
                     <th>Quotation Number</th>
                     <th>Vendor</th>
                     <?php 
                        foreach ($material as $key => $item) {
                           echo '<td>'. $item['material'] .'</td>';
                        }
                     ?>
                     <th style="width: 25px;"></th>
                  </tr>
               </thead>
               <tbody>
               <?php
                  foreach($vendor as $key => $i)
                  {
                     if($i['is_nego'] == 1)
                        echo "<tr style=\"background: #ffff97\" title=\"Nego to Vendor\">";
                     elseif($i['is_nego'] == 2)
                        echo "<tr style=\"background: #ffff97\" title=\"Nego From Vendor\">";
                     else
                        echo "<tr>";

                        echo "<td>". ($key + 1) ."</td>";
                        
                        $qo = item_quotation_rfq_vendor($data['id'], $i['vendor_id']);
                        if($qo)
                        {
                           echo '<td><a href="">'. $qo['quotation_number'] ."</a></td>";
                        }
                        else
                        {
                           echo '<td></td>';
                        }
                        echo "<td>". $i['vendor'] ."</td>";
                        foreach ($material as $item) {
                           $row = get_material_vendor_row($item['material_id'], $i['vendor_id']);
                           if($row)
                           {
                              echo '<td class="editable">'. format_idr($row['sales_price']) .'</td>';
                           }
                           else
                           {
                              echo '<td></td>';
                           }
                        }
                     ?>
                     <td>
                        <?php if($qo): ?>
                        <div class="btn-group pull-right">
                          <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-bars"></i>
                          </a>
                          <ul class="dropdown-menu">
                              <li><a href="<?=site_url('request-for-quotation/nego/'. $qo['id'])?>?vendor_id=<?=$i['vendor_id']?>"><i class="fa fa-edit"></i> Nego </a></li>
                              <li><a href="<?=site_url('purchase-order/createpobyqo/'. $qo['id'])?>"><i class="fa fa-arrow-right"></i> PO</a></li>
                           </ul>
                        </div>
                        <?php endif;?>
                     </td>
                    </tr>
                     <?php 
                  }
               ?>
               </tbody>
            </table>
         </div>
         <a href="<?=site_url('requestForQuotation')?>" class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
      </div>
   </div>
</div>