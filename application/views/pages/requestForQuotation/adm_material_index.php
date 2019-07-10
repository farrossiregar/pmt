<script type="text/javascript">
  var i = 1;
  var term = 1;
    function hitung(i){
    var qty = $("#qty_"+i).val();
    var price = $("#price_"+i).val();
    var discount = $("#discount_"+i).val();

    var total = parseInt(qty) * (parseFloat(price) - parseFloat(discount));
    $("#total_"+i).val(total); 
    $("#penawaran_"+i).val(total);
  }

</script>

<div class="col-md-12 col-sm-12 col-xs-12">
   <div class="x_panel">
      <div class="x_title">
         <h2>Material Purcashing Request</b></h2>
         &nbsp;
        
         <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
         </ul>
         <div class="clearfix"></div>
      </div>
      <div class="x_content">
         <div class="table-responsive">
            <table id="datatable-buttons" class="table table-striped table-bordered">
               <thead>
                  <tr class="headings">
                     <th class="column-title" style="width:35px;">No</th>
                     <th class="column-title">Vendor Name</th>
                      <?php
                        foreach($data as $key => $value){
                          echo '<th class="column-title">'.$value['name'].'</th>';
                        }
                      ?>
                      <th class="column-title" style="width:85px;">Action</th>
                  </tr>
               </thead>
               <tbody>
                  <?php 
                     foreach ($vendor as $key => $value) {
                        echo '<tr>';
                        echo '<td class="column-title">'.($key+1).'</td>';
                        echo '<td class-"column-title" width="200">'.$value['vendor_name'].'</td>';
                        foreach($data as $k => $v){
                          echo '<td class="column-title" align="right">'.number_format($v['price'],2,',','.').'</td>';
                        }
                        echo '<td class="column-title" align="center"><a class="btn btn-default btn-xs" href="#" onclick="openDialog('.$id.')" title="Penawaran"><i class="fa fa-external-link"></i></a>&nbsp; 
                                 <a class="btn btn-default btn-xs" href="#" title="PO" onclick="createPO('.$id.')" ><i class="fa fa-file-powerpoint-o"></i></a>&nbsp;
                                 <a class="btn btn-default btn-xs" href="#" title="Term & Condition" onclick="openDialogFaq('.$value['vendor_id'].')"><i class="fa fa-barcode"></i></a></td>';
                        echo '</tr>';
                     } 
                  ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>

<div id="modal_penawaran" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Form Negosiasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="demo-form2" name="demo-form2" method="post" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
          <?php
            foreach($data as $k => $v){
              echo '<div class="form-group">';
              echo '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="require_date">'.$v['name'].'<span class="required"></span>';
              echo '</label>';

              echo '<div class="col-md-6 col-sm-6 col-xs-12">';
              echo '<input type="text" id="KontenMaterial_'.$k.'" style="text-align: right;" value="'.number_format($v['price'],2,',','.').'" readOnly class="form-control">';

              echo '<input type="hidden" name="materialPenawaran['.$k.'][material_id]" style="text-align: right;" value="'.$v['material_id'].'" class="form-control">';
              echo '<input type="text" id="KontenPenawaran_'.$k.'" name="materialPenawaran['.$k.'][penawaran]" style="text-align: right;" value="'.number_format($v['penawaran'],2,',','.').'" class="form-control">';

              echo '</div>';
              echo '<div class="clearfix"></div>';
              echo '</div>';
            }
          ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        </form>
     </div>
    </div>
  </div>
</div>

<div id="modal_faq" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Form Term & Condition</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table align="left" class="add-table-term-condition" style="margin:auto; width: 100%" border="1">
            <thead>
              <tr>
                <td align="center">Term</td>
                <td align="center">Condition</td>
              </tr>
            </thead>
            <tbody id="table-term-condition">
            </tbody>
        </table>
        <br/>
        <br/>
        <br/>
        <br/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script type="text/javascript">
$(document).ready(function(){

});

function createPO(id){
  alert('under construction');
}

function openDialog(id_){
  $("#modal_penawaran").modal("show");
}

function openDialogFaq(id_){
  $.ajax({ 
      url: "<?=site_url("RequestForQuotation/getTermCondition")?>",
      type: 'get',
      dataType: 'json',
      data : {
         id : '<?=$id?>',
         vendor_id : id_
      },
      success: function(result){
        $("#table-term-condition").empty();
        var tr = '';
        for(var x=0; x < result.data.length; x++){
          tr += '<tr>';
          tr += '<td style="padding:2px;">'+result.data[x].term+'</td>';
          tr += '<td style="padding:2px;">'+result.data[x].cond+'</td>';
          tr += '</tr>';
        }
        $("#table-term-condition").append(tr);
        $("#modal_faq").modal("show");
      }
  });
}


function back(){
   window.location = "<?php echo base_url(); ?>RequestForQuotation";
}

</script>
