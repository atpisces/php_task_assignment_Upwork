<?php

	// This file contains various functions of API Requests
	include("functions.php");

	if(!isset($_SESSION['USER_ACCESS_TOKEN'])){
		header("Location: index.php");
	}

	// Delete a Book
	if(isset($_REQUEST["bookID"])){
		$bookID = $_REQUEST["bookID"];

		// Calling a common function placed in [functions.php] to delete Book 
		$deleteBook = apiCall("delete", "books", "DELETE", $bookID);
		echo '<h2 style="color: red;" align="center">Book Deleted Successfully.</h2><hr />';

	}

	if(isset($_REQUEST["authorID"])){
		$authorID = $_REQUEST["authorID"];

		// Calling a common function placed in [functions.php] to get Author Details 
		$authorDetails = apiCall("get_details", "authors", "GET", $authorID);
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Authors Details</title>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<br>
		<?php echo $logoutButton; ?>
		<h2>Authors Details</h2>
		<hr />

		<table class="table table-bordered">
			<tbody>
				<tr>
					<td><a href="authors.php" class="btn btn-primary">< Back to All Authors</a></td>
					<td align="right"><a href="add_new_book.php?authorID=<?php echo $authorDetails["id"]; ?>" class="btn btn-success">Add New Book</a></td>
				</tr>
				<tr>
					<td align="left">
						<b>ID: </b><?php echo $authorDetails["id"]; ?><br>
						<b>First Name: </b><?php echo $authorDetails["first_name"]; ?><br>
						<b>Last Name: </b><?php echo $authorDetails["last_name"]; ?><br>
						<b>Birthday: </b><?php echo date("d-m-Y", strtotime($authorDetails["birthday"])); ?><br>
						<b>Gender: </b><?php echo $authorDetails["gender"]; ?><br>
						<b>Place of Birth: </b><?php echo $authorDetails["place_of_birth"]; ?><br>
					</td>
					<td align="left">
						<b>Biography: </b><?php echo $authorDetails["biography"]; ?>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<b>Author Books</b>
						<hr />
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>ID</th>
									<th>Title</th>
									<th>Release Date</th>
									<th>Description</th>
									<th>ISBN</th>
									<th>Format</th>
									<th>Number of Pages</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
					<?php   foreach($authorDetails["books"] as $book){ ?>
								<tr>
									<td><?php echo $book["id"]; ?></td>
									<td><?php echo $book["title"]; ?></td>
									<td><?php echo date("d-m-Y", strtotime($book["release_date"])); ?></td>
									<td><?php echo $book["description"]; ?></td>
									<td><?php echo $book["isbn"]; ?></td>
									<td><?php echo $book["format"]; ?></td>
									<td><?php echo $book["number_of_pages"]; ?></td>
									<td><a href="author_details.php?authorID=<?php echo $authorDetails["id"]; ?>&bookID=<?php echo $book["id"]; ?>" onclick="return confirm('Are you sure, you want to delete this book?');" class="btn btn-danger">Delete Book</a></td>
								</tr>
					<?php   } ?>
							</tbody>
						</table>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</body>
</html>