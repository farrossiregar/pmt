<div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
         <div class="x_title">
            <h2>Form Request For Quotation</h2>
            <div class="clearfix"></div>
         </div>
         <div class="x_content">
            <form id="demo-form2" method="post" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">PR Number</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="form-control" name="pr_id">
                      <option value=""> - Select - </option>
                      <?php foreach(get_pr() as $item): ?>
                      <option value="<?=$item->id?>" <?=((isset($pr) and $pr['id'] == $item->id) ? ' selected' : '')?>><?=$item->no?></option>
                      <?php endforeach; ?>
                    </select> 
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">RFQ Number<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" readonly="readonly" class="form-control" name="RFQ[case_id]" value="<?=isset($data['case_id']) ? $data['case_id'] : generate_request_for_qoutation_no()?>">
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Document Title<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" class="form-control" name="RFQ[document_title]" value="<?=isset($data['document_title']) ? $data['document_title'] : '';?>">
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Solicitation Type<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                      <select name="RFQ[solicatation_type]" class="form-control">
                        <?php 
                           $solicatation = SOLICITATION___TYPE;                           
                           foreach ($solicatation as $key => $value) {
                              $selected = "";
                              if(isset($data['solicatation_type']) AND  $data['solicatation_type'] == $key)
                                 $selected="selected";

                              echo "<option ".$selected." value='".$key."'>".$value."</option>";
                           }
                        ?>
                     </select>
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Currency<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <select name="RFQ[currency]" class="form-control">
                        <?php 
                           $currency = CURRENCY;
                           
                           foreach ($currency as $key => $value) {
                              $selected = "";
                              if(isset($data['currency']) AND  $data['currency'] == $key)
                                 $selected="selected";

                              echo "<option ".$selected." value='".$key."'>".$value."</option>";
                           }
                        ?>
                     </select>
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Delivery Date<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" class="form-control tanggal" name="RFQ[delivery_date]" value="<?=isset($data['delivery_date']) ? $data['delivery_date'] : '';?>">
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Expiration Date and Time<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" class="form-control" id="expired_date" name="RFQ[expired_date]" value="<?=isset($data['expired_date']) ? $data['expired_date'] : '';?>">
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Delivery Address<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <textarea class="form-control" name="RFQ[detail_delivery_address]"><?=isset($data['detail_delivery_address']) ? $data['detail_delivery_address'] : '';?></textarea>
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group">Term of Payment<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="number" class="form-control" name="RFQ[term_day]" value="<?=isset($data['term_day']) ? $data['term_day'] : '';?>" style="width: 150px; float: left; margin-right: 10px;">
                     <label style="margin-top:8px;">After Invoice Received</label>
                  </div>
               </div>
               <table align="center" class="table" style="margin:auto; width: 50%" >
                  <tbody id="term_body">
                     <?php if(isset($term)){ ?>
                     <?php foreach($term as $item){ ?>
                        <tr>
                          <td><input type="text" id="tem_0" name="term[]" class="form-control" value="<?=$item['term']?>" placeholder="Term"></td>
                          <td><input type="text" id="cond_0" name="cond[]" class="form-control" value="<?=$item['cond']?>" placeholder="Cond"></td>
                          <td></td>
                       </tr>
                     <?php } ?>
                     <?php }else{ ?> 
                     <tr>
                        <td><input type="text" id="tem_0" name="term[]" class="form-control" placeholder="Term"></td>
                        <td><input type="text" id="cond_0" name="cond[]" class="form-control" placeholder="Cond"></td>
                        <td></td>
                     </tr>
                     <?php } ?>
                  </tbody>
                  <tfoot>
                     <tr>
                        <td colspan="3" style="text-align: right;"><a style="cursor: pointer;" class="btn btn-primary btn-xs" id="add_term"><i class="fa fa-plus"></i> Add</a></td>
                     </tr>
                  </tfoot>
               </table>
               <br/><br/>
               <br/>
               <div class="x_panel">
                  <div class="col-md-6">
                     <div class="x_content">
                        <h2>Material</h2>
                        <table class="table table-hover">
                           <thead>
                             <tr>
                               <th>Item</th>
                               <!-- <th>New Item</th> -->
                               <th>QTY</th>
                               <!-- <th><a style="cursor: pointer; float: right;" class="btn btn-primary" id="add_material">Add Material</a></th> -->
                             </tr>
                           </thead>
                           <tbody class="add-table-rfq-request">
                              <?php 
                                 if(isset($material) AND count($material) > 0)
                                 {
                                    foreach ($material as $key => $item) {
                                       echo '<tr>';
                                       echo '<td>'. $item['material'] .'</td>';
                                       echo '<td>'. $item['qty'];
                                       echo '<input type="hidden" name="material_id[]" value="'. $item['material_id'] .'" />';
                                       echo '<input type="hidden" name="qty[]" value="'. $item['qty'] .'" />';
                                       echo '</td>';
                                       echo '</tr>';
                                    }                                 
                                 }
                              ?>
                           </tbody>                  
                        </table>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="x_content">
                        <h2 class="pull-left">Vendor</h2>
                        <a href="javascript:void(0)" class="btn btn-info btn-xs pull-right" onclick="modal_add_vendor()" ><i class="fa fa-plus"></i> Add Vendor</a>
                        <div class="clearfix"></div>
                        <table class="table table-hover">
                           <thead>
                             <tr>
                               <th>Name</th>
                               <th>Email</th>
                               <th>Phone</th>
                             </tr>
                           </thead>
                           <tbody class="table_vendor">
                            <?php 
                              if(isset($vendor))
                              {
                                foreach ($vendor as $key => $item)
                                {
                                  echo '<tr>';
                                  echo '<td>'. $item['vendor'] .'</td>';     
                                  echo '<td>'. $item['email'] .'</td>';     
                                  echo '<td>'. $item['phone'] .'</td>';     
                                  echo '</tr>';
                                }
                              } 
                            ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
                <div class="form-group">
                  <div>
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

