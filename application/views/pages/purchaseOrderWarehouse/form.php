<div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
         <div class="x_title">
            <h2>Purchasing Order</h2>
            <div class="clearfix"></div>
         </div>
         <div class="x_content">
            <br>
            <form id="demo-form2" method="post" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
				  <div class="form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="po_number">Company <span class="required">*</span>
               </label>
               <div class="col-md-6 col-sm-6 col-xs-12">
               	<select class="form-control" disabled>
               		<option value="">-- Select Company --</option>
               		<?php foreach(get_company() as $item) { ?>
					         <option value="<?=$item['id']?>" <?=(isset($pr_data) and $pr_data['company_id'] == $item['id']) ? 'selected' : ''?> data-po_number="<?=generate_purchase_order_no($item['code'])?>"><?=$item['name']?></option>
               		<?php } ?>
               	</select>
                  <input type="hidden" name="PO[company_id]" value="<?=(isset($pr_data) ) ? $pr_data['company_id'] : ''?>" />
               </div>
              </div>
               	<div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="po_number">PO Number <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" id="po_number" required="required" name="PO[po_number]" value="<?=generate_purchase_order_no($pr_data['project_code'])?>" readonly="readonly" class="form-control col-md-7 col-xs-12">
                  </div>
               	</div>
               	<div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="rfq_id">RFQ Number <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                  	 <?php if(isset($pr_data)) { ?>
                     <select class="form-control col-md-7 col-xs-12" name="PO[rfq_id]" id="rfq_id" disabled>
                     <?php } else { ?>
                     <select class="form-control col-md-7 col-xs-12" name="PO[rfq_id]" id="rfq_id">
                     <?php } ?>
                     	<option value="0">-- Select FRQ --</option>
	                    <?php foreach ($rfq as $key => $value) { ?>
	                  		<option value="<?=$value['id']?>"><?=$value['case_id']?></option>
	                  	<?php } ?>
                     </select>
                  </div>
               	</div>
               	<div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pr_id">PR Number <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                  	  <?php if(isset($pr_data)) { ?>
                      <select class="form-control col-md-7 col-xs-12" readonly="true" name="PO[pr_id]" id="pr_id">
                      <?php } else{ ?>
                      <select class="form-control col-md-7 col-xs-12" name="PO[pr_id]" id="pr_id">
                      <?php } ?>
                     	<option value="0">-- Select PR --</option>
	                    <?php foreach ($pr as $key => $value) { 
	                    	$selected = '';
	                    	if(isset($pr_data)) 
	                    	{
	                    		if($pr_data['id'] == $value['id'])
	                    		{
	                    			$selected = 'selected';
	                    		}
	                    	}
	                    ?>
	                  		<option value="<?=$value['id']?>" <?=$selected?>><?=$value['no']?></option>
	                  	<?php } ?>
                     </select>
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="vendor_id">Vendor <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <select class="form-control col-md-7 col-xs-12" name="PO[vendor_id]" id="vendor">
                     	<option value="0">-- Select Vendor --</option>
	                     <?php foreach ($vendor as $key => $value): ?>
	                  		<option value="<?=$value['id']?>"><?=$value['name']?> / <?=$value['pic_name']?></option>
	                  	<?php endforeach; ?>
                     </select>
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="doc_date">Doc. Date <span class="required">*</span>
                  </label>
                  <div class="col-md-3 col-sm-3 col-xs-3">
                     <input type="text" id="doc_date" required="required" name="PO[doc_date]"  class="form-control col-md-7 col-xs-12 tanggal">
                  </div>
               </div>               
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Term of Payment<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="number" class="form-control" name="PO[term_day]" placeholder="Day" style="width: 150px; float: left; margin-right: 10px;">
                     <label style="margin-top:8px; float: left;">After Invoice Received</label>
                     <input type="text" class="form-control" name="PO[term_day_remark]" style="float: left;margin-left: 10px; width: 300px;" placeholder="Remark">
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Note
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                  	<textarea class="form-control" name="PO[note]" style="height: 100px;"></textarea>
                  </div>
               </div>

               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Delivery Address
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <textarea class="form-control" name="PO[address]" style="height: 100px;"></textarea>
                  </div>
               </div>
               
               <table align="center" class="table" style="margin:auto; width: 50%" >
                  <tbody id="term_body">
                     <tr id="tb_0">
                        <td><input type="text" id="tem_0" name="term[]" class="form-control" placeholder="Term"></td>
                        <td><input type="text" id="cond_0" name="cond[]" class="form-control" placeholder="Cond"></td>
                        <td style="text-align: right;"><a style="cursor: pointer;" class="btn btn-danger delete-term btn-sm" onclick="delete_term(0)"><i class="fa fa-trash"></i></a></td>
                     </tr>
                     <tr>
                        <td colspan="3" style="text-align: right;"><a style="cursor: pointer;" class="btn btn-primary btn-xs" id="add_term"><i class="fa fa-plus"></i> Add</a></td>
                     </tr>
                  </tbody>
               </table>
               <hr />
               <table align="center" class="table" style="margin:auto; width: 90%" >
	               	<thead>
	               		<tr>
                           <th style="width: 50px;">No</th>
	               			<th>Item</th>
	               			<th>PO QTY</th>
	               			<th>Unit Price</th>
	               			<th style="width: 300px;">Sub Total</th>
	               		</tr>
	               	</thead>
	               	<tbody id="material_body">
                        <tr>
                           <td colspan="5" style="text-align: center;"><i>Empty</i></td>
                        </tr>    
                     </tbody>
	               	<tfoot style="background: #fbfbfb;">
                        <tr>
                           <th colspan="4" style="text-align: right;vertical-align: middle;">
                              Discount
                           </th>
                           <td>
                              <input type="number" class="form-control" name="PO[discount]" placeholder="%" style="width: 80px; float: left; margin-right: 10px;">
                              <input type="number" class="form-control" name="PO[discount_rp]" placeholder="Rp. " style="width: 170px; float: left; margin-right: 10px;">
                           </td>
                        </tr>
                        <tr>
                           <td colspan="4" style="text-align: right;vertical-align: middle;">
                              <select name="PO[vat_type]" class="form-control" style="width: 100px;float: right;">
                                 <option value="1">PPh</option>
                                 <option value="2">PPN</option>
                              </select>
                           </td>
                           <td>
                              <input type="number" class="form-control" name="PO[vat]" placeholder="% " style="width: 150px; float: left; margin-right: 10px;">
                           </td>
                        </tr>
                        <tr>
                           <th colspan="4" style="text-align: right;vertical-align: middle;">Shipping Charge</th>
                           <td>
                              <input type="number" class="form-control" name="PO[shipping_charge]" placeholder="Rp. " style="width: 150px; float: left; margin-right: 10px;">
                           </td>
                        </tr>
		               	<tr>
		               		<td colspan="4" style="text-align: right;vertical-align: middle;">
                              <b>Total</b>
                              <input type="hidden" name="PO[total]" />
                           </td>
	            			  <td id="total"></td>
		               	</tr>
	                 </tfoot>
               </table>
               <div class="ln_solid"></div>
               <div class="form-group">
                  <div>
                     <a href="#" onclick="history.back()" class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i> Cancel</a>
                     <button class="btn btn-primary btn-sm" type="reset"><i class="fa fa-refresh"></i> Reset</button>
                     <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Submit Purchase Order</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
	var term = 1;
	var material = 0;
	var option = "";
	var data_material = "";
	var sales_distribution = "";
   var total = 0;

   function init_calculate(rp = "")
   {
      if(total == 0 || total == "") return false;

      var disc             = $("input[name='PO[discount]']").val() !="" ? parseInt($("input[name='PO[discount]']").val()) : 0;
      var shipping_charge  = $("input[name='PO[shipping_charge]']").val() !="" ? parseInt($("input[name='PO[shipping_charge]']").val()) : 0;
      var vat              = $("input[name='PO[vat]']").val() !="" ? parseInt($("input[name='PO[vat]']").val()) : 0;
      var discount_rp      = $("input[name='PO[discount_rp]']").val() !="" ? parseInt($("input[name='PO[discount_rp]']").val()) : 0;
      var total_           = total;

      if(disc != 0 && rp == "")
      {
         disc  = disc * total / 100; 
         total_ = parseInt(total_) - disc;
         $("input[name='PO[discount_rp]']").val(disc);
      }
      if(rp != "")
      {
         disc     = discount_rp / total * 100; 
         total_   = parseInt(total_) - discount_rp;
         $("input[name='PO[discount]']").val(disc);
      }
      if(vat != 0)
      {
         vat  = vat * total_ / 100; 
         total_ = parseInt(total_ + vat);
      }

      total_ += parseInt(shipping_charge);
      
      $("#total").html(numberWithDot(total_)); 
   }

	$( document ).ready(function() {      
      $("input[name='PO[discount]'], input[name='PO[vat]'], input[name='PO[shipping_charge]'], input[name='PO[discount_rp]']").on('input', function(){
         
         if($(this).attr('name') == 'PO[discount_rp]')
         {
            init_calculate('rp');         
         } 
         else init_calculate();         

      });

		$("select[name='PO[company_id]']").on('change', function(){
			var no_po = $(this).find(':selected').data('po_number');
			$("input[name='PO[po_number]']").val(no_po);
		});

		$("#pr_id").change(function(){
			var id = parseInt($(this).val());
			if(id != 0)
				$("#rfq_id").val(0);

			$.ajax({
				url: '<?php echo base_url()."PurchaseOrderWarehouse/ajax_get_material_pr/"; ?>'+id,
            	type: 'get',
            	dataType: 'json',
            	success: function(data)
            	{
            		data_material = data;
            		show_material();
            	}
			});
		});

		$("#rfq_id").change(function(){
			var id = parseInt($(this).val());
			if(id != 0)
				$("#pr_id").val(0);

			$.ajax({
				url: '<?php echo base_url()."PurchaseOrderWarehouse/ajax_get_material_rfq/"; ?>'+id,
            type: 'get',
            dataType: 'json',
            success: function(data)
            {
            	data_material = data;
            	show_material();
            }
			});
		});

		$("#vendor").change(function(){
			var id_vendor = $(this).val();
			$.ajax({
				<?php if(isset($pr_data)) { ?>
				url: '<?php echo base_url()."PurchaseOrderWarehouse/ajax_get_pr_material_by_vendor/"; ?>'+id_vendor+'?pr_id=<?=$pr_data['id']?>',
				<?php } else { ?>
				url: '<?php echo base_url()."PurchaseOrderWarehouse/ajax_get_sales_distribution/"; ?>'+id_vendor,
				<?php } ?>
	            type: 'get',
	            dataType: 'json',
	            success: function(data)
	            {
	            	$("#material_body").html("");

	            	var el = ''; 

	            	$(data).each(function(k,v){
	            		var sub_total = 0;
	            		el += '<tr>';
                     el += '<td>'+ (parseInt(k) + 1) +'</td>';
	            		el += '<td>'+ v.material +'</td>';
	            		el += '<td>'+ v.qty;
	            		el += '<input type="hidden" name="Material['+ k +'][material_id]" value="'+ v.material_id +'" />';
	            		el += '<input type="hidden" name="Material['+ k +'][qty]" value="'+ v.qty +'" />';
	            		el += '<input type="hidden" name="Material['+ k +'][price]" value="'+ v.sales_price +'" />';
	            		el += '</td>';

	            		if(v.sales_price != "")
	            		{
	            			el += '<td>'+ numberWithDot(v.sales_price) +'</td>';
	            			total += parseInt(v.sales_price) * parseInt(v.qty); 
	            			sub_total = parseInt(v.sales_price) * parseInt(v.qty);
	            		}else{
	            			el += '<td><a href="javascript:void(0)" class="text-danger">Stock Empty</a></td>';
	            		}
	            		el += '<td>'+ numberWithDot(sub_total) +'</td>';
	            		el += '</tr>';
	            	});	

                  $("input[name='PO[total]']").val(total);

	            	$("#total").html(numberWithDot(total));
	            	$("#material_body").html(el);

	            }
			});
		});

		$("#branch_id").change(function(){
			var id = $(this).val();
			$.ajax({
 				url: '<?php echo base_url()."PurchaseOrderWarehouse/ajax_get_departement/"; ?>'+id,
            type: 'get',
            dataType: 'json',
            success: function(data)
            {
            	$("#departement_id").html('<option value="0">-- Pilih Departement --</option>');
            	$("#divisi_id").html('<option value="0">-- Pilih Divisi --</option>');
            	$("#section_id").html('<option value="0">-- Pilih Section --</option>');
               $.each(data , function(key, value){
                  $("#departement_id").append("<option value='"+value.id+"'>"+value.name+"</option>");
               });
            }				
			});
		});

		$("#departement_id").change(function(){
			var id = $(this).val();
			$.ajax({
 				url: '<?php echo base_url()."PurchaseOrderWarehouse/ajax_get_divisi/"; ?>'+id,
            type: 'get',
            dataType: 'json',
            success: function(data)
            {
            	$("#divisi_id").html('<option value="0">-- Pilih Divisi --</option>');
            	$("#section_id").html('<option value="0">-- Pilih Section --</option>');
               $.each(data , function(key, value){
                  $("#divisi_id").append("<option value='"+value.id+"'>"+value.name+"</option>");
               });
            }				
			});
		});

		$("#divisi_id").change(function(){
			var id = $(this).val();
			$.ajax({
 				url: '<?php echo base_url()."PurchaseOrderWarehouse/ajax_get_section/"; ?>'+id,
            type: 'get',
            dataType: 'json',
            success: function(data)
            {
            	$("#section_id").html('<option value="0">-- Pilih Section --</option>');
               $.each(data , function(key, value){
                  $("#section_id").append("<option value='"+value.id+"'>"+value.name+"</option>");
               });
            }				
			});
		});

		$("#requester").change(function(){
			var id = parseInt($(this).val());	
			var email = $(this).find(':selected').data('email');
				if(id == 0)
					$("#new_requester").show();
				else
					$("#new_requester").hide();

			if(typeof email == 'undefined')
         	$("#email_address").val("");
         else
         	$("#email_address").val(email);
		})		

		$("#add_term").click(function(){
			//term_body
			var td = '<tr id="tb_'+term+'">' +
	         			'<td><input type="text" id="tem_0" name="term[]" class="form-control" placeholder="Term"></td>' +
	         			'<td><input type="text" id="cond_0" name="cond[]" class="form-control" placeholder="Cond"></td>' +
	         			'<td><a style="cursor: pointer;" class="btn btn-danger delete-term" onclick="delete_term('+term+')" data-id="'+term+'">Delete</a></td>' +
	         		'</tr>';

	      $("#term_body").append(td);
	     	term ++;
		});		
	});	

	function delete_term(i)
	{
		$("#tb_"+i).remove();
	}

	function change_value_material(id_material, id_object)
	{
		var object = "#items_"+id_object;
		$(object).val(id_material);

		var price = parseInt($("#items_"+id_object).find(':selected').data('price').replace(/\s/g,'').replace(/\./g, "").replace(/\./g, "").replace("Rp", ""));
		var description = $("#items_"+id_object).find(':selected').data('description');
		var qty = parseInt($("#items_qty_"+id_object).val());
		var total = price * qty;

		var p1 = formatThousands(price);
		var p2 = formatThousands(total);

		$("#unit_price_"+id_object).val(p1);
		$("#line_total_"+id_object).val(p2);
		sum_total();
	}

	function manual_change_material(id_object)
	{
		var object = "#items_"+id_object;
		var description = $("#items_"+id_object).find(':selected').data('descripsi');

		if(typeof description == 'undefined')
		{
			$("#unit_price_"+id_object).val("");
			$("#line_total_"+id_object).val("");
			$("#description_"+id_object).val("");
		}else{
			var price = parseInt($("#items_"+id_object).find(':selected').data('price').replace(/\s/g,'').replace(/\./g, "").replace(/\./g, "").replace("Rp", ""));		
			var qty = parseInt($("#items_qty_"+id_object).val());
			var total = price * qty;

			var p1 = formatThousands(price);
			var p2 = formatThousands(total);

			$("#unit_price_"+id_object).val(p1);
			$("#line_total_"+id_object).val(p2);
			$("#description_"+id_object).val(description);
		}
			
	}

	function calculation_line_total(id_object)
	{
		var object = "#items_"+id_object;
		var price = parseInt($("#items_"+id_object).find(':selected').data('price').replace(/\s/g,'').replace(/\./g, "").replace(/\./g, "").replace("Rp", ""));
		var qty = parseInt($("#items_qty_"+id_object).val());
		var total = price * qty;

		var p1 = formatThousands(price);
		var p2 = formatThousands(total);

		$("#line_total_"+id_object).val(p2);
		sum_total();
	}

	function formatThousands(n, dp) {
	  var s = ''+(Math.floor(n)), d = n % 1, i = s.length, r = '';
	  while ( (i -= 3) > 0 ) { r = ',' + s.substr(i, 3) + r; }
	  return s.substr(0, i + 3) + r + (d ? '.' + Math.round(d * Math.pow(10,dp||2)) : '');
	}

	function sum_total()
	{
		var sum = 0;
		$('.line_total').each(function()
		{
			sum += parseInt($(this).val().replace(/\s/g,'').replace(/\,/g, ""));
		});
		
		var sales_tax = $("#sales_tax").val();
		if(sales_tax == "")
			sales_tax = 0;

		sales_tax = parseFloat(sales_tax);
		var potongan_percen = sum * sales_tax / 100;
		var result = sum + potongan_percen;
		$("#subtotal").html(formatThousands(sum));
		$("#percen_sales").html(sales_tax+" %");
		$("#subtotal_percent").html(formatThousands(potongan_percen));
		$("#total").html(formatThousands(result));
	}

	$("#sales_tax").change(function(){
		sum_total();
	});

	function hapus_material(i)
	{
		$("#material_content_"+i).remove();
		sum_total();
	}
</script>