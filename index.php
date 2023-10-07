<?php 

	// This file contains various functions of API Requests
	include("functions.php");

	if(isset($_SESSION['USER_ACCESS_TOKEN'])){
		header("Location: authors.php");
	}


	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$email = $_POST["user_email"];
	    $password = $_POST["user_password"];

	    // Calling function to login via API [function.php]
	    loginApiCall($email, $password);
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Page | Candidate Testing API</title>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>

	<div class="container">
		<h2>Login Page | Candidate Testing API</h2>
		<br>
		<form name="LoginForm" method="post">
			<label>Your Valid Email:</label>
			<input type="text" name="user_email" class="form-control" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" required />
			<br>
			<label>Your Password:</label>
			<input type="password" name="user_password" class="form-control" required="">
			<br>
			<button type="submit" name="LoginBtn" class="btn btn-success">Login via API</button>
		</form>
	</div>

</body>
</html>