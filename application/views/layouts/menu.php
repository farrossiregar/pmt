<?php

$access 		= (Int)$this->session->userdata('access_id');
$position_id 	= (Int)$this->session->userdata('position_id');
$menu 			= [];

// is administrator
if($access == 1){
	$menu = [

		[
			'label' => 'Master Data',
			'link' => '#',
			'icon' => 'fa-database',
			'items' => [
				[
					'label' => 'Material / Services',
					'link' => 'material',
					'icon' => ''
				],
				[
					'label' => 'Vehicle',
					'link' => 'vehicle',
					'icon' => ''
				],
				[
					'label' => 'Vendor / Suplier',
					'link' => 'vendor',
					'icon' => ''
				],
				[
					'label' => 'Project',
					'link' => 'project',
					'icon' => ''
				],
				[
					'label' => 'Region',
					'link' => 'region',
					'icon' => ''
				],
				[
					'label' => 'Company',
					'link' => 'company',
					'icon' => ''
				]
			]
		],

		[
			'label' => 'User Management',
			'link' => 'user',
			'icon' => 'fa-user',
			'items' => [
			// 	[
			// 		'label' => 'User List',
			// 		'link' => 'user',
			// 		'icon' => ''
			// 	]
			]
		]
	]; 
}
else if($access == 13) // Purchasing
{
	$menu = [
		// [
		// 	'label' => 'Purchase Requisition',
		// 	'link' => 'PurchasingRequest',
		// 	'icon' => 'fa-paper-plane-o',
		// ]
	]; 
}
else if($access == 14) // Procurement Manager
{
	$menu = [
		[
			'label' => 'Catalog',
			'link' => 'procurementho/catalog',
			'icon' => 'fa-database',
		],
		[
			'label' => 'Purchase Requisition',
			'link' => 'purchase-request',
			'icon' => 'fa-paper-plane-o',
		],
		[
			'label' => 'Request For Quotation',
			'link' => 'requestForQuotation',
			'icon' => 'fa-paper-plane-o'
		],
		[
			'label' => 'PO',
			'link' => 'PurchaseOrderWarehouse',
			'icon' => 'fa-paper-plane-o'
		],
		[
			'label' => 'Invoice',
			'link' => 'PurchaseOrderWarehouse/invoice',
			'icon' => 'fa-calendar'
		],
		[
			'label' => 'Bid Analysis Comparison',
			'link' => 'home/bac',
			'icon' => 'fa-bar-chart'
		]
	]; 
}
elseif($access == 18) // Procurement
{
	$menu = [
		[
			'label' => 'Catalog',
			'link' => 'procurementho/catalog',
			'icon' => 'fa-database',
		],
		[
			'label' => 'Purchase Requisition',
			'link' => 'purchase-request',
			'icon' => 'fa-paper-plane-o',
		],
		[
			'label' => 'Request For Quotation',
			'link' => 'requestForQuotation',
			'icon' => 'fa-paper-plane-o'
		],
		[
			'label' => 'PO',
			'link' => 'PurchaseOrderWarehouse',
			'icon' => 'fa-paper-plane-o'
		],
	]; 
}
elseif($access == 7)
{
	$vendor_type = $this->session->userdata('vendor_type');
	
	$menu = [
		[
			'label' => 'Catalog',
			'link' => (($vendor_type == "" || $vendor_type == 1) ? 'salesDistribution' : 'vehiclevendor'),
			'icon' => 'fa-database',
		],
		[
			'label' => 'Request For Quotation',
			'link' => 'requestForQuotationVendor',
			'icon' => 'fa-paper-plane-o'
		],
		[
			'label' => 'Purchase Order',
			'link' => 'PurchaseOrderVendor',
			'icon' => 'fa-paper-plane-o'
		],
		[
			'label' => 'Invoice',
			'link' => 'InvoiceVendor',
			'icon' => 'fa-calendar'
		],
	];
}
elseif($access == 15)
{
	$menu = [
		[
			'label' => 'Purchase Requisition',
			'link' => 'PurchasingRequest',
			'icon' => 'fa-paper-plane-o',
		],
		[
			'label' => 'Purchase Order',
			'link' => 'PurchaseOrderGM',
			'icon' => 'fa-paper-plane-o'
		],
	]; 
}
elseif($access == 16)
{
	$menu = [
		[
			'label' => 'Purchase Requisition',
			'link' => 'PurchasingRequest',
			'icon' => 'fa-paper-plane-o',
		],
		[
			'label' => 'Purchase Order',
			'link' => 'PurchaseOrderFinance',
			'icon' => 'fa-paper-plane-o'
		],
		[
			'label' => 'Invoice',
			'link' => 'InvoiceFinance',
			'icon' => 'fa-calendar'
		],
	]; 
}
elseif($access == 17)
{
	$menu = [
		// [
		// 	'label' => 'Purchase Requisition',
		// 	'link' => 'PurchasingRequest',
		// 	'icon' => 'fa-paper-plane-o',
		// ]
	]; 
}
elseif($access == 19) // PMG
{
	$menu = [
		[
			'label' => 'Purchase Order',
			'link' => 'purchaseorderpmg',
			'icon' => 'fa-paper-plane-o',
		]
	]; 
}
elseif($access == 22) // Director
{
	$menu = [
		[
			'label' => 'Purchase Order',
			'link' => 'purchaseorderdirector',
			'icon' => 'fa-paper-plane-o',
		]
	]; 
}
else
{
	$menu = [
		[
			'label' => 'Purchase Requisition',
			'link' => 'PurchasingRequest',
			'icon' => 'fa-paper-plane-o',
		]
	]; 
}

?>

<?php if($access == 17 || $access == 13):?>
	<style type="text/css">
		.left_col,.nav.toggle {
			display: none;
		}
		.nav-sm .main_container .top_nav, .nav-sm footer, .nav-sm .container.body .right_col {
			margin-left: 0;
		}
	</style>
<?php endif; ?>
<ul class="nav side-menu">
	<?php
		foreach($menu as $key => $value){
			echo '<li><a ';
			
			if($value['link'] != '#') echo ' href="'. site_url($value['link']) .'" ';

			echo '><i class="fa '. $value['icon'] .'"></i> '. $value['label'];

			if(isset($value['items'])) echo '<span class="fa fa-chevron-down"></span>';

			echo  ' </a>';

			if(isset($value['items'])){
    			echo '<ul class="nav child_menu">';
				foreach($value['items'] as $i){
      				echo '<li><a href="'. site_url($i['link']) .'">'. $i['label'] .'</a></li>';
				}
				echo '</ul>';
			}

			echo '</li>';
		}
	?>
</ul>
