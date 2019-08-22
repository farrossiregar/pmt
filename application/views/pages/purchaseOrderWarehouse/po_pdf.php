
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<title><?=$po['po_number']?></title>
	<meta name="generator" content="LibreOffice 6.0.2.1 (Linux)"/>
	<meta name="author" content="Lenovo"/>
	<meta name="created" content="2018-04-25T01:01:53"/>
	<meta name="changedby" content="Lenovo"/>
	<meta name="changed" content="2018-04-25T01:28:16"/>
	<meta name="AppVersion" content="15.0300"/>
	<meta name="DocSecurity" content="0"/>
	<meta name="HyperlinksChanged" content="false"/>
	<meta name="LinksUpToDate" content="false"/>
	<meta name="ScaleCrop" content="false"/>
	<meta name="ShareDoc" content="false"/>
	<style type="text/css">
		.container {
			padding: 10px 40px;
		}
		.table {
			width: 100%;
			border-spacing: 0;
		}
		.table th {
			background: #efefef; 
		}
		.table tr th.border, .table tr td.border {
			border: 1px solid;
		}
		.box-1 {
			width: 40%;
			float: left;
		}
		
		.box-2 {
			width: 40%;
			float: right;
		}
		.box {
			height: 70px;
			width: 100%;
			border: 1px solid;
		}
		.signature {
			border-bottom: 1px solid;
			width: 200px;
			margin-top: 20px;
		}
		.table_total {
			width: 50%;
			float: right;
		}
		.divremarks {
  			position: absolute;
  			top:50%;
  			text-align: center;
		}
		.remarksimg{
			-ms-transform: rotate(-30deg); /* IE 9 */
  			-webkit-transform: rotate(-30deg); /* Safari 3-8 */
  			transform: rotate(-30deg);
  			opacity: 0.1;
  			text-align: center;
  			margin-left: 130px;
  			height: 300px;
		}
	</style>
</head>
<body>
	<div class="divremarks">
		<img src="<?=base_url()?>/assets/images/approved.png" class="remarksimg">
	</div>
	<div class="container">
		<?php if($po['status'] == 4):?>
		<p><img src="<?=base_url('upload/').$po['company_logo']?>" style="width: 150px;" /></p>
		<?php endif; ?>
		<hr />
		<table>
			<tr>
				<td style="vertical-align: top;">
					<h4><?=$po['company']?></h4><br />
					<p><?=$po['company_address']?></p>
					<p>Phone : <?=$po['company_telepon']?></p>
					<p><?=$po['website']?></p>
				</td>
				<td style="text-align: right">
					<h1>PURCHASE ORDER</h1>
					<br />
					<br />
					<br />
					<br />
					<p><strong>PO # </strong> <?=$po['po_number']?></p>	
					<p><strong>ORDER DATE # </strong> <?=(date('d/m/Y', strtotime($po['created_at'])))?></p>	
					<p><strong>ToP # </strong> <?=$po['term_day']?>D</p>	
				</td>
			</tr>
		</table>
		<div class="box-1">
			<h4>VENDOR</h4>
			<div class="box">
				<p style="padding-left: 10px;"><?=$po['vname']?></p>
			</div>
		</div>
		<div class="box-2">
			<h4>SHIPPED TO</h4>
			<div class="box" style="float: right;">
				<p style="padding-left: 10px;">
					<?php if(!empty($po['rfq_id'])): ?>
					<?=$po['detail_delivery_address']?>
					<?php else: ?>
					<?=$po['address']?>
					<?php endif; ?>		
				</p>
			</div>
		</div>
		<div style="clear: both;"></div>
		<br />
		<table class="table">
			<thead>
				<tr>
					<th class="border">ITEM</th>
					<th class="border">QTY</th>
					<th class="border">UNIT PRICE (IDR)</th>
					<th class="border">DISC (%)</th>
					<th class="border">LINE TOTAL (IDR)</th>
				</tr>
			</thead>
			<tbody>
			<?php 
			$sub_total = 0;
			foreach($material as $item) {

				$d = 0;
                if(!empty($item->discount)) $d = $item->discount * $item->price / 100;
				
				$sub_total += ($item->price - $d)*$item->qty;

			?>
				<tr>
					<td class="border"><?=@$item->material?></td>
					<td class="border"><?=@$item->qty?></td>
					<td class="border" style="text-align: right"><?=@format_idr($item->price)?></td>
					<td class="border" style="text-align: right"><?=@format_idr($item->discount)?></td>
					<td class="border" style="text-align: right"><?=@format_idr(($item->price - $d)*$item->qty)?></td>
				</tr>
			<?php 
				
				}?>
				<tr>
					<td> </td>
					<td></td>
				</tr>
				<tr>
					<td colspan="4" style="text-align: right">Sub Total</td>
					<td style="width: 160px;text-align: right;"><strong><?=format_idr($sub_total)?></strong></td>
				</tr>
				<tr>
					<td colspan="4" style="text-align: right">
					<?php 
                        if($po['vat_type']==1)
                        { 
                          echo "PPH"; 
                        }else  echo "PPN";
                    ?>
					 (<?=$po['vat']?>%)</td>
					<td style="text-align: right">
						<strong>
						<?php 
							$vat = ($po['vat'] * $sub_total / 100);
							echo format_idr($vat);
						?>
						</strong>
					</td>
				</tr>
				<tr>
					<td colspan="4" style="text-align: right">Shipping Charge</td>
					<td style="text-align: right"> <strong><?=format_idr($po['shipping_charge'])?></strong></td>
				</tr>
				<tr>
					<td colspan="4" style="text-align: right">Order Total</td>
					<td style="text-align: right"><strong><?=format_idr($sub_total - $disc + $vat + $po['shipping_charge'])?></strong></td>
				</tr>
			  </tbody>
			</table>
			<?php 
				foreach($t as $item)
				{
					echo '<p>'. $item['term'] .' : '. $item['cond'] .'</p>';
				}
			?>
			<?php if(!empty($po['note'])):?>
			<div style="border: 1px solid black; width: 300px; min-height: 20px;padding: 5px;">
				<?=$po['note']?>
			</div>
			<?php endif;?>

		</div>
		<div style="clear: both;"></div>
		<p style="text-align: center;"><small>Approved By:</small></p>
		<div style="width: 33%; float: left;text-align: center;height: 100px;">
			<p>P & L Manager</p>
			<p><?=$po['note_procurement']?></p>
		</div>
		<div style="width: 33%; float: left;text-align: center;height: 100px;">
			<p>General Manager</p>
			<p><?=$po['note_gm']?></p>
		</div>
		<div style="width: 33%; float: left;text-align: center;height: 100px;">
			<p>FA Manager</p>
			<p><?=$po['note_finance']?></p>
		</div>
		<div style="clear: both;"></div>
			
		<div class="signature">
			<p>Vendor Signature</p>
		</div>
		<br />
		<br />
		<br />
		<br />
		<div style="border-bottom: 1px solid #000000; width: 100px;">
			<p>Director</p>
		</div>
		<p style="color: blue;position: absolute;bottom: 10px;">This is computer generated document no signature required</p>
	</div>
</body>
</html>
