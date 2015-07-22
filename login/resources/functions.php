<?php 
	
	
	// Check if user is logged in 
	function isLogged(){
		session_start();
		if(!isset($_SESSION["userId"])){
				header("location:./login.php");
		}
	}
	
	
	// Logout user
	function logOut(){
		session_start();
		session_destroy();
	}

	
	function printLikesChar(){

		$servername="localhost"; // Host name 
		$username="Dev"; // Mysql username 
		$password="\"TRFBMIsCWh{19"; // Mysql password 
		$dbname="fanbot_db"; // Database name 

		
			
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}
		
		$sql = "SELECT * FROM interactions WHERE clientId = '". $_SESSION['userId']. "'";
		$result = $conn->query($sql);
		
		if ($result->num_rows > 1) {
			$i = 1;

			while($row = $result->fetch_assoc()) {		    

			    $likesArray[$i]['fanbotId'] = $row["fanbotId"];
			    $likesArray[$i]['clientId'] = $row["clientId"];
			    $likesArray[$i]['date'] = $row["date"];
			    $i++;
			}
				
			} else {

			}
		$conn->close();

	}
	
	function getLikesGraph($month,$year){

	$servername="localhost"; // Host name 
	$username="Dev"; // Mysql username 
	$password="\"TRFBMIsCWh{19"; // Mysql password 
	$dbname="fanbot_db"; // Database name 

		
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	$sql = "SELECT * FROM interactions WHERE EXTRACT(MONTH FROM date) = '". $month. "' AND EXTRACT(YEAR FROM date) = '". $year."' AND clientId = '". $_SESSION['userId']."'"; 

	$result = $conn->query($sql);
	$daysInMonth = cal_days_in_month(CAL_GREGORIAN, date("m"), date("Y"));
	$dayArray = array();
	if ($result->num_rows > 0) {		    

		    while($row = $result->fetch_assoc()) {

			// Create a new date var from date in db
			$date =new DateTime($row['date']);
			// Get de number of day from the date variable
			$day = $date->format('d');
			// Create the array 
			$i = 1;
			$dayArray[$i] = 0;
			for($i = 1; $i <= $daysInMonth; $i++){
				 if ($day == $i){
				 $dayArray[$i]++;

		    }
		}
	}

	for($i = 1; $i <= $daysInMonth; $i++){
		
		if (isset($dayArray[$i])) {
			echo "{ d: '".$i ."', l: ". $dayArray[$i] ." }";
			
		} else {
			echo "{ d: '".$i ."', l: ". 0 ." }";
			}

		if ($daysInMonth > $i) {
			echo ', ';
		}
		
		}
		

    }

	$conn->close();
	
}

?>