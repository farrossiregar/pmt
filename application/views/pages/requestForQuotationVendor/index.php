<div class="col-md-12 col-sm-12 col-xs-12">
   <div class="x_panel">
      <div class="x_title">
         <h2>Request For Quotation</h2>
         <div class="clearfix"></div>
      </div>
      <div class="x_content">
         <div class="table-responsive">
            <table class="table table-striped table-bordered">
               <thead>
                  <tr class="headings">
                     <th>No</th>
                     <th class="column-title">RFQ Number </th>
                     <th class="column-title">Type</th>
                     <th class="column-title">Document Title</th>
                     <th class="column-title">Solicatation Type</th>
                     <th class="column-title">Delivery Date</th>
                     <th class="column-title">Expired Date</th>
                     <th class="column-title">Delivery Address</th>
                     <th class="column-title">Status</th>
                     <th style="width: 30px;"></th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                     foreach ($data as $key => $value) {
                        $no = $key +1;
                        echo "<tr>";
                           echo "<td>".$no."</td>";
                           echo "<td>".$value['case_id']."</td>";
                           echo "<td>".$value['purchase_type']."</td>";
                           echo "<td>".$value['document_title']."</td>";
                           echo "<td>".$value['solicatation_type']."</td>";
                           echo "<td>".$value['delivery_date']."</td>";
                           echo "<td>".$value['expired_date']."</td>";
                           echo "<td>".$value['detail_delivery_address']."</td>";
                           $status = status_quotation_rfq_vendor($value['id'], $vendor_id);
                           ?>
                            <td><?=$status['msg']?></td>
                            <td>
                               <div class="btn-group pull-right">
                                 <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                   <i class="fa fa-bars"></i>
                                 </a>
                                 <ul class="dropdown-menu">
                                    <?php if($status['status'] == "" ): ?>
                                     <li><a href="<?=site_url("requestForQuotationVendor/detail/{$value['id']}")?>" ><i class="fa fa-plus"></i> Create Quotation</a></li>
                                    <?php else:?>
                                     <li><a href="<?=site_url("requestForQuotationVendor/detail/{$value['id']}")?>?quotation_id=<?=$status['data']['id']?>" ><i class="fa fa-search"></i> Quotation</a></li>
                                    <?php endif;?>
                                    <?php if($value['is_nego'] == 1):?>
                                     <li><a href="<?=site_url("requestForQuotationVendor/nego/{$value['id']}")?>" ><i class="fa fa-edit"></i> Nego</a></li>
                                    <?php endif;?>
                                 </ul>
                               </div>
                            </td>
                    <?php
                        echo "</tr>";
                     }
                  ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>