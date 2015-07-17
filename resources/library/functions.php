<?php

	require(realpath(dirname(__FILE__) . "/../config.php"));
	
	require_once ( realpath(dirname(__FILE__) . '/facebook/facebook-php-sdk-v4/src/Facebook/FacebookSession.php') );
	require_once ( realpath(dirname(__FILE__) . '/facebook/facebook-php-sdk-v4/src/Facebook/HttpClients/FacebookCurl.php') );
	require_once ( realpath(dirname(__FILE__) . '/facebook/facebook-php-sdk-v4/src/Facebook/HttpClients/FacebookHttpable.php') );
	require_once ( realpath(dirname(__FILE__) . '/facebook/facebook-php-sdk-v4/src/Facebook/HttpClients/FacebookCurlHttpClient.php') );
	require_once ( realpath(dirname(__FILE__) . '/facebook/facebook-php-sdk-v4/src/Facebook/FacebookResponse.php') );
	require_once ( realpath(dirname(__FILE__) . '/facebook/facebook-php-sdk-v4/src/Facebook/FacebookRequest.php') );
	require_once ( realpath(dirname(__FILE__) . '/facebook/facebook-php-sdk-v4/src/Facebook/FacebookSDKException.php') );
	require_once ( realpath(dirname(__FILE__) . '/facebook/facebook-php-sdk-v4/src/Facebook/FacebookRequestException.php') );
	require_once ( realpath(dirname(__FILE__) . '/facebook/facebook-php-sdk-v4/src/Facebook/FacebookAuthorizationException.php') );
	require_once ( realpath(dirname(__FILE__) . '/facebook/facebook-php-sdk-v4/src/Facebook/Entities/SignedRequest.php') );
	require_once ( realpath(dirname(__FILE__) . '/facebook/facebook-php-sdk-v4/src/Facebook/Entities/AccessToken.php') );
	require_once ( realpath(dirname(__FILE__) . '/facebook/facebook-php-sdk-v4/src/Facebook/FacebookSignedRequestFromInputHelper.php') );
	require_once ( realpath(dirname(__FILE__) . '/facebook/facebook-php-sdk-v4/src/Facebook/FacebookRedirectLoginHelper.php') );
	require_once ( realpath(dirname(__FILE__) . '/facebook/facebook-php-sdk-v4/src/Facebook/GraphObject.php') );
	require_once ( realpath(dirname(__FILE__) . '/facebook/facebook-php-sdk-v4/src/Facebook/GraphUser.php') );
	 
	use Facebook\FacebookSession;
	use Facebook\FacebookRequest;
	use Facebook\FacebookJavaScriptLoginHelper;
	use Facebook\FacebookRedirectLoginHelper;
	use Facebook\Graphuser; 
	use Facebook\FacebookRequestException;	
		
	function getUserFbInfo($code){

	
		require(realpath(dirname(__FILE__) . "/../config.php"));		
			$servername = $config["db"]["fanbot"]["host"];
			$username = $config["db"]["fanbot"]["username"];
			$password = $config["db"]["fanbot"]["password"];
			$dbname = $config["db"]["fanbot"]["dbname"];

		// Initialize the Facebook app using the application ID and secret.
		FacebookSession::setDefaultApplication( $config["fbApp"]["appId"],$config["fbApp"]["appSecret"] );
		
		// Get de JSON text containing the token 
		$codeToToken = file_get_contents('https://graph.facebook.com/v2.3/oauth/access_token?client_id='.$config["fbApp"]["appId"].'&redirect_uri=http://ec2-52-26-183-244.us-west-2.compute.amazonaws.com/fb_login.php&client_secret='.$config["fbApp"]["appSecret"].'&code='. $code);
		$token = json_decode($codeToToken);


			
		//get new session
		if (!isset($session)) {
		  try {
		    $session = new FacebookSession($token->{'access_token'});	    
		  } catch(FacebookRequestException $e) {
		    unset($session);
		    echo $e->getMessage();
		  }
		}
		 
		//do some api stuff
		if (isset($session)) {
		  $me = (new FacebookRequest($session, 'GET', '/me'))->execute()->getGraphObject(GraphUser::className());
		  $_SESSION['fbUserId'] = $me->getId();
		  $_SESSION['fbUserLink'] = $me->getLink();
		  $_SESSION['fbUserName'] = $me->getName();
		  $_SESSION['fbUserEmail'] = $me->getEmail();
		  $_SESSION['fbUserFirstName'] = $me->getFirstName();
		  $_SESSION['fbUserLastName'] = $me->getLastName();
		  $_SESSION['fbUserGender'] = $me->getGender();
		}
	}
	
	function saveUserDataToDB(){
				
	
		require(realpath(dirname(__FILE__) . "/../config.php"));		
			$servername = $config["db"]["fanbot"]["host"];
			$username = $config["db"]["fanbot"]["username"];
			$password = $config["db"]["fanbot"]["password"];
			$dbname = $config["db"]["fanbot"]["dbname"];


				// Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				// Check connection
				if ($conn->connect_error) {
				    die("Connection failed: " . $conn->connect_error);
				} 
				
						$sql = "SELECT * FROM users WHERE fbID = '". $_SESSION['fbUserId']. "'";
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {		    
			    echo "User already exist";	
			} else {
				$sql = "INSERT INTO users (fbID, fbName, firstName, lastName, email, gender) VALUES ( '". $_SESSION['fbUserId']. "','". $_SESSION['fbUserName']. "','". $_SESSION['fbUserFirstName']. "','". $_SESSION['fbUserLastName']. "','". $_SESSION['fbUserEmail'] ."','". $_SESSION['fbUserGender']."')";
				
				if ($conn->query($sql) === TRUE) {
				    echo "New User saved successfully <br>";
				} else {
				    echo "Error: " . $sql . "<br>" . $conn->error;
				}
		}
				
				$conn->close();
		}

	function saveInteractionToDB(){
				
		require(realpath(dirname(__FILE__) . "/../config.php"));		
			$servername = $config["db"]["fanbot"]["host"];
			$username = $config["db"]["fanbot"]["username"];
			$password = $config["db"]["fanbot"]["password"];
			$dbname = $config["db"]["fanbot"]["dbname"];

				// Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				// Check connection
				if ($conn->connect_error) {
				    die("Connection failed: " . $conn->connect_error);
				} 

				$sql = "INSERT INTO interactions  (fanbotId, userId, clientId, fbPage) VALUES ( '". $_SESSION['id']. "','".  $_SESSION['fbUserId']. "','". $_SESSION['clientId']. "','". $_SESSION['fbPage']. "')";
				
				if ($conn->query($sql) === TRUE) {
				    echo "Interaction saved successfully <br>";
				} else {
				    echo "Error: " . $sql . "<br>" . $conn->error;
				}
				
				$conn->close();
		}

	function fanbotAction($deviceId, $accesToken){
		
		$ch = curl_init("https://api.particle.io/v1/devices/". $deviceId.  "/?access_token=". $accesToken);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$output = curl_exec($ch);
		curl_close($ch);
		
	
	
		$curloutput = json_decode($output, true);
		$connectedSpark = $curloutput["connected"];
	
	
	
			if($connectedSpark){
	
	
				$ch = curl_init("https://api.particle.io/v1/devices/". $deviceId.  "/led?access_token=". $accesToken);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, "params=D7,HIGH");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$output = curl_exec($ch);
				curl_close($ch);
		}
	
	}
	
	
	function findFnbt($fnbtName){	
		
		require(realpath(dirname(__FILE__) . "/../config.php"));		
		$servername = $config["db"]["fanbot"]["host"];
		$username = $config["db"]["fanbot"]["username"];
		$password = $config["db"]["fanbot"]["password"];
		$dbname = $config["db"]["fanbot"]["dbname"];

		
			
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}
		
		$sql = "SELECT * FROM fanbot WHERE name = '". $fnbtName ."' ";
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {		    
		    while($row = $result->fetch_assoc()) {
			    			        
		        $_SESSION['id'] = $row["id"];
		        $_SESSION['clientId'] = $row["clientId"];
		        $_SESSION['fbPage'] = $row["fbPage"];
		        $_SESSION['accesToken'] = $row["accesToken"];
		        $_SESSION['deviceId'] = $row["deviceId"];

			    }
			    return TRUE;	
			} else {
				return FALSE;

			}
		$conn->close();

	}		
	
	function checkForDuplucatedLike(){

		require(realpath(dirname(__FILE__) . "/../config.php"));		
		$servername = $config["db"]["fanbot"]["host"];
		$username = $config["db"]["fanbot"]["username"];
		$password = $config["db"]["fanbot"]["password"];
		$dbname = $config["db"]["fanbot"]["dbname"];

		
			
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}
		
		$sql = "SELECT * FROM interactions WHERE userId = '". $_SESSION['fbUserId'] ." ' AND fbPage = '". $_SESSION['fbPage'] . "'";
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {		    

			    return FALSE;	
			} else {
				return TRUE;

			}
		$conn->close();

	}	
			
?>