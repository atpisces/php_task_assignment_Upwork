<?php 

	// This file contains various functions of API Requests
	include("functions.php");

	if(!isset($_SESSION['USER_ACCESS_TOKEN'])){
		header("Location: index.php");
	}

	// Adding New Book via API
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

	    $book_author = $_POST["book_author"];
	    $book_title = $_POST["book_title"];
	    $book_date = $_POST["book_date"];
	    $book_description = $_POST["book_description"];
	    $book_isbn = $_POST["book_isbn"];
	    $book_format = $_POST["book_format"];
	    $no_of_pages = $_POST["no_of_pages"];

	    $api_url = 'https://candidate-testing.api.royal-apps.io/api/v2/books'; // API endpoint

	    $data = array(
	    	'author' => array(
	    				'id' => $book_author
	    			),
	        'title' => $book_title,
	        'release_date' => $book_date,
	        'description' => $book_description,
	        'isbn' => $book_isbn,
	        'format' => $book_format,
	        'number_of_pages' => (int)$no_of_pages
	    );

	    $ch = curl_init($api_url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_POST, true);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
	    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	        'Content-Type: application/json',
	        'Accept: application/json',
	        'Authorization: Bearer bf9ed30f7a6835a9925c046731cfaca43eba4437f17735cb792901bddf813d7f91a2122face91429'
	    ));

	    $response = curl_exec($ch);

	    curl_close($ch);

	    $response_data = json_decode($response, true);

	    if(isset($response_data["id"])){
	    	echo '<h2 style="color: green;" align="center">New Book Added Successfully.</h2><hr />';
	    }
	}

	// Calling a common function placed in [functions.php] to get Authors List
	$params = 'orderBy=id&direction=ASC&limit=12&page=1';
	$authorsList = apiCall("list", "authors", "GET", $params);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add New Book | Candidate Testing API</title>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>

	<div class="container" style="margin-bottom: 200px;">
		<br>
		<?php echo $logoutButton; ?>
		<h2>Add New Book | Candidate Testing API</h2>
		<br>
		<a href="author_details.php?authorID=<?php echo $_REQUEST["authorID"]; ?>" class="btn btn-primary">< Back to Author Details</a>
		<br><br><br>
		<form name="LoginForm" method="post" >
			<label>Book Author:</label>
			<select name="book_author" class="form-control" required>
				<option value="">-- Select Author --</option>
		<?php foreach($authorsList["items"] as $author){ ?>
				<option value="<?php echo $author["id"]; ?>"><?php echo $author["first_name"]." ".$author["last_name"]; ?></option>
		<?php } ?>
			</select>
			<br>
			<label>Book Title:</label>
			<input type="text" name="book_title" class="form-control" placeholder="Book Title" required />
			<br>
			<label>Release Date:</label>
			<input type="datetime-local" name="book_date" class="form-control" required>
			<br>
			<label>Description:</label><br>
			<textarea name="book_description" class="form-control" placeholder="Book description goes here..." rows="8" cols="50" required></textarea>
			<br>
			<label>ISBN:</label>
			<input type="text" name="book_isbn" class="form-control" placeholder="Book ISBN" required>
			<br>
			<label>Format:</label>
			<input type="text" name="book_format" class="form-control" placeholder="Book Format" required>
			<br>
			<label>No. of Pages:</label>
			<input type="number" min="1" name="no_of_pages" class="form-control" placeholder="No. of Pages" required>
			<br>
			<button type="submit" name="NewBookBtn" class="btn btn-success">Add New Book</button>
		</form>
	</div>

</body>
</html>