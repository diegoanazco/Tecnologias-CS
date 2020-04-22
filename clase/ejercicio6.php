<?php
	if(!array_key_exists('HTTP_X_HASH',$_SERVER)||
	!array_key_exists('HTTP_X_UID',$_SERVER)){
		die;
	}

	list($hash,$uid)=[
	$_SERVER['HTTP_X_HASH'],
	$_SERVER['HTTP_X_UID']
	];

	$pwd='my password';

	$newHash = sha1($uid.$pwd);
	
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
	
	if($newHash !== $hash){
		echo "Acceso denegado";
	}
	else{
		echo "BIENVENIDO" . PHP_EOL;

		if('GET'==strtoupper($_SERVER['REQUEST_METHOD'])){		
			if($productoId == 'cocina'){
					echo json_encode($cocinas);
				}
				else{
					echo "No hay productos en cocina";
				}    
			if($productoId == 'taller'){
					echo json_encode($taller);
				}
				else{
					echo "No hay productos en taller";
				}
			if($productoId == 'limpieza'){
					echo json_encode($limpieza);
				}
				else{
					echo "No hay productos en limpieza";
				}				
		}
		
		if('POST' == strtoupper($_SERVER['REQUEST_METHOD'])){
			$json=file_get_contents('php://input');
			if($productoId == 'cocina'){
				$cocinas[]=json_decode($json,true);
				echo json_encode($cocinas);
			}
			if($productoId == 'taller'){
				$taller[]=json_decode($json,true);
				echo json_encode($taller);
			}
			if($productoId == 'limpieza'){
				$limpieza[]=json_decode($json,true);
				echo json_encode($limpieza);
			}
		}
		
		if('PUT'==strtoupper($_SERVER['REQUEST_METHOD'])){
			if($productoId == 'cocina'){
				if(!empty($itemId) && array_key_exists($itemId,$cocinas)){
					$json=file_get_contents('php://input');
					$cocinas[$itemId]=json_decode($json,true);
					echo json_encode($cocinas);
				}
				else{
					echo json_encode($cocinas);
				}
			}
			if($productoId == 'taller'){
				if(!empty($itemId) && array_key_exists($itemId,$taller)){
					$json=file_get_contents('php://input');
					$taller[$itemId]=json_decode($json,true);
					echo json_encode($taller);
				}
				else{
					echo json_encode($taller);
				}
			}
			if($productoId == 'limpieza'){
				if(!empty($itemId) && array_key_exists($itemId,$limpieza)){
					$json=file_get_contents('php://input');
					$limpieza[$itemId]=json_decode($json,true);
					echo json_encode($limpieza);
				}
				else{
					echo json_encode($limpieza);
				}
			}
		}
		
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
	}

?>