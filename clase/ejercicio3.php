<?php
	
	function call_api ($word){
	
		$url = 'https://linguatools-conjugations.p.rapidapi.com/conjugate/';
		$request_url = $url . '?verb=' . $word;

		$curl = curl_init($request_url);

		curl_setopt_array($curl, array(CURLOPT_CUSTOMREQUEST =>'GET'));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, [
		  'X-RapidAPI-Host: linguatools-conjugations.p.rapidapi.com',
		  'X-RapidAPI-Key: dd9b30ac44msh1963fe8a53d6448p1889d2jsnafe1d3641ad1',
		  'Content-Type: application/json'
		]);

		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		$response = curl_exec($curl);


		echo $response;

	}
	
	$myfile = fopen("words.txt","r") or die ("No se puede abrir archivo");
	while(!feof($myfile)){
		$current_word = fgets($myfile);
		call_api($current_word);
	}
	fclose ($myfile);
	
	
?>