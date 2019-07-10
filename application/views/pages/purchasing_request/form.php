<div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
         <div class="x_title">
            <h2>Form Input Material Request</h2>
            <div class="clearfix"></div>
         </div>
         <div class="x_content">
            <br>
            <form id="demo-form2" name="demo-form2" autocomplete="off" method="post" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
               <input type="hidden" id="purchase_id" name="purchase_id" />
               <input type="hidden" id="purchase_material_id" name="purchase_material_id" />
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="po_number">Company <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <select class="form-control" name="company_id">
                        <option value="" data-code="">-- Select Company --</option>
                        <?php foreach(get_company() as $item) { ?>
                        <option value="<?=$item['id']?>" <?=((isset($data['company_id']) and $data['company_id'] == $item['id']) ? ' selected ' : '')?> data-code="<?=$item['code']?>"><?=$item['name']?></option>
                        <?php } ?>
                     </select>
                  </div>
                  </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group_id">Projects <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <select class="form-control" name="projects" id="projects">
                        <option value="" data-project_code="">- Projects -</option>
                        <?php foreach ($project as $key => $value){?>
                           <option value="<?=$value['id']?>" data-osm="<?=$value['osm']?>" data-project_code="<?=$value['project_code']?>" data-pr_number="<?=generate_purchase_request_no($value['project_code'])?>" data-region="<?=$value['region_code']?>" data-project_type="<?=$value['project_type']?>" data-project_manager="<?=$value['project_manager']?>"><?=$value['project_code']?> / <?=$value['name']?></option>
                        <?php } ?>
                     </select>
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group_id">Region</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" class="form-control readonly_region" readonly="true" value="<?=(isset($data['region']) ? $data['region'] : "")?>" >
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group_id">Project Type</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" class="form-control readonly_project_type" readonly="true" value="<?=(isset($data['project_type']) ? $data['project_type'] : "")?>">
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group_id">Operation Service Manager</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" class="form-control readonly_osm" readonly="true" value="<?=(isset($data['osm']) ? $data['osm'] : "")?>">
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_id">PR Number <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" name="purchase_number_hidden" class="form-control" readonly="true" value="<?=(isset($data['no']) ? $data['no'] : '' )?>" />
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="require_date">Required Date <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" value="<?=(isset($data['require_date']) ? $data['require_date'] : "")?>"  name="require_date" class="form-control" id="require_date">
                  </div>
               </div>
               <hr/>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_group_id">Material Group <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <select class="form-control" name="material_group_id" id="material_group_id">
                        <option value="">- Material Group -</option>
                        <?php foreach ($group_material as $key => $value){?>
                           <option value="<?=$value->id?>"><?=$value->name?></option>
                        <?php } ?>
                     </select>
                  </div>
               </div>

               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="material_id">Material <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <select class="form-control" name="material_id" id="material_id">
                     </select>
                  </div>
               </div>

               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="qty">Required Qty. <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="number"  name="qty" class="form-control" id="qty">
                  </div>
               </div>

               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="urgency">Urgency Level. <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="form-control" name="urgency" id="urgency">

                        <?php   
                              $urgent = URGENCY___LEVEL;
                              foreach ($urgent as $key => $value){
                           ?>
                           <option value="<?=$key?>"><?=$value?></option>
                        <?php } ?>
                     </select>
                  </div>
               </div>
            </form>
            <form id="form-detail" name="form-detail" method="post" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
               <input type="hidden" id="purchase_param" name="purchase_param" value="purchase_request" />
               <input type="hidden" id="purchase_idx" name="purchase_idx" value="" />
               <input type="hidden" id="purchase_require_date" name="purchase_require_date" value="" />
               <input type="hidden" id="purchase_project" name="purchase_project" value="" />
               <input type="hidden" id="x" name="x" value="0" />
               <input type="hidden" name="purchase_number">
               <input type="hidden" name="company_id" />
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <a class="btn btn-primary btn-sm" id="add-request" style="float: right;"><i class="fa fa-plus"></i> Pick</a>
                  </div>
               </div><br/><br/>
               <div class="x_panel">
                  <div class="x_content">
                     <table class="table table-hover" >
                        <thead>
                          <tr>
                            <th>Material Group</th>
                            <th>Material</th>
                            <th>Required Qty.</th>
                            <th>Urgency Level</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody class="add-table-purcashing-request" id="table_detail">
                        </tbody>                  
                     </table>
                  </div>
               </div>

               <div class="ln_solid"></div>
               <div class="form-group">
                  <div class="col-md-12">
                     <a onclick="back()" class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
                     <button type="button" id="save" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Submit</button>
                  </div>
               </div>

            </form>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
