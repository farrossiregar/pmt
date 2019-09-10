<?php
 
 header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename=Purchase-Requisition-History.xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
 
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 </head>
 <body>
 	<h3>Purchase Requisition</h3>
	<table class="table table-striped table-bordered">
	    <thead>
	      <tr class="headings" style="background: #eee;">
	        <th class="column-title" style="border: 1px solid  #000000;">No</th>
	        <th class="column-title" style="border: 1px solid  #000000;">PR Number </th>
	        <th class="column-title" style="border: 1px solid  #000000;">PR Date</th>
	        <th class="column-title" style="border: 1px solid  #000000;">RFQ Number </th>
	        <th class="column-title" style="border: 1px solid  #000000;">RFQ Date </th>
	        <th class="column-title" style="border: 1px solid  #000000;">PO Number </th>
	        <th class="column-title" style="border: 1px solid  #000000;width: 200px;">Vendor / Supplier </th>
	        <th class="column-title" style="border: 1px solid  #000000;">Material </th>
	        <th class="column-title" style="border: 1px solid  #000000;">QTY </th>
	        <th class="column-title" style="border: 1px solid  #000000;">UOM </th>
	        <th class="column-title" style="border: 1px solid  #000000;">Total Price </th>
	        <th class="column-title" style="border: 1px solid  #000000;">PPN / NON PPN </th>
	        <th class="column-title" style="border: 1px solid  #000000;">Top </th>
	        <th class="column-title" style="border: 1px solid  #000000;">Code Project </th>
	        <th class="column-title" style="border: 1px solid  #000000;">Project Name </th>
	        <th class="column-title" style="border: 1px solid  #000000;">Region </th>
            <th class="column-title" style="border: 1px solid  #000000;">Requestor </th>
            <th class="column-title" style="border: 1px solid  #000000;">Remarks </th>
            <th class="column-title" style="border: 1px solid  #000000;">Status </th>
            <th class="column-title" style="border: 1px solid  #000000;">PIC </th>
	      </tr>
	    </thead>
	    <tbody>
	    <?php foreach($data as $key => $item): ?>
            <?php if(empty($item->project_code)) continue; ?>
	        <tr class="even pointer">
	            <td class="a-center " style="border: 1px solid  #000000;"><?=($key+1)?></td>
	            <td style="border: 1px solid  #000000;padding-left: 10px; padding-right: 10px"><?=($item->purchase_request_no)?></td>
	            <td style="border: 1px solid  #000000;padding-left: 10px; padding-right: 10px"><?=($item->pr_date)?></td>
	            <td style="border: 1px solid  #000000;padding-left: 10px; padding-right: 10px"><?=($item->rfq_no)?></td>
	            <td style="border: 1px solid  #000000;padding-left: 10px; padding-right: 10px"><?=($item->rfq_date)?></td>
	            <td style="border: 1px solid  #000000;padding-left: 10px; padding-right: 10px"><?=($item->po_no)?></td>
	            <td style="border: 1px solid  #000000;padding-left: 10px; padding-right: 10px"><?=$item->vendor_name?></td>
	            <td style="border: 1px solid  #000000;padding-left: 10px; padding-right: 10px"><?=$item->material_name?></td>
	            <td style="border: 1px solid  #000000;padding-left: 10px; padding-right: 10px"><?=$item->qty?></td>
	            <td style="border: 1px solid  #000000;padding-left: 10px; padding-right: 10px"><?=format_idr($item->price)?></td>
	            <td style="border: 1px solid  #000000;padding-left: 10px; padding-right: 10px"><?=format_idr($item->price * $item->qty)?></td>
	            <?php if(isset($item->vat) and !empty($item->vat)):?>
	            <td style="border: 1px solid  #000000;padding-left: 10px; padding-right: 10px"><?=format_idr($item->price * $item->vat / 100)?></td>
	            <?php else:?>
	            <td style="border: 1px solid  #000000;padding-left: 10px; padding-right: 10px">0</td>
	            <?php endif;?>
	            <td style="border: 1px solid  #000000;padding-left: 10px; padding-right: 10px"><?=$item->term_day_remark?></td>
	            <td style="border: 1px solid  #000000;padding-left: 10px; padding-right: 10px"><?=$item->project_code?></td>
	            <td style="border: 1px solid  #000000;padding-left: 10px; padding-right: 10px"><?=$item->project_name?></td>
	            <td style="border: 1px solid  #000000;padding-left: 10px; padding-right: 10px"><?=$item->region_code?></td>
                <td style="border: 1px solid  #000000;padding-left: 10px; padding-right: 10px"><?=$item->requester?></td>
                <td style="border: 1px solid  #000000;padding-left: 10px; padding-right: 10px"><?=$item->term_day_remark?></td>
                <td style="border: 1px solid  #000000;padding-left: 10px; padding-right: 10px">
                <?php 
                  if($item->status == 1 || $item->status == "")
                  {
                    echo 'Proqurement Manager';
                  }
                  elseif($item->status == 2 || $item->status == 3)
                  {
                    echo 'General Manager / Finance';
                  }
                  elseif($item->status == 4)
                  {
                     echo 'Approved';
                  }
                  elseif($item->status == 5)
                  {
                     echo 'Rejected';
                  }
                ?>
                </td>
                <td style="border: 1px solid  #000000;padding-left: 10px; padding-right: 10px"><?=$item->pic?></td>
	        </tr> 
	    <?php endforeach;?>
	    </tbody>
	</table>
 	</body>
</html>