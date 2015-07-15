<?php

	require(realpath(dirname(__FILE__) . "/../config.php"));
   
	require_once ( realpath(dirname(__FILE__) . '/facebook/facebook-php-sdk-v4/src/Facebook/HttpClients/FacebookHttpable.php') );
	require_once ( realpath(dirname(__FILE__) . '/facebook/facebook-php-sdk-v4/src/Facebook/HttpClients/FacebookCurl.php') );
	require_once ( realpath(dirname(__FILE__) . '/facebook/facebook-php-sdk-v4/src/Facebook/HttpClients/FacebookCurlHttpClient.php') );
    // added in v4.0.0
    require_once( realpath(dirname(__FILE__) . '/facebook/facebook-php-sdk-v4/src/Facebook/FacebookSession.php') );
    require_once( realpath(dirname(__FILE__) . '/facebook/facebook-php-sdk-v4/src/Facebook/FacebookRedirectLoginHelper.php') );
    require_once( realpath(dirname(__FILE__) . '/facebook/facebook-php-sdk-v4/src/Facebook/FacebookRequest.php') );
    require_once( realpath(dirname(__FILE__) . '/facebook/facebook-php-sdk-v4/src/Facebook/FacebookResponse.php') );
    require_once( realpath(dirname(__FILE__) . '/facebook/facebook-php-sdk-v4/src/Facebook/FacebookSDKException.php') );
    require_once( realpath(dirname(__FILE__) . '/facebook/facebook-php-sdk-v4/src/Facebook/FacebookRequestException.php') );
    require_once( realpath(dirname(__FILE__) . '/facebook/facebook-php-sdk-v4/src/Facebook/FacebookOtherException.php') );
    require_once( realpath(dirname(__FILE__) . '/facebook/facebook-php-sdk-v4/src/Facebook/FacebookAuthorizationException.php') );
    require_once( realpath(dirname(__FILE__) . '/facebook/facebook-php-sdk-v4/src/Facebook/GraphObject.php') );
    require_once( realpath(dirname(__FILE__) . '/facebook/facebook-php-sdk-v4/src/Facebook/GraphSessionInfo.php') );
    
    

	require_once ( realpath(dirname(__FILE__) . '/facebook/facebook-php-sdk-v4/src/Facebook/Entities/SignedRequest.php') );
	require_once ( realpath(dirname(__FILE__) . '/facebook/facebook-php-sdk-v4/src/Facebook/Entities/AccessToken.php') );
	require_once ( realpath(dirname(__FILE__) . '/facebook/facebook-php-sdk-v4/src/Facebook/FacebookSignedRequestFromInputHelper.php') );
	require_once ( realpath(dirname(__FILE__) . '/facebook/facebook-php-sdk-v4/src/Facebook/GraphUser.php') );

    // added in v4.0.5
    use Facebook\FacebookHttpable;
    use Facebook\FacebookCurl;
    use Facebook\FacebookCurlHttpClient;
    // added in v4.0.0
    use Facebook\FacebookSession;
    use Facebook\FacebookRedirectLoginHelper;
    use Facebook\FacebookRequest;
    use Facebook\FacebookResponse;
    use Facebook\FacebookSDKException;
    use Facebook\FacebookRequestException;
    use Facebook\FacebookOtherException;
    use Facebook\FacebookAuthorizationException;
    use Facebook\GraphObject;
    use Facebook\GraphSessionInfo;
    
  

		require(realpath(dirname(__FILE__) . "/../config.php"));		
			$servername = $config["db"]["fanbot"]["host"];
			$username = $config["db"]["fanbot"]["username"];
			$password = $config["db"]["fanbot"]["password"];
			$dbname = $config["db"]["fanbot"]["dbname"];

		// Initialize the Facebook app using the application ID and secret.
		FacebookSession::setDefaultApplication( '1645168355707000','3e5c77fee5087278e2f04d8a7fffbd7f' );

		// Add `use Facebook\FacebookRedirectLoginHelper;` to top of file
		$helper = new FacebookRedirectLoginHelper('http://ec2-52-26-183-244.us-west-2.compute.amazonaws.com/fb_login.php');
		echo 'Entro a la funcion';
		//get new session
		
		// see if a existing session exists
		if (isset($_SESSION) && isset($_SESSION['fb_token'])) {
		    // create new session from saved access_token
		    $session = new FacebookSession($_SESSION['fb_token']);
		    // validate the access_token to make sure it's still valid
		    try {
		        if (!$session->validate()) {
		            $session = null;
		        }
		    } catch (Exception $e) {
		        // catch any exceptions
		        $session = null;
		    }
		} else {
		    // no session exists
		    try {
		        $session = $helper->getSessionFromRedirect();
		    } catch (FacebookRequestException $ex) {
		        // When Facebook returns an error
		    } catch (Exception $ex) {
		        // When validation fails or other local issues

		    }
		}

		// see if we have a session
		if (isset($session)) {
		    // save the session
		    $_SESSION['fb_token'] = $session->getToken();
		    // create a session using saved token or the new one we generated at login
		    $session = new FacebookSession($session->getToken());
		    // graph api request for user data
		    $request = new FacebookRequest($session, 'GET', '/me');
		    $response = $request->execute();
		    $graphObject = $response->getGraphObject()->asArray();
		
		    $_SESSION['valid'] = true;
		    $_SESSION['timeout'] = time();
		
		    $_SESSION['FB'] = true;
		
		    $_SESSION['usernameFB'] = $graphObject['name'];
		    $_SESSION['idFB'] = $graphObject['id'];
		    $_SESSION['first_nameFB'] = $graphObject['first_name'];
		    $_SESSION['last_nameFB'] = $graphObject['last_name'];
		    $_SESSION['genderFB'] = $graphObject['gender'];
		    echo $_SESSION['usernameFB'];
				    
		} else {
			echo '<br>El usuario no fue creado <br>';
		}
		echo 'salio de la funcion'; 
		