<div class="modal fade" id="add_vendor">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Vendor</h4>
      </div>
      <div class="modal-body">
        <form id="demo-form2" name="demo-form2" method="post" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
         <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="require_date">Vendor</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
               <select class="form-control" name="vendor_id">
                  <option value=""> - Select - </option>
                  <?php foreach(get_vendor() as $item) { ?>
                     <option value="<?=$item['id']?>" data-email="<?=$item['email']?>" data-phone="<?=$item['phone_1']?>"><?=$item['name']?> / <?=$item['pic_name']?></option>
                  <?php } ?>
               </select>
            </div>
         </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left btn-sm" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
        <button type="button" class="btn btn-primary btn-sm" id="push_vendor"><i class="fa fa-plus"></i> Add</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  
  $("select[name='pr_id']").on('change', function(){
    var url = '<?=site_url('RequestForQuotation/insert')?>?pr_id='+ $(this).val();
    window.location.href = url ;
  });

   var j = "<?=isset($material_rfq) ? count($material_rfq) : 0 ?>";
   var i = parseInt(j);

   $("#push_vendor").click(function(){

      var el  = '<tr>';
          el += '<td>'+ $("select[name='vendor_id']").find(':selected').text() +'</td>';
          el += '<td>'+ $("select[name='vendor_id']").find(':selected').data('email') +'</td>';
          el += '<td>'+ $("select[name='vendor_id']").find(':selected').data('phone');
          el += '<input type="hidden" name="vendor_id[]" value="'+ $("select[name='vendor_id']").find(':selected').val() +'" />';
          el += '</td>';
          el += '</tr>';
      $('.table_vendor').append(el);

      $("#add_vendor form").trigger('reset');

      $('#add_vendor').modal("hide");
   });

   $("#add_term").click(function(){
      var el  = '<tr>';
          el += '<td><input type="text" class="form-control" name="term[]" placeholder="Term" /></td>';
          el += '<td><input type="text" class="form-control" name="cond[]" placeholder="Condition" /></td>';
          el +='<td style="text-align: right;"><a style="cursor: pointer;" class="btn btn-danger delete-term btn-sm" onclick="delete_term(this)"><i class="fa fa-trash"></i></a></td>';
          el += '</tr>';


    $('#term_body').append(el);
   });

   function delete_term(el)
   {
    $(el).parent().parent().remove();
   }

   function modal_add_vendor()
   {
      $('#add_vendor').modal("show");
   }

   $( document ).ready(function() {      
       $('#expired_date').datetimepicker({
         format:'YYYY-MM-DD HH:mm:ss'
      });
      
       $("#requester").change(function(){
         var user = $(this).find(':selected').data('user');
         var divisi = $(this).find(':selected').data('divisi');
         var divisi_id = $(this).find(':selected').data('divisi_id');
         var option = "<option value='-1'>-- Pilih Materialnya --</option>";

         if(typeof user == 'undefined' && typeof divisi == 'undefined')
         {
            user = "";   
            divisi = "";   
         }

         $("#buyer_group").html(divisi);
         $("#request_by").html(user);

         $.ajax({ 
            url: '<?php echo base_url()."requestForQuotation/ajax_get_material/"; ?>'+divisi_id,
            type: 'get',
            dataType: 'json',
            async: false,
            success: function(data)
            {             
               $.each(data , function(key, value){
                  option=option+"<option value='"+value.id+"'>"+value.name+"</option>";
               });

               option=option+"<option value='0'>Material Baru</option>";
            }
         });

         $.ajax({ 
            url: '<?php echo base_url()."requestForQuotation/ajax_get_purchase_material/"; ?>'+$(this).val(),
            type: 'get',
            dataType: 'json',
            async: false,
            success: function(data)
            { 
               var td = "";
               $(".add-table-rfq-request").html("");
               $.each(data, function(key, value){                  
                  td = "<tr id='child_material_rfq_"+i+"'>"+
                              "<td><select style='width:90%' class='form-control material' name='RFQMaterial["+i+"][material_id]' id='material_id_"+i+"'>"+option+"</select></td>"+
                              "<td><input class='form-control' name='RFQMaterial["+i+"][material_new]' value='"+value.new_material+"' id='new_material_"+i+"'></td>"+
                              "<td><input style='width:50%' type='number' class='form-control' name='RFQMaterial["+i+"][qty]' value='"+value.qty+"' id='qty_"+i+"'></td>"+
                              "<td><a style='cursor: pointer; float: right;' onclick='hapus_material("+i+")' class='btn btn-warning'>Delete</a></td>"+
                           "<tr>";               
                  
                  $(".add-table-rfq-request").append(td);
                  change_select_material('material_id_'+i, value.material_id);
                  i++;
               });            

               $(".tanggal").datetimepicker({
                  format: 'YYYY-MM-DD'
               });

               $(".material").select2();
            }
         });
      
      });      
      

      function change_select_material(object_material_id, material_id)
      {
         $("#"+object_material_id).val(material_id);
      }

       $("input").on("change", function() {
          this.setAttribute(
              "data-date",
              moment(this.value, "YYYY-MM-DD")
              .format( this.getAttribute("data-date-format") )
          )
      }).trigger("change")
   });

   function hapus_material(id)
   {
      $("#child_material_rfq_"+id).remove();
   }

   $("#add_material").click(function(){
      var td = "";
      var divisi_id = $("#requester").find(':selected').data('divisi_id');
      
      if(typeof divisi_id == 'undefined')
         divisi_id = 0;

      $.ajax({ 
            url: '<?php echo base_url()."requestForQuotation/ajax_get_material/"; ?>'+divisi_id,
            type: 'get',
            dataType: 'json',
            async: false,
            success: function(data)
            {
               var option_2 = "<option value='-1'>-- Pilih Materialnya --</option>";

               $.each(data , function(key, value){
                  option_2=option_2+"<option value='"+value.id+"'>"+value.name+"</option>";
               });

               option_2=option_2+"<option value='0'>Material Baru</option>";

               td = "<tr id='child_material_rfq_"+i+"'>"+
                           "<td><select style='width:90%' class='form-control material' name='RFQMaterial["+i+"][material_id]' id='material_id_"+i+"'>"+option_2+"</select></td>"+
                           "<td><input class='form-control' name='RFQMaterial["+i+"][material_new]' id='new_material_"+i+"'></td>"+
                           "<td><input style='width:50%' type='number' class='form-control' name='RFQMaterial["+i+"][qty]' id='qty_"+i+"'></td>"+
                           "<td><a style='cursor: pointer; float: right;' onclick='hapus_material("+i+")' class='btn btn-warning'>Delete</a></td>"+
                        "<tr>";               

               $(".add-table-rfq-request").append(td);
               i++;
            }
         });

   });

</script>
