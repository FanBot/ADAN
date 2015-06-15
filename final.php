<?php
	
	$ch = curl_init("https://api.particle.io/v1/devices/54ff6e066672524826401167/?access_token=fca57b414c7445a2b4f641a6eec1abca96bad3b9");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$output = curl_exec($ch); 
	curl_close($ch);
	
	$curloutput = json_decode($output, true);
	$connectedSpark = $curloutput["connected"];
	
	
		
		if($connectedSpark){


			$ch = curl_init("https://api.particle.io/v1/devices/54ff6e066672524826401167/led?access_token=fca57b414c7445a2b4f641a6eec1abca96bad3b9");
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "params=D7,HIGH");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
			$output = curl_exec($ch); 
			curl_close($ch);
}
?>

<script>
    window.location="adios.html";
 </script>