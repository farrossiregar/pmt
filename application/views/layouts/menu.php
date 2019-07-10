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
			'link' => '#',
			'icon' => 'fa-user',
			'items' => [
				[
					'label' => 'User List',
					'link' => 'user',
					'icon' => ''
				]
			]
		]
	]; 
}
else if($access == 13) // Purchasing
{
	$menu = [
		[
			'label' => 'Purchasing Request',
			'link' => 'PurchasingRequest',
			'icon' => 'fa-paper-plane-o',
		]
	]; 
	
	// $menu = [
	// 	[
	// 		'label' => 'Master Data',
	// 		'link' => '#',
	// 		'icon' => 'fa-home',
	// 		'items' => [
	// 			[
	// 				'label' => 'Material / Services',
	// 				'link' => 'material',
	// 				'icon' => ''
	// 			],
	// 			[
	// 				'label' => 'Vendor',
	// 				'link' => 'vendor',
	// 				'icon' => ''
	// 			],
	// 			[
	// 				'label' => 'Sales And Distribution',
	// 				'link' => 'salesDistribution',
	// 				'icon' => ''
	// 			],
	// 			[
	// 				'label' => 'Request For Quotation',
	// 				'link' => 'requestForQuotation',
	// 				'icon' => ''
	// 			],
	// 			[
	// 				'label' => 'PO',
	// 				'link' => 'PurchaseOrderWarehouse',
	// 				'icon' => ''
	// 			],
	// 			[
	// 				'label' => 'Import Material',
	// 				'link' => 'importMaterial',
	// 				'icon' => ''
	// 			]
	// 		]
	// 	]
	// ]; 
}
else if($access == 14) // Procurement HO
{
	$menu = [
		[
			'label' => 'Catalog',
			'link' => 'procurementho/catalog',
			'icon' => 'fa-database',
		],
		[
			'label' => 'Purchasing Request',
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
			'link' => 'Bac',
			'icon' => 'fa-bar-chart'
		]
	]; 
}
elseif($access == 7)
{
	$menu = [
		[
			'label' => 'Catalog',
			'link' => 'salesDistribution',
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
			'label' => 'Purchasing Request',
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
			'label' => 'Purchasing Request',
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
else
{
	$menu = [
		[
			'label' => 'Purchasing Request',
			'link' => 'PurchasingRequest',
			'icon' => 'fa-paper-plane-o',
		]
	]; 
}

?>
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
