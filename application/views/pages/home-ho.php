<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Purchase Requisition History</h2>
            <div class="col-md-10 pull-right" style="padding-right: 0;">
                <form method="GET" action="" autocomplete="off">
                    <!-- <a href="" class="btn btn-success btn-sm pull-right"><i class="fa fa-file"></i> Download Excel </a> -->
                    <button type="submit" class="btn btn-info btn-sm pull-right"><i class="fa fa-search-plus"></i></button>
                    <div class="col-md-2 pull-right">
                        <input type="text" class="form-control date-range" name="date" placeholder="Start Date" value="<?=isset($_GET['date']) ? $_GET['date'] : ''?>">
                    </div>
                    <div class="col-md-2 pull-right">
                        <select name="vendor_id" class="form-control">
                            <option value="">- Select Vendor - </option>
                            <?php 
                                $this->db->order_by('name', 'ASC');
                                $vendor = $this->db->get('vendor_of_material')->result_array();
                            ?>
                            <?php foreach ($vendor as $key => $value): ?>
                            <?php 
                                $selected = '';
                                if(isset($_GET['vendor_id']))
                                {
                                    if($_GET['vendor_id'] == $value['id'])
                                    {
                                      $selected = ' selected';
                                    }
                                }
                            ?>
                                <option value="<?=$value['id']?>" <?=$selected?>><?=$value['name']?> / <?=$value['pic_name']?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2 pull-right">
                        <select name="company_id" class="form-control">
                            <option value="">- Select Company - </option>
                            <?php foreach(get_company() as $item) { ?>
                            <?php
                                $selected = '';
                              if(isset($_GET['company_id']))
                              {
                                if($_GET['company_id'] == $item['id'])
                                {
                                  $selected = ' selected';
                                }
                              }
                            ?>
                            <option value="<?=$item['id']?>" <?=$selected?> <?=((isset($data['company_id']) and $data['company_id'] == $item['id']) ? ' selected ' : '')?> data-code="<?=$item['code']?>"><?=$item['name']?></option>
                            <?php } ?>
                        </select>
                    </div>
                </form>
            </div>
            <div class="clearfix"></div>
        </div>
      <div class="x_content">
        <div class="table-responsive">
          <table class="table table-striped table-bordered">
            <thead>
              <tr class="headings">
                <th class="column-title">No</th>
                <th class="column-title">PR Number </th>
                <th class="column-title">PR Date</th>
                <th class="column-title">RFQ Number </th>
                <th class="column-title">RFQ Date </th>
                <th class="column-title">PO Number </th>
                <th class="column-title">Vendor / Supplier </th>
                <th class="column-title">Material </th>
                <th class="column-title">QTY </th>
                <th class="column-title">UOM </th>
                <th class="column-title">Total Price </th>
                <th class="column-title">PPN / NON PPN </th>
                <th class="column-title">Top </th>
                <th class="column-title">Code Project </th>
                <th class="column-title">Project Name </th>
              </tr>
            </thead>
            <tbody>
            <?php foreach($data as $key => $item): ?>
                <tr class="even pointer">
                    <td class="a-center "><?=($key+1)?></td>
                    <td><?=($item->purchase_request_no)?></td>
                    <td><?=($item->pr_date)?></td>
                    <td><?=($item->rfq_no)?></td>
                    <td><?=($item->rfq_date)?></td>
                    <td><?=($item->po_no)?></td>
                    <td><?=$item->vendor_name?></td>
                    <td><?=$item->material_name?></td>
                    <td><?=$item->qty?></td>
                    <td><?=format_idr($item->price)?></td>
                    <td><?=format_idr($item->price * $item->qty)?></td>
                    <?php if(isset($item->vat) and !empty($item->vat)):?>
                    <td><?=format_idr($item->price * $item->vat / 100)?></td>
                    <?php else:?>
                    <td>0</td>
                    <?php endif;?>
                    <td><?=$item->term_day_remark?></td>
                    <td><?=$item->project_code?></td>
                    <td><?=$item->project_name?></td>
                </tr> 
            <?php endforeach;?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>

