<div class="col-md-12 col-sm-12 col-xs-12">
   <div class="x_panel">
      <div class="x_title">
         <h2>Request For Quotation</h2>
         <div class="pull-right">
            <a href="<?=site_url('requestForQuotation/insert')?>" class="btn btn-success btn-sm"> <i class="fa fa-plus"></i> Create / Insert</a>
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
                     <th class="column-title">Vendor </th>
                     <th class="column-title">Material </th>
                     <th class="column-title">Price </th>
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
                           echo '<td>'. $value['vendor_name'] .'</td>';
                           echo '<td>'. $value['material_name'] .'</td>';
                           echo '<td>'. format_idr($value['sales_price']) .'</td>';
                        echo "</tr>";
                     }
                  ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>