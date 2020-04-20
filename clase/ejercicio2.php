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
	
	
	$tipo= $_REQUEST['tipo_producto']; 
	
	if('GET' == strtoupper($_SERVER['REQUEST_METHOD'])){
		if($tipo == 'cocina'){
			echo json_encode($cocinas);
		}
		elseif($tipo == 'taller'){
			echo json_encode($taller);
		}
		elseif($tipo == 'limpieza'){
			echo json_encode($limpieza);
		}
	}
	
	if('POST' == strtoupper($_SERVER['REQUEST_METHOD'])){
		$json=file_get_contents('php://input');
		if($tipo == 'cocina'){
			$cocinas[]=json_decode($json,true);
			echo json_encode($cocinas);
		}
		elseif($tipo == 'taller'){
			$taller[]=json_decode($json,true);
			echo json_encode($taller);
		}
		elseif($tipo == 'limpieza'){
			$limpieza[]=json_decode($json,true);
			echo json_encode($limpieza);
		}			
	}
	
	
?>