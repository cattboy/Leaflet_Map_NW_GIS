<?php 
	if (isset($_POST['signup-submit']))
	{
		// Include config file
		require_once 'config.php';
	   	// include("config.php");
	   	// session_start();

		// Get values passed from form in login.php file
		$username = $_POST['username'];
		$password = $_POST['password'];
		$password_retype = $_POST['password_retype'];
		$email = $_POST['email'];
		$forum_name = $_POST['forum_name'];

	 

		// To prevent mysql injection
		$username = stripcslashes($username);
		$password = stripcslashes($password);
		$password_retype = stripcslashes($password_retype);
		$email = stripcslashes($email);
		$forum_name = stripcslashes($forum_name);


		//check if empty
		if (empty($username) || empty($password) || empty($password_retype) || empty($email) || empty($forum_name))	{
			//bring user back to signupform and bring back data they used
			header("Location: ../signup.php?error=emptyfields&username=".$username."&mail=".$email);
			//exits and stops the rest of the code
			exit();

		}
		// check for valid email AND username
		else if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-z0-9]*$/", $username))	{
			header("Location: ../signup.php?error=invalidemailusername");
			exit();
		}		
		//Validation on email to make sure its proper
		else if(!filter_var($email, FILTER_VALIDATE_EMAIL))	{
			header("Location: ../signup.php?error=invalidemail&username=".$username);
			exit();
		}
		//Validate the username is proper characters
		else if(!preg_match("/^[a-zA-z0-9]*$/", $username))	{
			header("Location: ../signup.php?error=username&email=".$email);
			exit();
		}	
		//check if passwords match if not reject and ask again
		else if($password !== $password_retype)	{
			header("Location: ../signup.php?error=passwordcheck&username=".$username."&mail=".$email);
			exit();
		}
		//is the username already in the database?
		else
		{
			//Check con
			$dblink = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("DB Connection Failed. Config error".mysqli_connect_error());
			$sql = "SELECT username FROM login where username=?";
			$stmt = mysqli_stmt_init($dblink);
			if (!mysqli_stmt_prepare($stmt, $sql)){
				header("Location: ../signup.php?error=sqlerroronSTMT");
				exit();
			}
			else{
				//This will bind username to the ? field in the sql statment
				mysqli_stmt_bind_param($stmt, "s", $username);
				//Execute
				mysqli_stmt_execute($stmt);
				//Stores results form the query
				mysqli_stmt_store_result($stmt);
				//Check how many rows returned
				$resultCheck = mysqli_stmt_num_rows($stmt);
				//If this username exsists, it will need to send user back
				if ($resultCheck > 0){ 
					header("Location: ../signup.php?error=usernameTaken".$email);
					exit();					
				}
				else
				{
					$sql = "INSERT INTO login (username, password, email, forum_name) VALUES (?, ?, ?, ?)";
					$stmt = mysqli_stmt_init($dblink);
					if (!mysqli_stmt_prepare($stmt, $sql)){
						header("Location: ../signup.php?error=sqlerroronSTMT2");
						exit();
					}
					else{
						//This will hash the password to store in the database
						$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

						mysqli_stmt_bind_param($stmt, "ssss", $username, $hashedPassword, $email, $forum_name);
						mysqli_stmt_execute($stmt);
						//User created account successfully
						header("Location: ../signup.php?signup=success");
						exit();
					}

				}

			}
		}
		//Close all open connections
		mysqli_stmt_close($stmt);
		mysqli_close($dblink);
	}
	//If user gets here without clicking the button we need to send them back to the signup
	else{
		header("Location: ../signup.php");
		exit();
	}
?>
