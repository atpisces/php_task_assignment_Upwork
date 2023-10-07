<?php 

	// This file contains various functions of API Requests
	include("functions.php");

	if(!isset($_SESSION['USER_ACCESS_TOKEN'])){
		header("Location: index.php");
	}

	if(isset($_REQUEST["authorID"])){
		$authorID = $_REQUEST["authorID"];

		// Deleting an Author via API call
		$deleteAuthor = apiCall("delete", "authors", "DELETE", $authorID);
		echo '<h2 style="color: green;" align="center">Author Deleted Successfully.</h2><hr />';
	}

	// Calling a common function placed in [functions.php] to get Authors List
	$params = 'orderBy=id&direction=ASC&limit=12&page=1';
	$authorsList = apiCall("list", "authors", "GET", $params);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Authors List</title>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>

	<div class="container">
		<br>
		<?php echo $logoutButton; ?>
		<h1>Logged In User>> [Frist Name: <u class="text-primary"><?php echo $_SESSION["USER_FIRST"]; ?></u>], [Last Name: <u class="text-primary"><?php echo $_SESSION["USER_LAST"]; ?>]</u> </h1>
		<hr />
		<h2>Authors List</h2>

		<table class="table table-striped">
			<thead>
				<tr>
					<th>ID</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Birthday</th>
					<th>Gender</th>
					<th>Place of Birth</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
		<?php
			foreach($authorsList["items"] as $author){
		?>
				<tr>
					<td><?php echo $author["id"]; ?></td>
					<td><?php echo $author["first_name"]; ?></td>
					<td><?php echo $author["last_name"]; ?></td>
					<td><?php echo date("d-m-Y", strtotime($author["birthday"])); ?></td>
					<td><?php echo $author["gender"]; ?></td>
					<td><?php echo $author["place_of_birth"]; ?></td>
					<td>
						<a href="authors.php?authorID=<?php echo $author["id"]; ?>" onclick="return confirm('Are you sure, you want to delete this author?');" class="btn btn-danger">Delete Author</a>
						<br>
						<a href="author_details.php?authorID=<?php echo $author["id"]; ?>" target="_blank" class="btn btn-warning">View Author Details</a>
					</td>
				</tr>
		<?php
			}
		?>
			</tbody>
		</table>
	</div>

</body>
</html>