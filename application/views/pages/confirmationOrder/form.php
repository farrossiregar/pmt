<div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
         <div class="x_title">
            <h2>Form Confirmation Order</h2>
            <div class="clearfix"></div>
         </div>
         <div class="x_content">
            <br>
            <form id="demo-form2" method="post" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
               
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="no_do">No Do <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" id="no_do" required="required" name="CO[no_do]"  value="<?=(isset($data['vendor']) ? $data['vendor'] : '')?>" class="form-control col-md-7 col-xs-12">
                  </div>
               </div>

               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="vendor">Vendor <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <select class="form-control" name="CO[vendor_id]" id="vendor">
                        <option value="0">-- Pilih Vendor --</option>
                        <?php
                           foreach ($vendor as $key => $value){
                              echo "<option value='".$value['id']."'>".$value['name']."</option>";
                           }
                     ?>
                     </select>
                  </div>
               </div>

               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="">Branch <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <select readonly="readonly" disabled="disabled"  class="form-control">
                        <?php
                           foreach ($branch as $key => $value){
                              $select = '';
                              if($value['id'] === $branch_id)
                                 $select = 'selected';

                              echo "<option ".$select." value='".$value['id']."'>".$value['name']."</option>";
                           }
                     ?>
                     </select>
                  </div>
               </div>

               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tanggal">Tanggal Penerimaan <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" id="tanggal" required="required" name="CO[tanggal]"   class="form-control col-md-7 col-xs-12 tanggal">
                     <input type="hidden" id="" required="required" name="CO[created_by]" value="<?=$_SESSION['user_id']?>"   class="form-control col-md-7 col-xs-12">
                     <input type="hidden" id="" name="CO[branch_id]" value="<?=$branch_id?>" class="form-control col-md-7 col-xs-12">
                  </div>
               </div>

               <table align="center" class="table" style="margin:auto; width: 90%" >
                  <thead>
                     <tr>
                        <td>Item</td>
                        <td>Item Number / Serial Number</td>
                        <td>QTY</td>
                        <td>Keterangan</td>
                        <td><a style="cursor: pointer; float: right;" class="btn btn-primary" id="add_material">Add Material</a></td>
                     </tr>
                  </thead>
                  <tbody id="material_body">
                     
                  </tbody>               
               </table>

               <div class="ln_solid"></div>
               <div class="form-group">
                  <div>
                     <a href="#" onclick="history.back()" class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i> Cancel</a>
                     <button class="btn btn-primary btn-sm" type="reset"><i class="fa fa-refresh"></i> Reset</button>
                     <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Save</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

<script type="text/javascript">
   var material = "";
   var option = "";
   var i = 0;
   $( document ).ready(function() {

      $("#vendor").change(function(){
         var id = $(this).val();

         $.ajax({
            url: '<?php echo base_url()."confirmationOrder/ajax_get_material/"; ?>'+id,
            type: 'get',
            dataType: 'json',
            success: function(data)
            {
               material = data;
               option = "";              
               $.each(data, function(key, value){
                  option = option+"<option value='"+value.id+"'>"+value.name+"</option>";
               });

               $("#material_body").html("");
            }           
         });
      });

      $("#add_material").click(function(){
         
         if(material.length > 0)
         {
            var td = "<tr id='body_content_material_"+i+"'>"+
                        "<td><select class='form-control' name='Material["+i+"][material_id]'><option value=0>-- Pilih Material --</option>"+option+"</select></td>"+
                        "<td><input type='text' class='form-control' name='Material["+i+"][serial_number]'></td>"+
                        "<td width='10%'><input  type='number' class='form-control' name='Material["+i+"][qty]'></td>"+
                        "<td><textarea name='Material["+i+"][keterangan]' class='form-control'></textarea></td>"+
                        "<td><a onclick='DeleteMaterial("+i+")' class='btn btn-warning'>Hapus Material</a></td>"+
                     "</tr>";
            $("#material_body").append(td);
            i++;
         }         
      });


   });

   function DeleteMaterial(id)
   {
      $("#body_content_material_"+id).remove();
   }
</script>