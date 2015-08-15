<?php
//Method which does a basic curl get request

function get_data($url) {
	
		$ch = curl_init();
		$timeout = .5;
        curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_POSTFIELDS, "params=D7,HIGH");
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $data = curl_exec($ch);
        //getinfo gets the data for the request
        $info = curl_getinfo($ch);
        //output the data to get more information.
        print_r($info);
        print_r($ch);
        curl_close($ch);
        return $data;
        
}

get_data("https://api.particle.io/v1/devices/440035001447343338333633/led?access_token=8f143ea31dd63ec40437558c3d352b560a2dfcd4");

?>
