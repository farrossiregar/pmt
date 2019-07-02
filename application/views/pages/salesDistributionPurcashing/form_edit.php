<div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
         <div class="x_title">
            <h2>Catalog</h2>
            <div class="clearfix"></div>
         </div>
         <div class="x_content">
            <br>
            <form id="demo-form2" method="post" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Material Group<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <select class="form-control" id="material_group" readonly>
                     	<option value="0">- Group Material -</option>
	                     <?php
	                        foreach ($group as $key => $value) {
                            $selected = "";

                            if(isset($material['material_group']) AND $material['material_group'] == $value['id'])
                              $selected = "selected";

	                         echo "<option ".$selected." value='".$value['id']."'>".$value['name']."</option>";
	                        }
	                     ?>
                     </select>
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material">Material<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <select class="form-control" id="material" readonly>
                     	<option value="0">- Material -</option>
                       <?php
                          foreach ($data_material as $key => $value) {
                            $selected = "";

                            if(isset($material['id']) AND $material['id'] == $value['id'])
                              $selected = "selected";

                           echo "<option ".$selected." value='".$value['id']."'>".$value['name']."</option>";
                          }
                       ?>
                     </select>
                  </div>
               </div>
               <br/>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sales_price">SALES PRICE<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                  	<input type="text" name="salesDistribution[sales_price]" id="salesDistribution[sales_price]" value="<?=$data['sales_price']?>" class="form-control idr">
                  </div>
               </div>

               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="valid_until">VALID UNTIL<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                  	<input type="text" name="salesDistribution[valid_until]" id="valid_until" value="<?=$data['valid_until']?>" class="form-control tanggal">
                  </div>
               </div>

               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="discont">DISCOUNT <span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <label class="switch">
                        <?php
                          $checked="";
                          $display="none;";
                          if($data['discont'] == 1){
                            $checked="checked"; 
                            $display=";";
                          }
                        ?>

                        <input type="checkbox" <?=$checked?> value="1" id="discont">
                        
                        <span class="slider round"></span>
                     </label>
                  </div>
               </div>
              
               <div class="form-group" id="table_discont" style="display: <?=$display?>">
               	<label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
               	<div class="col-md-6 col-sm-12 col-xs-12">
               		<table align="center" class="table">
	               		<thead>
	               			<tr>
	               				<td>START (.QTY)</td>
		               			<td>END (.QTY)</td>
		               			<td>DISCOUNT (%)</td>
		               			<td><button id="add_discont" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add</button> </td>	
	               			</tr>	               			
	               		</thead>
	               		<tbody id="qty-table" class="qty-table">
                      <?php 
                        if($data['discont_val'] != "")
                        {
                           $data_discont = explode(";", $data['discont_val']);

                            if(count($data_discont) > 0)
                            {
                              foreach ($data_discont as $key => $value) {
                                $data_table = explode(",", $value);
                               ?>
                                  <tr id="content-body-<?=$key?>">
                                    <td><input class="form-control col-md-7 col-xs-12" type="number" value="<?=$data_table[0]?>" id="start-qty-<?=$key?>" name="disc[<?=$key?>][start_qty]"></td>
                                    <td><input class="form-control col-md-7 col-xs-12" type="number" value="<?=$data_table[1]?>" id="end-qty-<?=$key?>" name="disc[<?=$key?>][end_qty]"></td>
                                    <td><input class="form-control col-md-7 col-xs-12" type="number" value="<?=$data_table[2]?>" step="0.01" id="discont-<?=$key?>" name="disc[<?=$key?>][discont]"></td>
                                    <td><a id="delete_discont" id="delete-disc-<?=$key?>" data-id="<?=$key?>"  onclick="delete_disc(<?=$key?>)" class="btn btn-danger delete-disc btn-sm"><i class="fa fa-trash"></i></a></td>
                                  </tr>
                               <?php
                              }
                            }
                        }
                      ?>
	               		</tbody>
	               	</table>
               	</div>               	
               </div>


               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="supply_abbility">SUPPLY ABILITY <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <select class="form-control" id="supply_abbility" name="salesDistribution[supply_abbility]">
                     	<option value="0">- Abbility -</option>
	                     <?php
	                        foreach ($period as $key => $value) {

                            $selected="";

                            if($data['supply_abbility'] == $value['id'])
                            {
                              $selected="selected";
                            }

	                           echo "<option ".$selected." value='".$value['id']."'>".$value['name']."</option>";
	                        }

                          $display = "none;";

                          if(count($period) == $data['supply_abbility'])
                          {
                              $display = ";";
                          }

                          $from = ""; $to = "";
                          $temp_costume = explode(" ", $data['supply_abbility_value']);
                          if(count($temp_costume) > 1)
                          {
                              $from = $temp_costume[0];
                              $to = $temp_costume[1];
                          }
	                     ?>
                     </select>
                  </div>
               </div>

                <div class="form-group" style="display: <?=$display?>" id="costume_period">
               	<label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
               	<div class="col-md-3 col-sm-6 col-xs-12"> From :<input type="text" id="from" name="from" value="<?=$from?>" class="form-control tanggal"> </div>
               	<div class="col-md-3 col-sm-6 col-xs-12"> To :<input type="text" id="to" name="to" value="<?=$to?>" class="form-control tanggal"> </div>
               </div>

               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="valid_until">Min Order<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                  	<input type="number" name="salesDistribution[min_order]" id="min_order" value="<?=$data['min_order']?>" class="form-control">
                  </div>
               </div>
                              
              <div class="ln_solid"></div>
              <div class="form-group">
                  <div>
                      <input type="hidden" name="salesDistribution[discont]" value="<?=$data['discont']?>" id="discont_hide">
                     <a href="#" onclick="history.back()" class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
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
	var i = 100;
	var j = 1;
	$("#material_group").change(function(){
		$.ajax({ 
        	url: '<?php echo base_url()."salesDistribution/ajax_get_material"; ?>',
        	data: {
          	'id' : $(this).val(),
        	},
        	type: 'get',
        	dataType: 'json',
        	success: function(data)
        	{
        		$("#material").html("<option value='0'>- Material -</option>");
         	$.each( data, function( key, value ) {
					$("#material").append('<option value="'+value.id+'">'+value.name+'</option>');
				});
        	}
     	});
	});

	$("#vendor_group").change(function(){
		$.ajax({ 
        	url: '<?php echo base_url()."salesDistribution/ajax_get_vendor"; ?>',
        	data: {
          	'id' : $(this).val(),
        	},
        	type: 'get',
        	dataType: 'json',
        	success: function(data)
        	{
        		$("#vendor").html("<option value='0'>- Vendor -</option>");
         	$.each( data, function( key, value ) {
					$("#vendor").append('<option value="'+value.id+'">'+value.name+'</option>');
				});
        	}
     	});
	});


	$('#add_discont').click(function(e){
		var temp = '<tr id="content-body-'+i+'">'+
	               	'<td><input class="form-control col-md-7 col-xs-12" type="number" id="start-qty-'+i+'" name="disc['+i+'][start_qty]"></td>' +
	               	'<td><input class="form-control col-md-7 col-xs-12" type="number" id="end-qty-'+i+'" name="disc['+i+'][end_qty]"></td>' +
	               	'<td><input class="form-control col-md-7 col-xs-12" type="number" step="0.01" id="discont-'+i+'" name="disc['+i+'][discont]"></td>'+
	               	'<td><a id="delete_discont" id="delete-disc-'+i+'" data-id="'+i+'" onclick="delete_disc('+i+')" class="btn btn-warning delete-disc">delete</a></td>'+
	               	'<td></td>'+
	               '</tr>';

	   $(".qty-table").append(temp);
	   i++;
	   e.preventDefault();
	});	


	$("#discont").click(function(){
      var checked = $(this).is(':checked');
      if(checked === true){
         $("#table_discont").show();
         $("#discont_hide").val(1);
      }
      else{
         $("#table_discont").hide();   
         $("#discont_hide").val(0);
      }

   });

	$("#supply_abbility").change(function(){
			var id = parseInt($(this).val());
			var last = parseInt("<?=count($period)?>");
			if(id === last)
			{
				$("#costume_period").show();
			} else
				{
					$("#costume_period").hide();
          $("#from").val("");
          $("#to").val("");
				}
	});
	
	function delete_disc(i) {
		$("#content-body-"+i).remove()
	}
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