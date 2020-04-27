<?php
   
	include 'conection.php';
   
	$time=time();
	$id= " ";
	$pass = " ";
	   
	if('POST'==strtoupper($_SERVER['REQUEST_METHOD'])){
		$json = json_decode(file_get_contents('php://input'),true);
		foreach($json as $key => $value){
			if($key=="id")
				$id=$value;
			if($key=="pass")
				$pass=$value;
		}
		$hash=sha1($id.$time.$pass);
		$query = mysqli_query($conexion, "INSERT INTO users(id,password,token,token_time)
							values ('$id','$pass','$hash',$time)")
							or die(mysqli_error($conexion));
		echo "Token:" . $hash;
	}
	
	if('GET'==strtoupper($_SERVER['REQUEST_METHOD'])){	
		$json = json_decode(file_get_contents('php://input'),true);
		foreach($json as $key => $value){
			if($key=="id")
				$id=$value;
			if($key=="pass")
				$pass=$value;
		}
		$hash=sha1($id.$time.$pass);
		$query_token = mysqli_query($conexion, "UPDATE users SET token = '$hash' where id = '$id' and password = '$pass';")
							or die(mysqli_error($conexion));
		$query_time = mysqli_query($conexion, "UPDATE users SET token_time = $time where id = '$id' and password = '$pass';")
							or die(mysqli_error($conexion));
		echo "New Token:" . $hash;
	}
	
	
	
	

?>