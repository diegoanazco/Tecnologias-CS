<?php
	header('Content-Type:application/json');
	$tipos_productos = [
		'cocina',
		'taller',
		'limpieza'
	];
	
	$cocinas= [
	1=>['tipo' => 'electrica',
	'marca'=>'hp',
	'id_seguro'=> 1,],
	2=>['tipo' => 'gas',
	'marca'=>'LG',
	'id_seguro'=>2,],
	];
	
	$taller= [
	1=>['tipo' => 'martillo',
	'marca'=>'ProMart',
	'id_seguro'=> 1,],
	2=>['tipo' => 'clavo',
	'marca'=>'HomeCenter',
	'id_seguro'=>2,],
	];
	
	$limpieza= [
	1=>['tipo' => 'escoba',
	'marca'=>'Sapolio',
	'id_seguro'=> 1,],
	2=>['tipo' => 'lejia',
	'marca'=>'clorox',
	'id_seguro'=>2,],
	];
	
	$productoId=array_key_exists('producto_id',$_GET) ? $_GET['producto_id']:'';
	$itemId=array_key_exists('item_id',$_GET) ? $_GET['item_id']:'';


	if('DELETE'==strtoupper($_SERVER['REQUEST_METHOD'])){
		
		if($productoId == 'cocina'){
			if(!empty($itemId) && array_key_exists($itemId,$cocinas)){
				unset($cocinas[$itemId]);
				echo json_encode($cocinas);
			}
			else{
				echo json_encode($cocinas);
			}    
		}
		
		if($productoId == 'taller'){
			if(!empty($itemId) && array_key_exists($itemId,$taller)){
				unset($taller[$itemId]);
				echo json_encode($taller);
			}
			else{
				echo json_encode($taller);
			}    
		}
		
		if($productoId == 'limpieza'){
			if(!empty($itemId) && array_key_exists($itemId,$limpieza)){
				unset($limpieza[$itemId]);
				echo json_encode($limpieza);
			}
			else{
				echo json_encode($limpieza);
			}    
		}
	}
	
	
?>