<?php
//Method which does a basic curl get request

function get_data($url) {
	
		$ch = curl_init();
		$timeout = 100;
        curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "params=D7,HIGH");
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $data = curl_exec($ch);
        //getinfo gets the data for the request
        $info = curl_getinfo($ch);
        //output the data to get more information.
        print_r($info);
        return $data;
        
}

function find_data($url) {
	
		$ch = curl_init();
		$timeout = 100;
        curl_setopt($ch, CURLOPT_URL, $url);  
        curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $data = curl_exec($ch);
        //getinfo gets the data for the request
        $info = curl_getinfo($ch);
        //output the data to get more information.
        print_r($info);
        return $data;
        
}


		echo '<br>';

		echo '<br>';
		$ip ='api.particle.io';

		$arr = find_data("https://". $ip ."/v1/devices/440035001447343338333633/?access_token=8f143ea31dd63ec40437558c3d352b560a2dfcd4");
		print_r($arr);

		echo '<br>';
		


?>

