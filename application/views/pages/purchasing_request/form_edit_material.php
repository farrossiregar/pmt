<div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
         <div class="x_title">
            <h2>Form EDIT MATERIAL REQUEST</h2>
            <div class="clearfix"></div>
         </div>
         <div class="x_content">
            <br>

            <form id="demo-form2" method="post" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
               
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_id">No Purchase Request <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <b><?=$header['no'];?></b>
                  </div>
               </div>
               
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_id">Material <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <select class="form-control" name="Material[material_id]" id="material_id">
                        <option value="0">- Material -</option>
                        <?php  
                           $select ="";
                              $display = "none";
                              $new = "";
                           foreach ($material as $key => $value){
                           
                           if($data['material_id'] == 0)
                           {
                              $display = "";
                              $new = "selected";
                           } else if($data['material_id'] == $value['id']){
                              $select = "selected";
                           }

                           ?>
                           <option <?=$select?> value="<?=$value['id']?>"><?=$value['name'];?></option>
                        <?php } ?>
                        <option <?=$new;?> value="new">new material</option>
                     </select>
                  </div>
               </div>

               <div class="form-group" id="new_material_input" style="display: <?=$display?>">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for=""></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text"  name="Material[new_material]" class="form-control" value="<?=$data['new_material']?>" id="new_material" placeholder="Input material baru">
                  </div>
               </div>               

               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="qty">Required Qty. <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="number"  name="Material[qty]" class="form-control" id="qty" value="<?=$data['qty']?>">
                  </div>
               </div>

               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="urgency">Urgency Level. <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="form-control" name="Material[urgency]" id="urgency">
                        
                        <?php   
                              $urgent = URGENCY___LEVEL;
                              foreach ($urgent as $key => $value){

                              $select ="";
                              if($key == $data['urgency'])
                                 $select ="selected";

                           ?>
                           <option <?=$select?> value="<?=$key?>"><?=$value?></option>
                        <?php } ?>
                     </select>
                  </div>
               </div>

               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <a class="btn btn-primary" id="add-request" style="float: right;"> Next</a>
                  </div>
               </div><br/><br/>

               <div class="ln_solid"></div>
               <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                     <a onclick="history.back();" class="btn btn-default">Cancel</a>
                     <button class="btn btn-primary" id="reset" type="reset">Reset</button>
                     <button type="submit" class="btn btn-success">Save</button>
                  </div>
               </div>

            </form>

         </div>
      </div>
   </div>
</div>

<script type="text/javascript">
    $( document ).ready(function() {

     $("#material_id").change(function(){
      var val = $(this).val();
      if(val == 'new')
         $("#new_material_input").show();
      else
         $("#new_material_input").hide();
   });

   });
</script>