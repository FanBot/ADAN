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

	function isFanbotOnline($token, $id){
		$json = file_get_contents('https://api.particle.io/v1/devices/'. $id.'?access_token='.$token);		
		$obj = json_decode($json,true);
		if ($obj['connected']){
			echo 'onine';
		} else {
			echo 'offline';
		}
		
	}

	function listFnbt(){	
			
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
		
		$sql = "SELECT * FROM fanbot WHERE clientId = '00'";
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {		    
		    while($row = $result->fetch_assoc()) { ?>
			    			
							<tr>
                                <td><a href="#"><?php echo $row['name']?></a></td>
                                <td class="hidden-phone"><?php echo $row['id']?></td>
                                <td><?php echo $row['plan']?> </td>
                                <td><span class="label label-success label-mini"><?php isFanbotOnline($row['accesToken'], $row['deviceId']); ?></span></td>
                                <td>
                                    <div class="progress progress-striped progress-xs">
                                        <div style="width: 40%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-success">
                                            <span class="sr-only">40% Complete (success)</span>
                                            
											<?php //print_r($row); ?>
                                        </div>
                                    </div>
                                </td>
                            </tr>


<?php			    }
			    return TRUE;	
			} else {
				return FALSE;

			}
		$conn->close();

	}	
?>