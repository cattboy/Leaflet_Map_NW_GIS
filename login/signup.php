<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>New World Map Signup Page</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
	<link rel="stylesheet" type="text/css" href="includes/style.css">
</head>
<body>
	<div class="signup-form">
		<form action="includes/process_signup.php" method="POST">
            <h2 class="text-center">Create account</h2>       
            <div class="form-group">
				<input type="text" class="form-control" placeholder="Username" id="username" name="username" required="required">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" id="password" name="password" required="required">
            </div>
			<div class="form-group">
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Re-type Password" id="password_retype" name="password_retype" required="required">
            </div>
			<div class="form-group">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Email" id="email" name="email" required="required">
            </div>
			<div class="form-group">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="New World Alpha Forum Name" id="forum_name" name="forum_name" required="required">
            </div>
			<div class="form-group">							
                <button type="submit" class="btn btn-primary btn-block" id="btn" name="signup-submit">Sign Up!</button>
            </div>
            <div class="clearfix">
                <a href="#" class="pull-right">Forgot Password?</a>
            </div>        
        </form>
        <p class="text-center"><a href="login.php">Return to Login</a></p>
    </div>
</body>
</html>