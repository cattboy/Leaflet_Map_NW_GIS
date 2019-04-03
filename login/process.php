<?php 

	// Include config file
	require_once 'config.php';
   	// include("config.php");
   	// session_start();

	// Get values passed from form in login.php file
	$username = $_POST['username'];
	$password = $_POST['password'];
	$alpha_access_nda = true;

	// To prevent mysql injection
	$username = stripcslashes($username);
	$password = stripcslashes($password);

	// Connect to the server and select database
	$dblink = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("Unable to Connect to '$dbhost'".mysql_error());

	// To prevent mysql injection
	$username = mysqli_real_escape_string($dblink, $username);
	$password = mysqli_real_escape_string($dblink, $password);

	// Query the database for user
	$query_users_table = "select * from login where username = '$username' and password = '$password'";
	$result = mysqli_query($dblink, $query_users_table)
		or die("Failed to query database".mysql_error());
	$row = mysqli_fetch_array($result);


	//Login good
	if ($row['username'] == $username && $row['password'] == $password && $row['alpha_access_nda'] == $alpha_access_nda) {
		echo "Login successful! <br />\n Welcome to New World map project " . $username . " !<br />\n";

		//Go to map here
		$_SESSION['logged_in'] = true;
		header("Location: success.php");






	} 
	//Login good but No alpha access
	elseif ($row['username'] == $username && $row['password'] == $password && $row['alpha_access_nda'] != $alpha_access_nda) {
		echo "Thanks for registering but you don't have Alpha access you slimey dawg! Make sure to sign up for alpha access on the new world site: <br />\n <br />\n <a href='https://www.amazon.com/dp/B07GB3ZV9M' target='_blank'>Alpha Sign Up Here</a>";
	}
	//Catch all Bad Pass usually or no account on website
	else {
		echo "Wrong username and/or password... Remember you need to make an account for this website AND you need Alpha Access to see whats behind door number 1! <br />\n <br />\n<a href='https://www.amazon.com/dp/B07GB3ZV9M' target='_blank'>Alpha Sign Up Here</a>";
	}
	
?>
