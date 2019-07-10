<script type="text/javascript">
  var i = 1;
  var term = 1;
    function hitung(i){
    var qty = $("#qty_"+i).val();
    var price = $("#price_"+i).val();
    var discount = $("#discount_"+i).val();

    var total = parseInt(qty) * (parseFloat(price) - parseFloat(discount));
    $("#total_"+i).val(total); 
  }

</script>

<div class="col-md-12 col-sm-12 col-xs-12">
   <div class="x_panel">
      <div class="x_title">
         <h2>Material Purcashing Request :  <b><?php echo $header['no']; ?></b></h2>
         &nbsp;
        
         <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
         </ul>
         <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <form id="demo-form2" name="demo-form2" method="post" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
         <div class="table-responsive">
            <table id="datatable-buttons" class="table table-striped table-bordered">
               <thead>
                  <tr class="headings">
                     <th class="column-title" width="35">No</th>
                     <th class="column-title">Group Material</th>
                     <th class="column-title">Material Name</th>
                     <th class="column-title">Qty</th>
                     <th class="column-title" width="100">Price ($)</th>
                     <th class="column-title" width="100">Discount ($)</th>
                     <th class="column-title" width="100">Total ($)</th>
                     <th class="column-title" width="100">Tawaran ($)</th>
                     <!--<th class="column-title no-link last"></th>-->
                  </tr>
               </thead>
               <tbody>

                  <?php 
                     foreach ($data as $key => $value) {
                        echo '<tr>';
                        echo '<td class="column-title">'.($key+1);
                        echo '<input type="hidden" class="form-control" name="material_vendor['.$key.'][id]" id="id_'.$key.'" value="'.$value['id'].'">';
                        echo '<input type="hidden" class="form-control" name="material_vendor['.$key.'][vendor_id]" id="vendor_'.$key.'" value="'.$value['vendor_id'].'">';
                         echo '<input type="hidden" class="form-control" name="material_vendor['.$key.'][material_id]" id="material_'.$key.'" value="'.$value['material_id'].'">';
                        echo '<input type="hidden" class="form-control" name="material_vendor['.$key.'][qty]" id="qty_'.$key.'" value="'.$value['qty'].'">';
                        echo '</td>';
                        echo '<td class="column-title">'.$value['group_material'].'</td>';
                        echo '<td class="column-title">'.$value['name'];
                        echo '</td>';
                        echo '<td class="column-title">'.$value['qty'].'</td>';

                        echo '<td class="column-title"><input type="text" class="form-control" style="text-align: right; width:120px;" name="material_vendor['.$key.'][price]" onkeyup="hitung('.$key.')" id="price_'.$key.'" value="'.$value['price'].'"></td>';

                        echo '<td class="column-title"><input type="text" class="form-control" style="text-align: right; width:120px;" name="material_vendor['.$key.'][discount]" onkeyup="hitung('.$key.')" id="discount_'.$key.'" value="'.$value['discount'].'"></td>';

                        echo '<td class="column-title"><input type="text" readonly="readonly" style="text-align: right; width:120px;" class="form-control" id="total_'.$key.'" name="material_vendor['.$key.'][total]" value="'.$value['total'].'"></td>';
                         echo '<td class="column-title"><input type="text" readonly="readonly" style="text-align: right; width:120px;" class="form-control" id="penawaran_'.$key.'" name="material_vendor['.$key.'][penawaran]" value="'.$value['penawaran'].'"></td>';
                        echo '</tr>';
                     } 
                  ?>
               </tbody>
            </table>
         </div>
         <br/>
         <hr/>

         <div class="form-group" >
            <label><u><i>Term And Condition</i></u></label>
         </div>
         <div class="control-label col-md-12 col-sm-12 col-xs-12">
         <table align="left" class="add-table-term-condition" style="margin:auto; width: 50%">
            <thead>
              <tr>
                <td style="padding:2px;" align="center">&nbsp;</td>
                <td style="padding:2px;" align="center">Term</td>
                <td style="padding:2px;" align="center">Condition</td>
                <td style="padding:2px;" align="center"><a style="margin-top:5px; cursor: pointer;" class="btn btn-primary btn-sm" id="add_term">Add Term</a></td>
              </tr>
            </thead>
            <tbody id="term_body">
              <?php 
                  $c=1;
                  if(isset($request_term) AND count($request_term) > 0)
                  {
                     $input = '';

                     foreach ($request_term as $key => $value) {
                        $checked = $value->checking == '1' ? 'checked' : '';

                        echo '<tr id="tb_'.$key.'">';
                        echo '<td width="30" align="center"><input type="checkbox" id="check_'.$key.'" name="T['.$key.'][check]" class="form-check-input" style="margin:2px;" '.$checked.'><input type="hidden" id="id_'.$key.'" name="T['.$key.'][idx]" value="'.$value->term_vendor_id.'"></td>';
                        echo '<td><input type="text" id="tem_'.$key.'" name="T['.$key.'][term]" class="form-control" placeholder="Term" value="'.$value->term.'"></td>';
                        echo '<td><input type="text" style="margin-left:2px;" id="cond_'.$key.'" name="T['.$key.'][cond]" class="form-control" placeholder="Cond" value="'.$value->cond.'"></td>';
                        echo '<td style="padding:2px;" align="center"><a style="cursor: pointer;" class="btn btn-danger btn-sm delete-term" onclick="delete_term('.$key.')">Delete</a></td>';
                        echo '</tr>';

                        $c = $key;
                     }                                 
                  }else{
                ?>
                <tr id="tb_0">
                  <td width="30" align="center"><input type="checkbox" id="check_0" name="T[0][check]" class="form-check-input" style="margin:2px;" ><input type="hidden" id="id_0" name="T[0][idx]" value=""></td>
                  <td><input type="text" id="tem_0" name="T[0][term]" class="form-control" placeholder="Term"></td>
                  <td><input type="text" style="margin-left:2px;" id="cond_0" name="T[0][cond]" class="form-control" placeholder="Cond"></td>
                  <td style="padding:2px;" align="center"><a style="cursor: pointer;" class="btn btn-danger btn-sm delete-term" onclick="delete_term(0)">Delete</a></td>
                </tr>

              <?php
                  }
               ?>
               <script type="text/javascript">
                 term ='<?=$c?>';
               </script>
            </tbody>
        </table>
        </div>
        <br/><br/><br/><br/><br/><br/>
        <hr/>
        <div class="form-group col-md-12 col-sm-12 col-xs-12" >
            <div>
               <a href="#" onclick="back()" class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
               <button type="button" id="button-save" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Save</button>
            </div>
         </div>
        </form>
      </div>
   </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
  $("#add_term").click(function(){
    //term_body
    var td = '<tr id="tb_'+term+'">' +
              '<td width="30" align="center"><input type="checkbox" id="check_0" name="T['+term+'][check]" class="form-check-input" style="margin:2px;" checked ><input type="hidden" id="id_0" name="T['+term+'][idx]" value=""></td>' +
              '<td><input type="text" id="tem_0" name="T['+term+'][term]" class="form-control" placeholder="Term"></td>' +
              '<td><input type="text" style="margin-left:2px;" id="cond_0" name="T['+term+'][cond]" class="form-control" placeholder="Cond"></td>' +
              '<td style="padding:2px;" align="center"><a style="cursor: pointer;" class="btn btn-danger btn-sm delete-term" onclick="delete_term('+term+')" data-id="'+term+'">Delete</a></td>' +
            '</tr>';

      $("#term_body").append(td);
      term ++;
  });  

  $("#button-save").click(function(){
     $("form[name='demo-form2']").submit();
  }) 

});

function delete_term(i){
  $("#tb_"+i).remove();
}

function back(){
   window.location = "<?php echo base_url(); ?>RequestForQuotation";
}

</script>
