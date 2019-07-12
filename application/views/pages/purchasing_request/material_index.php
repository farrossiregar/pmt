<div class="col-md-12 col-sm-12 col-xs-12">
   <div class="x_panel">
      <div class="x_title">
         <h2>Material Purchase Requisition :  <b><?php echo $header['no']; ?></b></h2>
         &nbsp;
         <!--<a href="<?=site_url('PurchasingRequest/insert/'.$header['id'])?>" class="btn btn-success btn-sm">Create / Insert Material </a>-->
         <a href="<?=site_url('PurchasingRequest/')?>" class="btn btn-success btn-sm">back to all Purchase Requisition</a>
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
                     <th class="column-title" width="35">No</th>
                     <th class="column-title">Group Material</th>
                     <th class="column-title">Nama Material</th>
                     <th class="column-title">Qty</th>
                     <th class="column-title">Urgency Level</th>
                     <!--<th class="column-title no-link last"></th>-->
                  </tr>
               </thead>
               <tbody>

                  <?php 
                     foreach ($data as $key => $value) {
                       ?>
                        <tr>
                           <td class="column-title"><?php echo $key+1; ?></td>
                           <td class="column-title"><?php echo $value['group_material']; ?></td>
                           <td class="column-title">
                              <?php 
                                $name = $value["name_material"];
                                if($value["material_id"] == "0")
                                  $name = $value["new_material"];

                                echo $name;
                              ?>
                           </td>
                           <td class="column-title"><?php echo $value['qty']; ?></td>
                           <td class="column-title"><?php
                            $urgency = URGENCY___LEVEL;
                            $urgency_val = isset($urgency[$value['urgency']]) ? $urgency[$value['urgency']] : "";
                            echo $urgency_val;
                            ?></td>
                            <!--
                           <td>
                              <a href="<?=site_url("PurchasingRequest/editMaterial/{$header['id']}/{$value['id']}")?>" title="Edit"><i class="fa fa-edit"></i></a>
                              <a title="Hapus" onclick="_confirm('Hapus data ini?', '<?=site_url("PurchasingRequest/deleteMaterial//{$header['id']}/{$value['id']}")?>')" ><i class="fa fa-trash"></i></a>
                           </td>
                            -->
                        </tr>
                  <?php
                     } 
                     ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>