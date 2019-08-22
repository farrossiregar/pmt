
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<title>Purchase Request #<?=$data['no']?></title>
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
			padding-left: 10px;
			padding-right: 10px;
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
  			top:30%;
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
		<p><img src="<?=base_url('upload/').$data['company_logo']?>" style="width: 150px;" /></p>
		<hr />
		<table>
			<tr>
				<td style="vertical-align: top;">
					<h4><?=$data['company']?></h4><br />
					<p><?=$data['company_address']?></p>
					<p>Phone : <?=$data['company_telepon']?></p>
					<p><?=$data['website']?></p>
				</td>
				<td style="text-align: right">
					<h2>PURCHASE REQUEST</h2>
					<p><strong>PR NO : </strong> <?=$data['no']?></p>		
					<br />
					<br />
					<br />
					<br />
				</td>
			</tr>
			<tr>
				<td>
					<p>
						<b>Date of Assigment:</b> <?=date('d F Y', strtotime($data['created_at']))?><br />
						Requester : <?=$data['project_manager']?><br />
						<b>Project Name : <?=$data['project']?></b><br />
						<b>Contract Project No: : <?=$data['project_code']?></b><br />
						<b>Region: : <?=$data['region_code']?></b><br />
					</p>
				</td>
				<td>
					<p>Date Required : <?=date('d F Y', strtotime($data['require_date']))?></p>
				</td>
			</tr>
		</table>
		<br />
		<p>Purchase Request Information</p>
		<table class="table" >
          <thead>
            <tr>
              <th class="border">No</th>
              <th class="border">Material Group</th>
              <th class="border">Purchase Category</th>
              <th class="border">Material</th>
              <th class="border">Required Qty.</th>
              <th class="border">Urgency Level</th>
              <th class="border">Note</th>
            </tr>
          </thead>
          <tbody class="add-table-purcashing-request" id="table_detail">
          <?php foreach($material as $key => $value):?>
            <tr>
               <td class="column-title border"><?php echo $key+1; ?></td>
               <td class="column-title border"><?php echo $value['group_material']; ?></td>
               <td class="column-title border"><?php echo $value['purchase_category']; ?></td>
               <td class="column-title border">
                  <?php 
                    $name = $value["name_material"];
                    if($value["material_id"] == "0")
                      $name = $value["new_material"];

                    echo $name;
                  ?>
               </td>
               <td class="column-title border"><?php echo $value['qty']; ?></td>
               <td class="column-title border"><?php
                $urgency = URGENCY___LEVEL;
                $urgency_val = isset($urgency[$value['urgency']]) ? $urgency[$value['urgency']] : "";
                echo $urgency_val;
                ?></td>
               <td class="column-title border"><?php echo $value['note']; ?></td>
            </tr>
          <?php endforeach;?>
          </tbody>                  
       </table>
		</div>
		<div style="clear: both;"></div>
		
		<p style="color: blue;position: absolute;bottom: 10px;">This is computer generated document no signature required</p>
	</div>
</body>
</html>
