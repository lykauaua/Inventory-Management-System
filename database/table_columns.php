<?php
	
	$tables_columns_mapping = [
		'users' =>[
			'ID', 'name', 'email', 'password', 'created_at', 'updated_at'
		],
		'equipment' => [
			'ID', 'equip_name', 'brand_model', 'img', 'quantity', 'created_at', 'created_by', 'updated_at', 'status', 'serial_num', 'maintenance', 'location', 'remarks'

		],
		'tools' => [
			'ID', 'equip_name', 'brand_model', 'img', 'quantity', 'created_at', 'created_by', 'updated_at', 'status', 'serial_num','maintenance', 'location', 'remarks'

		],
		'consumables' => [
			'ID', 'equip_name', 'brand_model', 'img', 'quantity', 'created_at', 'created_by', 'updated_at', 'status', 'serial_num','maintenance', 'location', 'remarks'

		]
	]

?>