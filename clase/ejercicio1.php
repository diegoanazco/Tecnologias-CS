<?php
	header('Content-Type:application/json');
	$tipos_productos = [
		'cocina',
		'taller',
		'limpieza'
	];
	
	$productos = array(
		array(
		'refrigeradora' => 'Descripcion 01',
		'licuadora' => 'Descripcion 02',
		'plato' => 'Descripcion 03'
		),
		array(
		'martillo' => 'Descripcion 04',
		'clavo' => 'Descripcion 05'
		),
		array(
		'escoba' => 'Descripcion 06',
		'lejia' => 'Descripcion 07'
		)
	);
	
	$new_array = array_combine($tipos_productos, $productos);
	
	$tipoProducto= $_GET['tipos_productos'];

	foreach($new_array as $key => $value){
		if($tipoProducto == $key)
		{
			echo json_encode($value);
		}
	};
	
?>