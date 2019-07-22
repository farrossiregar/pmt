<div class="col-md-12 col-sm-12 col-xs-12">
   <div class="x_panel">
      <div class="x_title">
         <h2>Request For Quotation</h2>
         <div class="pull-right">
            <a href="<?=site_url('requestForQuotation/insert')?>" class="btn btn-success btn-sm"> <i class="fa fa-plus"></i> Create</a>
         </div>
         <div class="clearfix"></div>
      </div>
      <div class="x_content">
         <div class="table-responsive">
            <table class="table table-striped table-bordered">
               <thead>
                  <tr class="headings">
                     <th>No</th>
                     <th class="column-title">Company </th>
                     <th class="column-title">RFQ Number </th>
                     <th class="column-title">Document Title</th>
                     <th class="column-title">Delivery Date</th>
                     <th class="column-title">Expired Date</th>
                     <th class="column-title">Delivery Address</th>
                     <th style="width: 30px;"></th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                     foreach ($data as $key => $value) {
                        $no = $key +1;
                        echo "<tr>";
                           echo "<td>".$no."</td>";
                           echo "<td>".$value['company_name']."</td>";
                           echo '<td><a href="'.site_url("requestForQuotation/edit/{$value['id']}") .'" class="link">'.$value['case_id']."</a></td>";
                           echo "<td>".$value['document_title']."</td>";
                           echo "<td>".$value['delivery_date']."</td>";
                           echo "<td>".$value['expired_date']."</td>";
                           echo "<td>".$value['detail_delivery_address']."</td>";
                           ?>
                              <td>
                                 <div class="btn-group pull-right">
                                   <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                     <i class="fa fa-bars"></i>
                                   </a>
                                   <ul class="dropdown-menu">
                                       <li><a href="<?=site_url("requestForQuotation/bac/{$value['id']}")?>" title="Bid Analysis Comparison"><i class="fa fa-bar-chart"></i> Bid Analysis Comparison</a></li>
                                       <li><a href="<?=site_url("requestForQuotation/edit/{$value['id']}")?>" title="Edit"><i class="fa fa-edit"></i> Edit</a></li>
                                       <li><a style="cursor: pointer;" title="Hapus" onclick="_confirm('Hapus data ini?', '<?=site_url("requestForQuotation/delete/{$value['id']}")?>')" ><i class="fa fa-trash"></i> Delete</a></li>
                                       <li><a href="<?=site_url('requestForQuotation/pdf/'.$value['id'])?>" target="_blank" title="Print"><i class="fa fa-print"></i> Print</a> </li>
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