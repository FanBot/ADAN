<?php
	session_start();

	require 'resources/library/functions.php';

	if (checkForDuplucatedLike()){
		$deviceId = $_SESSION["deviceId"];
		$accesToken = $_SESSION['accesToken'];
		saveUserDataToDB();
		saveInteractionToDB();	
		fanbotAction( $deviceId, $accesToken);
		require_once("resources/library/last1.php");
	} else {
		
		require_once("resources/library/last2.php");
	}
