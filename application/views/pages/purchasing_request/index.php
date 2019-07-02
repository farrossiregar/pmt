<div class="col-md-12 col-sm-12 col-xs-12">
   <div class="x_panel">
      <div class="x_title">
          <h2>Purchasing Request</h2>
          <div class="pull-right">
            <a href="<?=site_url('PurchasingRequest/insert')?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Create / Insert</a>
          </div>
         <div class="clearfix"></div>
      </div>
      <div class="x_content">
         <div class="table-responsive">
            <table class="table table-striped table-bordered">
               <thead>
                  <tr class="headings">
                     <th class="column-title" align="center">No</th>
                     <th class="column-title">Company </th>
                     <th class="column-title">No Purchase Request </th>
                     <th class="column-title">Requester </th>
                     <th class="column-title">Region </th>
                     <th class="column-title">Project </th>
                     <th class="column-title">Project Manager </th>
                     <th class="column-title">Require Date </th>
                     <th class="column-title">Receive Date </th>
                     <th class="column-title" align="center">Status </th>
                     <th class="column-title no-link last"></th>
                  </tr>
               </thead>
               <tbody>
                <?php 
                 foreach ($data as $key => $value) {
                   ?>
                    <tr>
                       <td class="column-title" align="center"><?php echo $key+1; ?></td>
                       <td class="column-title"><?php echo $value['company']; ?></td>
                       <td class="column-title"><?php echo $value['no']; ?></td>
                       <td class="column-title"><?=get_user_name($value['user_id'])?></td>
                       <td class="column-title"><?=get_branch_name($value['branch_id'])?></td>
                       <td class="column-title"><?=$value['project']?></td>
                       <td class="column-title"><?=$value['project_manager']?></td>
                       <td class="column-title"><?php echo $value['require_date']; ?> </td>
                       <td class="column-title"><?php echo $value['receive_date']; ?> </td>
                       <td class="column-title" align="center">
                        <?php 
                          if($value['status'] == 1){
                              echo "<button class='btn btn-primary btn-xs'>Open</button>";
                           }else if($value['status'] == 2){
                              echo "<button class='btn btn-warning btn-xs'>Process</button>";
                           }else if($value['status'] == 3){
                              echo "<button class='btn btn-danger btn-xs'>Rejected</button>";
                           }else if($value['status'] == 4){
                              echo "<button class='btn btn-warning  btn-xs'>Delivery</button>";
                           }else if($value['status'] == 5){
                              echo "<button class='btn btn-info  btn-xs'><i class=\"fa fa-check-square-o\"></i> Received</button>";
                           } 
                        ?>                           
                       </td>
                       <td align="center">
                          <div class="btn-group pull-right">
                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                              <i class="fa fa-bars"></i>
                            </a>
                            <ul class="dropdown-menu">
                              <?php 
                                if($value['status'] == 1)
                                {
                                  if($value['project_manager_id'] == $user_id)
                                  {
                                    echo '<li><a class="text-success" data-id="'. $value['id'] .'" data-no_pr="'. $value['no'] .'" onclick="approve(this)"><i class="fa fa-check"></i> Approve</a></li>'; 
                                  }
                                }
                                if($value['status'] == 2)
                                {
                                  if($access_id == 14)
                                  {
                                    echo '<li><a href="javascript:void(0)" data-id="'. $value['id'] .'" data-no_pr="'. $value['no'] .'" onclick="approve(this)"><i class="fa fa-check"></i> Approve</a></li>'; 
                                  }
                                }

                                if($value['status'] == 4)
                                {
                                  if($user_id   == $value['user_id'])
                                  {
                                    echo "<li><a href=\"javascript:void(0)\" onclick=\"confirm_receive(".$value['id'] .")\"><i class=\"fa fa-check\"></i> Received</a></li>";
                                  }
                                }

                                if($value['status'] ==4)
                                {
                                  if($access_id == 14)
                                  {
                                    echo '<li><a href="'. site_url('RequestForQuotation/insert?pr_id='. $value['id']) .'" class="text-success"><i class="fa fa-plus"></i> Create RFQ</a></li>';
                                    echo '<li><a href="'. site_url('PurchaseOrderWarehouse/insert?pr_id='. $value['id']) .'" class="text-success"><i class="fa fa-plus"></i> Create PO</a></li>';
                                    echo '<li><a href="'. site_url("PurchasingRequest/checkinventory/").$value['id'] .'" title="Check Inventory"><i class="fa fa-check-square"></i> Check Inventory</a></li>';
                                  }
                                }
                              ?>
                              <li><a href="<?=site_url("PurchasingRequest/material/{$value['id']}")?>" title="Show Detail Material"><i class="glyphicon glyphicon-share"></i> Detail Material</a></li>                    
                              <?php 
                                    if((int)$position == 1 && (int)$value['status'] > 1){ 
                                      // No Action [hide]
                                    }else{ 
                                        if((int)$access_id == 14 && (int)$value['status'] >= 4){ 
                                            // No Action [hide]
                                        }else{ 
                              ?>
                              <li><a href="<?=site_url("PurchasingRequest/insert/{$value['id']}")?>" title="Edit"><i class="fa fa-edit"></i> Edit</a></li>
                              <li><a title="Hapus" onclick="_confirm('Hapus data ini?', '<?=site_url("PurchasingRequest/delete/{$value['id']}")?>')" ><i class="fa fa-trash"></i> Delete</a></li> 
                            <?php }
                                } ?>
                              </ul>
                          </div>
                       </td>
                    </tr>
                <?php } ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>

