<?php
	session_start();
	include 'resources/library/functions.php'; ?>
<?php			
			$loginUrl = 'https://www.facebook.com/dialog/oauth?client_id='. $config["fbApp"]["appId"] .'&redirect_uri='. $config["urls"]["baseUrl"] .'/fb_login.php&scope=public_profile, email&response_type=code';
			switch ($_SESSION['pageNumber']) {
		    case 1:
		    	$fnbtName  = htmlspecialchars($_GET["name"]);
				if (findFnbt($fnbtName) == TRUE) { 	
					$_SESSION['pageNumber'] = 2;				
					require_once("resources/library/mid1.php");
					} else {
						$_SESSION['pageNumber'] = 1;
						$_SESSION['nameErr'] = TRUE;
						echo "<script>window.location='index.php';</script>";						
					}
				break;
		    case 2:
		    	if(isset($_GET["code"])){
			    	$_SESSION['pageNumber'] = 3;
			    	getUserFbInfo($_GET["code"]);
					require_once("resources/library/mid1.php");

		    	} else if(isset($_GET["error"])) {
			    	require_once("resources/library/last2.php");
					}
				break;
			default:
				echo "<script>window.location='index.php';</script>";
		}
			    ?>
