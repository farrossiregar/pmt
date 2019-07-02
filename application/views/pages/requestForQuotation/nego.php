<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="col-md-12 col-sm-12 col-xs-12">
   <div class="x_panel">
      <div class="x_title">
         <h2>Nego #<?=$data['case_id']?> / </h2>
         <div class="clearfix"></div>
      </div>
      <div class="x_content">
         <div class="table-responsive">
            <table class="table table-striped table-bordered">
               <thead>
                  <tr class="headings">
                     <th style="width: 50px;">No</th>
                     <th>Material</th>
                     <th>Price</th>
                     <th>Nego</th>
                     <th>Sub Total</th>
                  </tr>
               </thead>
               <tbody>
               <?php
                  foreach($material as $key => $i)
                  {
                     echo "<tr>";
                        echo "<td>". ($key + 1) ."</td>";
                        
                        echo "<td>". $i['material'] ."</td>";
                        $row = get_material_vendor_row($i['material_id'], $vendor_id);
                        if($row)
                        {
                           echo '<td>'. format_idr($row['sales_price']) .'</td>';
                        }
                        else
                        {
                           echo '<td></td>';
                        }
                        echo '<td><input type="text" class="form-control" /></td>';
                        echo '<td></td>';
                     ?>
                    </tr>
                     <?php 
                  }
               ?>
               </tbody>
            </table>
         </div>
         <a href="<?=site_url('requestForQuotation')?>" class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
         <button type="button" class="btn btn-info btn-sm"><i class="fa fa-arrow-right"></i> Submit Nego</button>
      </div>
   </div>
</div>
<script type="text/javascript">
   function nego(el)
   {

   }
</script>