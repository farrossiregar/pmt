<div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
         <div class="x_title">
            <h2>Form Sales And Distribution Purchasing</h2>
            <div class="clearfix"></div>
         </div>
         <div class="x_content">
            <br>
            <form id="demo-form2" method="post" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Material Group<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <select class="form-control" id="material_group" name="material_group">
                     	<option value="0">- Group Material -</option>
	                     <?php
	                        foreach ($group as $key => $value) {
	                           echo "<option value='".$value['id']."'>".$value['name']."</option>";
	                        }
	                     ?>
                     </select>
                  </div>
               </div>

               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material">Material<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <select class="form-control" id="material" name="material">
                     	<option value="0">- Material -</option>
                     </select>
                  </div>
               </div>

               <br/>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" >Vendor<span class="required">*</span></label>
               </div>

               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="vendor_group">Vendor Group<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <select class="form-control" id="vendor_group" name="vendor_group">
                     	<option value="0">- Group Material -</option>
	                     <?php 
                          foreach ($group_vendor as $key => $value) {
	                           echo "<option value='".$value['id']."'>".$value['name']."</option>";
	                        }
	                     ?>
                     </select>
                  </div>
               </div>

               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="vendor">Vendor Name<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <select class="form-control" id="vendor" name="vendor">
                     	<option value="0">- Vendor -</option>
                     </select>
                  </div>
               </div>

               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sales_price">SALES PRICE<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                  	<input type="text" name="sales_price" id="sales_price" class="form-control idr">
                  </div>
               </div>

               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="valid_until">VALID UNTIL<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                  	<input type="text" name="valid_until" id="valid_until" class="form-control tanggal">
                  </div>
               </div>

               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="discont">DISCOUNT <span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <label class="switch">                         
                        <input type="checkbox" value="1" id="discont">
                        <span class="slider round"></span>
                     </label>
                  </div>
               </div>

               <div class="form-group" id="table_discont" style="display: none;">
               	<label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
               	<div class="col-md-6 col-sm-12 col-xs-12">
               		<table align="center" class="table">
	               		<thead>
	               			<tr>
	               				<td>START (.QTY)</td>
		               			<td>END (.QTY)</td>
		               			<td>DISCOUNT (%)</td>
		               			<td><button id="add_discont" class="btn btn-primary">Add</button> </td>	
	               			</tr>	               			
	               		</thead>
	               		<tbody id="qty-table" class="qty-table">
	               			<tr id="content-body-0">
	               				<td><input class="form-control col-md-7 col-xs-12" type="number" id="start-qty-0" name="start_qty[]"></td>
	               				<td><input class="form-control col-md-7 col-xs-12" type="number" id="end-qty-0" name="end_qty[]"></td>
	               				<td><input class="form-control col-md-7 col-xs-12" type="number" step="0.01" id="discont-0" name="discont[]"></td>
	               				<td><a id="delete_discont" id="delete-disc-0" data-id="0"  onclick="delete_disc(0)" class="btn btn-warning delete-disc">delete</a></td>
	               			</tr>
	               		</tbody>
	               	</table>
               	</div>               	
               </div>


               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="supply_abbility">SUPPLY ABILITY<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <select class="form-control" id="supply_abbility" name="supply_abbility">
                     	<option value="0">- Abbility -</option>
	                     <?php
	                        foreach ($period as $key => $value) {
	                           echo "<option value='".$value['id']."'>".$value['name']."</option>";
	                        }
	                     ?>
                     </select>
                  </div>
               </div>
                
                <div class="form-group" style="display: none" id="costume_period">
               	<label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
               	<div class="col-md-3 col-sm-6 col-xs-12"> From :<input type="text" id="from" name="from" class="form-control tanggal"> </div>
               	<div class="col-md-3 col-sm-6 col-xs-12"> To :<input type="text" id="to" name="to" class="form-control tanggal"> </div>
               </div>

               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="valid_until">Min Order<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                  	<input type="number" name="min_order" id="min_order" class="form-control">
                  </div>
               </div>

               <div style="float: right; margin-right: 300px">
               	<a id="save_temp" class="btn btn-warning">Next</a>
               </div>
               <div style="clear: both;"></div> <!-- Clear the float -->

               <div>
	            
	            <div class="x_panel">
	              	<div class="x_content">
	                	<table class="table table-hover">
		                  <thead>
		                    <tr>
		                      <th>VENDOR</th>
		                      <th>SALES PRICE</th>
		                      <th>DISCOUNT</th>
		                      <th>VALID UNTIL</th>
		                      <th>SUPPLY ABILITY (./Mo)</th>
		                      <th>MINIMUM ORDER QTY</th>
		                      <th></th>
		                    </tr>
		                  </thead>
	                  	<tbody class="add-table-sales">
	                    
	                  	</tbody>                  
	                	</table>
	              	</div>
	            </div>
              
	          </div>
               
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
	var i = 1;
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

	$("#save_temp").click(function(){
		var temp = "";
		var checked = $("#discont").is(':checked');
		var discont = 'tidak';
		var discont_bol = 0;
		var input = "";
		var supply_abbility_value = "";
		var value_discont = "";
		var result_value_discont = "";
      if(checked === true){
         discont = 'ada';
         discont_bol = 1;

         var table = $("#qty-table");
         var dataArray = [];
			var data = table.find('td'); //Get All HTML td elements
			var isi = 0;
			
			$("#qty-table tr").each(function ( key, value) {
				var this_row = $(this);
				var s = $(this).find("td:eq(0) input[type='number']").val();
				var e = $(this).find("td:eq(1) input[type='number']").val();
				var d = $(this).find("td:eq(2) input[type='number']").val();

				if(s != "" && e != "" && d != "")
				{
					if(isi > 0)
					{
						result_value_discont+=";";
					}

					result_value_discont+=s+","+e+","+d;
					isi++;
				}
				
		   });

			
      }

      var id = parseInt($("#supply_abbility").val());
		var last = parseInt("<?=count($period)?>");

		if(id === last)
		{
			var from = $("#from").val();
			var to = $("#to").val();

			if(from != "" && to !="")
				supply_abbility_value = from+ " " +to;
		}

      var input = '<input type="hidden" name="salesDistribution['+j+'][vendor_id]" value="'+$( "#vendor" ).val()+'">'+
      				'<input type="hidden" name="salesDistribution['+j+'][material_id]" value="'+$( "#material" ).val()+'">'+
      				'<input type="hidden" name="salesDistribution['+j+'][valid_until]" value="'+$( "#valid_until" ).val()+'">'+
      				'<input type="hidden" name="salesDistribution['+j+'][discont]" value="'+discont_bol+'">'+
      				'<input type="hidden" name="salesDistribution['+j+'][discont_val]" value="'+result_value_discont+'">'+
      				'<input type="hidden" name="salesDistribution['+j+'][supply_abbility]" value="'+$( "#supply_abbility" ).val()+'">'+
      				'<input type="hidden" name="salesDistribution['+j+'][supply_abbility_value]" value="'+supply_abbility_value+'">'+
      				'<input type="hidden" name="salesDistribution['+j+'][min_order]" value="'+$( "#min_order" ).val()+'">'+
      				'<input type="hidden" name="salesDistribution['+j+'][sales_price]" value="'+$( "#sales_price" ).val()+'">';


		temp = '<tr id="table-body-sales-'+j+'">' +
					'<th>'+$( "#vendor option:selected" ).text()+'</th>' +
					'<th>'+$("#sales_price").val()+'</th>'+
					'<th>'+discont+'</th>' +
					'<th>'+$("#valid_until").val()+'</th>'+
					'<th>'+$( "#supply_abbility option:selected" ).text()+'</th>'+
					'<th>'+$("#min_order").val()+'</th>'+
					'<th><a onclick="delete_body_sales('+j+')" id="" class="btn btn-warning delete_body_sales">delete</a>'+input+'</th>'+
				'</tr>';
		$(".add-table-sales").append(temp);
		emptyInput();
		j++;
	});

	$('#add_discont').click(function(e){
		var temp = '<tr id="content-body-'+i+'">'+
	               	'<td><input class="form-control col-md-7 col-xs-12" type="number" id="start-qty-'+i+'" name="start_qty[]"></td>' +
	               	'<td><input class="form-control col-md-7 col-xs-12" type="number" id="end-qty-'+i+'" name="end_qty[]"></td>' +
	               	'<td><input class="form-control col-md-7 col-xs-12" type="number" step="0.01" id="discont-'+i+'" name="discont[]"></td>'+
	               	'<td><a id="delete_discont" id="delete-disc-'+i+'" data-id="'+i+'" onclick="delete_disc('+i+')" class="btn btn-warning delete-disc">delete</a></td>'+
	               	'<td></td>'+
	               '</tr>';

	   $(".qty-table").append(temp);
	   i++;
	   e.preventDefault();
	});

	function emptyInput()
	{
		$("#qty-table").html("");
		$("#from").val("");
		$("#to").val("");

		$("#table_discont").hide();
		$("#table_discont").hide(); 
		$( "#vendor" ).val("");
      $( "#material" ).val("");
      $( "#valid_until" ).val("");
      $( "#supply_abbility").val("");
      $( "#min_order" ).val("");
      $( "#sales_price" ).val("");
      $( "#material_group" ).val(0);
      $( "#vendor_group" ).val(0);
      $( "#supply_abbility" ).val(0);
      $( "#costume_period" ).hide();
      $('#discont').prop('checked', false)
	}

	function delete_body_sales(id)
	{
		$("#table-body-sales-"+id).remove();
	}

	$("#discont").click(function(){
      var checked = $(this).is(':checked');
      if(checked === true){
         $("#table_discont").show();
      }
      else{
         $("#table_discont").hide();
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