<div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
         <div class="x_title">
            <h2>Form Material</h2>
            <div class="clearfix"></div>
         </div>
         <div class="x_content">
            <br>
            <form id="demo-form2" method="post" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Material Group<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <select class="form-control" name="Material[material_group]">
                     <?php 
                        foreach ($group as $key => $value) {
                           echo "<option value='".$value['id']."'>".$value['name']."</option>";
                        }
                     ?>                  
                     </select>
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Material / Services <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" id="name" required="required" name="Material[name]"  value="<?=(isset($data['name']) ? $data['name'] : '')?>" class="form-control col-md-7 col-xs-12">
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Description <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <textarea class="form-control" name="Material[description]"><?=(isset($data['description']) ? $data['description'] : '')?></textarea>
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Order Unit<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" class="form-control autocomplete-order-unit" name="order_unit_name"  value="<?=(isset($data['name_unit']) ? $data['name_unit'] : '')?>">
                    <input type="hidden" class="form-control" name="Material[order_unit]" value="<?=(isset($data['order_unit']) ? $data['order_unit'] : '')?>">
                    
                    <!-- <select class="form-control" name="Material[order_unit]">
                     <?php 
                        foreach ($unit as $key => $value){
                            $selected = "";

                            if(isset($data['order_unit']))
                            {
                              if($data['order_unit'] == $value['id']){
                                $selected = " selected";
                              }
                            }

                           echo "<option ".$selected."  value='".$value['id']."'>".$value['name']."</option>";
                        }
                     ?>                  
                     </select> -->
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="safety_stock">Safety Stock <span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="number" id="safety_stock" required="required" name="Material[safety_stock]"  value="<?=(isset($data['safety_stock']) ? $data['safety_stock'] : '')?>" class="form-control col-md-7 col-xs-12 count_reorder_level">
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="plaanned_delivery_time">Planned Delivery Time <span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <select class="form-control count_reorder_level" id="planned_delivery_time" name="Material[planned_delivery_time]">
                     <?php 
                        $variable = PLANNED__DELIVERY__TIME;
                        $count = count($variable) - 1;
                        foreach ($variable as $key => $value) {

                            $selected = "";
                            $costume = "display: none;margin-top: 10px";

                            if(isset($data['planned_delivery_time']))
                            {
                              if($data['planned_delivery_time'] == $key){
                                $selected = " selected";
                              }
                            }

                           echo "<option ".$selected." value='".$key."'>".$value."</option>";
                        }

                        if(isset($data['planned_delivery_time']) AND  ( $data['planned_delivery_time'] == count($variable) - 1 ))
                        {                      
                            $costume = "margin-top: 10px";
                        }

                     ?>                  
                     </select>
                     <input style="<?=$costume?>" type="number" id="costumePlanned" required="required" name="Material[costumePlanned]" name="Material[costumePlanned]"  value="<?=(isset($data['costumePlanned']) ? $data['costumePlanned'] : '')?>" class="form-control col-md-7 col-xs-12 count_reorder_level count_reorder_level">
                  </div>
               </div>

               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="planned_daily_usage">Planner Daily Usage <span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="number" id="planned_daily_usage" required="required" name="Material[planned_daily_usage]"  value="<?=(isset($data['planned_daily_usage']) ? $data['planned_daily_usage'] : '')?>" class="form-control col-md-7 col-xs-12 count_reorder_level">
                  </div>
               </div>

               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="reorder_level">Reorder Level <span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" readonly="readonly" id="reorder_level" required="required" name="Material[reorder_level]"  value="<?=(isset($data['reorder_level']) ? $data['reorder_level'] : '')?>" class="form-control col-md-7 col-xs-12">
                  </div>
               </div>

               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="reorder_level">Purchasing Group (Group of Buyers) <span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <select multiple="multiple" class="form-control" id="division" name="Material[division][]">
                     <?php 

                        foreach ($division as $key => $value) {

                            $selected = "";

                            if(isset($data['division']) )
                            {
                                $val_select  = explode(",", $data['division']);
                                if(count($val_select) > 0 AND in_array($value['id'], $val_select))
                                {
                                  $selected = " selected";
                                }
                            }

                           echo "<option ".$selected." value='".$value['id']."'>".$value['name']."</option>";
                        }
                     ?>                  
                     </select>
                  </div>
               </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_detail">Matrerial Detail <span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <label class="switch">
                        <input type="checkbox" value="1" id="material_detail">
                        <span class="slider round"></span>
                     </label>
                  </div>
               </div>
                
                <div id="material_detail_child" style="display: none;"> 
                  <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12">Brand <span class="required">*</span></label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="texr" name="Material[brand]" value="<?=(isset($data['brand']) ? $data['brand'] : '')?>" class="form-control col-md-7 col-xs-12">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12">Model <span class="required">*</span></label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="texr" name="Material[model]" value="<?=(isset($data['model']) ? $data['model'] : '')?>" class="form-control col-md-7 col-xs-12">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12">Type <span class="required">*</span></label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="texr" name="Material[type]" value="<?=(isset($data['type']) ? $data['type'] : '')?>" class="form-control col-md-7 col-xs-12">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12">Series <span class="required">*</span></label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="texr" name="Material[series]" value="<?=(isset($data['series']) ? $data['series'] : '')?>" class="form-control col-md-7 col-xs-12">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12">Part Number <span class="required">*</span></label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="texr" name="Material[part_number]" value="<?=(isset($data['part_number']) ? $data['part_number'] : '')?>" class="form-control col-md-7 col-xs-12">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12">Size <span class="required">*</span></label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="texr" name="Material[size]" value="<?=(isset($data['size']) ? $data['size'] : '')?>" class="form-control col-md-7 col-xs-12">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12">Color <span class="required">*</span></label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="texr" name="Material[color]" value="<?=(isset($data['color']) ? $data['color'] : '')?>" class="form-control col-md-7 col-xs-12">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12">Capacity or Quantity <span class="required">*</span></label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="texr" name="Material[capacity_or_quantity]" value="<?=(isset($data['capacity_or_quantity']) ? $data['capacity_or_quantity'] : '')?>" class="form-control col-md-7 col-xs-12">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12">Dimensional <span class="required">*</span></label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="texr" name="Material[dimensional]" value="<?=(isset($data['dimensional']) ? $data['dimensional'] : '')?>" class="form-control col-md-7 col-xs-12">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12">Weight <span class="required">*</span></label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="texr" name="Material[weight]" value="<?=(isset($data['weight']) ? $data['weight'] : '')?>" class="form-control col-md-7 col-xs-12">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12">Engine Model <span class="required">*</span></label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="texr" name="Material[engine_model]" value="<?=(isset($data['engine_model']) ? $data['engine_model'] : '')?>" class="form-control col-md-7 col-xs-12">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12">Data Sheet <span class="required">*</span></label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="texr" name="Material[data_sheet]" value="<?=(isset($data['data_sheet']) ? $data['data_sheet'] : '')?>" class="form-control col-md-7 col-xs-12">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12">Services <span class="required">*</span></label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="texr" name="Material[services]" value="<?=(isset($data['services']) ? $data['services'] : '')?>" class="form-control col-md-7 col-xs-12">
                     </div>
                  </div>
                  
                </div>

               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="shipping_instruction">Shipping Instruction <span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <label class="switch">
                        <?php 
                          $checked = "";
                          $display = "display: none";
                          if(isset($data['shipping_instruction']) AND  $data['shipping_instruction'] == 1)
                          {
                              $checked = 'checked="checked"';
                              $display = "";
                          }

                        ?>

                        <input <?=$checked;?> type="checkbox" value="1" id="shipping_instruction">
                        <span class="slider round"></span>
                     </label>
                  </div>
               </div>

               <div id="shipping_child" style="<?=$display;?>"> 
                  <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="overdelive_tol">OVERDELIV. TOL <span class="required">*</span></label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="number" step="0.01" id="overdelive_tol" name="Material[overdelive_tol]" value="<?=(isset($data['overdelive_tol']) ? $data['overdelive_tol'] : '')?>" class="form-control col-md-7 col-xs-12">
                     </div>
                  </div>

                  <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="underdelive_tol">UNDERDELIV. TOL <span class="required">*</span></label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="number" step="0.01" id="underdelive_tol" name="Material[underdelive_tol]" value="<?=(isset($data['underdelive_tol']) ? $data['underdelive_tol'] : '')?>" class="form-control col-md-7 col-xs-12">
                     </div>
                  </div>

                  <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="stock_type">STOCK TYPE <span class="required">*</span></label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="Material[stock_type]">
                        <?php 
                           foreach ($unit as $key => $value) {

                            $selected = "";

                            if(isset($data['stock_type']))
                            {
                              if($data['stock_type'] == $value['id']){
                                $selected = " selected";
                              }
                            }

                              echo "<option ".$selected." value='".$value['id']."'>".$value['name']."</option>";
                           }
                        ?>                  
                        </select>
                     </div>
                  </div>

                  <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="reminder">REMINDER <span class="required">*</span></label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                        <label class="switch">
                          <?php 
                            $checked = "";
                            $display = "display: none";
                            if(isset($data['reminder']) AND  $data['reminder'] == 1)
                            {
                                $checked = 'checked="checked"';
                                $display = "";
                            }

                          ?>

                           <input <?=$checked;?> type="checkbox" value="1" id="reminder">
                           <span class="slider round"></span>
                        </label>
                     </div>
                  </div>

                  <div id="reminder_child" style="<?=$display;?>"> 
                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="1_st_rem">1st REM./EXPED <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="number" id="1_st_rem" name="Material[1_st_rem]" value="<?=(isset($data['1_st_rem']) ? $data['1_st_rem'] : '')?>" class="form-control col-md-7 col-xs-12">
                        </div>
                     </div>

                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="2_st_rem">2st REM./EXPED <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="number" id="2_st_rem" name="Material[2_st_rem]" value="<?=(isset($data['2_st_rem']) ? $data['2_st_rem'] : '')?>" class="form-control col-md-7 col-xs-12">
                        </div>
                     </div>

                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="3_st_rem">3st REM./EXPED <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="number" id="3_st_rem" name="Material[3_st_rem]" value="<?=(isset($data['3_st_rem']) ? $data['3_st_rem'] : '')?>" class="form-control col-md-7 col-xs-12">
                        </div>
                     </div>   
                  </div>

                  <input type="hidden" id="shipping_instruction_val" name="Material[shipping_instruction_val]" value="<?=(isset($data['shipping_instruction']) ? $data['shipping_instruction'] : 0)?>">
                  <input type="hidden" id="forecasting" name="Material[forecasting]" value="<?=(isset($data['reminder']) ? $data['reminder'] : '')?>">

               </div>
               <!-- end shipping child -->

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
<link href="<?=base_url()?>assets/js/ui/jquery-ui.min.css" rel="stylesheet">
<script src="<?=base_url()?>assets/js/ui/jquery-ui.min.js"></script>
<script type="text/javascript">
   $( document ).ready(function() {

      $("#planned_delivery_time").change(function(){
         var count = <?php echo count(PLANNED__DELIVERY__TIME) - 1; ?>;
         if(parseInt($(this).val()) === count)
            $("#costumePlanned").show();
         else
            $("#costumePlanned").hide();         
      });

      $(".count_reorder_level").change(function(){
         var safety_stock = parseInt($("#safety_stock").val());
         var daily_usage = parseInt($("#planned_daily_usage").val());
         var planned_delivery_time = parseInt($("#planned_delivery_time").val());
         if(planned_delivery_time == 0)
            $("#reorder_level").val(0);
         else
         {
            if(planned_delivery_time == 1)
               var value_planned_delivery = 7;
            else if(planned_delivery_time == 2)
               var value_planned_delivery = 30;
            else
               var value_planned_delivery = parseInt($("#costumePlanned").val());

            var result = safety_stock + (value_planned_delivery * daily_usage);
            if(isNaN(result))
               result = 0;

            $("#reorder_level").val(result);
         }         
      });

      $("#shipping_instruction").click(function(){
         var checked = $(this).is(':checked');
         if(checked === true){
            $("#shipping_child").show();
            $("#shipping_instruction_val").val(1);
         }
         else{
            $("#shipping_child").hide();
            $("#shipping_instruction_val").val(0);
         }

      });

      $(".autocomplete-order-unit").autocomplete({
        minLength:0,
        limit: 25,
        dataType: "json",
        source: function( request, response ) {
            $.ajax({
              url: "<?=site_url('ajax/getorderunit')?>",
              method : 'POST',
              data: {
                'name': request.term
              },
              success: function( data ) {
                response( data );
              }
            });
        },
        select: function( event, ui ) {
          $("input[name='Material[order_unit]']").val(ui.item.id);
        }
      }).on('focus', function () {
            $(this).autocomplete("search", "");
      });

      $("#material_detail").click(function(){
         var checked = $(this).is(':checked');
         if(checked === true){
            $("#material_detail_child").show();
            $("#material_detail_val").val(1);
         }
         else{
            $("#material_detail_child").hide();
            $("#material_detail_val").val(0);
         }

      });

      $("#reminder").click(function(){
         var checked = $(this).is(':checked');
         if(checked === true){
            $("#reminder_child").show();
            $("#forecasting").val(1);
         }
         else{
            $("#reminder_child").hide();
            $("#forecasting").val(0);
         }

      });

      $("#division").select2();    
   });
</script>

<style type="text/css">
   /* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {display:none;}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>