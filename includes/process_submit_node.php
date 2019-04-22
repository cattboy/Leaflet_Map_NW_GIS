<?php 
//check if user has access to submit --done
//verify their account again login/nda access level --done
//Maybe return their row_id from the login table and store that into the the nodes_table
//get nodedetails (saved in a string array)
//send cord locations as well as type
//confirmaiton

if (is_ajax()) 
{
	if (isset($_POST['node_resource_type'])) //change to node submit button info
	{
		// Include config file
		require_once 'config.php';
	   	session_start();

	   	//VARIABLE
	   	$alpha_access_nda = $_SESSION['alpha_access_nda'];
	   	$alphauser_row_id = 0;


	   	if($alpha_access_nda < 2) //No access
		{
			echo 'You dont have access to submit node data @ access_checker 1, sorry</p>';
			exit();
		}
		else
		{
			//Check again for alpha acccess
			//VARIABLE
			$username = $_SESSION['username']; //change to username from sessions
			$dblink = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("DB Connection Failed. Config error".mysqli_connect_error());
			$sql = "SELECT row_id, alpha_access_nda FROM login where username=?";
			$stmt = mysqli_stmt_init($dblink);
			if (!mysqli_stmt_prepare($stmt, $sql)){
				echo 'Failed DB';
				//header("Location: ../signup.php?error=sqlerroronSTMT");
				exit();
			}
			else
			{
				mysqli_stmt_bind_param($stmt, "s", $username);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_bind_result($stmt, $alphauser_row_id, $alpha_access_nda);
				mysqli_stmt_fetch($stmt);
				mysqli_stmt_close($stmt);
				if($alpha_access_nda < 2) //checking again, if they have access to submit
				{
					echo 'You dont have access to submit node data @ access_checker 2, sorry</p>';
					exit();
				}
				else //able to submit to the site
				{


					$node_resource_type = $_REQUEST["node_resource_type"];
					$node_resource_name = $_REQUEST["node_resource_name"];
					$node_position_ingame_x = $_REQUEST["node_position_ingame_x"];
					$node_position_ingame_y = $_REQUEST["node_position_ingame_y"];
					$node_position_lat = $_REQUEST["node_position_lat"];
					$node_position_lng = $_REQUEST["node_position_lng"];


					$sql = "INSERT INTO resource_node_details (node_resource_type, node_resource_name, node_position_ingame_x, node_position_ingame_y, node_position_lat, node_position_lng, forum_name, alpha_access_nda, login_row_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
					$stmt = mysqli_stmt_init($dblink);
					if (!mysqli_stmt_prepare($stmt, $sql)){
						echo 'ERROR DURING SUBMIT! Sorry, error code: ERR#PSN1 </p>';
						// header("Location: ../signup.php?error=sqlerroronSTMT2");
						exit();
					}
					else{
						
						mysqli_stmt_bind_param($stmt, "ssddddsii", $node_resource_type, $node_resource_name, $node_position_ingame_x, $node_position_ingame_y, $node_position_lat, $node_position_lng, $username, $alpha_access_nda, $alphauser_row_id);
						mysqli_stmt_execute($stmt);
						
						//User created account successfully
						// header("Location: ../login.php?signup=success");
						echo 'Node submitted successfully! Inside Process_submit_node </p>';
						exit();
					}


				}
			}
		}
		mysqli_stmt_close($stmt);
		mysqli_close($dblink);
	}
}	
function is_ajax() {
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}
?>