function CompareDate(val){
   var pr_date = $("#pr_date").val();
   if(pr_date){
      var date_pr = new Date(pr_date).getTime();
      var req_date = new Date(val.value).getTime();
      if(req_date < date_pr){
         alert('Require Date cannot less than Purchase Request Date !');
         val.value = '';
      }
   }else{
      alert('Purchase Request Date cannot be null !');
   }
}

(function ($){

   $('#require_date').datepicker({
     dateFormat: 'yy-mm-dd',
     format: 'yyyy-mm-dd',
     onSelect: function(d,i){
          if(d !== i.lastVal){
              $(this).change();
          }
     }
   });

   $("select[name='company_id']").on('change', function(){
      generate_pr_number();
      
      var id = $(this).val();

      $("input[name='company_id']").val(id);
   });

   $("select[name='projects']").on('change', function(){
      
      generate_pr_number();
      
      var el = $(this).children("option:selected");

      $('.readonly_project_type').val(el.data('project_type'));
      $('.readonly_project_manager').val(el.data('project_manager'));
      $('.readonly_osm').val(el.data('osm'));
      $('.readonly_region').val(el.data('region'));
   });

   function generate_pr_number()
   {
      var pr_number = '';
      var company_code = $("select[name='company_id']").children("option:selected").data('code');
      var project_code = $("select[name='projects']").children("option:selected").data('project_code');
      
      pr_number += company_code != "" ? company_code : '';
      pr_number += project_code != "" ? '/'+project_code : '';
      pr_number += '<?=generate_purchase_request_no()?>';

      $("input[name='purchase_number']").val(pr_number);
      $("input[name='purchase_number_hidden']").val(pr_number);
   }

   var idx = '<?=$id?>';
   
   if(parseInt(idx)){
      $.ajax({
         url: site_url + "PurchasingRequest/getPurchasingRequest", 
         data: {'id' : idx },
         type: 'GET',
         success: function(result){
            var data = JSON.parse(result);

            /* Purchase Request */
            $("#purchase_idx").val(data.pr.id);
            $("#purchase_number").val(data.pr.no);
            $("#purchase_require_date").val(data.pr.require_date);
            $("#purchase_project").val(data.pr.project_id);
            $("#purchase_id").val(data.pr.id);
            $("#purchase_no").text(data.pr.no);
            $("#require_date").val(data.pr.require_date);
            $("#projects").val(data.pr.project_id);

            /* Material Purchase Request */
            for(var x=0; x<data.pr_material.length; x++){
               var input = '<input type="hidden" name="purchasingRequest['+i+'][id]" value="'+data.pr_material[x].id+'">'+
                           '<input type="hidden" name="purchasingRequest['+i+'][material_group_id]" value="'+data.pr_material[x].material_group_id+'">'+
                           '<input type="hidden" name="purchasingRequest['+i+'][material_id]" value="'+data.pr_material[x].material_id+'">'+
                           '<input type="hidden" name="purchasingRequest['+i+'][qty]" value="'+data.pr_material[x].qty+'">'+
                           '<input type="hidden" name="purchasingRequest['+i+'][urgency]" value="'+data.pr_material[x].urgency+'">';

               var tr = "<tr id='child-request-"+i+"'>"+
                           "<td>"+data.pr_material[x].group_material+"</td>"+
                           "<td>"+data.pr_material[x].material+"</td>"+
                           "<td align='center'>"+data.pr_material[x].qty+"</td>"+
                           "<td>"+data.urgency[data.pr_material[x].urgency]+"</td>"+
                           "<td><a class='btn btn-danger delete-row btn-xs' onclick='delete_row("+i+")' data-id='"+i+"' ><i class='fa fa-trash'></i></a> "+
                               "<a class='btn btn-info delete-row btn-xs' onclick='edit_row("+i+")' data-id='"+i+"' ><i class='fa fa-edit'></i></a> "+ input+"</td>"+
                        "<tr>";

               $("#reset").click();
               $("#new_material_input").hide();
               $(".add-table-purcashing-request").append(tr);
               i++;
            }
         }
     });
   }

   $("form[name='demo-form2']").validate({
       rules: {
         material_group_id: "required",
         material_id: "required",
         require_date : "required",
         qty : "required",
         urgency : "required"
       },
       messages: {
         material_group_id: "Please select Group Material",
         material_id: "Please select Material",
         require_date: "Please enter Require Date",
         qty: "Please enter Quantity",
         urgency : "Please select Urgency Level"
       },
   });

   $("#material_group_id").change(function(v) {
      $.ajax({
         url: site_url + "ajax/getMaterial", 
         data: {'id' : v.target.value },
         type: 'GET',
         success: function(result){
           $("select[name='material_id']").html(result);
         }
     })
   });

   var i = 1;
   $("#add-request").click(function(){
      if($("form[name='demo-form2']").valid()){
         if(parseInt($("#x").val()) > 0){
            $("#child-request-"+parseInt($("#x").val())).remove();
         }
         $("#purchase_idx").val($("#purchase_id").val());
         $("#purchase_require_date").val($("#require_date").val());
         $("#purchase_project").val($("#projects").val());

         var input = '<input type="hidden" name="purchasingRequest['+i+'][id]" value="'+$("#purchase_material_id").val()+'">'+
                     '<input type="hidden" name="purchasingRequest['+i+'][material_group_id]" value="'+$( "#material_group_id" ).val()+'">'+
                     '<input type="hidden" name="purchasingRequest['+i+'][material_id]" value="'+$( "#material_id" ).val()+'">'+
                     '<input type="hidden" name="purchasingRequest['+i+'][qty]" value="'+$( "#qty" ).val()+'">'+
                     '<input type="hidden" name="purchasingRequest['+i+'][urgency]" value="'+$( "#urgency" ).val()+'">';

         var tr = "<tr id='child-request-"+i+"'>"+
                     "<td>"+$("#material_group_id option:selected").text()+"</td>"+
                     "<td>"+$("#material_id option:selected").text()+"</td>"+
                     "<td align='center'>"+$("#qty ").val()+"</td>"+
                     "<td>"+$("#urgency option:selected").text()+"</td>"+
                     "<td><a class='btn btn-danger delete-row btn-xs' onclick='delete_row("+i+")' data-id='"+i+"' ><i class='fa fa-trash'></i></a> "+
                         "<a class='btn btn-info delete-row btn-xs' onclick='edit_row("+i+")' data-id='"+i+"' ><i class='fa fa-edit'></i></a> "+ input+"</td>"+
                  "<tr>";

         $("#reset").click();
         $("#new_material_input").hide();
         $(".add-table-purcashing-request").append(tr);
         i++;

         $("#material_group_id").val('');
         $("#material_id").val('');
         $("#qty").val('');
         $("#urgency").val(0);
      }
   });

   $("#save").click(function(){
      $("#purchase_idx").val($("#purchase_id").val());
      $("#purchase_require_date").val($("#require_date").val());
      $("#purchase_project").val($("#projects").val());
      $("#form-detail").submit();
   });

})(jQuery);


   function delete_row(id){
      $("#child-request-"+id).remove();
   }

   function edit_row(id){
      var idx = $('input[name="purchasingRequest['+id+'][id]"]')[0].value;
      var material_group_id = $('input[name="purchasingRequest['+id+'][material_group_id]"]')[0].value;
      var material_id = $('input[name="purchasingRequest['+id+'][material_id]"]')[0].value;
      var qty = $('input[name="purchasingRequest['+id+'][qty]"]')[0].value;
      var urgency = $('input[name="purchasingRequest['+id+'][urgency]"]')[0].value;

      $("#purchase_material_id").val(idx);
      $("#material_group_id").val(material_group_id);
      $.ajax({
         url: site_url + "ajax/getMaterial", 
         data: {'id' :material_group_id },
         type: 'GET',
         success: function(result){
            $("select[name='material_id']").html(result);
            $("#material_id").val(material_id);
         }
      })
      $("#qty").val(qty);
      $("#urgency").val(urgency);
      $("#x").val(id);

   }

   function back(){
      window.location = "<?php echo base_url(); ?>PurchasingRequest";
   }
</script>