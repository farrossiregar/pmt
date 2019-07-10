<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="col-md-12 col-sm-12 col-xs-12">
   <div class="x_panel">
      <div class="x_title">
         <h2>Nego #<?=$data['case_id']?> / </h2>
         <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <form method="post" action="" id="form_nego" autocomplete="off">
         <div class="table-responsive">
            <table class="table table-striped table-bordered">
               <thead>
                  <tr class="headings">
                     <th rowspan="2" style="width: 50px;">No</th>
                     <th rowspan="2">Material</th>
                     <th rowspan="2">Price</th>
                     <th rowspan="2" style="width: 60px;">QTY</th>
                     <th rowspan="2">Sub Total</th>
                     <th colspan="3" style="text-align: center; background: #ffff97;">Nego</th>
                  </tr>
                  <tr>
                     <th style="width: 100px;background: #ffff97;text-align: center;"> (%)</th>
                     <th style="background: #ffff97;">Price Nego (Rp)</th>
                     <th style="background: #ffff97;">Sub Total Nego (Rp)</th>
                  </tr>
               </thead>
               <tbody>
               <?php
                  foreach($material as $key => $i):

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
                        
                        echo '<td>';
                        echo '<input type="hidden" name="material_id['. $i['id'] .']" value="'. $i['material_id'] .'" />';
                        echo '<input type="hidden" name="qty" value="'. $i['qty'] .'" />';
                        echo '<input type="hidden" class="price" name="price['. $i['id'] .']" value="'. $row['sales_price'] .'" />';
                        echo '<input type="hidden" name="price_nego['. $i['id'] .']" value="'. $row['price_nego'] .'" />';
                        echo $i['qty'] .'</td>';
                        echo '<td class="sub_total">'. format_idr(($i['qty'] * $row['sales_price'])) .'</td>';
                        echo '<td style="background: #ffff97;"><input type="text" class="form-control nego" value="'. $row['persen_nego'] .'" name="persen_nego['. $i['id'] .']" /></td>';
                        echo '<td style="background: #ffff97;" class="price_nego">'. $row['price_nego'] .'</td>';
                        echo '<td style="background: #ffff97;" class="sub_total_nego">0</td>';
                     ?>
                    </tr>
               <?php endforeach; ?>
               </tbody>
            </table>
         </div>
         <hr />
         <a href="<?=site_url('requestForQuotation')?>" class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
         <button type="button" class="btn btn-info btn-sm" onclick="nego()"><i class="fa fa-arrow-right"></i> Submit Nego</button>
       </form>
      </div>
   </div>
</div>
<script type="text/javascript">
   $(".nego").each(function(){
      $(this).on('input', function(){

         var qty = $(this).parent().parent().find("input[name='qty']").val();
         var price = $(this).parent().parent().find(".price").val();
         var price_nego = parseInt(price) * parseInt($(this).val()) / 100;
             price_nego = price - price_nego;

         if($(this).val() == "") 
         {
            $(this).parent().parent().find('.price_nego').html(0);;
            $(this).parent().parent().find('.sub_total_nego').html(0);

            $(this).parent().parent().find("input[name='price_nego']").html(0);
         } 
         else
         {
            $(this).parent().parent().find('.price_nego').html(numberWithDot(price_nego));;
            $(this).parent().parent().find('.sub_total_nego').html(numberWithDot(price_nego * qty));
            $(this).parent().parent().find("input[name='price_nego']").html(price_nego * qty);

         }
      });
   })

   function nego(el)
   {
      if(confirm('Submit form ?'))
      {
         $('#form_nego').submit();
      }
   }
</script>