<div id="modal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail Material</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table">
           <thead>
              <th>Material</th>
              <th>Quantity</th>
           </thead>
           <tbody id="table-body">
              
           </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_confirm_receive">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Confirm Receive</h4>
      </div>
      <div class="modal-body">
        <form id="demo-form2" name="demo-form2" method="post" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
         
         <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="require_date">Date <span class="required"></span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="receive_date" value="<?php echo date('Y-m-d'); ?>" class="form-control tanggal" />
            </div>
         </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left btn-sm" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
        <button type="button" class="btn btn-primary btn-" onclick="action_procced_receive()"><i class="fa fa-check"></i> Receive</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Approval</h4>
      </div>
      <div class="modal-body">
        <form id="demo-form2" name="demo-form2" method="post" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
         <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12"> <span class="required"></span>
            </label>
            <div class="col-sm-8">
              <label class="radio-inline"> <input type="radio" name="approval" id="approval" value="<?php echo $access_id == 14 ? 4 : 2 ?>"> Approve </label>
              <label class="radio-inline"> <input type="radio" name="approval" id="approval" value="3"> Reject </label>
            </div>
            <div class="clearfix"></div>
         </div>
         <div class="clearfix"></div>
         <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="require_date">Date <span class="required"></span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="require_date" value="<?php echo date('Y-m-d'); ?>" class="form-control tanggal" id="require_date">
            </div>
            <div class="clearfix"></div>
         </div>
         <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Note <span class="required"></span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <textarea id="description" width="500" size="100" class="form-control"></textarea>
            </div>
            <div class="clearfix"></div>
         </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left btn-sm" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
        <button type="button" class="btn btn-primary btn-sm" onclick="action_procced()"><i class="fa fa-check"></i> Procced</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
var keys = 0;

function approve(el)
{
  keys = $(el).data('id');
  $("#dialog .modal-title").html($(el).data('no_pr'));
  $("#dialog").modal("show");
}

function openDialog(id_)
{
  keys = id_;
  $("#dialog").modal("show");
}

function confirm_receive(id_)
{
  keys = id_;

  $("#modal_confirm_receive").modal("show");
}

function action_procced_receive()
{
  $.ajax({ 
     url: "<?=site_url("PurchasingRequest/receive")?>",
     type: 'post',
     dataType: 'json',
     data : {
        id : keys,
        date : $("#receive_date").val()
     },
     success: function(result){

        if(result.success){
          window.location = "<?php echo base_url(); ?>PurchasingRequest";
        }else{
          alert('Approval failed !');
        }
     }
  });
}
  
function action_procced()
{
  $.ajax({ 
     url: "<?=site_url("PurchasingRequest/approval")?>",
     type: 'post',
     dataType: 'json',
     data : {
        id : keys,
        value : $('input[name=approval]:checked').val(),
        date : $("#require_date").val(),
        description : $("#description").val()
     },
     success: function(result){
        if(result.success){
          window.location = "<?php echo base_url(); ?>PurchasingRequest";
        }else{
          alert('Approval failed !');
        }
     }
  });
}


function show_detail(id)
{
  $.ajax({ 
     url: "<?=site_url("PurchasingRequest/ajaxGetMaterial/")?>"+id,
     type: 'get',
     dataType: 'json',
     success: function(data)
     {
        $("#table-body").html("");
          $.each(data, function(key, val){
           var name = val['name_material'];
           if(val["material_id"] == "0")
              name = val["new_material"];


           var tr = "<tr>"+
                       "<td>"+name+"</td>"+
                       "<td>"+val["qty"]+"</td>"+
                    "</tr>";
           $("#table-body").append(tr);
        });

        $("#modal").modal('show');
     }
  });
}
</script>