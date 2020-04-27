<?php

	include 'conection.php';
	header('Content-Type:application/json');
	
	if(!array_key_exists('HTTP_X_UID',$_SERVER)||
		!array_key_exists('HTTP_X_PASS',$_SERVER) ||
		!array_key_exists('HTTP_X_TOKEN',$_SERVER)){
		die;
	}

	list($uid,$pass,$token)=[
	$_SERVER['HTTP_X_UID'],
	$_SERVER['HTTP_X_PASS'],
	$_SERVER['HTTP_X_TOKEN']
	];
	
	$tipos_lenguajes = [
	'lenguaje'
	];
	
	$lenguajes= [
	1=>	['Python'=>[
			'Creacion' => '1991',
			'Ultima version'=>'3.8.0',
			'Diseñador'=> 'Guido van Rossum',
			'Descripcion' => [
								'extension' => '.py',
								'tipo' => 'compilado',]]],
	2 => ['JAVA'=>[
		'Creacion' => '1983',
		'Ultima version'=>'14',
		'Diseñador'=> 'James Gosling',
		'Descripcion' => [
							'extension' => '.java',
							'tipo' => 'compilado e interpretado',]]]
	];

	$productoId=array_key_exists('lenguaje_id',$_GET) ? $_GET['lenguaje_id']:'';
	$itemId=array_key_exists('item_id',$_GET) ? $_GET['item_id']:'';
	
	$sentence = "SELECT * FROM users where id = " . $uid . " and password = '" . $pass . "' and token = '" . $token . "'";
	$query = strval($sentence);
		
	$get_users = mysqli_query($conexion, $query);					
	while ($row = mysqli_fetch_array($get_users)) {
		$id = $row['id'];
		$password = $row['password'];
		$token_table = $row['token'];
		$token_time = $row['token_time'];
	}
	
	if ($id == $uid and $password == $pass and $token_table == $token ){
		echo "Bienvenido " . PHP_EOL;
		$end_token = $token_time + 60;
		$current_time = time();
		$timeleft = $current_time - $end_token;
		//echo "Token BD:" . $token_time . PHP_EOL;
		//echo "Token FIN:" . $end_token . PHP_EOL;
		//echo "Tiempo Actual:" . $current_time . PHP_EOL;
		if ($timeleft <= 300) {
			if('GET'==strtoupper($_SERVER['REQUEST_METHOD'])){		
				if($productoId == 'lenguaje'){
						echo json_encode($lenguajes);
				}
			}
			
			if('POST' == strtoupper($_SERVER['REQUEST_METHOD'])){
			$json=file_get_contents('php://input');
				if($productoId == 'lenguaje'){
					$lenguajes[]=json_decode($json,true);
					echo json_encode($lenguajes);
				}
			}
			
			if('PUT'==strtoupper($_SERVER['REQUEST_METHOD'])){
				if($productoId == 'lenguaje'){
					if(!empty($itemId) && array_key_exists($itemId,$lenguajes)){
						$json=file_get_contents('php://input');
						$lenguajes[$itemId]=json_decode($json,true);
						echo json_encode($lenguajes);
					}
					else{
						echo json_encode($lenguajes);
					}
				}
			}
			
			if('DELETE'==strtoupper($_SERVER['REQUEST_METHOD'])){
				if($productoId == 'lenguaje'){
					if(!empty($itemId) && array_key_exists($itemId,$lenguajes)){
						unset($lenguajes[$itemId]);
						echo json_encode($lenguajes);
					}
					else{
						echo json_encode($lenguajes);
					}    
				}
			}
		}
		else 
		{
			echo "Token expirado";
		}
	}		
	else{
		echo "Acceso denegado";
	}
		
	
	
							
	
?>